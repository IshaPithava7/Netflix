<?php

namespace App\Services;

use App\Models\Collection;

class ContentPageService
{
    public function getPageData(?string $contentType = null)
    {
        $videoConstraint = function ($query) use ($contentType) {
            $query->select('videos.id', 'title', 'poster', 'file_path', 'title_poster', 'description');
            if ($contentType) {
                $query->whereHas('types', function ($q) use ($contentType) {
                    $q->where('name', 'like', '%' . $contentType . '%');
                });
            }
        };

        $collectionQuery = Collection::query();
        if ($contentType) {
            $collectionQuery->whereHas('videos.types', function ($q) use ($contentType) {
                $q->where('name', 'like', '%' . $contentType . '%');
            });
        }

        $allCollections = $collectionQuery->with(['videos' => $videoConstraint])
            ->has('videos')
            ->orderBy('id', 'asc')
            ->get();

        $heroCollection = $allCollections->firstWhere('title', 'Hero Section');
        $top10Collection = $allCollections->firstWhere('title', 'Top 10 Shows in India Today');

        $mainCollections = $allCollections
            ->reject(fn($c) => ($heroCollection && $c->id === $heroCollection->id)
                || ($top10Collection && $c->id === $top10Collection->id))
            ->filter(fn($c) => $c->videos->isNotEmpty())
            ->values();

        return [
            'heroCollection' => $heroCollection,
            'top10Collection' => $top10Collection,
            'mainCollections' => $mainCollections,
        ];
    }
}
