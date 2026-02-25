<!-- Start::app-sidebar -->
<aside class="app-sidebar sticky" id="sidebar">

    <!-- Start::main-sidebar-header -->

    {{-- <div class="main-sidebar-header">
        <a href="{{ route('/') }}" class="header-logo">
            <img src="{{ asset('icons/logo.png') }}" alt="logo" class="desktop-logo">
            <img src="{{ asset('icons/logo.png') }}" alt="logo" class="toggle-logo">
            <img src="{{ asset('icons/logo.png') }}" alt="logo" class="desktop-dark">

            <img src="{{ asset(path: 'icons/logo.png') }}" alt="logo" class="toggle-dark">
        </a>
    </div> --}}
    <div class="main-sidebar-header">
        <a href="{{ url('/admin') }}" class="header-logo">
            @if(isset($dashboardLogo) && $dashboardLogo)
                <img src="{{ asset($dashboardLogo) }}" alt="{{ $dashboardWebsiteName ?? 'البناء المتقدم' }}" class="desktop-logo" style="max-height: 50px; width: auto;">
                <img src="{{ asset($dashboardLogo) }}" alt="{{ $dashboardWebsiteName ?? 'البناء المتقدم' }}" class="toggle-logo" style="max-height: 50px; width: auto;">
                <img src="{{ asset($dashboardLogo) }}" alt="{{ $dashboardWebsiteName ?? 'البناء المتقدم' }}" class="desktop-dark" style="max-height: 50px; width: auto;">
                <img src="{{ asset($dashboardLogo) }}" alt="{{ $dashboardWebsiteName ?? 'البناء المتقدم' }}" class="toggle-dark" style="max-height: 50px; width: auto;">
            @else
                <img src="{{ asset('icons/logo.png') }}" alt="logo" class="desktop-dark">
            @endif
        </a>
    </div>
    <!-- End::main-sidebar-header -->

    <!-- Start::main-sidebar -->
    <div class="main-sidebar" id="sidebar-scroll">

        <!-- Start::nav -->
        <nav class="main-menu-container nav nav-pills flex-column sub-open">
            <div class="slide-left" id="slide-left">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24"
                    viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path>
                </svg>
            </div>
            <ul class="main-menu">

                {{-- one slide dashboard --}}


                {{-- settings --}}



                <!-- Start::slide -->
                <li class="slide">
                    <a href="{{ url('/admin') }}" class="side-menu__item {{ request()->routeIs('/admin') ? 'active' : '' }}">
                        <i class="ti ti-dashboard side-menu__icon"></i>
                        <span class="side-menu__label">@lang('dashboard.Dashboard')</span>
                    </a>
                </li>
                {{-- end one slide dashboard --}}

                {{-- start edit admin profile --}}

                <li class="slide">
                    <a href="{{ route('admin-profile.edit', auth()->user()->id) }}"
                        class="side-menu__item {{ request()->routeIs('admin-profile.edit') ? 'active' : '' }}">
                        <i class="ti ti-user-circle side-menu__icon"></i>
                        <span class="side-menu__label">@lang('dashboard.Profile')</span>
                    </a>
                </li>


                {{-- end edit admin profile --}}




                <!-- Start::sliders -->
                <li class="slide">
                    <a href="{{ route('sliders.index') }}"
                        class="side-menu__item {{ request()->routeIs('sliders.index') ? 'active' : '' }}">
                        <i class="ti ti-slideshow side-menu__icon"></i>
                        <span class="side-menu__label">@lang('dashboard.sliders')</span>
                    </a>
                </li>
                <!-- End::sliders -->
                <!-- Start::about-us -->
                <li class="slide">
                    <a href="{{ route('abouts.index') }}"
                        class="side-menu__item {{ request()->routeIs('abouts.index') ? 'active' : '' }}">
                        <i class="ti ti-info-circle side-menu__icon"></i>
                        <span class="side-menu__label">@lang('dashboard.about_us')</span>
                    </a>
                </li>
                <!-- End::about-us -->
                <!-- End::orders -->
                <!-- Start::services -->
                <li class="slide">
                    <a href="{{ route('services.index') }}"
                        class="side-menu__item {{ request()->routeIs('services.index') ? 'active' : '' }}">
                        <i class="ti ti-briefcase side-menu__icon"></i>
                        <span class="side-menu__label">@lang('dashboard.services')</span>
                    </a>
                </li>
                <!-- End::services -->
                <!-- Start::contacts -->
                <li class="slide">
                    <a href="{{ route('contacts.index') }}"
                        class="side-menu__item {{ request()->routeIs('contacts.index') ? 'active' : '' }}">
                        <i class="ti ti-phone side-menu__icon"></i>
                        <span class="side-menu__label">@lang('dashboard.contacts')</span>
                    </a>
                </li>
                <!-- End::contacts -->



                <li
                    class="slide has-sub {{ in_array(request()->route()->getName(), ['about.index', 'terms_and_conditions.index', 'service_structure.index', 'policy.index']) ? 'open active' : '' }}">
                    <a href="javascript:void(0);" class="side-menu__item ">
                        <i class="bx bx-sitemap side-menu__icon"></i>
                        <span class="side-menu__label">@lang('dashboard.Structure')</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">

                        <li class="slide">
                            <a href="{{ route('about.index') }}"
                                class="side-menu__item {{ in_array(request()->route()->getName(), ['about.index']) ? 'active' : '' }}">
                                @lang('dashboard.about')
                            </a>
                        </li>
                        <li class="slide">
                            <a href="{{ route('service_structure.index') }}"
                                class="side-menu__item {{ in_array(request()->route()->getName(), ['service_structure.index']) ? 'active' : '' }}">
                                @lang('dashboard.services')
                            </a>
                        </li>


                        <li class="slide">
                            <a href="{{ route('terms_and_conditions.index') }}"
                                class="side-menu__item {{ in_array(request()->route()->getName(), ['terms_and_conditions.index']) ? 'active' : '' }}">
                                @lang('dashboard.terms_and_conditions')
                            </a>
                        </li>

                        <li class="slide">
                            <a href="{{ route('policy.index') }}"
                                class="side-menu__item {{ in_array(request()->route()->getName(), ['policy.index']) ? 'active' : '' }}">
                                @lang('dashboard.privacy_policy')
                            </a>
                        </li>
                        <li class="slide">
                            <a href="{{ route('footer.index') }}"
                                class="side-menu__item {{ in_array(request()->route()->getName(), ['footer.index']) ? 'active' : '' }}">
                                @lang('dashboard.footer')
                            </a>
                        </li>
                    </ul>
                </li>



            </ul>
            <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                    width="24" height="24" viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path>
                </svg>
            </div>
        </nav>
        <!-- End::nav -->

    </div>
    <!-- End::main-sidebar -->

</aside>
<!-- End::app-sidebar -->
