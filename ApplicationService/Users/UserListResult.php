<?php
declare(strict_types = 1);

namespace App\ApplicationService\Users;

/**
 * class UserListResult
 */
final class UserListResult {

/**
 * @var array<string,mixed>
 */
	private $__meta;

/**
 * @var \App\ApplicationService\Users\UserData[]
 */
	private $__data;

/**
 * constructor
 *
 * @param array<string,mixed> $meta meta
 * @param \App\ApplicationService\Users\UserData[] $data data
 */
	public function __construct(
		array $meta,
		array $data
	) {
		$this->__meta = $meta;
		$this->__data = $data;
	}

/**
 * 整形する
 *
 * @return array<string,array<mixed>>
 */
	public function format() : array {
		$data = [];
		foreach ($this->__data as $source) {
			$data[] = [
				'id' => $source->getId(),
				'username' => $source->getUsername(),
				'password' => $source->getPassword(),
				'roleName' => $source->getRoleName(),
				'name' => $source->getName(),
				'created' => $source->getCreated()->format('Y-m-d H:i:d'),
				'modified' => $source->getModified()->format('Y-m-d H:i:d'),
			];
		}

		return [
			'meta' => $this->__meta,
			'data' => $data,
		];
	}
}
