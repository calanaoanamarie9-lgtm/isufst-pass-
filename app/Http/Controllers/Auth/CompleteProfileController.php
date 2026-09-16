<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\StudentProfile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class CompleteProfileController extends Controller
{
    public const GUEST_PURPOSES = [
        'document' => 'Document Request',
        'appointment' => 'Appointment',
        'transaction' => 'School Transaction',
        'inquiry' => 'Inquiry',
        'visit' => 'Visit',
        'other' => 'Other',
    ];

    public const RELATIONSHIPS = [
        'mother' => 'Mother',
        'father' => 'Father',
        'guardian' => 'Guardian',
        'sibling' => 'Sibling',
        'relative' => 'Relative',
        'other' => 'Other',
    ];

    /**
     * Display the "Complete Personal Details" step.
     */
    public function create(): View
    {
        return view('auth.complete-profile', ['user' => auth()->user()]);
    }

    /**
     * Save the user's personal details, then proceed to the dashboard.
     */
    public function store(Request $request): RedirectResponse
    {
        $user = $request->user();

        if ($user->studentProfile) {
            $validated = $request->validate([
                'student_id' => ['nullable', 'string', 'max:30'],
                'course' => ['nullable', 'string', 'max:100'],
                'year_level' => ['nullable', 'string', Rule::in(StudentProfile::YEAR_LEVELS)],
                'contact_number' => ['required', 'string', 'max:20'],
                'address' => ['nullable', 'string', 'max:255'],
            ]);

            $profile = $user->studentProfile ?? $user->studentProfile()->create();

            $profile->update($validated);
        } else {
            $common = [
                'contact_number' => ['required', 'string', 'max:20'],
            ];

            $rules = match ($user->registration_type) {
                'alumni' => $common + [
                    'student_id' => ['nullable', 'string', 'max:30'],
                    'course' => ['nullable', 'string', 'max:100'],
                    'year_graduated' => ['required', 'string', 'max:4'],
                ],
                'guest' => $common + [
                    'organization' => ['nullable', 'string', 'max:100'],
                    'address' => ['nullable', 'string', 'max:255'],
                    'purpose' => ['required', 'string', Rule::in(array_keys(self::GUEST_PURPOSES))],
                ],
                'parent' => $common + [
                    'relationship_to_student' => ['required', 'string', Rule::in(array_keys(self::RELATIONSHIPS))],
                    'student_full_name' => ['required', 'string', 'max:255'],
                    'student_id' => ['nullable', 'string', 'max:30'],
                ],
                default => $common,
            };

            $validated = $request->validate($rules);

            $user->update($validated);
        }

        return redirect()->route('dashboard');
    }
}