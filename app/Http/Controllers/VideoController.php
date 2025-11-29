<?php

namespace App\Http\Controllers;

use App\Http\Requests\VideoRequest;
use App\Models\Video;
use App\Services\VideoService;
use App\Models\Collection;
use App\Models\Type;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    protected $videoService;

    public function __construct(VideoService $videoService)
    {
        $this->videoService = $videoService;
    }

    // Show all videos
    public function index()
    {
        $localVideos = Video::with('types')->paginate(10);
        return view('admin.videos.index', compact('localVideos'));
    }

    public function videos()
    {
        $localVideos = Video::with('types')->paginate(10);
        return view('admin.videos', compact('localVideos'));
    }

    // Show upload form
    public function create()
    {
        $types = Type::all();
        $collections = Collection::select('id', 'title')->get();
        return view('admin.videos.create', compact('types', 'collections'));
    }

    // Store uploaded video
    public function store(VideoRequest $request): JsonResponse
    {
        try {
            $video = $this->videoService->createVideo($request, $request->validated());
            return response()->json([
                'message' => 'Video uploaded successfully.',
                'video' => $video
            ], 201);
        } catch (\Exception $e) {
            Log::error('Video upload failed: '.$e->getMessage());
            return response()->json(['message' => 'An error occurred while uploading the video.'], 500);
        }
    }

    // Show edit form
    public function edit(Video $video)
    {
        $video->load('types', 'collections');
        $types = Type::all();
        $collections = Collection::select('id', 'title')->get();
        return view('admin.videos.edit', compact('video', 'types', 'collections'));
    }

    // Update video metadata
    public function update(VideoRequest $request, Video $video): JsonResponse
    {
        try {
            $video = $this->videoService->updateVideo($request, $video, $request->validated());
            return response()->json([
                'message' => 'Video updated successfully!',
                'video' => $video
            ]);
        } catch (\Exception $e) {
            Log::error('Video update failed: '.$e->getMessage());
            return response()->json(['message' => 'An error occurred while updating the video.'], 500);
        }
    }

    public function destroy(Video $video): JsonResponse
    {
        try {
            $files = [
                $video->trailer,
                $video->poster,
                $video->mini_poster,
            ];

            // Remove null or empty file names
            $files = array_filter($files);

            if (!empty($files)) {
                Storage::disk('public')->delete($files);
            }

            $video->delete();

            return response()->json(['message' => 'Video deleted successfully!']);
        } catch (\Exception $e) {
            Log::error('Video deletion failed: '.$e->getMessage());
            return response()->json(['message' => 'An error occurred while deleting the video.'], 500);
        }
    }
}
