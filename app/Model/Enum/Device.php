<?php

declare(strict_types=1);

namespace App\Model\Enum;

enum Device: string
{
	case PC = 'pc';
	case LAPTOP = 'laptop';
	case MOBILE = 'mobile';
}