<?php

namespace App\Support;

use Illuminate\Support\Facades\URL;

/**
 * Builds the absolute base URL embedded inside generated QR codes.
 *
 * A QR code is scanned by a PHONE, so "127.0.0.1" or "localhost" would point
 * at the phone itself and never reach the computer running Laravel.
 *
 * Resolution order:
 *   1. config('app.qr_url')  — explicit override via QR_URL in .env (use in production)
 *   2. Auto-detected LAN IPv4 of this machine + current request port
 *   3. Fallback: the normal app root URL
 */
class QrUrl
{
    private static ?string $cachedLanIp = null;

    public static function base(): string
    {
        $configured = trim((string) config('app.qr_url'));

        if ($configured !== '') {
            return rtrim($configured, '/');
        }

        if ($ip = self::lanIp()) {
            return 'http://' . $ip . self::portSuffix();
        }

        return rtrim(URL::to('/'), '/');
    }

    /**
     * Full URL for a verification path, e.g. /verify/pass/{token}.
     */
    public static function to(string $path): string
    {
        return self::base() . '/' . ltrim($path, '/');
    }

    /**
     * Best-effort detection of this machine's LAN IPv4 address without
     * sending any network traffic (UDP "connect" only).
     */
    public static function lanIp(): ?string
    {
        if (self::$cachedLanIp !== null) {
            return self::$cachedLanIp;
        }

        self::$cachedLanIp = false;

        $sock = @stream_socket_client('udp://8.8.8.8:53', $errno, $errstr, 1);

        if ($sock) {
            $local = stream_socket_get_name($sock, false);
            fclose($sock);

            if ($local && ! str_starts_with($local, '127.') && filter_var($local, FILTER_VALIDATE_IP)) {
                self::$cachedLanIp = $local;

                return $local;
            }
        }

        // Fallback: resolve this host's own name.
        $host = gethostname();

        if ($host) {
            $ip = gethostbyname($host);

            if ($ip !== $host && ! str_starts_with($ip, '127.') && filter_var($ip, FILTER_VALIDATE_IP)) {
                self::$cachedLanIp = $ip;
            }
        }

        return self::$cachedLanIp ?: null;
    }

    /**
     * Keep whatever port the server actually runs on (:8000 with artisan
     * serve); omit it entirely when serving on plain port 80.
     */
    private static function portSuffix(): string
    {
        $port = request()?->getPort();

        if (! $port || $port === 80) {
            return '';
        }

        return ':' . $port;
    }
}