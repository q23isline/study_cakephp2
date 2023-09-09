<?php
/**
 * User Fixture
 */
class UserFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'primary', 'collate' => 'utf8mb4_general_ci', 'comment' => 'ID', 'charset' => 'utf8mb4'),
		'username' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'key' => 'unique', 'collate' => 'utf8mb4_general_ci', 'comment' => 'ログインID', 'charset' => 'utf8mb4'),
		'password' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => 'パスワード', 'charset' => 'utf8mb4'),
		'role_name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 20, 'collate' => 'utf8mb4_general_ci', 'comment' => 'ロール名', 'charset' => 'utf8mb4'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'utf8mb4_general_ci', 'comment' => '姓名', 'charset' => 'utf8mb4'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null, 'comment' => '作成日'),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null, 'comment' => '更新日'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'users_IDX1' => array('column' => 'username', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8mb4', 'collate' => 'utf8mb4_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 'd51ec08b-360a-458e-ac32-67cb82668f7a',
			'username' => 'Lorem ipsum dolor sit amet',
			'password' => 'Lorem ipsum dolor sit amet',
			'role_name' => 'Lorem ipsum dolor ',
			'name' => 'Lorem ipsum dolor sit amet',
			'created' => '2023-09-09 05:58:03',
			'modified' => '2023-09-09 05:58:03'
		),
	);

}
