<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ProjectController;

class AboutMeController extends Controller
{
    public function index()
    {
        $projectController = new ProjectController();
        $projectCount = $projectController->getProjectCount();

        return view('aboutme', compact('projectCount'));
    }
}
