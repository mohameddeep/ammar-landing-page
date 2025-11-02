<!-- app-header -->
<header class="app-header">

    <!-- Start::main-header-container -->
    <div class="main-header-container container-fluid">

        <!-- Start::header-content-left -->
        <div class="header-content-left">

            <!-- Start::header-element -->
            <div class="header-element">
                <div class="horizontal-logo">
                    <a href="{{ route('/') }}" class="header-logo">
                        <img src="{{ asset('assets/images/brand-logos/desktop-logo.png') }}" alt="logo"
                            class="desktop-logo">
                        <img src="{{ asset('assets/images/brand-logos/toggle-logo.png" alt="logo') }}"
                            class="toggle-logo">
                        <img src="{{ asset('assets/images/brand-logos/desktop-dark.png" alt="logo') }}"
                            class="desktop-dark">
                        <img src="{{ asset('assets/images/brand-logos/toggle-dark.png" alt="logo') }}"
                            class="toggle-dark">
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
            <div class="header-element notifications-dropdown">
                <!-- Start::header-link|dropdown-toggle -->
                @php
                    $user = auth()->user();
                    $unReadNotifications = $user?->unreadNotifications;
                    $unreadCount = $user?->unreadNotifications()->count() ?? 0;
                @endphp

                <a href="javascript:void(0);" class="header-link dropdown-toggle" data-bs-toggle="dropdown"
                    data-bs-auto-close="outside" id="messageDropdown" aria-expanded="false">
                    <i class="bx bx-bell header-link-icon"></i>
                    @if ($unreadCount > 0)
                        <span class="badge bg-secondary rounded-pill header-icon-badge pulse pulse-secondary"
                            id="notification-icon-badge">{{ $unreadCount }}</span>
                    @endif
                </a>
                <!-- End::header-link|dropdown-toggle -->

                <!-- Start::main-header-dropdown -->
                <div class="main-header-dropdown dropdown-menu dropdown-menu-end">
                    <div class="p-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <p class="mb-0 fs-17 fw-semibold">{{ __('dashboard.notifications') }}</p>
                            <span class="badge bg-secondary-transparent" id="notification-data">
                                {{ $unreadCount }} {{ __('dashboard.unread') }}
                            </span>
                        </div>
                    </div>
                    <div class="dropdown-divider"></div>

                    <ul class="list-unstyled mb-0" id="header-notification-scroll">
                        @forelse($unReadNotifications as $notification)
                            @php
                                $data = $notification->data ?? [];
                            @endphp
                            <li class="dropdown-item {{ $notification->read_at ? '' : 'bg-light' }}">
                                <a href="javascript:void(0);" class="d-flex align-items-start notification-item"
                                    data-id="{{ $notification->id }}" data-url="{{ route('complaints.index') }}">
                                    <div class="pe-2">
                                        <span class="avatar avatar-md bg-success-transparent avatar-rounded">
                                            <i class="ti ti-bell fs-18"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 d-flex align-items-center justify-content-between">
                                        <div>
                                            <p class="mb-0 fw-semibold">
                                                {{ $data['title'] ?? __('dashboard.notification') }}
                                            </p>
                                            <span class="text-muted fw-normal fs-12 header-notification-text">
                                                {{ $data['body'] ?? '' }}
                                            </span>
                                            <small class="text-muted d-block mt-1">
                                                {{ $notification->created_at->diffForHumans() }}
                                            </small>
                                        </div>
                                        @if (!$notification->read_at)
                                            <span
                                                class="badge bg-secondary-transparent ms-2">{{ __('dashboard.unread') }}</span>
                                        @endif
                                    </div>
                                </a>
                            </li>

                        @empty
                            <li class="text-center text-muted p-3">{{ __('dashboard.no_new_notifications') }}</li>
                        @endforelse
                    </ul>

                    <div class="p-3 border-top text-center">
                        <a href="{{ route('notifications.index') }}" class="btn btn-sm btn-primary">
                            {{ __('dashboard.view_all') }}
                        </a>
                    </div>
                </div>
                <!-- End::main-header-dropdown -->
            </div>
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
