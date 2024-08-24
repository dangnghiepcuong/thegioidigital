<!-- Simplicity is an acquired taste. - Katharine Gerould -->
<div class="panel {{ $align ?? null}}">
    <div class="row">
        <x-partial.button.selection :text="'Dưới 2 triệu'" />
        <x-partial.button.selection :text="'Từ 2 - 4 triệu'" />
        <x-partial.button.selection :text="'Từ 4 - 7 triệu'" />
        <x-partial.button.selection :text="'Từ 7 - 13 triệu'" />
        <x-partial.button.selection :text="'Từ 13 - 20 triệu'" />
        <x-partial.button.selection :text="'Trên 20 triệu'" />
    </div>
</div>
