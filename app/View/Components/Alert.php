<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Alert extends Component
{
    /**
     * Create a new component instance.
     */

    public $type;

    public $content;

    public $dataIcon;
    public function __construct($type='success', $content, $dataIcon='check')
    {
        $this->type = $type;
        $this->content = $content;
        $this->dataIcon = $dataIcon;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.alert');
    }
}
