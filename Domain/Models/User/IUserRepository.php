<?php
declare(strict_types = 1);

namespace App\Domain\Models\User;

use App\Domain\Models\User\Type\UserId;

/**
 * interface IUserRepository
 */
interface IUserRepository {

/**
 * カウント
 *
 * @return int
 */
	public function count();

/**
 * IDで検索
 *
 * @param \App\Domain\Models\User\Type\UserId $userId userId
 * @return \App\Domain\Models\User\User
 * @throws \NotFoundException
 */
	public function getById(UserId $userId);

/**
 * すべて取得
 *
 * @param int $page ページ番号
 * @param int $pageSize ページサイズ
 * @param string $sort ソート
 * @return \App\Domain\Models\User\UserCollection
 */
	public function findAll(int $page, int $pageSize, string $sort);
}
