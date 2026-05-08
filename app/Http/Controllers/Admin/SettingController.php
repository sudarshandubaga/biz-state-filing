<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Show the settings edit form.
     */
    public function edit()
    {
        $setting = Setting::firstOrCreate(['id' => 1]);
        return view('admin.settings.edit', compact('setting'));
    }

    /**
     * Update the settings.
     */
    public function update(Request $request)
    {
        $setting = Setting::firstOrCreate(['id' => 1]);

        $validated = $request->validate([
            'site_name' => 'required|string|max:255',
            'admin_email' => 'nullable|email|max:255',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:50',
            'contact_address' => 'nullable|string|max:500',
            'facebook_url' => 'nullable|url|max:500',
            'instagram_url' => 'nullable|url|max:500',
            'twitter_url' => 'nullable|url|max:500',
            'pinterest_url' => 'nullable|url|max:500',
            'linkedin_url' => 'nullable|url|max:500',
            'youtube_url' => 'nullable|url|max:500',
            'header_scripts' => 'nullable|string',
            'footer_scripts' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'favicon' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:1024',
        ]);

        // Handle Logo upload: resize to 200px width and convert to webp
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoPath = $this->processImage($logo, 'logo', 200);
            if ($logoPath) {
                // Delete old logo
                if ($setting->logo) {
                    $oldPath = public_path('uploads/settings/' . $setting->logo);
                    if (file_exists($oldPath)) unlink($oldPath);
                }
                $validated['logo'] = $logoPath;
            }
        }

        // Handle Favicon upload: resize to 32x32 and convert to webp
        if ($request->hasFile('favicon')) {
            $favicon = $request->file('favicon');
            $faviconPath = $this->processImage($favicon, 'favicon', 32, 32);
            if ($faviconPath) {
                if ($setting->favicon) {
                    $oldPath = public_path('uploads/settings/' . $setting->favicon);
                    if (file_exists($oldPath)) unlink($oldPath);
                }
                $validated['favicon'] = $faviconPath;
            }
        }

        $setting->update($validated);

        return redirect()->route('admin.settings.edit')
            ->with('success', 'Settings updated successfully.');
    }

    /**
     * Process and save an image with resize and webp conversion.
     */
    private function processImage($file, $prefix, $width, $height = null): ?string
    {
        try {
            $uploadDir = public_path('uploads/settings');
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            // Create image from upload
            $ext = strtolower($file->getClientOriginalExtension());
            $sourceImage = match($ext) {
                'jpeg', 'jpg' => imagecreatefromjpeg($file->getRealPath()),
                'png' => imagecreatefrompng($file->getRealPath()),
                'gif' => imagecreatefromgif($file->getRealPath()),
                'webp' => imagecreatefromwebp($file->getRealPath()),
                default => null,
            };

            if (!$sourceImage) return null;

            $origW = imagesx($sourceImage);
            $origH = imagesy($sourceImage);

            // Calculate dimensions
            if ($height === null) {
                $ratio = $origW / $origH;
                $newW = $width;
                $newH = (int)($width / $ratio);
            } else {
                $newW = $width;
                $newH = $height;
            }

            // Resize
            $resized = imagecreatetruecolor($newW, $newH);
            imagealphablending($resized, false);
            imagesavealpha($resized, true);
            imagecopyresampled($resized, $sourceImage, 0, 0, 0, 0, $newW, $newH, $origW, $origH);

            // Save as webp
            $filename = $prefix . '-' . time() . '.webp';
            $filepath = $uploadDir . '/' . $filename;
            imagewebp($resized, $filepath, 90);

            imagedestroy($sourceImage);
            imagedestroy($resized);

            return $filename;
        } catch (\Exception $e) {
            return null;
        }
    }
}