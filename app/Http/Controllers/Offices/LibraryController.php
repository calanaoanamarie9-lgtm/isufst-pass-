<?php

namespace App\Http\Controllers\Offices;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class LibraryController extends Controller
{
    public function dashboard(): View
    {
        return view('Offices.Library.dashboard', [
            'office' => 'Library',
        ]);
    }

    public function appointments(): View
    {
        return view('Offices.Library.appointments', [
            'office' => 'Library',
        ]);
    }

    public function availability(): View
    {
        return view('Offices.Library.availability', [
            'office' => 'Library',
        ]);
    }

    public function qrScanner(): View
    {
        return view('Offices.Library.qr', [
            'office' => 'Library',
        ]);
    }

    public function consultations(): View
    {
        return view('Offices.Library.consultations', [
            'office' => 'Library',
        ]);
    }

    public function profile(): View
    {
        return view('Offices.Library.profile', [
            'user' => auth()->user(),
            'office' => 'Library',
        ]);
    }

    public function help(): View
    {
        return view('Offices.Library.help', [
            'office' => 'Library',
        ]);
    }
}