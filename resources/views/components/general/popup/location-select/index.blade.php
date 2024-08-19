<div class="layer-shadow-overlay">
</div>

<div class="layout-location-select">
    <div class="layout-top">
        <div class="layout-control-panel">
            <div class="text">
                <span class="title">Địa chỉ đã được chọn: </span>
                <span class="address province">tỉnh Bình Dương, </span>
                <span class="address district">huyện Dầu Tiếng, </span>
                <span class="address ward">thị trấn Dầu Tiếng </span>
            </div>
            <a class="btn-close" onclick="popupLocationSelect('close')">
                <span class="icon material-symbols-outlined">close</span>
                <span>Đóng</span>
            </a>
        </div>
        <div class="bar-search">
            <input class="inputtext input-search" placeholder="Tìm nhanh tỉnh thành, quận huyện, phường xã  " />
            <div class="layout-icon-search">
                <span class="icon material-symbols-outlined">
                    search
                </span>
            </div>
        </div>
    </div>
    <div class="layout-location-list">
        <div class="title">Hoặc chọn tỉnh, thành phố</div>
        <ul class="list-location list-province">
            @foreach ($locations as $item)
                <li class="item-location">{{ $item }}</li>
            @endforeach
            <li class="item-location">Hồ Chí Minh</li>
            <li class="item-location">Hồ Chí Minh</li>
            <li class="item-location">Hồ Chí Minh</li>
            <li class="item-location">Hồ Chí Minh</li>
            <li class="item-location">Hồ Chí Minh</li>
            <li class="item-location">Hồ Chí Minh</li>
            <li class="item-location">Hồ Chí Minh</li>
            <li class="item-location">Hồ Chí Minh</li>
            <li class="item-location">Hồ Chí Minh</li>
            <li class="item-location">Hồ Chí Minh</li>
            <li class="item-location">Hồ Chí Minh</li>
            <li class="item-location">Hồ Chí Minh</li>
            <li class="item-location">Hồ Chí Minh</li>
        </ul>
    </div>
</div>
