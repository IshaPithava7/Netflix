<?php

namespace App\Services;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoService
{
    public function createVideo(Request $request, array $data): Video
    {
        $data = $this->handleFileUploads($request, $data);
        $data['uploaded_by'] = auth()->id();

        $video = Video::create($data);

        if ($request->has('types')) {
            $video->types()->attach($request->types);
        }

        if ($request->has('collections')) {
            $video->collections()->attach($request->collections);
        }

        return $video;
    }

    public function updateVideo(Request $request, Video $video, array $data): Video
    {
        $data = $this->handleFileUploads($request, $data, $video);

        $video->update($data);

        if ($request->has('types')) {
            $video->types()->sync($request->types);
        } else {
            $video->types()->detach();
        }

        if ($request->has('collections')) {
            $video->collections()->sync($request->collections);
        } else {
            $video->collections()->detach();
        }

        return $video;
    }

    private function handleFileUploads(Request $request, array $data, Video $video = null): array
    {
        if ($request->hasFile('video')) {
            if ($video && $video->file_path) {
                Storage::disk('public')->delete($video->file_path);
            }
            $data['file_path'] = $request->file('video')->store('videos', 'public');
        }

        if ($request->hasFile('poster')) {
            if ($video && $video->poster) {
                Storage::disk('public')->delete($video->poster);
            }
            $data['poster'] = $request->file('poster')->store('video_posters', 'public');
        }

        if ($request->hasFile('title_poster')) {
            if ($video && $video->title_poster) {
                Storage::disk('public')->delete($video->title_poster);
            }
            $data['title_poster'] = $request->file('title_poster')->store('title_posters', 'public');
        }
        return $data;
    }
}
