<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// модели
use App\Models\Setting;

class SettingController extends Controller
{
    /**
     * начальные установки
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $settings = Setting::get()->first();

        // возвращаемый параметр
        return response()->json([
            'status_code' => 200,
            'data' => $settings,
        ]);
    }
}
