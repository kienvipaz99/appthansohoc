<?php

namespace App\Http\Controllers;


use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BabnnerController extends Controller
{
    public function index()
    {
        $banner =  Banner::all();
        $arr = [
            'status' => true,
            'message' => "Danh sách banner",
            'data' => $banner,

        ];
        return response()->json($arr, 200);
    }
    public function store(Request $request)
    {
        $input = $request->all();

        $validatedData =  Validator::make($input, [
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'name' => 'required',
            'link' => 'required|url',
        ]);
        if ($validatedData->fails()) {
            $arr = [
                'success' => false,
                'message' => 'Lỗi kiểm tra dữ liệu',
                'data' => $validatedData->errors()
            ];
            return response()->json($arr, 400);
        }
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_path = $image->store('image', 'public');
            $imageUrl = asset(Storage::url($image_path));
            $data = Banner::create([
                'image' => $imageUrl,
                'name' => $input['name'],
                'link' => $input['link'],
            ]);

            session()->flash('success', 'Ảnh đã được tải lên thành công');

            return $data;
        }
    }
    public function update(Request $request, $id)
    {
        $banner = Banner::find($id);

        if (!$banner) {
            $arr = [
                'success' => false,
                'message' => 'Không tìm thấy banner',
            ];
            return response()->json($arr, 404);
        }

        $input = $request->all();

        $validatedData = Validator::make($input, [
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'name' => 'required',
            'link' => 'required|url',
        ]);

        if ($validatedData->fails()) {
            $arr = [
                'success' => false,
                'message' => 'Lỗi kiểm tra dữ liệu',
                'data' => $validatedData->errors(),
            ];
            return response()->json($arr, 400);
        }

        if ($request->hasFile('image')) {
            // Xử lý tải lên hình ảnh và cập nhật đường dẫn hình ảnh
            $image = $request->file('image');
            $image_path = $image->store('image', 'public');
            $imageUrl = asset(Storage::url($image_path));
            $banner->image = $imageUrl;
        }

        $banner->name = $input['name'];
        $banner->link = $input['link'];

        $banner->save();

        $arr = [
            'success' => true,
            'message' => 'Banner đã được cập nhật thành công',
            'data' => $banner,
        ];

        return response()->json($arr, 200);
    }
    public function destroy($id)
    {
        $banner = Banner::find($id);

        if (!$banner) {
            $arr = [
                'success' => false,
                'message' => 'Không tìm thấy banner',
            ];
            return response()->json($arr, 404);
        }

        $banner->delete();

        $arr = [
            'success' => true,
            'message' => 'Banner đã được xoá thành công',
        ];

        return response()->json($arr, 200);
    }
}
