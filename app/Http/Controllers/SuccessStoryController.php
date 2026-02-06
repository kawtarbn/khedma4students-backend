<?php

namespace App\Http\Controllers;

use App\Models\SuccessStory;

class SuccessStoryController extends Controller
{
    public function index()
    {
        return SuccessStory::all();
    }
}
