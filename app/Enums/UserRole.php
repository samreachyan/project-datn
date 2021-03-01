<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class UserRole extends Enum
{
    const Admin = 1;
    const Instructor = 2;
    const Student = 3;
}
