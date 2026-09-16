<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Support\AuditLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ConfigController extends Controller
{
    private array $keys = [
        'institution_name',
        'institution_address',
        'academic_term',
        'support_email',
        'support_phone',
        'banner_enabled',
        'banner_text',
    ];

    public function index(): View
    {
        $settings = collect($this->keys)->mapWithKeys(
            fn (string $key) => [$key => Setting::get($key)]
        );

        return view('admin.config.index', ['settings' => $settings]);
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'institution_name' => ['required', 'string', 'max:255'],
            'institution_address' => ['nullable', 'string', 'max:255'],
            'academic_term' => ['nullable', 'string', 'max:255'],
            'support_email' => ['nullable', 'email', 'max:255'],
            'support_phone' => ['nullable', 'string', 'max:255'],
            'banner_enabled' => ['sometimes', 'boolean'],
            'banner_text' => ['nullable', 'string', 'max:1000'],
        ]);

        foreach ($data as $key => $value) {
            Setting::query()->updateOrCreate(['key' => $key], ['value' => $value]);
        }
        Setting::query()->updateOrCreate(
            ['key' => 'banner_enabled'],
            ['value' => $request->boolean('banner_enabled') ? 'true' : 'false']
        );

        AuditLogger::log('settings.updated', 'Updated system configuration.', $request->user());

        return back()->with('status', 'System configuration saved.');
    }
}