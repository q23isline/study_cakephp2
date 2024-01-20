<?php
App::uses('Mysql', 'Model/Datasource/Database');

class MysqlLog extends Mysql {

/**
 * Log given SQL query.
 *
 * @param string $sql — SQL statement
 * @param array $params — Values binded to the query (prepared statements)
 * @return void
 */
	public function logQuery($sql, $params = []) {
		parent::logQuery($sql, $params);
		if (Configure::read('Cake.logQuery')) {
			$this->log($sql, LOG_DEBUG); // SQLクエリーのみ
		}
	}
}
