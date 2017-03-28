<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php wp_head(); ?>
	<title><?php if ( is_home() ) {
        bloginfo('name'); echo " - "; bloginfo('description');
    } elseif ( is_category() ) {
        single_cat_title(); echo " - "; bloginfo('name');
    } elseif (is_single() || is_page() ) {
        single_post_title();
    } elseif (is_search() ) {
        echo "搜索结果"; echo " - "; bloginfo('name');
    } elseif (is_404() ) {
        echo '页面未找到!';
    } else {
        wp_title('',true);
    } ?></title>
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/icon.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/casual.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/normalize.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/style.css" type="text/css" media="screen" />
	<script src="<?php bloginfo('template_url'); ?>/js/jquery.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="<?php bloginfo('template_url'); ?>/js/utils.js" type="text/javascript" charset="utf-8"></script>
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0 - 所有文章" href="<?php echo get_bloginfo('rss2_url'); ?>" />
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0 - 所有评论" href="<?php bloginfo('comments_rss2_url'); ?>" />
	<script src="<?php bloginfo('template_url'); ?>/js/modernizr.js"></script>
</head>
<?php flush(); ?>
<body>
<div class="header">
    <header class="site-header">
        <?php if(is_home() && !is_paged()):?>
            <figure class="site-banner">
                <img src="<?php header_image();?>" alt="<?php bloginfo('name'); ?>" style="width: 100%;">
                <h3 id="logo" class="grid_4 site-title"><a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a></h3>
    		</figure>
        <?php endif;?>
        <div>
            <div class="site-nav" style=""><span class="button-toggle"></span>
               <!--  <div class="container">
                    <div class="nav-item <?php if (is_home()) { echo 'current';} ?>"><a title="<?php bloginfo('name'); ?>"  href="<?php echo get_option('home'); ?>/">主页</a></div>
                    <div class="nav-item"><a href="/archives" target="_self" data-text="archive">归档</a></div>
                    <div class="nav-item"><a href="/about" target="_self" data-text="about">关于</a></div>
                    <div class="nav-item"><a href="/atom.xml" target="_self" data-text="rss">订阅</a></div>
                    <div class="nav-item"><a href="/resume" target="_blank">求职</a></div>
                </div> -->
                 <div class="container">
                    <div class="nav-item <?php if (is_home()) { echo 'current';} ?>">
                        <a target="_self" title="<?php bloginfo('name'); ?>" href="<?php echo get_option('home'); ?>/">主页</a>
                    </div>
                     <?php wp_list_pages('depth=1&title_li=0&sort_column=menu_order'); ?>
                </div>
                <!-- <ul id="navigation" class="grid_8">
                    <?php wp_list_pages('depth=1&title_li=0&sort_column=menu_order'); ?>
                    <li <?php if (is_home()) { echo 'class="current"';} ?>><a title="<?php bloginfo('name'); ?>"  href="<?php echo get_option('home'); ?>/">主页</a></li>
                </ul> -->
                <?php get_search_form(); ?>
            </div>
        </div>
    </header>
</div>