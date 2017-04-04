<?php

require_once 'uyan_header.php';

$action = isset($_GET['action']) && $_GET['action'] != '' ? $_GET['action'] : '';

if($action) {	// 执行的操作，完成后即退出
	switch($action) {
		case 'setkey' :
			$key = isset($_GET['key']) && $_GET['key'] != '' ? $_GET['key'] : '';
			$uid = isset($_GET['uid']) && $_GET['uid'] != '' ? $_GET['uid'] : '';
			if($key && $uid) {
				update_option('uyan_uid', $uid);
				update_option('uyan_key', $key);
				update_option('uyan_code', '<!-- UY BEGIN -->
<div id="uyan_frame" class="comments-area"></div>
<script type="text/javascript" src="http://v2.uyan.cc/code/uyan.js?uid=' . $uid . '"></script>
<!-- UY END -->');
				echo '<script type="text/javascript">window.parent.location.href="./admin.php?page=uyan";</script>';
			}
		break;
	}
	exit;
}

if(get_option('uyan_uid') && get_option('uyan_key') && get_option('uyan_code')) {
	$page = isset($_GET['page']) && $_GET['page'] != '' ? $_GET['page'] : 'uyan';
	if($page == 'uyan_analysis') {
		$pre = 'analysis/user';
	} else if($page == 'uyan_setting') {
		$pre = 'setting';
	} else if($page == 'uyan_sync') {
		require_once 'uyan_sync.php';
		exit;
	} else {
		$pre = 'comment';
	}
?>

<div id="uyan_comment">
	<div style="position:absolute; left: 15px;">
		<img src="<?php echo plugin_dir_url(__FILE__);?>img/uyan_loading.gif" />
	</div>
</div>
<script type="text/javascript">
var pre = '<?php echo $pre; ?>';
var iUrl = "http://www.uyan.cc/"+pre+"?iframe=1&dm="+document.domain;
jQuery(document).ready(function($) {
	$.show('<?php echo get_option('uyan_uid'); ?>', '<?php echo get_option('uyan_key'); ?>', iUrl);
});
</script>

<?php
} else {
?>

<div id="uyan_comment">
	<div style="position:absolute; left: 15px; top: 100px;">
		<span style="font-size: 18px;">第一步：验证用户编号：</span>
		<input id="uyan_uid" type="text" style="width: 200px; height: 35px; border: 1px solid #ccc;" value="" />
		<input id="uyan_uid_smt" type="submit" style="width: 60px; height: 35px;" value="提交" onclick="jQuery(document).ready(function($) {$.setUid($('#uyan_uid').val());});" />
		&nbsp;&nbsp;<br /><br />
		<span style="font-size: 18px;">第二步：验证友言密钥：</span>
		<input id="uyan_key" type="text" style="width: 200px; height: 35px; border: 1px solid #ccc;" disabled="disabled" value="" />
		<input id="uyan_key_smt" type="submit" style="width: 60px; height: 35px;" value="提交" disabled="disabled" onclick="jQuery(document).ready(function($) {$.setKey($('#uyan_uid').val(), $('#uyan_key').val());});" />
		&nbsp;&nbsp;<br /><br />
		<span id="uyan_msg" style="font-size: 14px;">可以<a style="color: #ff0000;" href="http://www.uyan.cc/register" target="_blank">点击这里</a>到友言官网注册并登陆成功后获取用户编号以及密钥</span>
	</div>
</div>

<?php
}