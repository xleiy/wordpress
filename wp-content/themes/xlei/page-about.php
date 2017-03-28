<? /* Template Name: About模板 */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<title>About</title>
<meta name="description" content="<?php bloginfo('description'); ?>" />
<meta name="keywords" content="<?php bloginfo('name'); ?>" />
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/about.css" type="text/css" media="screen" />
<link rel="shortcut icon" href="<?php bloginfo('url'); ?>/favicon.ico" type="image/x-icon" />
<script src="<?php bloginfo('template_url'); ?>/js/jquery.min.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/about.js"></script>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <div id="a1">xlei的博客</div>
    <div id="a2"></div>
    <div id="a3" data-days="<?php $Date_1="2017-03-11";$Date_2=date("Y-m-d");$d1=strtotime($Date_1);$d2=strtotime($Date_2);$Days=round(($d2-$d1)/3600/24);echo $Days;?>"></div>
    <div id="a4" data-month="<?php $Year_1 = 2017;$Year_2 = date("Y");$Month_1 = 03;$Month_2 = date("m");echo ($Year_2-$Year_1)*11 + $Month_2 - $Month_1;?>"></div>
    <div id="a5"></div>
    <?php 
    global $wpdb,$month;
    $lastpost = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_date <'" . current_time('mysql') . "' AND post_status='publish' AND post_type='post' AND post_password='' ORDER BY post_date DESC LIMIT 1");
    $output = get_option('SHe_archives2_'.$lastpost);
    if(empty($output)){
        $output = '';
        $wpdb->query("DELETE FROM $wpdb->options WHERE option_name LIKE 'SHe_archives2_%'");
         $q = "SELECT DISTINCT YEAR(post_date) AS year, MONTH(post_date) AS month, count(ID) as posts FROM $wpdb->posts p WHERE post_date <'" . current_time('mysql') . "' AND post_status='publish' AND post_type='post' AND post_password='' GROUP BY YEAR(post_date), MONTH(post_date) ORDER BY post_date ASC";
        $monthresults = $wpdb->get_results($q);
         if ($monthresults) {
             foreach ($monthresults as $monthresult) {
             $thismonth    = zeroise($monthresult->month, 2);
             $thisyear    = $monthresult->year;
             $q = "SELECT ID, post_date, post_title, comment_count FROM $wpdb->posts p WHERE post_date LIKE '$thisyear-$thismonth-%' AND post_date AND post_status='publish' AND post_type='post' AND post_password='' ORDER BY post_date DESC";
             $postresults = $wpdb->get_results($q);
             if ($postresults) {
                 $postcount = count($postresults);
                 $output .= '<div class="post-count" data-count="'.$postcount.'"><span class="count">0</span><span class="height"></span></div>';
             }
             }
         update_option('SHe_archives2_'.$lastpost,$output);
         }
     }
     echo $output;
    ?>
     <div id="a7"><?php bloginfo('name'); ?> · <?php bloginfo('description'); ?></div>
    <div id="a8">
        <a id="home" href="http://192.168.20.60:8888/wordpress/index.php" title="Home"></a>
        <a id="weibo" title="新浪微博" target="_blank" href="http://weibo.com/u/389201"></a>
        <!-- <a id="gplus" title="赞助hd" target="_blank" href="http://me.alipay.com/hdlc"></a> -->
        <!--<a title="twitter" id="twitter" target="_blank" href="twitter地址"></a>-->
    </div>
<?php wp_footer();?>
</body>
</html>