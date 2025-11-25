<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Video;

class VideoCard extends Component
{
    public $video;
<<<<<<< HEAD

=======
>>>>>>> c9e99602ab009b88ada301ed06b31af527641be8
    public $type;

    /**
     * Create a new component instance.
     */
    public function __construct(Video $video, string $type = 'collection')
    {
        $this->video = $video;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.video-card');
    }
}
