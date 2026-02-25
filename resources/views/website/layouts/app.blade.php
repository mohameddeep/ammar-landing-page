@php
  use App\Repository\StructureRepositoryInterface;
  use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
  $currentLocale = LaravelLocalization::getCurrentLocale() ?? app()->getLocale() ?? 'ar';
  
  // Fetch Footer structure content for footer and header layouts
  $footerStructure = app(StructureRepositoryInterface::class)->structure('footer');
  $footerContent = null;
  if ($footerStructure && $footerStructure->content) {
      $footerContent = json_decode($footerStructure->content, true);
  }
  
  // Extract header data from footer content
  $headerLogo = $footerContent['image'] ?? null;
  $headerWebsiteName = $footerContent['website_name'][$currentLocale] ?? ($footerContent['website_name']['ar'] ?? 'البناء المتقدم');
@endphp

@include('website.layouts.header', ['headerLogo' => $headerLogo, 'headerWebsiteName' => $headerWebsiteName, 'currentLocale' => $currentLocale])


@yield('content')

@stack('scripts')

@include('website.layouts.footer', ['footerContent' => $footerContent, 'currentLocale' => $currentLocale])
