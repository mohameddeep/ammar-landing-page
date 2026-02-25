@php 
use Illuminate\Support\Facades\Session;
use App\Repository\StructureRepositoryInterface;

// Fetch Footer structure content for logo
$footerStructure = app(StructureRepositoryInterface::class)->structure('footer');
$dashboardLogo = null;
$dashboardWebsiteName = 'البناء المتقدم';
if ($footerStructure && $footerStructure->content) {
    $footerContent = json_decode($footerStructure->content, true);
    $dashboardLogo = $footerContent['image'] ?? null;
    $currentLocale = app()->getLocale() ?? 'ar';
    $dashboardWebsiteName = $footerContent['website_name'][$currentLocale] ?? ($footerContent['website_name']['ar'] ?? 'البناء المتقدم');
}
@endphp
<!DOCTYPE html>
{{-- <html lang="{{ app()->getLocale() }}" @if (app()->getLocale() == 'ar') id="rtl" @endif> --}}
{{-- romio --}}
<html dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" lang="{{ app()->getLocale() }}"
    {{-- class="{{ app()->getLocale() === 'ar' ? 'direction-rtl' : 'direction-ltr' }}"  --}}
    data-nav-layout="vertical"
    data-theme-mode="light" data-header-styles="light" data-menu-styles="dark" data-toggled="close">

@include('dashboard.core.tags.head')

<body>
    <div class="page">
        @include('dashboard.core.includes.header', ['dashboardLogo' => $dashboardLogo, 'dashboardWebsiteName' => $dashboardWebsiteName])

        @include('dashboard.core.includes.sidebar', ['dashboardLogo' => $dashboardLogo, 'dashboardWebsiteName' => $dashboardWebsiteName])

        <div class="main-content app-content">
            @yield('content')
        </div>

        @include('dashboard.core.includes.footer')
    </div>
    <div class="scrollToTop">
        <span class="arrow"><i class="ri-arrow-up-s-fill fs-20"></i></span>
    </div>
    <div id="responsive-overlay"></div>
    @include('dashboard.core.tags.scripts')

    @if (Session::has('success'))
        @include('dashboard.core.alerts.sweet-alert.success')
    @endif

    @if ($errors->any())
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                @foreach ($errors->all() as $error)
                    toastr.error({!! json_encode($error) !!}, '', {
                        positionClass: 'toast-top-right',
                        timeOut: 5000,
                        progressBar: true,
                        closeButton: true
                    });
                @endforeach
            });
        </script>
    @endif



</body>

</html>
