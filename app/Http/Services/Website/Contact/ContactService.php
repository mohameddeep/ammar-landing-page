<?php

namespace App\Http\Services\Website\Contact;

use App\Repository\ContactUsRepositoryInterface;
use App\Repository\StructureRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\Log;

class ContactService
{
    public function __construct(
        private readonly ContactUsRepositoryInterface $contactRepository,
        private readonly StructureRepositoryInterface $structureRepository,
    ) {}


    public function index()
    {
        // Fetch Footer structure content
        $footerStructure = $this->structureRepository->structure('footer');
        $footerContent = null;
        if ($footerStructure && $footerStructure->content) {
            $footerContent = json_decode($footerStructure->content, true);
        }

        return view('website.contact', compact('footerContent'));
    }

    /**
     * Store contact form submission
     *
     * @param array $data
     * @return array
     */
    public function store(array $data): array
    {
        try {
            // Remove _token if present
            unset($data['_token']);
            
            $contactData = [
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'subject' => $data['subject'] ?? null,
                'message' => $data['message'],
            ];
            
            Log::info('Contact form submission attempt', ['data' => $contactData]);
            
            // Try to create contact directly using model
            $contactModel = \App\Models\ContactUs::create($contactData);

            if ($contactModel && $contactModel->id) {
                Log::info('Contact form submitted successfully', ['contact_id' => $contactModel->id]);
                return [
                    'success' => true,
                    'message' => __('website.contactSuccessMessage'),
                ];
            }

            Log::error('Contact form submission: create failed', [
                'contactModel' => $contactModel ? get_class($contactModel) : 'null',
                'contactData' => $contactData
            ]);
            
            return [
                'success' => false,
                'message' => __('website.contactErrorMessage'),
            ];
        } catch (Exception $e) {
            Log::error('Contact form submission error: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
                'data' => $data
            ]);
            
            return [
                'success' => false,
                'message' => __('website.contactErrorMessage'),
            ];
        }
    }
}

