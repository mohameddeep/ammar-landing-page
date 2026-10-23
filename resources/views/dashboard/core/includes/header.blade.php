<!-- app-header -->
<header class="app-header">

    <!-- Start::main-header-container -->
    <div class="main-header-container container-fluid">

        <!-- Start::header-content-left -->
        <div class="header-content-left">

            <!-- Start::header-element -->
            <div class="header-element">
                <div class="horizontal-logo">
                    <a href="{{ url('/admin') }}" class="header-logo">
                        @if(isset($dashboardLogo) && $dashboardLogo)
                            <img src="{{ asset($dashboardLogo) }}" alt="{{ $dashboardWebsiteName ?? __('website.companyName') }}"
                                class="desktop-logo" style="max-height: 40px; width: auto;">
                            <img src="{{ asset($dashboardLogo) }}" alt="{{ $dashboardWebsiteName ?? __('website.companyName') }}"
                                class="toggle-logo" style="max-height: 40px; width: auto;">
                            <img src="{{ asset($dashboardLogo) }}" alt="{{ $dashboardWebsiteName ?? __('website.companyName') }}"
                                class="desktop-dark" style="max-height: 40px; width: auto;">
                            <img src="{{ asset($dashboardLogo) }}" alt="{{ $dashboardWebsiteName ?? __('website.companyName') }}"
                                class="toggle-dark" style="max-height: 40px; width: auto;">
                        @else
                            <img src="{{ asset(\App\Support\WebsiteImage::LOGO_LIGHT) }}" alt="{{ $dashboardWebsiteName ?? __('website.companyName') }}" class="desktop-logo" style="max-height: 40px; width: auto;">
                            <img src="{{ asset(\App\Support\WebsiteImage::MARK) }}" alt="{{ $dashboardWebsiteName ?? __('website.companyName') }}" class="toggle-logo" style="height: 36px; width: 36px;">
                            <img src="{{ asset(\App\Support\WebsiteImage::LOGO) }}" alt="{{ $dashboardWebsiteName ?? __('website.companyName') }}" class="desktop-dark" style="max-height: 40px; width: auto;">
                            <img src="{{ asset(\App\Support\WebsiteImage::MARK) }}" alt="{{ $dashboardWebsiteName ?? __('website.companyName') }}" class="toggle-dark" style="height: 36px; width: 36px;">
                        @endif
                    </a>
                </div>
            </div>
            <!-- End::header-element -->

            <!-- Start::header-element -->
            <div class="header-element">
                <!-- Start::header-link -->
                <a aria-label="Hide Sidebar"
                    class="sidemenu-toggle header-link animated-arrow hor-toggle horizontal-navtoggle"
                    data-bs-toggle="sidebar" href="javascript:void(0);"><span></span></a>
                <!-- End::header-link -->
            </div>
            <!-- End::header-element -->

        </div>
        <!-- End::header-content-left -->

        <!-- Start::header-content-right -->
        <div class="header-content-right">

            <!-- Start::header-element -->
            <div class="header-element country-selector">
                <!-- Start::header-link|dropdown-toggle -->
                <a href="javascript:void(0);" class="header-link dropdown-toggle" data-bs-auto-close="outside"
                    data-bs-toggle="dropdown">
                    <i class="ti ti-language fs-5"></i>
                </a>
                <!-- End::header-link|dropdown-toggle -->

                <ul class="main-header-dropdown dropdown-menu dropdown-menu-end">

                    @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <a rel="alternate" hreflang="{{ $localeCode }}"
                            href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                            class="dropdown-item">
                            <div class="media">
                                <div class="media-body">
                                    <h6 class="dropdown-item-title">
                                        {{ $properties['native'] }}
                                    </h6>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                    @endforeach

                </ul>
                <!-- End::Dropdown Menu -->
            </div>
            <!-- End::header-element -->

            <!-- Start::header-element -->
            <div class="header-element header-theme-mode">
                <!-- Start::header-link|layout-setting -->
                {{-- <a href="javascript:void(0);" class="header-link layout-setting">
                    <span class="light-layout">
                        <!-- Start::header-link-icon -->
                        <i class="bx bx-moon header-link-icon"></i>
                        <!-- End::header-link-icon -->
                    </span>
                    <span class="dark-layout">
                        <!-- Start::header-link-icon -->
                        <i class="bx bx-sun header-link-icon"></i>
                        <!-- End::header-link-icon -->
                    </span>
                </a> --}}
                <!-- End::header-link|layout-setting -->
            </div>
            <!-- End::header-element -->


            <!-- Start::header-element -->
          
            <!-- End::header-element -->


            <!-- Start::header-element -->
            <div class="header-element  me-3">
                <!-- Start::header-link|dropdown-toggle -->
                <a href="#" class="header-link dropdown-toggle" id="mainHeaderProfile" data-bs-toggle="dropdown"
                    data-bs-auto-close="outside" aria-expanded="false">
                    <div class="d-flex align-items-center">
                        {{-- <div class="me-sm-2 me-0">
                            @if (Auth::user()->image)
                                <img src="@image(Auth::user()->image)" alt="img" width="32" height="32"
                                    class="rounded-circle">
                            @else
                                <img src="{{ asset('img/user2-160x160.jpg') }}" alt="img" width="32"
                                    height="32" class="rounded-circle">
                            @endif
                        </div> --}}
                        <div class="d-sm-block d-none">
                            <p class="fw-semibold mb-0 lh-1">{{ auth()->user()->name }} </p>
                        </div>
                    </div>
                </a>
                <!-- End::header-link|dropdown-toggle -->
                <ul class="main-header-dropdown dropdown-menu pt-0 overflow-hidden header-profile-dropdown dropdown-menu-end"
                    aria-labelledby="mainHeaderProfile">
                    <li>
                        <a class="dropdown-item d-flex" href="{{ route('admin-profile.edit', auth()->user()->id) }}">
                            <i class="ti ti-user-circle fs-18 me-2 op-7"></i>
                            {{ __('dashboard.Profile') }}
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item d-flex" href="{{ route('auth.logout') }}">
                            <i class="ti ti-logout fs-18 me-2 op-7"></i>
                            {{ __('dashboard.Logout') }}
                        </a>
                    </li>

                </ul>
            </div>
            <!-- End::header-element -->


        </div>
        <!-- End::header-content-right -->

    </div>
    <!-- End::main-header-container -->

</header>
<!-- /app-header -->
