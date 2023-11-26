<?php
declare(strict_types = 1);

namespace App\Domain\Models\User\Type;

use App\Domain\Shared\Exception\ExceptionItem;
use App\Domain\Shared\Exception\ValidateException;

/**
 * class RoleName
 */
final class RoleName {

/**
 * @var array<string>
 */
	private const ARROW_ROLE_NAMES = [
		'admin',
		'author',
	];

/**
 * @var string
 */
	private $__value;

/**
 * constructor
 *
 * @param string $value value
 * @throws \App\Domain\Shared\Exception\ValidateException
 */
	public function __construct(string $value) {
		if (!in_array($value, self::ARROW_ROLE_NAMES, true)) {
			throw new ValidateException([new ExceptionItem('roleName', 'ロール名は admin, author のいずれかです。')]);
		}

		$this->__value = $value;
	}

/**
 * value
 *
 * @return string
 */
	public function getValue() : string {
		return $this->__value;
	}
}
