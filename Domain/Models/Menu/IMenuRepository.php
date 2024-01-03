<?php
declare(strict_types = 1);

namespace App\Domain\Models\Menu;

use App\Domain\Models\User\Type\RoleName;

/**
 * interface IMenuRepository
 */
interface IMenuRepository {

/**
 * 許可する全ての権限タイプを取得
 *
 * @param RoleName $roleName roleName
 * @param string $key key
 * @return array<string>
 */
	public function getArrowPermissionTypes(RoleName $roleName, string $key);
}
