<?php
declare(strict_types = 1);

namespace App\ApplicationService\Users;

use App\Domain\Models\User\IUserRepository;
use App\Domain\Services\PermissionService;
use App\Domain\Shared\Exception\ExceptionItem;
use App\Domain\Shared\Exception\PermissionDeniedException;
use App\Domain\Shared\Exception\ValidateException;

/**
 * class UserListApplicationService
 */
class UserListApplicationService {

/**
 * @var \App\Domain\Models\User\IUserRepository
 */
	private $__userRepository;

/**
 * @var \App\Domain\Services\PermissionService
 */
	private $__permissionService;

/**
 * @var array<string>
 */
	private const SORTS = [
		'id',
		'username',
		'password',
		'roleName',
		'name',
		'created',
		'modified',
	];

/**
 * constructor
 *
 * @param \App\Domain\Models\User\IUserRepository $userRepository userRepository
 * @param \\App\Domain\Services\PermissionService $permissionService permissionService
 */
	public function __construct(
		IUserRepository $userRepository,
		PermissionService $permissionService
	) {
		$this->__userRepository = $userRepository;
		$this->__permissionService = $permissionService;
	}

/**
 * ユーザー一覧を取得する
 *
 * @param \App\ApplicationService\Users\UserListCommand $command command
 * @return array{0:array<string,mixed>,1:array<\App\ApplicationService\Users\UserData>}
 * @throws \App\Domain\Shared\Exception\PermissionDeniedException
 * @throws \App\Domain\Shared\Exception\ValidateException
 */
	public function handle(UserListCommand $command) : array {
		if (!$this->__validateParamSort($command->getSort())) {
			throw new ValidateException([new ExceptionItem('sort', '不正なソートです。')]);
		}

		if (!$this->__permissionService->isAllowedSelf('list', 'user')) {
			throw new PermissionDeniedException([new ExceptionItem('', '権限がありません。')]);
		}

		$count = $this->__userRepository->count();
		$users = $this->__userRepository->findAll($command->getPage(), $command->getPageSize(), $command->getSort());

		$meta = [
			'totalCount' => $count,
			'page' => $command->getPage(),
			'pageSize' => $command->getPageSize(),
		];

		$data = [];
		foreach ($users as $user) {
			$data[] = new UserData($user);
		}

		return [$meta, $data];
	}

/**
 * sort のバリデーション
 *
 * @param string $sort ソート
 * @return bool
 */
	private function __validateParamSort(string $sort) : bool {
		$orderKey = substr($sort, 0, 1);
		if (!in_array($orderKey, ['+', '-'], true)) {
			return false;
		}

		$sortKey = substr($sort, 1);
		if (!in_array($sortKey, self::SORTS, true)) {
			return false;
		}

		return true;
	}
}
