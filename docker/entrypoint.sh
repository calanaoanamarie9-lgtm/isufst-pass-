#!/bin/sh
# ISUFSTPASS container entrypoint.
# - Prepares Laravel caches (SAFE subset only)
# - NEVER route:cache (routes/web.php contains closures -> route:cache fails)
# - NEVER migrate/seed here (Supabase schema/data already exists; destructive ops forbidden)
set -e

cd /app

# Discover package providers (needed after --no-scripts composer install)
php artisan package:discover --ansi 2>/dev/null || true

# Cache config + compiled views. Config cache bakes the runtime env vars
# injected by Vercel, which is exactly what we want in production.
php artisan config:cache 2>/dev/null || true
php artisan view:cache 2>/dev/null || true

# Keep storage writable on ephemeral instances
chmod -R 775 /app/storage /app/bootstrap/cache 2>/dev/null || true

# Start FrankenPHP/Caddy (serves Laravel public/ on $PORT)
exec /usr/local/bin/frankenphp run --config /etc/caddy/Caddyfile