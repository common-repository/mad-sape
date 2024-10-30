<?php
/*
Plugin Name: Mad_Sape
Plugin URI: http://d-o-b.ru/mad-sape-plugin-wordpress/
Description: Установка кода Sape. Перед активация проверьте наличие <a href="https://www.sape.ru/get_user_files.php">папки</a> с кодом Sape в корне сайта и права 777 на этой же папке.
Version: 1.0
Author: Yuriy 'Mad_Man' Lagodich
Author URI: http://d-o-b.ru/
*/
/*  Copyright 2010 Lagodich Yuriy Vladimirovich (email: admin@m7team.ru)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
register_activation_hook(__FILE__, 'first_start');

function first_start() {
	global $wpdb;
	global $sape_code;
	global $number;
	$number = '00000000000000000000000';
   	$table_name = $wpdb->prefix . "madsape";
   	if($wpdb->get_var("show tables like '$table_name'") != $table_name) {
	$sql = "CREATE TABLE `$table_name` (`code` VARCHAR(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, PRIMARY KEY (`code`)) ENGINE = MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;";
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
      	dbDelta($sql);
  	$rows_affected = $wpdb->insert($table_name, array('code' => $number));
add_option("sape_code", $sape_code);
	
}
}

add_action('admin_menu', 'sape_menu');

function sape_menu() {
add_submenu_page('options-general.php',
	'Mad_Sape',
	'Mad_Sape',
	'edit_plugins',
	__FILE__,
	'callme');
add_action('admin_menu', 'callme');
}

function callme() {
	include 'wp_area.php';
	global $wpdb;
	global $myrows;
	$table_name = $wpdb->prefix . "madsape";
	$myrows = $wpdb->get_results("SELECT 0, code FROM $table_name");
	print $myrows[0]->code . ".";
	include 'wp_area2.php';
	
}

add_action('wp_footer', 'call_code');

function call_code() {
	global $wpdb;
	global $myrows;
	global $c;
	$table_name = $wpdb->prefix . "madsape";
	$myrows = $wpdb->get_results("SELECT 0, code FROM $table_name");
	$c = $myrows[0]->code;
include 'sape.php';
}
?>
