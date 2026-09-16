<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Office;
use App\Support\AuditLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class DepartmentController extends Controller
{
    public function index(): View
    {
        return view('admin.departments.index', [
            'offices' => Office::query()->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('offices', 'name')],
            'location' => ['nullable', 'string', 'max:255'],
            'contact' => ['nullable', 'string', 'max:255'],
            'hours' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:500'],
        ]);

        Office::create($data + ['is_active' => true]);

        AuditLogger::log('office.created', 'Created department ' . $data['name'] . '.', $request->user());

        return back()->with('status', 'Department ' . $data['name'] . ' added.');
    }

    public function update(Request $request, Office $office): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('offices', 'name')->ignore($office->id)],
            'location' => ['nullable', 'string', 'max:255'],
            'contact' => ['nullable', 'string', 'max:255'],
            'hours' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:500'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $office->update($data + ['is_active' => $request->boolean('is_active')]);

        AuditLogger::log('office.updated', 'Updated department ' . $office->name . '.', $request->user());

        return back()->with('status', 'Department updated.');
    }

    public function destroy(Office $office, Request $request): RedirectResponse
    {
        $name = $office->name;
        $office->delete();

        AuditLogger::log('office.deleted', 'Deleted department ' . $name . '.', $request->user());

        return back()->with('status', 'Department ' . $name . ' removed.');
    }
}