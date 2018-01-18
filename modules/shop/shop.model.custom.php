<?php
/**
* @package Вывод количества товаров в меню
* @author Dmitry Petukhov (https://user.diafan.ru/user/weissfl)
* @copyright Copyright (c) 2018 by Dmitry Petukhov
* @license MIT License (https://en.wikipedia.org/wiki/MIT_License)
*/
class Shop_model extends Model
{
	/**
	 * Считает количество товаров в категории
	 *
	 * @param array $cat_ids номер категории и всех вложенных в нее
	 * @param integer $time текущее время, округленное до минут, в формате UNIX
	 * @return integer
	 */
	replace public function get_count_in_cat($cat_ids, $time)
	{
		return DB::query_result(
		"SELECT COUNT(DISTINCT e.id) FROM {shop} AS e"
		." INNER JOIN {shop_category_rel} AS r ON e.id=r.element_id"
		.($this->diafan->configmodules('where_access_element') ? " LEFT JOIN {access} AS a ON a.element_id=e.id AND a.module_name='shop' AND a.element_type='element'" : "")
		." WHERE r.cat_id IN (%s) AND e.[act]='1' AND e.trash='0'"
		." AND e.date_start<=%d AND (e.date_finish=0 OR e.date_finish>=%d)"
		.($this->diafan->configmodules('where_access_element') ? " AND (e.access='0' OR e.access='1' AND a.role_id=".$this->diafan->_users->role_id.")" : ''),
		implode(',', $cat_ids), $time, $time);
	}
}