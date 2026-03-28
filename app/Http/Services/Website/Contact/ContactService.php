<?php

namespace App\Http\Services\Website\Contact;

use App\Repository\ContactUsRepositoryInterface;
use App\Support\StructureContent;
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
        $footerContent = StructureContent::decode($this->structureRepository->structure('footer'));

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

    /**
     * Store pricing quote request (same storage as contact; structured body in message).
     *
     * @param  array<string, mixed>  $data
     * @return array{success: bool, message: string}
     */
    public function storePricingQuote(array $data): array
    {
        try {
            unset($data['_token'], $data['pricing_form'], $data['attachment']);

            $types = $data['project_types'] ?? [];
            $labels = array_map(fn (string $slug) => $this->pricingProjectTypeLabel($slug), $types);

            $sep = app()->getLocale() === 'ar' ? '، ' : ', ';
            $lines = [
                '--- '.__('website.pricingQuoteMessageHeader').' ---',
                __('website.pricingQuoteLabelTypes').': '.implode($sep, $labels),
                __('website.pricingQuoteLabelSpace').': '.$data['project_space'],
                __('website.pricingQuoteLabelCity').': '.$data['city'],
            ];
            if (! empty($data['notes'])) {
                $lines[] = __('website.pricingQuoteLabelNotes').': '.$data['notes'];
            }
            if (! empty($data['attachment_path'])) {
                $lines[] = __('website.pricingQuoteLabelAttachment').': '.$data['attachment_path'];
            }

            $message = implode("\n", $lines);

            $contactData = [
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'subject' => __('website.pricingQuoteSubject'),
                'message' => $message,
            ];

            Log::info('Pricing quote submission attempt', [
                'name' => $contactData['name'],
                'email' => $contactData['email'],
            ]);

            $contactModel = \App\Models\ContactUs::create($contactData);

            if ($contactModel && $contactModel->id) {
                Log::info('Pricing quote submitted', ['contact_id' => $contactModel->id]);

                return [
                    'success' => true,
                    'message' => __('website.pricingQuoteSuccess'),
                ];
            }

            return [
                'success' => false,
                'message' => __('website.contactErrorMessage'),
            ];
        } catch (Exception $e) {
            Log::error('Pricing quote error: '.$e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            return [
                'success' => false,
                'message' => __('website.contactErrorMessage'),
            ];
        }
    }

    private function pricingProjectTypeLabel(string $slug): string
    {
        return match ($slug) {
            'residential_building' => __('website.pricingTypeResidential'),
            'commercial_showrooms' => __('website.pricingTypeCommercial'),
            'villa' => __('website.pricingTypeVilla'),
            'warehouses' => __('website.pricingTypeWarehouses'),
            'other' => __('website.pricingTypeOther'),
            'tourism' => __('website.pricingTypeTourism'),
            'hospital' => __('website.pricingTypeHospital'),
            'hotel' => __('website.pricingTypeHotel'),
            default => $slug,
        };
    }
}

