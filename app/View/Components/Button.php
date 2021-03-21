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
     * The button id.
     *
     * @var string
     */
    public $id;
    /**
     * The button name.
     *
     * @var string
     */
    public $name;

    /**
     * The button type.
     *
     * @var string
     */
    public $buttonType;

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
     * @param null $id
     * @param null $name
     * @param string $buttonType
     * @param string $target
     * @param string $displayedName
     */

    public function __construct($type="primary", $id=null, $name=null, $buttonType="button",  $target="#", $displayedName="Submit")
    {
        $this->type=$type;
        $this->id=$id;
        $this->name=$name;
        $this->buttonType=$buttonType;
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
