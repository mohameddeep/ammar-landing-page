<?php

declare(strict_types=1);

namespace App\Http\Traits;

use Exception;
use Google\Client as GoogleClient;
use Illuminate\Support\Facades\Log;

trait SendNotification
{
    /**
     * Send a Firebase notification to multiple FCM tokens
     *
     * @param array $fcms Array of FCM tokens
     * @param string $title Notification title
     * @param string $body Notification body
     * @param array $data Additional data to send
     * @return array Results of sending notifications
     */
    public function sendFirebaseNotification(array $fcms, string $title, string $body, array $data = []): array
    {
        $results = [];

        try {
            $credentialsFilePath = public_path('json/allure.json');

            if (!file_exists($credentialsFilePath)) {
                throw new Exception("Firebase credentials file not found at {$credentialsFilePath}");
            }

            // Load Google client and generate access token
            $json = json_decode(file_get_contents($credentialsFilePath), true);
            $client = new GoogleClient();
            $client->setAuthConfig($json);
            $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
            $client->fetchAccessTokenWithAssertion();

            $token = $client->getAccessToken();
            $access_token = $token['access_token'] ?? null;

            if (!$access_token) {
                throw new Exception('No access token retrieved from Google Client.');
            }

            // 🔹 Flatten data (convert to simple key-value)
            $flattenedData = $this->flattenData($data);

            foreach ($fcms as $fcm) {
                // base message
                $message = [
                    'token' => $fcm,
                    'notification' => [
                        'title' => $title,
                        'body'  => $body,
                    ],
                ];

                // 🔸 Add data only if not empty
                if (!empty($flattenedData)) {
                    $message['data'] = $flattenedData;
                }

                $payload = ['message' => $message];

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/v1/projects/allure-app-4ebf8/messages:send');
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, [
                    'Authorization: Bearer ' . $access_token,
                    'Content-Type: application/json',
                ]);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));

                $response = curl_exec($ch);
                $err = curl_error($ch);
                curl_close($ch);

                if ($err) {
                    $results[] = ['token' => $fcm, 'error' => $err];
                } else {
                    $results[] = ['token' => $fcm, 'response' => json_decode($response, true)];
                }
            }
        } catch (Exception $e) {
            Log::error('Firebase notification failed: ' . $e->getMessage());
            $results[] = ['error' => $e->getMessage()];
        }

        return $results;
    }

    /**
     * Flatten nested arrays to a simple one-dimensional string map
     */
    private function flattenData(array $data, string $prefix = ''): array
    {
        $result = [];

        foreach ($data as $key => $value) {
            $newKey = $prefix ? "{$prefix}_{$key}" : $key;

            if (is_array($value)) {
                $result = array_merge($result, $this->flattenData($value, $newKey));
            } else {
                $result[$newKey] = (string) $value; // ✅ Firebase requires strings
            }
        }

        return $result;
    }

    
}
