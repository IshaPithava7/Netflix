<?php

namespace App\Http\Controllers;

use App\Http\Requests\VideoRequest;
use Illuminate\Http\Request;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Middleware\IsAdmin;
use App\Models\Collection;
use App\Models\WatchHistory;
use App\Models\Type;

class VideoController extends Controller
{
    protected $tmdb;

    public function __construct()
    {

    }

    // Show all videos
    public function index()
    {
        $localVideos = Video::with('types')->latest()->get(); // Local videos

        return view('admin.videos.index', compact('localVideos'));

    }

    // Show upload form
    public function create()
    {
        $types = Type::paginate(20); // Fetch all movie types from DB
        $collections = Collection::select('id', 'title')->get(); // Add this
        return view('admin.videos.create', compact('types', 'collections'));
    }

    // Store uploaded video
    public function store(VideoRequest $VideoRequest)
    {
        $data = $VideoRequest->validated();

        $data['file_path'] = $VideoRequest->file('video')->store('videos', 'public');
        $data['poster'] = $VideoRequest->hasFile('poster') ? $VideoRequest->file('poster')->store('video_posters', 'public') : null;
        $data['title_poster'] = $VideoRequest->hasFile('title_poster') ? $VideoRequest->file('title_poster')->store('title_posters', 'public') : null;
        $data['uploaded_by'] = auth()->id();

        $video = Video::create($data);

        $video->types()->attach($VideoRequest->types);
        $video->collections()->attach($VideoRequest->collections ?? []);

        return redirect()->route('admin.videos.index')->with('success', 'Video uploaded successfully.');
    }


    // Show edit form
    public function edit(Video $video)
    {
        $video->load('types', 'collections'); // eager load existing types
        $types = Type::all();
        $collections = Collection::select('id', 'title')->get();
        return view('admin.videos.edit', compact('video', 'types', 'collections'));
    }

    // Update video metadata
    public function update(VideoRequest $videoRequest, Video $video)
    {
        $data = $videoRequest->validated();


        if ($videoRequest->hasFile('video')) {
            Storage::disk('public')->delete($video->file_path);
            $data['file_path'] = $videoRequest->file('video')->store('videos', 'public');
        }

        if ($videoRequest->hasFile('poster')) {
            Storage::disk('public')->delete($video->poster);
            $data['poster'] = $videoRequest->file('poster')->store('video_posters', 'public');
        }

        if ($videoRequest->hasFile('title_poster')) {
            Storage::disk('public')->delete($video->title_poster);
            $data['title_poster'] = $videoRequest->file('title_poster')->store('title_posters', 'public');
        }

        $video->update($data);

        $video->types()->sync($videoRequest->types);
        $video->collections()->sync($videoRequest->collections ?? []);

        return redirect()->route('admin.videos.index')->with('success', 'Video updated successfully!');
    }



    // Optional: delete video // Delete video
    public function destroy(Video $video)
    {
        // Delete file from storage
        Storage::disk('public')->delete([$video->file_path, $video->poster, $video->title_poster]);

        // Delete DB record
        $video->delete();

        return redirect()->route('admin.videos.index')->with('success', 'Video deleted successfully!');
    }


}
