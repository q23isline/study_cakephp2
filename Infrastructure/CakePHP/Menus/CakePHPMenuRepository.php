<?php
declare(strict_types = 1);

namespace App\Infrastructure\CakePHP\Menus;

use App\Domain\Models\Menu\IMenuRepository;
use App\Domain\Models\User\Type\RoleName;
use ClassRegistry;

/**
 * class CakePHPMenuRepository
 */
final class CakePHPMenuRepository implements IMenuRepository {

/**
 * {@inheritDoc}
 */
	public function getArrowPermissionTypes(RoleName $roleName, string $key) : array {
		/** @var \Menu $model */
		$model = ClassRegistry::init('Menu');
		$records = $model->find('all', [
			'fields' => [
				'permission_type',
			],
			'conditions' => [
				'key' => $key,
				'role_name' => $roleName->getValue(),
			],
		]);

		return array_map(function (array $record) {
			return $record['Menu']['permission_type'];
		}, $records);
	}
}
