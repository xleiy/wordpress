<?php
/*
Template Name: archive
*/
?>
<?php
/**
 * @package WordPress
 * @subpackage xlei
 * @since xlei 1.0
 */

get_header();?>

	<div id="primary" class="content-area actives site-content">
		<main id="main" class="site-main" role="main">
		<?php zww_archives_list(); ?>		
		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_footer(); ?>
<script type="text/javascript">
	$(document).ready(function(){
		$(".cd-accordion-menu").css("min-height",$(window).height()-46-64); 
	});

</script>