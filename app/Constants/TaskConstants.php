<?php

namespace App\Constants;

class TaskConstants
{
    const LOW_PRIORITY    = 'LOW';
    const HIGH_PRIORITY   = 'HIGH';
    const MEDIUM_PRIORITY = 'MEDIUM';

    const PRIORITIES = [
        self::LOW_PRIORITY,
        self::HIGH_PRIORITY,
        self::MEDIUM_PRIORITY,
    ];
}
