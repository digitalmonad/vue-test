<?php

declare(strict_types=1);

namespace App\Model\Enum;

enum OperationSystem: string
{
	case WIN = 'win';
	case LIN = 'lin';
	case MAC_OS = 'macOS';
	case I_OS = 'iOS';
	case ANDROID = 'android';
}