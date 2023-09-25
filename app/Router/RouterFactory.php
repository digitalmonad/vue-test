<?php

declare(strict_types=1);

namespace App\Router;

use Nette\Application\Routers\RouteList;
use Contributte\ApiRouter\ApiRoute;

final class RouterFactory
{
	public static function createRouter(): RouteList
	{
		$router = new RouteList;

		$router[] = new ApiRoute('/list', 'Devices', [
			'methods' => ['GET' => 'read']
		]);

		$router[] = new ApiRoute('/save', 'Devices', [
			'methods' => ['POST' => 'create']
		]);


		return $router;
	}
}
