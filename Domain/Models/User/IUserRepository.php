<?php
declare(strict_types = 1);

namespace App\Domain\Models\User;

use App\Domain\Models\User\Type\UserId;

/**
 * interface IUserRepository
 */
interface IUserRepository {

/**
 * IDで検索
 *
 * @param \App\Domain\Models\User\Type\UserId $userId userId
 * @return \App\Domain\Models\User\User
 * @throws \NotFoundException
 */
	public function getById(UserId $userId);
}
