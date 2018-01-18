<?php
/**
* @package Вывод количества товаров в меню
* @author Dmitry Petukhov (https://user.diafan.ru/user/weissfl)
* @copyright Copyright (c) 2018 by Dmitry Petukhov
* @license MIT License (https://en.wikipedia.org/wiki/MIT_License)
*/

if (! defined('DIAFAN'))
{
	$path = __FILE__; $i = 0;
	while(! file_exists($path.'/includes/404.php'))
	{
		if($i == 10) exit; $i++;
		$path = dirname($path);
	}
	include $path.'/includes/404.php';
}

class Trash_admin extends Frame_admin
{
	
	/**
	 * Восстанавливает элементы из корзины
	 * @return void
	 */
	after public function restore_id($id)
	{
		if($row['module_name']=='shop')
		{
    		 $this->diafan->_cache->delete('', 'menu');
		}
	}
}