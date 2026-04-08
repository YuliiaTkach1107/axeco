<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FAQ;
use Inertia\Inertia;

class FaqController extends Controller
{
     public function index()
{
        $faqs = FAQ::all();

    return Inertia::render('FAQ', [
        'faqs'=>$faqs,
    ]);
}
}
