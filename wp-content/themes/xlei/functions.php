<?php
/*
 * 对所有用户和访客隐藏工具条
 */
add_filter('show_admin_bar', '__return_false');

/*
 * 只对管理员显示工具条
 */
if (!current_user_can('manage_options')) {
    add_filter('show_admin_bar', '__return_false');
}

//移除头部多余信息
remove_action('wp_head','wp_generator'); //禁止在head泄露wordpress版本号
remove_action('wp_head','rsd_link'); //移除head中的rel="EditURI"
remove_action('wp_head','wlwmanifest_link'); //移除head中的rel="wlwmanifest"
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0 ); //rel=shortlink

//文章缩略图
if ( function_exists( 'add_theme_support' ) )   {
  add_theme_support( 'post-thumbnails' );
}

/*首页文章截断*/
/*首页文章截断完*/


// 分页代码
function par_pagenavi($range = 3)
{
    global $paged, $wp_query;
    if (!$max_page) {
    	$max_page = $wp_query->max_num_pages;
    }
    if ($max_page > 1) {
        if (!$paged) {
        	$paged = 1;
        }
        if ($paged != 1) {
        	echo "<a href='" . get_pagenum_link(1) . "' class='extend' title='跳转到首页'>«</a>";
        }
        if ($max_page > $range) {
            if ($paged < $range) {
                for ($i = 1; $i <= ($range + 1); $i++) {
                	echo "<a href='" . get_pagenum_link($i) . "'";
                    if ($i == $paged) {
                        echo " class='current'";
                    }
                    echo ">$i</a>";
                }
            } elseif ($paged >= ($max_page - ceil(($range / 2)))) {
                for ($i = $max_page - $range; $i <= $max_page; $i++) {
                    echo "<a href='" . get_pagenum_link($i) . "'";
                    if ($i == $paged) {
                        echo " class='current'";
                    }
                    echo ">$i</a>";
                }
            } elseif ($paged >= $range && $paged < ($max_page - ceil(($range / 2)))) {
                for ($i = ($paged - ceil($range / 2)); $i <= ($paged + ceil(($range / 2))); $i++) {
                    echo "<a href='" . get_pagenum_link($i) . "'";if ($i == $paged) {
                        echo " class='current'";
                    }
                    echo ">$i</a>";
                }
            }
        } else {
            for ($i = 1; $i <= $max_page; $i++) {echo "<a href='" . get_pagenum_link($i) . "'";
                if ($i == $paged) {
                    echo " class='current'";
                }
                echo ">$i</a>";
            }
        }
        next_posts_link(' »');
    }
}
/*分页完*/

/*头部图像*/
$defaults = array(
	'default-image'          =>get_template_directory_uri().'/images/default.jpg',
	'random-default'         => false,
	'width'                  => 1366,
	'height'                 => 283.75,
	'flex-height'            => false,
	'flex-width'             => false,
	'default-text-color'     => '',
	'header-text'            => true,
	'uploads'                => true,
	'wp-head-callback'       => '',
	'admin-head-callback'    => '',
	'admin-preview-callback' => '',
);
add_theme_support( 'custom-header', $defaults );
/*头部图像完*/

/*搜索*/
if(is_search()){
add_filter('posts_orderby_request', 'search_orderby_filter');
}
function search_orderby_filter($orderby = ''){
    global $wpdb;
    $keyword = $wpdb->prepare($_REQUEST['s']);
    return "((CASE WHEN {$wpdb->posts}.post_title LIKE '%{$keyword}%' THEN 2 ELSE 0 END) + (CASE WHEN {$wpdb->posts}.post_content LIKE '%{$keyword}%' THEN 1 ELSE 0 END)) DESC,
{$wpdb->posts}.post_modified DESC, {$wpdb->posts}.ID ASC";
}
//搜索结果只有一篇，就从定向到该日志
add_action('template_redirect', 'wpjam_redirect_single_post');
function wpjam_redirect_single_post() {
    if (is_search()) {
        global $wp_query;
        if ($wp_query->post_count == 1) {
            wp_redirect( get_permalink( $wp_query->posts['0']->ID ) );
        }
    }
}
/*搜索完*/


/*评论*/
function bg_recent_comments($post_id,$no_comments = 5, $comment_len = 80, $avatar_size = 80) {   
    $comments_query = new WP_Comment_Query();   
    $comments = $comments_query->query( array( 'number' => $no_comments,'post_id'=>$post_id) );   
    $comm = '<div id="comment-list"><ol class="comment-list">';   
    if ( $comments ) : 
        foreach ( $comments as $comment ) :   
            $comm.='<li id="li-comment-' . $comment->comment_ID . '" class="comment">';
                $comm.='<div id="comment-' . $comment->comment_ID . '" class="comment-block">';
                    $comm.='<div class="comment__vcard">';
                        $comm.='<div class="comment__avatar">';
                            $comm.= get_avatar( $comment->comment_author_email, $avatar_size );
                        $comm.='</div>';
                        $comm.='<div class="comment__meta">';
                            $comm.='<cite class="comment__author">'.get_comment_author( $comment->comment_ID ).'</cite>';
                            $comm.='<time class="comment__time" datetime="'.get_comment_date('Y-m-d G:i:s',$comment->comment_ID).'">'.get_comment_date('Y-m-d G:i:s',$comment->comment_ID).'</time>';
                        $comm.='</div>';
                    $comm.='</div>';
                    $comm.='<div id="comment-content" class="comment__content">';
                        $comm .= '<div>' . strip_tags( apply_filters( 'get_comment_text', $comment->comment_content ) ) . '</div>';
                    $comm.='</div>';
                    $comm.='<a class="comment__reply" onclick="to_reply('.$comment->comment_ID.',\''.get_comment_author( $comment->comment_ID ).'\')" rel="nofollow">回复</a>';
                $comm.='</div>';
            $comm.='</li>';
        endforeach; 
    else :   
        $comm .= '当前文章没有评论。';   
     endif;   
     $comm .= '</ol></div>';
     $comm .= '<section id="load__more" class="post__more" data-type="comments">
        <a class="next" title="" href="'.get_permalink($post_id).'/comment-page-2#comments">加载更多</a>
    </section>';
     echo $comm;    
}  
/*评论完*/

/*标签及分类*/
//为WordPress页面添加标签和分类
 
class PTCFP{
 
  function __construct(){
 
    add_action( 'init', array( $this, 'taxonomies_for_pages' ) );
 
    /**
     * 确保这些查询修改不会作用于管理后台，防止文章和页面混杂 
     */
    if ( ! is_admin() ) {
      add_action( 'pre_get_posts', array( $this, 'category_archives' ) );
      add_action( 'pre_get_posts', array( $this, 'tags_archives' ) );
    } // ! is_admin
 
  } // __construct
 
  /**
   * 为“页面”添加“标签”和“分类”
   *
   * @uses register_taxonomy_for_object_type
   */
  function taxonomies_for_pages() {
      register_taxonomy_for_object_type( 'post_tag', 'page' );
      register_taxonomy_for_object_type( 'category', 'page' );
  } // taxonomies_for_pages
 
  /**
   * 在标签存档中包含“页面”
   */
  function tags_archives( $wp_query ) {
 
    if ( $wp_query->get( 'tag' ) )
      $wp_query->set( 'post_type', 'any' );
 
  } // tags_archives
 
  /**
   * 在分类存档中包含“页面”
   */
  function category_archives( $wp_query ) {
 
    if ( $wp_query->get( 'category_name' ) || $wp_query->get( 'cat' ) )
      $wp_query->set( 'post_type', 'any' );
 
  } // category_archives
 
} // PTCFP
 
$ptcfp = new PTCFP();
/*标签及分类完*/

/*归档*/
/* Archives list by zwwooooo | http://zww.me */
function zww_archives_list() {
	if( !$output = get_option('zww_archives_list') ){
		$the_query = new WP_Query( 'posts_per_page=-1&ignore_sticky_posts=1' ); //update: 加上忽略置顶文章
		$year=0; $mon=0; $i=0; $j=0;
		$output = '<ul class="cd-accordion-menu animated">';
		while ( $the_query->have_posts() ) : $the_query->the_post();
			$i++;
			$c="";
			if ($i==1) {
				$c = "checked";
			}
			$year_tmp = get_the_time('Y');
			$mon_tmp = get_the_time('m');
			$y=$year; $m=$mon;
			if ($mon != $mon_tmp && $mon > 0) $output .= '</li></ul>';
			if ($year != $year_tmp && $year > 0) $output .= '</li>';
			if ($year != $year_tmp) {
			 $year = $year_tmp;
			 $output .= '<li class="has-children">
			<input type="checkbox" name ="group-'. $year .'" id="group-'. $year .'" '.$c.'>
			<label for="group-'. $year .'">'. $year .' 年</label><ul><li class="has-children">'; //输出年份
			}
			if ($mon != $mon_tmp) {
			 $mon = $mon_tmp;
			 $output .= '<input type="checkbox" name ="sub-group-'. $mon .'" id="sub-group-'. $mon .'">
					<label for="sub-group-'. $mon .'">'. $mon .' 月</label><ul>'; //输出月份
			}
			$output .= '<li class="postInfo"><a href="'. get_permalink() .'">'. get_the_time('d日: ') .get_the_title() .' &nbsp;<i>('. get_comments_number('0', '1', '%').')</i></a></li>'; //输出文章日期和标题
			endwhile;
			wp_reset_postdata();
			$output .= '</ul>';
			update_option('zww_archives_list', $output);
	}
	echo $output;
}
function clear_zal_cache() {
 	update_option('zww_archives_list', ''); // 清空 zww_archives_list
}
add_action('save_post', 'clear_zal_cache'); // 新发表文章/修改文章时

//禁止文章自动保存  
add_action( 'wp_print_scripts', 'daxiawp_disable_autosave' );  
function daxiawp_disable_autosave(){  
    wp_deregister_script('autosave');  
}  
//禁止文章修订版本功能  
remove_action('pre_post_update', 'wp_save_post_revision' );  
?>