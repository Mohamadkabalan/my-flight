# my-flight

REST API for managing Flights (with nested Legs and Segments), built on Laravel 13 / PHP 8.3+.

## Stack

- **Framework**: Laravel 13 (`laravel/framework ^13.8`)
- **PHP**: ^8.3
- **Dev environment**: Laravel Sail (Docker)
- **Cache / Queue driver**: Redis
- **Queue dashboard**: Laravel Horizon
- **Code style**: Laravel Pint (PSR-12)
- **Tests**: Pest

## Domain model

```
Flight
  └── Leg (many per Flight)
        └── Segment (many per Leg)
```

All three resources are managed through this API.

## Authentication

**API-Key auth**: every request must include a valid API key (e.g. `X-Api-Key` header). There is no session or cookie auth — this is a pure API service.

## Idempotency

Mutating endpoints (POST/PUT/PATCH) support an `Idempotency-Key` header. Duplicate requests with the same key return the cached response without re-executing side effects. Keys are stored in Redis with a short TTL.

## Conventions

### Controllers
- One controller per resource (`FlightController`, `LegController`, `SegmentController`), nested under `app/Http/Controllers`.
- Thin controllers: delegate business logic to service classes or jobs.
- Return HTTP 202 Accepted for async operations.

### Validation
- All input validated via **Form Requests** (`app/Http/Requests`). No inline `$request->validate()` in controllers.

### Responses
- All responses shaped by **API Resources** (`app/Http/Resources`). No direct `->json()` with raw arrays.
- Consistent envelope: `{ data: ... }` for single items, `{ data: [...], meta: {...} }` for collections.

### Queue / async
- Heavy work (e.g. flight status updates, notifications) dispatched as **Jobs** to the Redis queue.
- Horizon supervises workers; see `config/horizon.php` for queue configuration.

### Routing
- All routes under `routes/api.php`, versioned (`/api/v1/...`).
- No web or Blade routes — `routes/web.php` is unused.

## Testing

Run tests with:

```bash
php artisan test
# or
./vendor/bin/pest
```

- Feature tests live in `tests/Feature/`, unit tests in `tests/Unit/`.
- Use `RefreshDatabase` trait for tests that touch the database.
- Test factories defined in `database/factories/`.

## Local development

```bash
./vendor/bin/sail up -d        # start containers
./vendor/bin/sail artisan migrate
./vendor/bin/sail artisan horizon  # start queue workers
```

## Key artisan commands

```bash
php artisan make:request StoreFlight Request   # Form Request
php artisan make:resource FlightResource       # API Resource
php artisan make:job ProcessFlight             # Queue job
php artisan horizon                            # Start Horizon dashboard
```