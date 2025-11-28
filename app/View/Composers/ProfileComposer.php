<?php

namespace App\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;

class ProfileComposer
{
    public function compose(View $view)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $profiles = $user->profiles;
            $selectedProfileId = session('selected_profile_id');
            $selectedProfile = $selectedProfileId ? Profile::find($selectedProfileId) : $profiles->first();

            $view->with(compact('profiles', 'selectedProfile'));
        }
    }
}
