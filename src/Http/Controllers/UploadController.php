<?php

namespace Dcat\Admin\Extension\DcatSkuPlus\Http\Controllers;

use Dcat\Admin\Http\Controllers\AdminController;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UploadController extends AdminController
{
    /**
     * 上传图片.
     *
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function store(): JsonResponse
    {
        if (request()->hasFile('file')) {
            $file = request()->file('file');

            $validator = Validator::make(['file' => $file], [
                'file' => 'required|image|mimes:jpg,jpeg,png,gif,webp|max:5120',
            ]);

            if ($validator->fails()) {
                return response()->json(['code' => 422, 'message' => $validator->errors()->first()], 422);
            }

            $disk = config('admin.upload.disk');
            $path = Storage::disk($disk)->put('sku', $file);
            $response = ['full_url' => Storage::disk($disk)->url($path), 'short_url' => $path];

            return response()->json($response);
        }

        return response()->json(['code' => 400, 'message' => '未选择文件'], 400);
    }

    /**
     * 删除图片.
     *
     * @return JsonResponse
     */
    public function delete(): JsonResponse
    {
        $disk = config('admin.upload.disk');
        $path = request()->input('path');

        if (!$path || str_contains($path, '..')) {
            return response()->json(['code' => 400, 'message' => '无效的文件路径']);
        }

        if (!Storage::disk($disk)->exists($path)) {
            return response()->json(['code' => 404, 'message' => '未找到相关图片']);
        }

        try {
            Storage::disk($disk)->delete($path);

            return response()->json(['code' => 200, 'message' => '删除成功']);
        } catch (\Exception $exception) {
            return response()->json(['code' => $exception->getCode(), 'message' => $exception->getMessage()]);
        }
    }
}
