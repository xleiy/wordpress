<?php get_header(); ?>
<div class="main">
    <div class="container">
    <div class="content">
	    <div class="post-list">
		    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			    <article class="post-list-article">
		            <figure class="post-thumbnail">
		                <a href="<?php the_permalink(); ?>">
		                <?php 
							if ( has_post_thumbnail() ) { ?> 
							<?php the_post_thumbnail(); ?> 
							<?php } else {?> 
							<img src="<?php bloginfo('template_url'); ?>/thumbnail.jpg">
						<?php } ?> 
		                
		                </a>
		            </figure>
		            <header class="post-header">
		                <div class="post-meta">
		                	<h2 class="post-title">
		                		<?php if(is_sticky(get_the_ID())){ ?>
		                			<span class="sticky">顶</span>
		                		<?php } ?>
		                	<a href="<?php the_permalink(); ?>">
		                	<?php the_title(); ?></a></h2>
						</div>
		                <span class="post-date"><?php the_time('Y年m月d日') ?></span>
		                <span class="post-tag"><?php the_category(get_the_ID()); ?></span>

		            </header>
		            <div class="post-excerpt">
		                <?php the_excerpt(); ?>
		            </div>
	        	</article>
			<?php endwhile; ?>
			<?php else : ?>
			    <h1>哎哟，找不到你想要的文章！</h1>
			<?php endif; ?>
	    </div>
	    <div id="page"><?php par_pagenavi(3); ?></div>
    </div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>