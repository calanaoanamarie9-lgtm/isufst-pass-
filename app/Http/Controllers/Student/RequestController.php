<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class RequestController extends Controller
{
    /**
     * New Request hub: pick between booking an appointment or requesting a document.
     */
    public function newRequest(): View
    {
        return view('student.requests.new');
    }
}