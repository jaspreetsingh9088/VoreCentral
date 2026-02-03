<?php

namespace App\Enum;

use BenSampo\Enum\Enum;

final class StripeAccountStatusEnum extends Enum
{
    const PENDING = 0;
    const ACTIVE = 1;
    const RESTRICTED = 2;
}
