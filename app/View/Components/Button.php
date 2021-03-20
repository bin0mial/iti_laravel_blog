<?php

namespace App\View\Components;

use Illuminate\View\Component;
use function Symfony\Component\Translation\t;

class Button extends Component
{
    /**
     * The button type.
     *
     * @var string
     */
    public $type;

    /**
     * The button target url.
     *
     * @var string
     */
    public $target;

    /**
     * The button displayed name.
     *
     * @var string
     */
    public $displayedName;

    /**
     * Create a new component instance.
     *
     * @param string $type
     * @param string $target
     * @param string $displayedName
     */

    public function __construct($type="primary", $target="#", $displayedName="Submit")
    {
        $this->type=$type;
        $this->target=$target;
        $this->displayedName=$displayedName;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.button');
    }
}
