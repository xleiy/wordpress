<!DOCTYPE html>
<html>
<head>
	<title>页面未找到</title>
	<style type="text/css" media="screen">
		button{
			position: relative;
	        /*float: right;*/
	        border: 0;
	        padding: 0;
	        cursor: pointer;
	        height: 35px;
	        width: 80px;
	        color: #fff;
	        background-color: #252626;
	        /*background: transparent;*/
	       /* border-left: 1px solid rgba(255, 255, 255, 0.18);*/
	        border-radius: 0px;
		}
		a:hover, a:visited, a:link, a:active {
    		text-decoration: none;
    		color: #fff;
		}
		.note{
			/*position: relative;
    		top: -300px;*/
		}
	</style>
</head>
<body>
	<div align="center">
		<div style="position:relative;">
			<img src="<?php bloginfo('template_url'); ?>/images/404.jpg" alt="" width="400" style="margin-top: -60px;">
			<!-- <img src="<?php bloginfo('template_url'); ?>/images/404-2.jpg" alt=""> -->
			
		</div>
		<h1 style="margin-top: -10px;">页面被网络拐跑了……?</h1>
		<h2>404</h2>
		<button><a href="<?php echo home_url(); ?>">返回首页</a></button>
		<button><a href="JavaScript:history.go(-1)">返回上一步</a></button>
	</div>
</body>
</html>