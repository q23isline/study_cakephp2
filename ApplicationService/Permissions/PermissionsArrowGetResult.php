<?php
declare(strict_types = 1);

namespace App\ApplicationService\Permissions;

/**
 * class PermissionsArrowGetResult
 */
final class PermissionsArrowGetResult {

/**
 * @var array<string>
 */
	private $__permissionType;

/**
 * constructor
 *
 * @param array<string> $permissionType permissionType
 */
	public function __construct(array $permissionType) {
		$this->__permissionType = $permissionType;
	}

/**
 * 整形する
 *
 * @return array<string,array<string,string>>
 */
	public function format() : array {
		return [
			'data' => $this->__permissionType,
		];
	}
}
