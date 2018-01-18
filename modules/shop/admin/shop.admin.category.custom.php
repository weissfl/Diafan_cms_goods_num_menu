<?php
/**
* @package Вывод количества товаров в меню
* @author Dmitry Petukhov (https://user.diafan.ru/user/weissfl)
* @copyright Copyright (c) 2018 by Dmitry Petukhov
* @license MIT License (https://en.wikipedia.org/wiki/MIT_License)
*/
class Shop_admin_category extends Frame_admin
{

    new public $config_other_row = array(
        'id' => 'function'
    );

    new public function other_row_id($row)
    {
        Custom::inc('modules/shop/shop.model.php');
        $shopModel = new Shop_model($this->diafan);
        $childs = $this->diafan->get_children($row['id'], 'shop_category');
        $time = mktime(23, 59, 0, date("m"), date("d"), date("Y"));
        $self_count = $shopModel->get_count_in_cat(array($row['id']), $time);
        $total_count = (!empty($childs) ? $shopModel->get_count_in_cat($childs, $time) : 0)+$self_count;
        return "<td>$total_count ($self_count)</td>";
    }

}