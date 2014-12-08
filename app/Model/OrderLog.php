<?php
App::uses('AppModel', 'Model');
/**
 * Warehouse Model
 *
 * @property Store $Store
 * @property Product $Product
 */
class OrderLog extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'order_logs';
}
