<?php

namespace App\View\Components\General\Header;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class index extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $menuItems = [
            0 => [
                'title' => 'Điện thoại',
                'icon' => 'phone_iphone'
            ],
            1 => [
                'title' => 'Laptop',
                'icon' => 'laptop_chromebook'
            ],
            2 => [
                'title' => 'Tablet',
                'icon' => 'aod_tablet'
            ],
            3 => [
                'title' => 'Phụ kiện',
                'icon' => 'headphones',
                'subMenu' => [
                    0 => [
                        'title' => 'Phụ kiện di động',
                        'subMenu' => [
                            0 => [
                                'title' => 'Sạc dự phòng',
                            ],
                            1 => [
                                'title' => 'Cáp sạc, củ sạc',
                            ],
                            2 => [
                                'title' => 'Ốp lưng điện thoại',
                            ],
                            3 => [
                                'title' => 'Ốp lưng máy tính bảng',
                            ],
                            4 => [
                                'title' => 'Miếng dán camera',
                            ],
                            5 => [
                                'title' => 'Hub chuyển đổi cáp',
                            ],
                            6 => [
                                'title' => 'Giá đỡ điện thoại'
                            ],
                            7 => [
                                'title' => 'Bút cảm ứng tablet',
                            ]
                        ],
                    ],
                    1 => [
                        'title' => 'Thiết bị âm thanh',
                        'subMenu' => [
                            0 => [
                                'title' => 'Tai nghe bluetooth',
                            ],
                            1 => [
                                'title' => 'Tai nghe dây',
                            ],
                            2 => [
                                'title' => 'Loa',
                            ],
                            3 => [
                                'title' => 'Micro',
                            ],
                        ],
                    ],
                    2 => [
                        'title' => 'Thiết bị nhà thông minh',
                        'subMenu' => [
                            0 => [
                                'title' => 'Camera trong nhà',
                            ],
                            1 => [
                                'title' => 'Camera ngoài trời',
                            ],
                        ],
                    ],
                    3 => [
                        'title' => 'Thương hiệu hàng đầu',
                        'subMenu' => [
                            0 => [
                                'title' => 'Apple',
                            ],
                            1 => [
                                'title' => 'Samsung',
                            ],
                            2 => [
                                'title' => 'Imou',
                            ],
                            3 => [
                                'title' => 'Baseus',
                            ],
                            4 => [
                                'title' => 'JBL',
                            ],
                            5 => [
                                'title' => 'Anker',
                            ],
                            6 => [
                                'title' => 'Xmobile',
                            ],
                        ]
                    ],
                    4 => [
                        'title' => 'Phụ kiện Laptop',
                        'subMenu' => [
                            0 => [
                                'title' => 'Chuột máy tính',
                            ],
                            1 => [
                                'title' => 'Bàn phím',
                            ],
                            2 => [
                                'title' => 'Giá đỡ laptop',
                            ],
                            3 => [
                                'title' => 'Balo chống sốc',
                            ],
                            4 => [
                                'title' => 'Phần mềm',
                            ],
                        ],
                    ],
                    5 => [
                        'title' => 'Thiết bị lưu trữ',
                        'subMenu' => [
                            0 => [
                                'title' => 'Ổ cứng di động',
                            ],
                            1 => [
                                'title' => 'Thẻ nhớ',
                            ],
                            2 => [
                                'title' => 'USB',
                            ],
                        ]
                    ],
                    6 => [
                        'title' => 'Phụ kiện khác',
                        'subMenu' => [
                            0 => [
                                'title' => 'Pin tiểu',
                            ],
                            1 => [
                                'title' => 'Phụ kiện ô tô',
                            ],
                        ],
                    ],
                ],
            ],
            4 => [
                'title' => 'Smartwatch',
                'icon' => 'fitness_tracker',
            ],
            5 => [
                'title' => 'Đồng hồ',
                'icon' => 'watch',
            ],
            6 => [
                'title' => 'Máy cũ, Thu cũ',
                'icon' => 'screen_rotation_up',
                'subMenu' => [
                    0 => [
                        'title' => 'Máy cũ, Thu cũ',
                        'subMenu' => [
                            0 => [
                                'title' => 'Máy cũ, giá rẻ',
                            ],
                            1 => [
                                'title' => 'Thu cũ đổi mới'
                            ]
                        ]
                    ]
                ]
            ],
            7 => [
                'title' => 'PC, Máy in',
                'icon' => 'important_devices',
                'subMenu' => [
                    0 => [
                        'title' => 'PC, Màn hình',
                        'subMenu' => [
                            0 => [
                                'title' => 'Máy tính để bàn',
                            ],
                            1 => [
                                'title' => 'Màn hình máy tính',
                            ],
                            2 => [
                                'title' => 'Máy chơi game cầm tay',
                            ],
                        ],
                    ],
                    1 => [
                        'title' => 'Máy in, mực in',
                        'subMenu' => [
                            0 => [
                                'title' => 'Mực in',
                            ],
                            1 => [
                                'title' => 'Máy in',
                            ],
                        ],
                    ],
                ],
            ],
            8 => [
                'title' => 'Sim, Thẻ cào',
                'icon' => 'sim_card'
            ],
            9 => [
                'title' => 'Dịch vụ tiện ích',
                'icon' => 'linked_services',
                'subMenu' => [
                    0 => [
                        'title' => 'Thanh toán hóa đơn',
                        'subMenu' => [
                            0 => [
                                'title' => 'Đóng tiền trả góp',
                            ],
                            1 => [
                                'title' => 'Đóng tiền điện',
                            ],
                            2 => [
                                'title' => 'Đóng tiền nước',
                            ],
                        ]
                    ],
                    1 => [
                        'title' => 'Tài chính - Bảo hiểm',
                    ],
                    2 => [
                        'title' => 'Tiện ích viễn thông',
                    ],
                ]
            ]
        ];

        return view('components.general.header.index', [
            'menuItems' => $menuItems
        ]);
    }
}
