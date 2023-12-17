<?php
/**
 * Menu Fixture
 */
class MenuFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary', 'comment' => 'ID'),
		'key' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'key' => 'index', 'collate' => 'utf8mb4_general_ci', 'comment' => '機能キー名', 'charset' => 'utf8mb4'),
		'permission_type' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'utf8mb4_general_ci', 'comment' => '機能アクションキー名', 'charset' => 'utf8mb4'),
		'role_name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 20, 'collate' => 'utf8mb4_general_ci', 'comment' => 'ロール名', 'charset' => 'utf8mb4'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null, 'comment' => '作成日'),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null, 'comment' => '更新日'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'menus_IDX1' => array('column' => array('key', 'permission_type', 'role_name'), 'unique' => 1)
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
			'id' => 1,
			'key' => 'Lorem ipsum dolor sit amet',
			'permission_type' => 'Lorem ipsum dolor sit amet',
			'role_name' => 'Lorem ipsum dolor ',
			'created' => '2023-12-17 16:05:00',
			'modified' => '2023-12-17 16:05:00'
		),
	);

}
