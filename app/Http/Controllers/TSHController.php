<?php

namespace App\Http\Controllers;

use App\Models\Tsh;
use Illuminate\Http\Request;

class TSHController extends Controller
{
    public function index(Request $request)
    {
        $data = Tsh::all();
        $arr = [
            'status' => true,
            'message' => "Danh sách sản phẩm",
            'data' => $data

        ];

        return response()->json($arr, 200);
    }
}
