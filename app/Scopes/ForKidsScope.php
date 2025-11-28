<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class ForKidsScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        if (session('kids_mode', false)) {
            $builder->where('for_kids', true);
        }
    }
}
