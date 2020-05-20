<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function getSettings(){
        return view('backend.settings.settings');
    }

    public function getSettingsEdit(){
        return view('backend.settings.setting-edit');
    }
}
