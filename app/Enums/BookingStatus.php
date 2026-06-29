<?php

namespace App\Enums;

enum BookingStatus: string
{
    case Pending = 'Pending';
    case Paid = 'Paid';
    case Completed = 'Completed';
    case Cancelled = 'Cancelled';
}
