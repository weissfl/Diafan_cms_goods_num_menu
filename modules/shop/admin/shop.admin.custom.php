<?php
/**
* @package Вывод количества товаров в меню
* @author Dmitry Petukhov (https://user.diafan.ru/user/weissfl)
* @copyright Copyright (c) 2018 by Dmitry Petukhov
* @license MIT License (https://en.wikipedia.org/wiki/MIT_License)
*/
class Shop_admin extends Frame_admin
{

	before public function delete($del_id, $trash_id)
	{
		$this->diafan->_cache->delete('', 'menu');
	}
	
	before public function save_variable_action()
	{
		if($this->diafan->is_new)
			{
				$this->diafan->_cache->delete('', 'menu');
			}
	}
	
}