<div style="text-align: center;padding-top: 10px;">
	<h3 id="blog-title"><?php bloginfo('name'); ?></h3>
</div>
<form class="search" action="<?php bloginfo('home'); ?>" id="search-toggle-form" onsubmit="return sub();">
    <input type="search" placeholder="Search here..." name="s" id="s" maxlength="34">
    <button id="search"><span>搜索</span><i class="iconfont icon-search" style="margin-top: 1px;"></i></button>
</form>
<script type="text/javascript">
	function sub(){
		var value=document.getElementById('s').value;
		if (value!=null&&value!=""&&value!=undefined) {
			return true;
		}else{
			return false;
		}
	}
</script>