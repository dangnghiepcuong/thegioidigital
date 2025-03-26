<?php

namespace App\View\Components\Admin\Products\Section;

use Illuminate\View\Component;

class BadgeTemplate extends Component
{
    public function __construct(
        private ?string $backgroundStyle,
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
    public function render()
    {
        return view('components.admin.products.section.badge-template', [
            'backgroundStyle' => $this->backgroundStyle,
            'backgroundColor1' => $this->backgroundColor1,
            'backgroundColor2' => $this->backgroundColor2,
            'backgroundUrl' => $this->backgroundUrl,
            'iconUrl' => $this->iconUrl,
            'text' => $this->text,
            'textColor' => $this->textColor,
        ]);
    }
}
