<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CaptchaController extends Controller
{
    /**
     * Generate a random text CAPTCHA code.
     */
    private function generateCode(int $length = 6): string
    {
        $chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789'; // Exclude similar chars: I,1,O,0
        $code = '';
        for ($i = 0; $i < $length; $i++) {
            $code .= $chars[rand(0, strlen($chars) - 1)];
        }
        return $code;
    }

    /**
     * Output a CAPTCHA image PNG.
     */
    public function image()
    {
        $code = $this->generateCode();
        session(['captcha_code' => $code]);

        $width = 150;
        $height = 50;

        // Create image
        $image = imagecreatetruecolor($width, $height);

        // Colors
        $bgColor = imagecolorallocate($image, 240, 244, 248);
        $textColor = imagecolorallocate($image, 30, 41, 59);
        $noiseColor = imagecolorallocate($image, 148, 163, 184);
        $lineColor = imagecolorallocate($image, 203, 213, 225);

        // Fill background
        imagefill($image, 0, 0, $bgColor);

        // Draw random lines (background noise)
        for ($i = 0; $i < 5; $i++) {
            imageline($image, rand(0, $width), rand(0, $height), rand(0, $width), rand(0, $height), $lineColor);
        }

        // Draw random dots (noise)
        for ($i = 0; $i < 80; $i++) {
            imagesetpixel($image, rand(0, $width), rand(0, $height), $noiseColor);
        }

        // Draw text characters with random rotation and position
        $x = 10;
        $fontSize = 5; // Built-in GD font size (1-5)
        for ($i = 0; $i < strlen($code); $i++) {
            $char = $code[$i];
            $charWidth = imagefontwidth($fontSize) + 2;
            $charHeight = imagefontheight($fontSize);

            // Random Y offset for wave effect
            $yOffset = rand(-3, 3);
            $y = ($height - $charHeight) / 2 + $yOffset;

            // Alternating colors
            $charColor = $i % 2 === 0
                ? imagecolorallocate($image, 30, 64, 175)  // blue
                : imagecolorallocate($image, 180, 30, 30); // red

            imagestring($image, $fontSize, $x, $y, $char, $charColor);

            // Spacing with some randomness
            $x += $charWidth + rand(3, 8);
        }

        // Output PNG
        header('Content-Type: image/png');
        header('Cache-Control: no-cache, no-store, must-revalidate');
        header('Pragma: no-cache');
        header('Expires: 0');
        imagepng($image);
        imagedestroy($image);
        exit;
    }

    /**
     * Refresh CAPTCHA - returns JSON with new image URL.
     */
    public function refresh()
    {
        // Generate a new timestamp to bust cache
        $timestamp = time();

        return response()->json([
            'image_url' => route('captcha.image') . '?' . $timestamp,
        ]);
    }
}