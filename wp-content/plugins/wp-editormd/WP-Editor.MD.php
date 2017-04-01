<?php
/**
 * Plugin Name: WP Editor.md
 * Plugin URI: https://iiong.com/wordpress-plugins-wp-editormd.html
 * Description: 或许这是一个WordPress中最好，最完美的Markdown编辑器。
 * Version: 1.4
 * Author: 淮城一只猫
 * Author URI: https://iiong.com/
 * License: GPLv2 or later
 */

define('WP_EDITORMD_PLUGIN_VERSION', '1.3'); //版本说明
define('WP_EDITORMD_PLUGIN_URL', plugins_url('', __FILE__)); //插件资源路径
define('WP_EDITORMD_PLUGIN_PATH', dirname(__FILE__)); //插件路径文件夹

//引入jetpack解析库
if (!function_exists('jetpack_require_lib')) {
    require WP_EDITORMD_PLUGIN_PATH . '/jetpack/require-lib.php';
}

//引入jetpack保存库
if (!class_exists('WPCom_Markdown')) {
    require WP_EDITORMD_PLUGIN_PATH . '/jetpack/markdown/easy-markdown.php';
}

//引入资源模板
require  WP_EDITORMD_PLUGIN_PATH . '/editormd_class.php';

add_action('personal_options_update', array($editormd, 'user_personalopts_update'));
add_action('admin_head', array($editormd, 'add_admin_head'));
add_action('edit_form_advanced', array($editormd, 'load_editormd'));
add_action('edit_page_form', array($editormd, 'load_editormd'));
add_action('simple_edit_form', array($editormd, 'load_editormd'));
add_action('admin_print_styles', array($editormd, 'add_admin_style'));
add_action('admin_print_scripts', array($editormd, 'add_admin_js'));
add_action('admin_init', array($editormd, 'editormd_jetpack_markdown_posting_always_on'), 11);
add_action('plugins_loaded', array($editormd, 'editormd_jetpack_markdown_load_textdomain'));
add_filter('quicktags_settings', array($editormd, 'quicktags_settings'), $editorId = 'content');// 删除编辑器的快捷按钮标签
add_filter('pre_option_' . WPCom_Markdown::POST_OPTION, '__return_true');
add_filter('plugin_action_links_' . plugin_basename(__FILE__), array($editormd, 'jetpack_markdown_settings_link'));//添加插件设置链接

register_activation_hook(basename(dirname(__FILE__)).'/' . basename(__FILE__), array($editormd, 'activate')); //启用挂钩
register_deactivation_hook(basename(dirname(__FILE__)).'/' . basename(__FILE__), array($editormd, 'deactivate'));//停用挂钩