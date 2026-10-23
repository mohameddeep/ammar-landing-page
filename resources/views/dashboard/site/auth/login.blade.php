<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="{{ app()->getLocale() === 'ar' ? 'direction-rtl' : 'direction-ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@lang('dashboard.Login')</title>
    <!-- Bootstrap RTL CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/toastr/toastr.css') }}" />
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
    <link rel="icon" href="{{ asset(\App\Support\WebsiteImage::MARK) }}" type="image/svg+xml">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&display=swap" rel="stylesheet">

    <style>
        /* Same look as the public website: deep navy, emerald accents, Cairo */
        .direction-ltr { direction: ltr !important; }
        .direction-rtl { direction: rtl !important; }

        body {
            min-height: 100vh;
            margin: 0;
            font-family: 'Cairo', system-ui, sans-serif;
            color: #e2e8f0;
            background:
                radial-gradient(ellipse at 85% 10%, rgba(16, 185, 129, 0.22), transparent 50%),
                radial-gradient(ellipse at 10% 90%, rgba(59, 130, 246, 0.2), transparent 50%),
                #0b1222;
            position: relative;
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image:
                linear-gradient(rgba(148, 163, 184, 0.07) 1px, transparent 1px),
                linear-gradient(90deg, rgba(148, 163, 184, 0.07) 1px, transparent 1px);
            background-size: 48px 48px;
            mask-image: radial-gradient(ellipse at center, #000 30%, transparent 75%);
            -webkit-mask-image: radial-gradient(ellipse at center, #000 30%, transparent 75%);
            pointer-events: none;
        }

        .container { position: relative; }

        .card {
            border-radius: 1.25rem;
            border: 1px solid rgba(148, 163, 184, 0.16);
            background: linear-gradient(160deg, rgba(30, 41, 59, 0.85), rgba(15, 23, 42, 0.92));
            box-shadow: 0 30px 60px -25px rgba(0, 0, 0, 0.8) !important;
            backdrop-filter: blur(12px);
            color: #e2e8f0;
        }

        .form-label { color: #cbd5e1; font-weight: 600; }

        .form-control {
            text-align: start;
            background: #0f172a;
            border: 1px solid #334155;
            color: #f1f5f9;
            border-radius: 0.75rem;
            padding: 0.7rem 0.9rem;
        }

        .form-control::placeholder { color: rgba(148, 163, 184, 0.7); }

        .form-control:focus,
        .form-check-input:focus {
            background: #0f172a;
            color: #f1f5f9;
            border-color: #10b981;
            box-shadow: 0 0 0 0.2rem rgba(16, 185, 129, 0.22);
        }

        .input-group-text {
            cursor: pointer;
            background: #1e293b;
            border-color: #334155;
            color: #cbd5e1;
        }

        .btn-primary {
            width: 100%;
            border: none;
            border-radius: 0.75rem;
            padding: 0.75rem;
            font-weight: 700;
            background: linear-gradient(135deg, #10b981, #059669);
            box-shadow: 0 12px 25px -10px rgba(16, 185, 129, 0.65);
        }

        .btn-primary:hover,
        .btn-primary:focus {
            background: linear-gradient(135deg, #34d399, #10b981);
        }

        .form-check-input { background-color: #0f172a; border-color: #475569; }
        .form-check-input:checked { background-color: #10b981; border-color: #10b981; }
        .form-check-label { color: #cbd5e1; }

        a { text-decoration: none; color: #34d399; }
        a:hover { color: #6ee7b7; }

        .text-danger { color: #fca5a5 !important; }
    </style>
</head>

<body class="d-flex align-items-center justify-content-center">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <!-- Logo -->
                        @php
                            use App\Repository\StructureRepositoryInterface;
                            $footerStructure = app(StructureRepositoryInterface::class)->structure('footer');
                            $loginLogo = null;
                            $loginWebsiteName = __('website.companyName');
                            if ($footerStructure && $footerStructure->content) {
                                $footerContent = json_decode($footerStructure->content, true);
                                $loginLogo = $footerContent['image'] ?? null;
                                $currentLocale = app()->getLocale() ?? 'ar';
                                $loginWebsiteName = $footerContent['website_name'][$currentLocale] ?? __('website.companyName');
                            }
                        @endphp
                        <div class="text-center mb-4">
                            <a href="{{ url('/admin') }}" class="app-brand-link">
                                @if($loginLogo)
                                    <img class="m-0" src="{{ asset($loginLogo) }}" alt="{{ $loginWebsiteName }}"
                                        style="max-width: 150px; max-height: 100px; width: auto; height: auto;">
                                @else
                                    <img class="m-0" src="{{ asset(\App\Support\WebsiteImage::LOGO) }}" alt="{{ $loginWebsiteName }}"
                                        style="width: 260px; max-width: 100%; height: auto;">
                                @endif
                            </a>
                        </div>


                        <form action="{{ route('auth.login') }}" method="post">
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="form-label">@lang('dashboard.Email')</label>
                                <input name="email" type="email" class="form-control" id="email"
                                    placeholder="@lang('dashboard.Email')" autofocus required>
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">@lang('dashboard.Password')</label>

                                </div>
                                <div class="input-group input-group-merge">
                                    <input name="password" type="password" id="password" class="form-control"
                                        placeholder="@lang('dashboard.Password')" aria-describedby="password" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" name="remember_me" type="checkbox" id="remember"
                                        checked>
                                    <label class="form-check-label" for="remember_me">@lang('dashboard.Remember Me')</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                @lang('dashboard.Login')
                            </button>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Toastr JS -->
    {{-- <script src="{{ asset('assets/js/Toasts.js') }}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/js/sweet-alerts.js') }}"></script>
    {{-- @if (Session::has('error'))
        @include('dashboard.core.alerts.toasts.error')
    @endif --}}

    @include('dashboard.core.alerts.sweet-alert.error')


</body>

</html>
