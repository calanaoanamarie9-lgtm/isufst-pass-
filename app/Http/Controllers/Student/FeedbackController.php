<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\DocumentRequest;
use App\Models\Feedback;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class FeedbackController extends Controller
{
    /**
     * Show the rating form for a completed appointment or document request.
     */
    public function create(Request $request): View
    {
        $validated = $request->validate([
            'kind' => ['required', 'in:appointment,document'],
            'id' => ['required', 'integer'],
        ]);

        $feedbackable = $validated['kind'] === 'appointment'
            ? Appointment::findOrFail($validated['id'])
            : DocumentRequest::findOrFail($validated['id']);

        Gate::authorize('view', $feedbackable);

        $this->ensureCompleted($feedbackable);

        $already = Feedback::where('user_id', Auth::id())
            ->where('feedbackable_type', get_class($feedbackable))
            ->where('feedbackable_id', $feedbackable->id)
            ->exists();

        return view('student.feedback.create', [
            'feedbackable' => $feedbackable,
            'kind' => $validated['kind'],
            'already' => $already,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'kind' => ['required', 'in:appointment,document'],
            'id' => ['required', 'integer'],
            'rating' => ['required', 'integer', 'between:1,5'],
            'comment' => ['nullable', 'string', 'max:1000'],
        ]);

        $feedbackable = $validated['kind'] === 'appointment'
            ? Appointment::findOrFail($validated['id'])
            : DocumentRequest::findOrFail($validated['id']);

        Gate::authorize('view', $feedbackable);
        $this->ensureCompleted($feedbackable);

        $exists = Feedback::where('user_id', Auth::id())
            ->where('feedbackable_type', get_class($feedbackable))
            ->where('feedbackable_id', $feedbackable->id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'You have already submitted feedback for this service.');
        }

        $serviceArea = $validated['kind'] === 'appointment'
            ? $feedbackable->office
            : $feedbackable->document()->value('name');

        Auth::user()->feedbacks()->create([
            'feedbackable_type' => get_class($feedbackable),
            'feedbackable_id' => $feedbackable->id,
            'service_area' => $serviceArea,
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
        ]);

        return redirect()->route('dashboard')
            ->with('status', 'Thank you! Your feedback has been recorded.');
    }

    private function ensureCompleted(Appointment|DocumentRequest $feedbackable): void
    {
        $completed = $feedbackable instanceof Appointment
            ? $feedbackable->status === 'completed'
            : in_array($feedbackable->status, ['completed', 'ready_for_pickup'], true);

        abort_unless($completed, 403, 'Feedback is only available for completed services.');
    }
}