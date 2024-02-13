<?php

declare(strict_types=1);

namespace App\Enum;

class TaskPriorityEnum
{
    public const PRIORITY_LOW = 'low';

    public const PRIORITY_HIGH = 'high';

    public const PRIORITY_MEDIUM = 'medium';

    public const PRIORITIES = [
        self::PRIORITY_LOW,
        self::PRIORITY_HIGH,
        self::PRIORITY_MEDIUM
    ];

    public const PRIORITIES_TRANS_KEYS = [
        self::PRIORITY_LOW => 'label.low',
        self::PRIORITY_HIGH => 'label.high',
        self::PRIORITY_MEDIUM => 'label.medium',
    ];

    public static function getTypesLabels(): array
    {
        return self::PRIORITIES_TRANS_KEYS;
    }

    public static function getTypeLabel(string $type): string
    {
        return self::PRIORITIES_TRANS_KEYS[$type];
    }
}