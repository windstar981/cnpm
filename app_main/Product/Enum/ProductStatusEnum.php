<?php
namespace AppMain\Product\Enum;

class ProductStatusEnum
{
    const PUBLIC = 1;
    const PRIVATE = 0;
    const DELETED = -1;

    public static $statusText = [
        self::PUBLIC => 'Hiển thị',
        self::PRIVATE => 'Ẩn'
    ];

}