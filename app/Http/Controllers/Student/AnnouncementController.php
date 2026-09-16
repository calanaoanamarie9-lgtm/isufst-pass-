<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\View\View;

class AnnouncementController extends Controller
{
    public function index(): View
    {
        $announcements = Announcement::published()
            ->latest('published_at')
            ->paginate(10);

        return view('student.announcements.index', ['announcements' => $announcements]);
    }

    public function show(Announcement $announcement): View
    {
        abort_unless($announcement->is_published && $announcement->published_at?->lte(now()), 404);

        return view('student.announcements.show', ['announcement' => $announcement]);
    }
}