<?php

namespace App\Modules\Management\BannerManagement\Banner\Actions;

class UpdateData
{
    static $model = \App\Modules\Management\BannerManagement\Banner\Models\Model::class;

    public static function execute($request,$slug)
    {
        try {
            if (!$data = self::$model::query()->where('slug', $slug)->first()) {
                return messageResponse('Data not found...',$data, 404, 'error');
            }
            $requestData = $request->validated();
              // Only allow mp4 video uploads
              if ($request->hasFile('video_file')) {
                $video = $request->file('video_file');
                // Validate file type and extension
                if ($video->getClientOriginalExtension() !== 'mp4' || $video->getMimeType() !== 'video/mp4') {
                    return messageResponse('Only MP4 video files are allowed.', [], 422, 'validation_error');
                }
                $currentDate = now()->format('Y/m');
                $videoPath = self::uploadVideoFile($video, $currentDate);
                $requestData['video_file'] = $videoPath;
            }
            $data->update($requestData);
            return messageResponse('Item updated successfully',$data, 201);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
     /**
     * Custom function to upload video file
     * @param \Illuminate\Http\UploadedFile $video
     * @param string $currentDate
     * @return string $filePath
     */
    private static function uploadVideoFile($video, $currentDate)
    {
        $destinationPath = '/uploads/videos/' . $currentDate;
        $fileName = uniqid('video_') . '.' . $video->getClientOriginalExtension();
        $video->move(public_path($destinationPath), $fileName);
        return $destinationPath . '/' . $fileName;
    }
}