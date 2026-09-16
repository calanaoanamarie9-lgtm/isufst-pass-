<?php

namespace App\Http\Controllers\Registrar;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StudentLookupController extends Controller
{
    public function index(Request $request): View
    {
        $query = User::query()->with('studentProfile')->where('role', 'student');

        if ($search = trim((string) $request->query('q'))) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhereHas('studentProfile', fn ($p) => $p
                        ->where('course', 'like', "%{$search}%")
                        ->orWhere('contact_number', 'like', "%{$search}%"));
            });
        }

        return view('registrar.students.index', [
            'students' => $query->latest()->paginate(12)->withQueryString(),
            'search' => $search,
        ]);
    }

    public function show(User $user): View
    {
        abort_unless($user->role === 'student', 404);

        $user->load(['studentProfile', 'documentRequests.documents', 'appointments']);

        return view('registrar.students.show', [
            'student' => $user,
        ]);
    }
}