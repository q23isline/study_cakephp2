<?php
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
/**
 * User Model
 *
 */
class User extends AppModel {

/**
 * Validation rules
 *
 * @var array<string,mixed>
 */
	public $validate = array(
		'username' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'A username is required',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'password' => array(
			'required' => array(
				'rule' => array('notBlank'),
				'message' => 'A password is required',
			),
		),
		'role_name' => array(
			'valid' => array(
				'rule' => array('inList', array('admin', 'author')),
				'message' => 'Please enter a valid role',
				'allowEmpty' => false,
			)
		),
		'name' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

/**
 * beforeSave
 *
 * @param array<mixed> $options options
 * @return true
 */
	public function beforeSave($options = array()) {
		if (!$this->data) {
			return true;
		}

		$password = $this->data[$this->alias]['password'] ?? null;
		if ($password !== null) {
			$passwordHasher = new BlowfishPasswordHasher();
			$this->data[$this->alias]['password'] = $passwordHasher->hash($password);
		}
		return true;
	}
}
