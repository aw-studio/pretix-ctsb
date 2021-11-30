# Pretix-CTSB

## Dev Setup

Install deps:

```bash
composer install
```

Add `.env` from preset

```bash
cp .env.example .env
```

Generate app key

```bash
php artisan key:generate
```

Add your favorite `port` the `Order-API-URL` and your super secret to `.env`:

```
APP_PORT=8080
PRETIX_ORDER_API_URL=https://pretix.eu/api/v1/organizers/ctsb/events/mobil4/orders/
PRETIX_SECRET=correcthorsebatterystaple
```

Run:

```bash
./vendor/bin/sail up
```

Visit
http://0.0.0.0:APP_PORT
