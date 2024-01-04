<?php
declare(strict_types = 1);

namespace App\ApplicationService\Permissions;

/**
 * class PermissionsArrowGetCommand
 */
final class PermissionsArrowGetCommand {

/**
 * @var string
 */
	private $__functionKey;

/**
 * constructor
 *
 * @param string $functionKey functionKey
 */
	public function __construct(string $functionKey) {
		$this->__functionKey = $functionKey;
	}

/**
 * FunctionKey
 *
 * @return string
 */
	public function getFunctionKey() : string {
		return $this->__functionKey;
	}
}
