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

                {{-- start edit admin profile --}}

                <li class="slide">
                    <a href="{{ route('admin-profile.edit', auth()->user()->id) }}"
                        class="side-menu__item {{ request()->routeIs('admin-profile.edit') ? 'active' : '' }}">
                        <i class="ti ti-user-circle side-menu__icon"></i>
                        <span class="side-menu__label">@lang('dashboard.Profile')</span>
                    </a>
                </li>


                {{-- end edit admin profile --}}


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
                                class="side-menu__item {{ in_array(request()->route()->getName(), ['providers.index']) ? 'active' : '' }}">
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
                    <a href="{{ route('dashobard.coupons.index') }}"
                        class="side-menu__item {{ request()->routeIs('dashboard.coupons.index') ? 'active' : '' }}">
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

                {{-- start orders --}}
                <li class="slide">
                    <a href="{{ route('orders.index') }}"
                        class="side-menu__item {{ in_array(request()->route()->getName(), ['orders.index']) ? 'active' : '' }}">
                        <i class="ti ti-package side-menu__icon"></i>
                        <span class="side-menu__label">@lang('dashboard.orders')</span>
                    </a>
                </li>
                {{-- end orders --}}

                <li class="slide">
                    <a href="{{ route('order-returns.index', ['status' => 'pending']) }}"
                        class="side-menu__item {{ in_array(request()->route()->getName(), ['order-returns.index']) ? 'active' : '' }}">
                        <i class="ti ti-package side-menu__icon"></i>
                        <span class="side-menu__label">@lang('dashboard.order_returns')</span>
                    </a>
                </li>

                <!-- Start::contacts -->
                <li class="slide">
                    <a href="{{ route('sliders.index') }}"
                        class="side-menu__item {{ request()->routeIs('sliders.index') ? 'active' : '' }}">
                        <i class="ti ti-photo side-menu__icon"></i>
                        <span class="side-menu__label">@lang('dashboard.sliders')</span>
                    </a>
                </li>
                <!-- End::orders -->
                <!-- Start::sliders -->
                <li class="slide">
                    <a href="{{ route('contacts.index') }}"
                        class="side-menu__item {{ request()->routeIs('contacts.index') ? 'active' : '' }}">
                        <i class="ti ti-photo side-menu__icon"></i>
                        <span class="side-menu__label">@lang('dashboard.contacts')</span>
                    </a>
                </li>
                <!-- End::orders -->
                <!-- Start::complaints -->
                <li class="slide">
                    <a href="{{ route('complaints.index') }}"
                        class="side-menu__item {{ request()->routeIs('complaints.index') ? 'active' : '' }}">
                        <i class="ti ti-photo side-menu__icon"></i>
                        <span class="side-menu__label">@lang('dashboard.complaints')</span>
                    </a>
                </li>
                <!-- End::complaints -->




                <!-- Start::coupons -->
                {{-- <li class="slide">
                    <a href="{{ route('calendar.index') }}" class="side-menu__item ">
                        <i class="ti ti-discount-2 side-menu__icon"></i>
                        <span class="side-menu__label">@lang('dashboard.calendar')</span>
                    </a>
                </li>
                <!-- End::coupons --> --}}

                {{--
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
                <!-- End::slide --> --}}




                <li
                    class="slide has-sub {{ in_array(request()->route()->getName(), ['about.index', 'terms_and_conditions.index']) ? 'open active' : '' }}">
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
                            <a href="{{ route('terms_and_conditions.index') }}"
                                class="side-menu__item {{ in_array(request()->route()->getName(), ['terms_and_conditions.index']) ? 'active' : '' }}">
                                @lang('dashboard.terms_and_conditions')
                            </a>
                        </li>
                        <li class="slide">
                            <a href="{{ route('dashboard.setting.edit') }}"
                                class="side-menu__item {{ in_array(request()->route()->getName(), ['dashboard.setting.edit']) ? 'active' : '' }}">
                                @lang('dashboard.website_info')
                            </a>
                        </li>

                    </ul>
                </li>




                  <li
                    class="slide has-sub {{ in_array(request()->route()->getName(), ['landingPage.header','landingPage.chooseContent',
                    'landingPage.features','landingPage.expirenceContent','landingPage.discover','landingPage.downloadSection','footer.index']) ? 'open active' : '' }}">
                    <a href="javascript:void(0);" class="side-menu__item ">
                        <i class="bx bx-sitemap side-menu__icon"></i>
                        <span class="side-menu__label">@lang('dashboard.landingPage')</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">

                        <li class="slide">
                            <a href="{{ route('landingPage.header') }}"
                                class="side-menu__item {{ in_array(request()->route()->getName(), ['landingPage.header']) ? 'active' : '' }}">
                                @lang('dashboard.landingPage_header')
                            </a>
                        </li>
                        <li class="slide">
                            <a href="{{ route('landingPage.chooseContent') }}"
                                class="side-menu__item {{ in_array(request()->route()->getName(), ['landingPage.chooseContent']) ? 'active' : '' }}">
                                @lang('dashboard.landingPage_chooseContent')
                            </a>
                        </li>
                        <li class="slide">
                            <a href="{{ route('landingPage.features') }}"
                                class="side-menu__item {{ in_array(request()->route()->getName(), ['landingPage.features']) ? 'active' : '' }}">
                                @lang('dashboard.landingPage_features')
                            </a>
                        </li>
                        <li class="slide">
                            <a href="{{ route('landingPage.expirenceContent') }}"
                                class="side-menu__item {{ in_array(request()->route()->getName(), ['landingPage.expirenceContent']) ? 'active' : '' }}">
                                @lang('dashboard.landingPage_expirenceContent')
                            </a>
                        </li>

                          <li class="slide">
                            <a href="{{ route('landingPage.discover') }}"
                                class="side-menu__item {{ in_array(request()->route()->getName(), ['landingPage.discover']) ? 'active' : '' }}">
                                @lang('dashboard.landingPage_discover')
                            </a>
                        </li>
                          <li class="slide">
                            <a href="{{ route('landingPage.downloadSection') }}"
                                class="side-menu__item {{ in_array(request()->route()->getName(), ['landingPage.downloadSection']) ? 'active' : '' }}">
                                @lang('dashboard.download_section')
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
