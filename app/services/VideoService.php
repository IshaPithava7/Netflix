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
        $data['for_kids'] = $request->has('for_kids');

        if ($request->filled('video_url')) {
            $data['video_url'] = $request->input('video_url');
        }

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

        if ($request->filled('video_url')) {
            $data['video_url'] = $request->input('video_url');
        }

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
            if ($video && $video->trailer) {
                Storage::disk('public')->delete($video->trailer);
            }
            $data['trailer'] = $request->file('video')->store('videos', 'public');
        }

        // support uploaded file for origin_movie (form uses file input named origin_movie)
        // store origin_movie uploads in a separate folder so they are not mixed with main video files
        if ($request->hasFile('origin_movie')) {
            if ($video && $video->origin_movie) {
                Storage::disk('public')->delete($video->origin_movie);
            }
            $data['origin_movie'] = $request->file('origin_movie')->store('video_urls', 'public');
        }

        if ($request->hasFile('poster')) {
            if ($video && $video->poster) {
                Storage::disk('public')->delete($video->poster);
            }
            $data['poster'] = $request->file('poster')->store('video_posters', 'public');
        }

        if ($request->hasFile('mini_poster')) {
            if ($video && $video->mini_poster) {
                Storage::disk('public')->delete($video->mini_poster);
            }
            $data['mini_poster'] = $request->file('mini_poster')->store('title_posters', 'public');
        }
        return $data;
    }
}
