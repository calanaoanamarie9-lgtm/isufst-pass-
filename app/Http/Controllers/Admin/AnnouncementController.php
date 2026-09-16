<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Office;
use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Support\AuditLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AnnouncementController extends Controller
{
    public function index(Request $request): View
    {
        $query = Announcement::query()->with('author')->latest();

        if ($search = trim((string) $request->query('q'))) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('body', 'like', "%{$search}%");
            });
        }

        return view('admin.announcements.index', [
            'announcements' => $query->paginate(12)->withQueryString(),
            'search' => trim((string) $request->query('q')),
            'offices' => Office::toSelect(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'office' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string', 'max:2000'],
        ]);

        $announcement = Announcement::create([
            'title' => $data['title'],
            'office' => $data['office'],
            'body' => $data['body'],
            'user_id' => $request->user()->id,
            'is_published' => true,
            'published_at' => now(),
        ]);

        AuditLogger::log('announcement.created', 'Broadcast created: ' . $announcement->title . '.', $request->user());

        return back()->with('status', 'Broadcast published.');
    }

    public function toggle(Announcement $announcement, Request $request): RedirectResponse
    {
        $announcement->update([
            'is_published' => ! $announcement->is_published,
            'published_at' => ! $announcement->is_published ? now() : $announcement->published_at,
        ]);

        AuditLogger::log('announcement.' . ($announcement->is_published ? 'published' : 'unpublished'), ($announcement->is_published ? 'Published' : 'Unpublished') . ' broadcast: ' . $announcement->title . '.', $request->user());

        return back()->with('status', ($announcement->is_published ? 'Published' : 'Unpublished') . ' ' . $announcement->title . '.');
    }

    public function destroy(Announcement $announcement, Request $request): RedirectResponse
    {
        $title = $announcement->title;
        $announcement->delete();

        AuditLogger::log('announcement.deleted', 'Deleted broadcast: ' . $title . '.', $request->user());

        return back()->with('status', 'Broadcast deleted.');
    }
}