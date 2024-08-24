<ul id="super-menu" class="menu super-menu">
    @foreach ($menuItems as $key => $item)
        <li>
            <a class="super-menu text-link" href="{{ $item['route'] ?? null }}">
                <span class="material-symbols-outlined">{{ $item['icon'] ?? null }}</span>
                <span class="title">
                    {{ $item['title'] ?? null }}
                    @if (isset($item['subMenu']))
                        <span class="keyboard-arrow-down material-symbols-outlined">keyboard_arrow_down</span>
                    @endif
                </span>
            </a>
            @if (isset($item['subMenu']))
                <div class="layout-pointer-arrow">
                    <span class="material-symbols-outlined pointer-arrow">change_history</span>
                </div>
            @endif
            @if (isset($item['subMenu']))
                <div class="menu-panel">
                    <ul class="menu grid-submenu">
                        @foreach ($item['subMenu'] as $subKey => $subItem)
                            <li>
                                <div class="title">{{ $subItem['title'] ?? null }}</div>
                                @if (isset($subItem['subMenu']))
                                    <ul class="menu vertical-submenu">
                                        @foreach ($subItem['subMenu'] as $sub2Item)
                                            <li>
                                                <a class="">
                                                    <span class="sub-title">{{ $sub2Item['title'] ?? null }}</span>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </li>
    @endforeach
</ul>
