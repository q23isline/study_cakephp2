<?php
declare(strict_types = 1);

namespace App\Domain\Services;

use App\Domain\Models\Menu\IMenuRepository;
use App\Domain\Models\User\IUserRepository;

/**
 * class PermissionService
 */
final class PermissionService {

/**
 * @var \App\Domain\Models\User\IUserRepository
 */
	private $__userRepository;

/**
 * @var \App\Domain\Models\Menu\IMenuRepository
 */
	private $__menuRepository;

/**
 * constructor
 *
 * @param \App\Domain\Models\User\IUserRepository $userRepository userRepository
 * @param \App\Domain\Models\Menu\IMenuRepository $menuRepository menuRepository
 */
	public function __construct(
		IUserRepository $userRepository,
		IMenuRepository $menuRepository
	) {
		$this->__userRepository = $userRepository;
		$this->__menuRepository = $menuRepository;
	}

/**
 * 許可するか
 *
 * @param string $action action
 * @param string $key key
 * @return bool
 */
	public function isAllowedSelf(string $action, string $key) : bool {
		$selfUser = $this->__userRepository->getLoginUser();
		$arrowPermissionTypes = $this->__menuRepository->getArrowPermissionTypes($selfUser->getRoleName(), $key);
		foreach ($arrowPermissionTypes as $type) {
			if ($type === 'editable') {
				switch ($action) {
					case 'add':
						return true;
					case 'edit':
						return true;
					case 'delete':
						return true;
				}
			} elseif ($type === 'referable') {
				switch ($action) {
					case 'list':
						return true;
					case 'view':
						return true;
				}
			}
		}

		return false;
	}
}