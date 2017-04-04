<?php 

$code = get_option('uyan_code');
if($code) {
	echo stripslashes($code);
} else {
	echo '<!-- UY BEGIN -->
<div id="uyan_frame" class="comments-area"></div>
<script type="text/javascript" src="http://v2.uyan.cc/code/uyan.js"></script>
<!-- UY END -->';
}