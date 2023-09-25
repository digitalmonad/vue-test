<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette;
use App\Model\Enum\Device;
use App\Model\Enum\OperationSystem;
use Nette\Application\Responses\JsonResponse;
use Nette\Database\Explorer;

class DevicesPresenter extends Nette\Application\UI\Presenter
{
	const AUTH_HEADER = 'Authorization';

	public function __construct(
		private string $apiToken,
		public Explorer $database
	)
	{
		parent::__construct();
	}

	public function startup()
	{
		if ($this->getHttpRequest()->getHeader(self::AUTH_HEADER) !== $this->apiToken) {
			$this->getHttpResponse()->setCode(Nette\Http\IResponse::S401_UNAUTHORIZED);
			$this->sendResponse(new JsonResponse('Bad token.'));
		}

		parent::startup();
	}

	public function actionRead()
	{
		$devices = [];
		foreach ($this->database->table('device')->fetchAll() as $_device) {
			$devices[] = [
				'hostname' => $_device->hostname,
				'device_type' => $_device->device_type,
				'os_type' => $_device->os_type,
				'owner' => $_device->user->name,
			];
		}

		$this->sendResponse(new JsonResponse($devices));
	}


	public function actionCreate($hostname)
	{
		$data = Nette\Utils\Json::decode($this->getHttpRequest()->getRawBody(), Nette\Utils\Json::FORCE_ARRAY);

		foreach (['hostname', 'device_type', 'os_type', 'owner_name'] as $_value) {
			if (! isset($data[$_value])) {
				$this->getHttpResponse()->setCode(Nette\Http\IResponse::S400_BAD_REQUEST);
				$this->sendResponse(new JsonResponse('Missing value: ' . $_value));
			}
		}

		$device = Device::tryFrom($data['device_type']);
		if (! $device) {
			$this->getHttpResponse()->setCode(Nette\Http\IResponse::S400_BAD_REQUEST);
			$this->sendResponse(new JsonResponse('Invalid device_type: ' . $_value));
		}


		$os = OperationSystem::tryFrom($data['os_type']);
		if (! $os) {
			$this->getHttpResponse()->setCode(Nette\Http\IResponse::S400_BAD_REQUEST);
			$this->sendResponse(new JsonResponse('Invalid os_type: ' . $_value));
		}

		if (
			in_array($device->value, [Device::PC->value, Device::LAPTOP->value])
			&& in_array($os->value, [OperationSystem::I_OS->value, OperationSystem::ANDROID->value])
		) {
			$this->getHttpResponse()->setCode(Nette\Http\IResponse::S400_BAD_REQUEST);
			$this->sendResponse(new JsonResponse('Invalid combination operation system and device.'));
		}


		$user = $this->database->table('user')->where(['name' => $data['owner_name']])->fetch();

		if (!$user) {
			$user = $this->database->table('user')->insert([
				'name' => $data['owner_name']
			]);
		}

		$this->database->table('device')->insert([
			'hostname' => $data['hostname'],
			'device_type' => $data['device_type'],
			'os_type' => $data['os_type'],
			'user_id' => $user->id
		]);

		$this->sendResponse(new JsonResponse('success'));
	}

}