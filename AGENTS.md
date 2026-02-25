# AGENTS.md

## Cursor Cloud specific instructions

### Project overview

This is a **Laravel 12** travel/tourism agency web application with multi-auth (User + Admin). It uses **SQLite** as the default database, **Vite 7 + Tailwind CSS 4** for frontend assets, and **PHPUnit 11** for testing. See `composer.json` for the full `scripts` section (setup, dev, test).

### Environment variable override (critical)

The Cursor Cloud secrets system injects environment variables (e.g. `DB_CONNECTION=mysql`) that **override** the `.env` file values. For local development with SQLite, the following overrides must be set (they are persisted in `~/.bashrc`):

```
export DB_CONNECTION=sqlite
export DB_DATABASE="$WORKSPACE_DIR/database/database.sqlite"
export CACHE_STORE=file
export SESSION_DRIVER=file
export QUEUE_CONNECTION=sync
export MAIL_MAILER=log
```

Replace `$WORKSPACE_DIR` with the actual workspace root (typically `/workspace`). If artisan commands fail with "could not find driver (Connection: mysql)", these overrides are likely missing. Source `~/.bashrc` or re-export them.

### Key commands

| Task | Command |
|---|---|
| Install PHP deps | `composer install` |
| Install JS deps | `npm install` |
| Build frontend | `npm run build` |
| Dev server (all-in-one) | `composer dev` (runs artisan serve + vite + queue + pail via concurrently) |
| Dev server (PHP only) | `php artisan serve --host=0.0.0.0 --port=8000` |
| Run tests | `php artisan test` |
| Lint (check) | `./vendor/bin/pint --test` |
| Lint (fix) | `./vendor/bin/pint` |
| Migrations | `php artisan migrate --force` |

### Known issues on Linux (case-sensitive filesystem)

- `app/Http/Controllers/Front/Frontcontroller.php` defines class `Frontcontroller` (lowercase 'c'), but `routes/web.php` imports `App\Http\Controllers\Front\FrontController` (uppercase 'C'). This causes a `ReflectionException` for all front-end routes on Linux. The admin panel (`/admin/*`) is unaffected.
- The Feature test `ExampleTest` fails because `GET /` returns 500 due to this same issue.

### Testing notes

- PHPUnit uses in-memory SQLite as configured in `phpunit.xml`, so system env overrides do not affect tests.
- The unit test (`ExampleTest`) passes. The feature test fails due to the front controller case mismatch (pre-existing).

### Admin panel access

Create a test admin via tinker:
```bash
php artisan tinker --execute="\$a = new App\Models\Admin(); \$a->name='Admin'; \$a->email='admin@test.com'; \$a->password=Hash::make('password123'); \$a->save();"
```
Then log in at `/admin/login`.
