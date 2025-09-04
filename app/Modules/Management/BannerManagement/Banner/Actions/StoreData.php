<?php

namespace App\Modules\Management\BannerManagement\Banner\Actions;

class StoreData
{
    static $model = \App\Modules\Management\BannerManagement\Banner\Models\Model::class;

    public static function execute($request)
    {
        try {

            $requestData = $request->validated();

            // Handle YouTube URL embedding
            if (!empty($requestData['video_url'])) {
                $videoUrl = $requestData['video_url'];
                $parsedUrl = parse_url($videoUrl);

                $videoId = null;

                // Handle full URL: https://www.youtube.com/watch?v=VIDEO_ID
                if (strpos($parsedUrl['host'], 'youtube.com') !== false && isset($parsedUrl['query'])) {
                    parse_str($parsedUrl['query'], $queryParams);
                    $videoId = $queryParams['v'] ?? null;
                }

                // Handle short URL: https://youtu.be/VIDEO_ID
                if (strpos($parsedUrl['host'], 'youtu.be') !== false) {
                    $videoId = ltrim($parsedUrl['path'], '/');
                }

                if ($videoId) {
                    $requestData['video_url'] = 'https://www.youtube.com/embed/' . $videoId;
                }
            }

            // Only allow mp4 video uploads
            if ($request->hasFile('video_file')) {
                $video = $request->file('video_file');
                // Validate file type and extension
                if ($video->getClientOriginalExtension() !== 'mp4' || $video->getMimeType() !== 'video/mp4') {
                    return messageResponse('Only MP4 video files are allowed.', [], 422, 'validation_error');
                }
                $currentDate = now()->format('Y/m');
                $videoPath = self::uploadVideoFile($video, $currentDate);
                    // dd($videoPath);
                $requestData['video_file'] = $videoPath;
            }

            if ($data = self::$model::query()->create($requestData)) {

                if (isset($requestData['display_status']) && $requestData['display_status'] == 1) {
                    // Set all other records to display_status = 0
                    self::$model::query()
                        ->where('id', '!=', $data->id)
                        ->update(['display_status' => 0]);
                }
                
                return messageResponse('Item added successfully', $data, 201);
            }
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
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
        $destinationPath = public_path('/uploads/videos/');

        // Ensure directory exists
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0775, true); // recursive mkdir
        }
    
        $fileName = uniqid('video_') . '.' . $video->getClientOriginalExtension();
    
        $video->move($destinationPath, $fileName);
    
        // Return relative path for storage (e.g., to save in DB)
        return '/uploads/videos/' . $fileName;
    }
}
