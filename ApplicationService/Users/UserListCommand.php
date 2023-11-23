<?php
declare(strict_types = 1);

namespace App\ApplicationService\Users;

/**
 * class UserListCommand
 */
final class UserListCommand {

/**
 * @var int
 */
	private $__page;

/**
 * @var int
 */
	private $__pageSize;

/**
 * @var string
 */
	private $__sort;

/**
 * constructor
 *
 * @param int $page page
 * @param int $pageSize pageSize
 * @param string $sort sort
 */
	public function __construct(
		int $page,
		int $pageSize,
		string $sort
	) {
		$this->__page = $page;
		$this->__pageSize = $pageSize;
		$this->__sort = $sort;
	}

/**
 * Page
 *
 * @return int
 */
	public function getPage() : int {
		return $this->__page;
	}

/**
 * PageSize
 *
 * @return int
 */
	public function getPageSize() : int {
		return $this->__pageSize;
	}

/**
 * Sort
 *
 * @return string
 */
	public function getSort() : string {
		return $this->__sort;
	}
}
