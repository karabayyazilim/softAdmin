<?php

namespace App\Http\Controllers\Backend\Files;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FileManagementController extends Controller
{
    public function getFiles() {
        return view('backend.files.file-management');
    }
}
