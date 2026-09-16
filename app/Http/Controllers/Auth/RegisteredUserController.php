<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Display the registration form for the selected account type.
     */
    public function form(Request $request): View
    {
        $type = $request->query('type');

        abort_unless(in_array($type, ['student', 'other'], true), 404);

        return view('auth.register-form', ['userType' => $type]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'user_type' => ['required', 'string', 'in:student,other'],
        ];

        if ($request->user_type === 'other') {
            $rules['registration_type'] = ['required', 'string', Rule::in(['alumni', 'guest', 'parent'])];
        }

        $request->validate($rules);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'registration_type' => $request->user_type === 'other' ? $request->registration_type : null,
            'email_verified_at' => now(),
        ]);

        if ($request->user_type === 'student') {
            $user->studentProfile()->create([
                'pass_token' => (string) \Illuminate\Support\Str::uuid(),
            ]);
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('complete-profile', absolute: false));
    }
}
