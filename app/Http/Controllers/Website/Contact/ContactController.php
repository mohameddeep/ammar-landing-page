<?php

namespace App\Http\Controllers\Website\Contact;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\Contact\ContactRequest;
use App\Http\Requests\Website\Contact\PricingQuoteRequest;
use App\Http\Services\Website\Contact\ContactService;
use Illuminate\Http\RedirectResponse;

class ContactController extends Controller
{
    public function __construct(
        private readonly ContactService $contactService,
    ) {}




    public function index()
    {
        return $this->contactService->index();
    }

    /**
     * Handle contact form submission
     *
     * @param ContactRequest $request
     * @return RedirectResponse
     */
    public function store(ContactRequest $request): RedirectResponse
    {
        $result = $this->contactService->store($request->validated());

        if ($result['success']) {
            return redirect()->back()->with('success', $result['message']);
        }

        return redirect()->back()
            ->with('error', $result['message'] ?? __('website.contactErrorMessage'))
            ->withInput();
    }

    public function storePricingQuote(PricingQuoteRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('attachment')) {
            $data['attachment_path'] = $request->file('attachment')->store('pricing-quotes', 'local');
        }

        $result = $this->contactService->storePricingQuote($data);

        if ($result['success']) {
            return redirect()->back()->with('success', $result['message']);
        }

        return redirect()->back()
            ->with('error', $result['message'] ?? __('website.contactErrorMessage'))
            ->withInput();
    }
}

