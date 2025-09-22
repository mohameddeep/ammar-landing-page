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
        <a href="{{ route('/') }}" class="header-logo">
            {{-- <img src="{{ asset('icons/logo.png') }}" alt="logo" class="desktop-logo" style="width: 80px; height: auto;">
            <img src="{{ asset('icons/logo.png') }}" alt="logo" class="toggle-logo"
                style="width: 80px; height: auto;"> --}}
            <img src="{{ asset('icons/logo.png') }}" alt="logo" class="desktop-dark">
            {{-- <img src="{{ asset(path: 'icons/logo.png') }}" alt="logo"
                class="toggle-dark"style="width: 80px; height: auto;"> --}}
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
                    <a href="{{ url('/') }}" class="side-menu__item {{ request()->routeIs('/') ? 'active' : '' }}">
                        <i class="ti ti-dashboard side-menu__icon"></i>
                        <span class="side-menu__label">@lang('dashboard.Dashboard')</span>
                    </a>
                </li>
                {{-- end one slide dashboard --}}

                {{-- nested slide slide users --}}
                <li
                    class="slide has-sub {{ in_array(request()->route()->getName(), [
                        'users.index',
                        'users.create',
                        'users.edit',
                        'users.show',
                        // 'roles.index',
                        // 'roles.create',
                        // 'roles.edit',
                        // 'roles.mangers',
                        'managers.edit',
                        'managers.create',
                    ])
                        ? 'open active'
                        : '' }}">
                    <a href="javascript:void(0);" class="side-menu__item ">
                        <i class="ri ri-user-settings-line side-menu__icon"></i>
                        <span class="side-menu__label">@lang('dashboard.User Management')</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        <li class="slide side-menu__label1">
                            <a href="javascript:void(0)">@lang('dashboard.Users')</a>
                        </li>

                        <li class="slide">
                            <a href="{{ route('users.index') }}"
                                class="side-menu__item {{ in_array(request()->route()->getName(), ['users.index', 'users.create', 'users.edit', 'users.show'])
                                    ? 'active'
                                    : '' }}">
                                @lang('dashboard.users')
                            </a>
                        </li>

                    
                            <li class="slide">
                                <a href="{{ route('providers.index') }}"
                                    class="side-menu__item {{ in_array(request()->route()->getName(), [
                                        'providers.index',
                                      
                                    ])
                                        ? 'active'
                                        : '' }}">
                                    @lang('dashboard.providers')
                                </a>
                            </li>
                    </ul>

                </li>
                {{-- end nested slide slide users --}}






                {{-- start commission --}}
                <li class="slide">
                    <a href="{{ route('commissions.index') }}"
                        class="side-menu__item {{ in_array(request()->route()->getName(), ['commissions.index', 'commissions.edit']) ? 'active' : '' }}">
                        <i class="ti ti-cash side-menu__icon"></i>
                        <span class="side-menu__label">@lang('dashboard.commissions')</span>
                    </a>
                </li>
                {{-- end commission --}}


                {{-- start packages --}}
                <li class="slide">
                    <a href="{{ route('packages.index') }}"
                        class="side-menu__item {{ in_array(request()->route()->getName(), ['packages.index', 'packages.edit', 'packages.create']) ? 'active' : '' }}">
                        <i class="ti ti-package side-menu__icon"></i>
                        <span class="side-menu__label">@lang('dashboard.packages')</span>
                    </a>
                </li>
                {{-- end packages --}}



                {{-- start categories --}}
                <li class="slide">
                    <a href="{{ route('categories.index') }}"
                        class="side-menu__item {{ in_array(request()->route()->getName(), ['categories.index', 'categories.edit', 'categories.create']) ? 'active' : '' }}">
                        <i class="bx bx-grid-alt side-menu__icon"></i>
                        <span class="side-menu__label">@lang('dashboard.categories')</span>
                    </a>
                </li>
                {{-- end categories --}}
                {{-- start products --}}
                <li class="slide">
                    <a href="{{ route('dashboard.products.index') }}"
                        class="side-menu__item {{ in_array(request()->route()->getName(), ['dashboard.products.index']) ? 'active' : '' }}">
                        <i class="bx bx-grid-alt side-menu__icon"></i>
                        <span class="side-menu__label">@lang('dashboard.products')</span>
                    </a>
                </li>
                {{-- end products --}}

                <!-- Start::coupons -->
                <li class="slide">
                    <a href="{{ route('coupons.index') }}"
                        class="side-menu__item {{ request()->routeIs('coupons.index') ? 'active' : '' }}">
                        <i class="ti ti-discount-2 side-menu__icon"></i>
                        <span class="side-menu__label">@lang('dashboard.coupons')</span>
                    </a>
                </li>
                <!-- End::coupons -->

                
                   {{-- start subscriptions --}}
                <li class="slide">
                    <a href="{{ route('subscriptions.index') }}"
                        class="side-menu__item {{ in_array(request()->route()->getName(), ['subscriptions.index']) ? 'active' : '' }}">
                        <i class="ti ti-package side-menu__icon"></i>
                        <span class="side-menu__label">@lang('dashboard.subscriptions')</span>
                    </a>
                </li>
                {{-- end subscriptions --}}

                <!-- Start::sliders -->
                <li class="slide">
                    <a href="{{ route('sliders.index') }}"
                        class="side-menu__item {{ request()->routeIs('sliders.index') ? 'active' : '' }}">
                        <i class="ti ti-photo side-menu__icon"></i>
                        <span class="side-menu__label">@lang('dashboard.sliders')</span>
                    </a>
                </li>
                <!-- End::orders -->




                <!-- Start::coupons -->
                <li class="slide">
                    <a href="{{ route('calendar.index') }}" class="side-menu__item ">
                        <i class="ti ti-discount-2 side-menu__icon"></i>
                        <span class="side-menu__label">@lang('dashboard.calendar')</span>
                    </a>
                </li>
                <!-- End::coupons -->

                <li class="slide">
                    <a href="{{ route('settings.edit', auth()->user()->id) }}"
                       class="side-menu__item {{ request()->routeIs('settings.edit') ? 'active' : '' }}">
                        <i class="ti ti-user-circle side-menu__icon"></i>
                        <span class="side-menu__label">@lang('dashboard.Profile')</span>
                    </a>
                </li>


                <!-- Start::slide -->
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item">
                        <i class="bx bx-layer side-menu__icon"></i>
                        <span class="side-menu__label">Nested Menu</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        <li class="slide side-menu__label1">
                            <a href="javascript:void(0)">Nested Menu</a>
                        </li>
                        <li class="slide">
                            <a href="javascript:void(0);" class="side-menu__item">Nested-1</a>
                        </li>
                        <li class="slide has-sub">
                            <a href="javascript:void(0);" class="side-menu__item">Nested-2
                                <i class="fe fe-chevron-right side-menu__angle"></i></a>
                            <ul class="slide-menu child2">
                                <li class="slide">
                                    <a href="javascript:void(0);" class="side-menu__item">Nested-2-1</a>
                                </li>
                                <li class="slide has-sub">
                                    <a href="javascript:void(0);" class="side-menu__item">Nested-2-2
                                        <i class="fe fe-chevron-right side-menu__angle"></i></a>
                                    <ul class="slide-menu child3">
                                        <li class="slide">
                                            <a href="javascript:void(0);" class="side-menu__item">Nested-2-2-1</a>
                                        </li>
                                        <li class="slide">
                                            <a href="javascript:void(0);" class="side-menu__item">Nested-2-2-2</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <!-- End::slide -->

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
