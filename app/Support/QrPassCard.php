<?php

namespace App\Support;

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

/**
 * Builds a complete, downloadable "pass card" SVG that contains everything
 * shown on screen — branding header, student identity, the transaction QR,
 * reference number and the verified footer — not just the bare QR code.
 */
class QrPassCard
{
    public static function svg(array $options): string
    {
        [
            'sectionLabel' => $sectionLabel,
            'refCode' => $refCode,
            'caption' => $caption,
            'name' => $name,
            'studentId' => $studentId,
            'course' => $course,
            'yearLevel' => $yearLevel,
            'qrPayload' => $qrPayload,
        ] = array_merge([
            'sectionLabel' => 'Transaction QR',
            'refCode' => '',
            'caption' => '',
            'name' => '',
            'studentId' => '',
            'course' => '',
            'yearLevel' => '',
            'qrPayload' => '',
        ], $options);

        $e = fn ($v) => htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8');

        // Downscaled logo keeps the SVG light while keeping official branding.
        $logo = self::logoDataUri();

        $identity = [
            ['Name', $name],
            ['Student ID', $studentId],
            ['Course / Program', $course],
            ['Year Level', $yearLevel],
        ];

        $svg = [];
        $svg[] = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="640" height="1010" viewBox="0 0 640 1010">';
        $svg[] = '<defs><clipPath id="card"><rect width="640" height="1010" rx="28"/></clipPath></defs>';
        $svg[] = '<g clip-path="url(#card)">';
        $svg[] = '<rect width="640" height="1010" fill="#ffffff"/>';

        // Header band
        $svg[] = '<rect width="640" height="170" fill="#102d5b"/>';
        if ($logo) {
            $svg[] = '<image x="34" y="45" width="80" height="80" xlink:href="' . $logo . '" href="' . $logo . '"/>';
        }
        $tx = $logo ? 134 : 44;
        $svg[] = '<text x="' . $tx . '" y="92" font-family="Arial, Helvetica, sans-serif" font-size="34" font-weight="800" fill="#ffffff">ISUFSTPASS</text>';
        $svg[] = '<text x="' . $tx . '" y="122" font-family="Arial, Helvetica, sans-serif" font-size="15" letter-spacing="3" fill="#9db8e8">DIGITAL STUDENT ID</text>';

        // Identity block
        $y = 216;
        foreach ($identity as [$label, $value]) {
            $size = mb_strlen((string) $value) > 30 ? 19 : 24;
            $svg[] = '<text x="44" y="' . $y . '" font-family="Arial, Helvetica, sans-serif" font-size="13" letter-spacing="2" fill="#94a3b8">' . $e(mb_strtoupper($label)) . '</text>';
            $svg[] = '<text x="44" y="' . ($y + 30) . '" font-family="Arial, Helvetica, sans-serif" font-size="' . $size . '" font-weight="700" fill="#0f172a">' . $e($value !== '' ? $value : '&#8212;') . '</text>';
            $y += 64;
        }

        $svg[] = '<line x1="44" y1="486" x2="596" y2="486" stroke="#e2e8f0" stroke-width="2"/>';

        // Transaction section
        $svg[] = '<text x="320" y="532" text-anchor="middle" font-family="Arial, Helvetica, sans-serif" font-size="22" font-weight="800" letter-spacing="1" fill="#1d4ed8">' . $e(mb_strtoupper($sectionLabel)) . '</text>';

        $qrUri = (new PngWriter())->write(new QrCode($qrPayload))->getDataUri();
        $svg[] = '<image x="155" y="556" width="330" height="330" xlink:href="' . $qrUri . '" href="' . $qrUri . '"/>';

        $svg[] = '<text x="320" y="926" text-anchor="middle" font-family="Arial, Helvetica, sans-serif" font-size="21" font-weight="800" fill="#0f172a">' . $e($refCode) . '</text>';

        if ($caption !== '') {
            $svg[] = '<text x="320" y="954" text-anchor="middle" font-family="Arial, Helvetica, sans-serif" font-size="14" fill="#64748b">' . $e($caption) . '</text>';
        }

        // Verified footer
        $svg[] = '<rect y="976" width="640" height="34" fill="#059669"/>';
        $svg[] = '<text x="320" y="998" text-anchor="middle" font-family="Arial, Helvetica, sans-serif" font-size="16" font-weight="800" letter-spacing="2" fill="#ffffff">ISUFSTPASS VERIFIED &#8226; SECURE &#8226; RELIABLE &#8226; OFFICIAL</text>';

        $svg[] = '</g>';
        $svg[] = '<rect x="1.5" y="1.5" width="637" height="1007" rx="26.5" fill="none" stroke="#cbd5e1" stroke-width="3"/>';
        $svg[] = '</svg>';

        return implode("\n", $svg);
    }

    /**
     * Downscale the brand logo so the downloaded SVG stays lightweight.
     */
    private static function logoDataUri(): ?string
    {
        $path = public_path('img/isufstpass-logo.png');

        if (! is_file($path)) {
            return null;
        }

        $src = @imagecreatefrompng($path);

        if ($src === false) {
            return base64_encode(file_get_contents($path)) ? 'data:image/png;base64,' . base64_encode(file_get_contents($path)) : null;
        }

        $size = 160;
        $dst = imagecreatetruecolor($size, $size);
        imagesavealpha($dst, true);
        $transparent = imagecolorallocatealpha($dst, 0, 0, 0, 127);
        imagefill($dst, 0, 0, $transparent);

        $w = imagesx($src);
        $h = imagesy($src);
        $side = min($w, $h);

        imagecopyresampled(
            $dst,
            $src,
            0,
            0,
            (int) (($w - $side) / 2),
            (int) (($h - $side) / 2),
            $size,
            $size,
            $side,
            $side
        );

        ob_start();
        imagepng($dst, null, 6);
        $data = ob_get_clean();

        imagedestroy($src);
        imagedestroy($dst);

        return $data ? 'data:image/png;base64,' . base64_encode($data) : null;
    }
}
