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
 
if (empty($result["rows"][$result["parent_id"]]))
{
	return true;
}

// начало уровня меню
echo '<ul>';
foreach ($result["rows"][$result["parent_id"]] as $row)
{
	if ($row["active"])
	{
		// начало пункта меню для текущей страницы
		echo '<li>';
	}
	elseif ($row["active_child"])
	{
		// начало пункта меню для активного дочернего пункта
		echo '<li>';
	}
	else
	{
		// начало любого другого пункта меню
		echo '<li>';
	}

	if (
		// на текущей странице нет ссылки, если не включена настройка "Текущий пункт как ссылка"
		(!$row["active"] || $result["current_link"])

		// влючен пункт "Не отображать ссылку на элемент, если он имеет дочерние пункты"
		&& (!$result["hide_parent_link"] || empty($result["rows"][$row["id"]]))
	)
	{
		if ($row["othurl"])
		{
			echo '<a href="'.$row["othurl"].'"'.$row["attributes"].'>';
		}
		else
		{
			echo '<a href="'.BASE_PATH_HREF.$row["link"].'"'.$row["attributes"].'>';
		}
	}

	//вывод изображения
	if (! empty($row["img"]))
	{
		echo '<img src="'.$row["img"]["src"].'" width="'.$row["img"]["width"].'" height="'.$row["img"]["height"]
		.'" alt="'.$row["img"]["alt"].'" title="'.$row["img"]["title"].'"> ';
	}

	// название пункта меню
	if (! empty($row["name"]))
	{
	    echo $row["name"].($row['module_name']=='shop' ? ' <sup>'.$row['count'].'</sup>' : ''); 
	}

	if (
		// на текущей странице нет ссылки, если не включена настройка "Текущий пункт как ссылка"
		(!$row["active"] || $result["current_link"])

		// влючен пункт "Не отображать ссылку на элемент, если он имеет дочерние пункты"
		&& (!$result["hide_parent_link"] || empty($result["rows"][$row["id"]]))
	)
	{
		echo '</a>';
	}

	if ($result["show_all_level"] || $row["active_child"] || $row["active"])
	{
		// вывод вложенного уровня меню
		$menu_data = $result;
		$menu_data["parent_id"] = $row["id"];
		$menu_data["level"]++;

		echo $this->get('show_level_leftmenu_2', 'menu', $menu_data);
	}
	if ($row["active"])
	{
		// окончание пункта меню - текущей страницы
		echo '</li>';
	}
	elseif ($row["active_child"])
	{
		// окончание пункта меню для активного дочернего пункта
		echo '</li>';
	}
	else
	{
		// окончание любого другого пункта меню
		echo '</li>';
	}
}
// окончание уровня меню
echo '</ul>';