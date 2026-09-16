<?php

namespace App\Http\Controllers\Student;

use App\Enums\Office;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class NotificationController extends Controller
{
    /**
     * System & email alerts for the logged-in student.
     */
    public function index(Request $request): View
    {
        $notifications = Auth::user()
            ->notifications()
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('student.notifications.index', [
            'notifications' => $notifications,
        ]);
    }

    /**
     * Mark a single notification as read.
     */
    public function markRead(DatabaseNotification $notification)
    {
        abort_unless(
            $notification->notifiable_type === Auth::user()->getMorphClass()
            && $notification->notifiable_id === Auth::user()->id,
            403
        );

        $notification->markAsRead();

        return back();
    }

    /**
     * Open a notification: mark it read, then follow its target link.
     */
    public function open(DatabaseNotification $notification)
    {
        abort_unless(
            $notification->notifiable_type === Auth::user()->getMorphClass()
            && $notification->notifiable_id === Auth::user()->id,
            403
        );

        $notification->markAsRead();

        return redirect()->to($notification->data['url'] ?? route('student.notifications.index'));
    }

    /**
     * Mark every notification as read.
     */
    public function markAllRead()
    {
        Auth::user()->unreadNotifications->markAsRead();

        return back();
    }
}