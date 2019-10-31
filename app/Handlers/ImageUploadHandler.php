<?php

namespace App\Handlers;

use Illuminate\Support\Str;

class ImageUploadHandler
{
    protected $allowed_ext = ['png', 'jpg', 'gif', 'jpeg'];
    /**
     * 图片保存
     *
     * @param fileinfo $file 系统资源编号
     * @param string $folder 文件目录
     * @param string $file_prefix 文件前缀
     * @return bool|array 
     */
    public function save($file, $folder, $file_prefix)
    {
        $folder_name = "uploads/images/$folder/" . date("Ym/d", time());
        $upload_path = public_path() . '/' . $folder_name;
        $extension = strtolower($file->getClientOriginalExtension()) ?: 'png';
        $filename = $file_prefix . '_' . time() . '_' . Str::random(10) . '.' . $extension;
        if (!in_array($extension, $this->allowed_ext)) {
            return false;
        }
        $file->move($upload_path, $filename);
        return [
            'path' => config('app.url') . "/$folder_name/$filename"
        ];
    }
}
