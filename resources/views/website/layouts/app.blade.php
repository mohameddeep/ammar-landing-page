@php
  use App\Repository\StructureRepositoryInterface;
  use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
  $currentLocale = LaravelLocalization::getCurrentLocale() ?? app()->getLocale() ?? 'ar';

  if (! isset($footerContent)) {
      $footerStructure = app(StructureRepositoryInterface::class)->structure('footer');
      $footerContent = null;
      if ($footerStructure && $footerStructure->content) {
          $footerContent = json_decode($footerStructure->content, true);
      }
  }

  // Logo uploaded from the dashboard footer settings wins; otherwise the official logo.
  $headerLogo = \App\Support\WebsiteImage::logo($footerContent['image'] ?? null);
  $headerWebsiteName = filled($footerContent['website_name'][$currentLocale] ?? null)
      ? $footerContent['website_name'][$currentLocale]
      : trans('website.companyName', [], $currentLocale);

  // Top-level services with their children: navbar dropdown + footer list.
  $navServices = app(\App\Repository\ServiceRepositoryInterface::class)->getActiveTopLevelWithChildren();
@endphp

@include('website.layouts.header', ['headerLogo' => $headerLogo, 'headerWebsiteName' => $headerWebsiteName, 'currentLocale' => $currentLocale, 'navServices' => $navServices])


@yield('content')

@stack('scripts')

@include('website.layouts.footer', ['footerContent' => $footerContent, 'currentLocale' => $currentLocale, 'navServices' => $navServices])
