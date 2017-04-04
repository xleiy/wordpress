<?php

/**
	Plugin Name: 友言
	Plugin URI: http://www.uyan.cc
	Description: 友言 - 国内最专业的社会化评论系统，它将替换您网站中默认的wordpress评论系统，一键同步评论留言信息到新浪微博，人人网，腾讯微薄，QQ空间，搜狐微博，网易微博，开心网，实时采集社交网络相关评论留言内容，从而帮助您的网站实现社交网络优化(SMO)，提高流量。(4.0以前版本需要删除旧评论插件，然后重新安装此版本)
	Version: 4.0
	Author: JiathisTeam (kefu@jiathis.com)
	Author URI: http://www.uyan.cc
*/

@date_default_timezone_set('PRC');
@session_start();
$domain = $_SERVER['HTTP_HOST'];

add_action('wp_head', 'uyan_wp_head');
add_action('admin_menu', 'uyan_add_pages', 10);
add_action('admin_head-edit-comments.php', 'uyan_comment_notice', 10);

add_filter('comments_template', 'uyan_comment');

function uyan_wp_head() {
	if(is_page() or is_single()) {
		echo "<link rel='shortlink' href='" . get_bloginfo('url') . '/?p='. get_the_ID() . "'/>";
	}
}

// 添加一级菜单及子菜单
function uyan_add_pages() {
	add_object_page(
		'友言评论',
		'友言评论',
		'manage_options',
		'uyan',
		'uyan_admin',
		plugin_dir_url(__FILE__) . 'img/uyan_icon.png'
	);
	add_submenu_page(
		'uyan',	// 一级菜单名称
		'安装设置',	//页面标题
		'安装设置',	// 选项名
		'manage_options',	// 权限
		'uyan_setting',	// 访问的页面
		'uyan_admin'	// 绑定的函数
	);
	add_submenu_page(
		'uyan',
		'统计分析',
		'统计分析',
		'manage_options',
		'uyan_analysis',
		'uyan_admin'
	);
	add_submenu_page(
		'uyan',
		'数据同步',
		'数据同步',
		'manage_options',
		'uyan_sync',
		'uyan_admin'
	);
}

// 管理页面
function uyan_admin() {
	include('uyan_admin.php');
}

// 原有评论是否保留
function uyan_comment($post_ID) {
	if(comments_open()) {
		return  dirname(__FILE__) . '/uyan_code.php';	// 登陆的时候会创建 uyan_src
	}
}

// 评论页提示
function uyan_comment_notice() {
	echo '<div class="updated" style="border:1px solid #E6DB55; background-color:#FFFBCC;">'
	. '<p>友言正在为您提供专业的社会化评论服务，Wordpress自带评论与友言评论将实时同步到本地数据库中。</p>'
	. '<p>评论管理请在友言中进行操作，您在本页对评论进行的任何操作，将不会同步到友言数据库中，但是在友言评论管理中进行的操作将会同步到Wordpress中。</p>'
	. '<p><a href="'.get_settings('home').'/wp-admin/admin.php?page=uyan">点击这里到友言进行管理</a>'
	. '</p></div>';
}

