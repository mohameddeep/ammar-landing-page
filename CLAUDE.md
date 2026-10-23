# CLAUDE.md

Bilingual (ar/en, RTL/LTR) landing site + admin dashboard. See `PROJECT.md` for product detail.

## Stack
Laravel 12, PHP 8.2+, MySQL, Blade only, Tailwind CSS 4 (Vite, `resources/css/app.css` + `website.css`), Laratrust (roles/permissions), mcamara/laravel-localization, session auth (`auth` middleware). Pint for style, PHPUnit for tests.

**Never** add React, Vue, or Inertia. Add no dependencies unless truly necessary.

## Architecture: Controller → Service → Repository
- Controllers (`app/Http/Controllers/{Dashboard,Website}/<Feature>/`): thin, `final`, `declare(strict_types=1)`; inject the service and delegate. Validation lives in FormRequests (`app/Http/Requests/{Dashboard,Website}/<Feature>/`).
- Services (`app/Http/Services/{Dashboard,Website,Mutual}/<Feature>/`): business logic and returning views/redirects. Shared helpers in `Mutual/` (`FileManagerService`, `HelperService`, `GetService`).
- Repositories: interface in `app/Repository/`, Eloquent impl in `app/Repository/Eloquent/` (extend `Repository`). Bind each in `app/Providers/RepositoryServiceProvider.php`.
- Traits in `app/Http/Traits` (`FileTrait`, `Responser`, `Searchable`, `HasUuid`, ...). Models in `app/Models`, enums in `app/Enums`, content helpers in `app/Support` (`StructureContent`, `WebsiteMeta`).
- Scaffold new features with `php artisan app:crud {Model} --web`, then review the output against a sibling feature (e.g. Slider).

## Routes
- `routes/web.php` (public), `routes/dashboard.php` (under `/{locale}/admin`, `auth` group; login at `admin/auth/login`). Both use localization middleware groups; keep new routes inside them.

## Views
- Dashboard: `resources/views/dashboard/core/app.blade.php` layout (+ `includes`, `alerts`, `tags`); pages in `dashboard/site/<feature>/`.
- Website: `website/layouts/{app,header,footer}.blade.php`; pages in `website/`, sections in `website/landing-page`.
- Reusable components (`resources/views/components` + `app/View/Components`): `breadcrumb`, `buttons` (create/edit/delete/show/toggle), `cards` (page-card, lists, swiper, dynamic-nav-tabs), `editor/summernote`, `form/form-component`, `input/input-field`. Reuse these before writing new markup.

## Localization
- Strings in `lang/{ar,en}/` (`dashboard.php`, `website.php`, `landingpage.php`, `messages.php`, `validation.php`). Every new string needs both languages; use `__()`/`trans()`, never hardcode text.
- Respect RTL/LTR (use logical Tailwind utilities like `ms-*`/`ps-*`/`text-start`). Translatable content is stored per locale; site-wide content comes from the `structures` table.

## Rules
- Preserve existing behavior and DB schema; add a new migration rather than editing old ones.
- Protect dashboard actions with Laratrust permissions consistently with sibling features.
- Don't touch unrelated files; keep changes small and in the style of surrounding code.
- After changes run: `vendor/bin/pint --dirty`, `php artisan test`, and `npm run build` if CSS/JS/Blade classes changed. Sanity check routes with `php artisan route:list` when adding routes.
