<?php

namespace App\Http\Controllers;

use App\Http\Requests\VideoRequest;
use App\Models\Video;
use App\Services\VideoService;
use App\Models\Collection;
use App\Models\Type;
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
    public function store(VideoRequest $request)
    {
        $this->videoService->createVideo($request, $request->validated());
        return redirect()->route('admin.videos.index')->with('success', 'Video uploaded successfully.');
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
    public function update(VideoRequest $request, Video $video)
    {
        $this->videoService->updateVideo($request, $video, $request->validated());
        return redirect()->route('admin.videos.index')->with('success', 'Video updated successfully!');
    }

    public function destroy(Video $video)
    {
        Storage::disk('public')->delete([$video->file_path, $video->poster, $video->title_poster]);
        $video->delete();
        return redirect()->route('admin.videos.index')->with('success', 'Video deleted successfully!');
    }
}
