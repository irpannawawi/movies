<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MovieCard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $image,
        public string $title,
        public string $releaseDate,
        public string $rating,
        public string $runtime,
        public array $genres=[],
        public string $id,
        public string $loading= 'lazy'
        )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.movie-card');
    }
}
