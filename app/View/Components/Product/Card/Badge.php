<?php

namespace App\View\Components\Product\Card;

use App\Enums\BadgeBackgroundStyleEnum;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Badge extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        private string $backgroundStyle,
        private ?string $backgroundColor1,
        private ?string $backgroundColor2,
        private ?string $backgroundUrl,
        private ?string $iconUrl,
        private ?string $text,
        private ?string $textColor,
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $background = 'black';
        switch ($this->backgroundStyle) {
            case BadgeBackgroundStyleEnum::LINEAR_TO_RIGHT:
                $background = "linear-gradient(to right, $this->backgroundColor1, $this->backgroundColor2)";
                break;
            case BadgeBackgroundStyleEnum::LINEAR_TO_LEFT:
                $background = "linear-gradient(to left, $this->backgroundColor1, $this->backgroundColor2)";
                break;
            case BadgeBackgroundStyleEnum::LINEAR_TO_TOP:
                $background = "linear-gradient(to top, $this->backgroundColor1, $this->backgroundColor2)";
                break;
            case BadgeBackgroundStyleEnum::LINEAR_TO_BOTTOM:
                $background = "linear-gradient(to bottom, $this->backgroundColor1, $this->backgroundColor2)";
                break;
            case BadgeBackgroundStyleEnum::SOLID:
                $background = $this->backgroundColor1;
                break;
            case BadgeBackgroundStyleEnum::RADIAL:
                $background = "radial-gradient($this->backgroundColor1, $this->backgroundColor2)";
                break;
            case BadgeBackgroundStyleEnum::URL:
                $background = "url($this->backgroundUrl)";
                break;
        }

        return view('components.product.card.badge', [
            'background' => $background,
            'iconUrl' => $this->iconUrl,
            'text' => $this->text,
            'textColor' => $this->textColor,
        ]);
    }
}
