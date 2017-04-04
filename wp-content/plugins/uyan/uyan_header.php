<?php echo wp_enqueue_script('jquery'); ?>
<script type='text/javascript' src="<?php echo plugin_dir_url(__FILE__); ?>js/uyan.js"></script>
<div style="margin: 10px 15px 0; border-bottom: 1px solid #cdcdcd; padding-bottom: 5px;">
	<a target="_blank" href="http://www.uyan.cc"><img src="<?php echo plugin_dir_url(__FILE__); ?>img/uyan_logo.png"></a>
	<span id="uyan_notice"><?php echo bloginfo('version'); ?></span>
	<script type='text/javascript' src="http://www.uyan.cc/resource/js/notice.js"></script>
</div>