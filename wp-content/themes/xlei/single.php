<?php get_header(); ?>
<div class="main">
    <div class="container">
    <div class="content">
    <?php if (have_posts()) : the_post(); update_post_caches($posts); ?>
    	<div class="post">
    		<article class="post-block">
			    <h1 class="post-title">
            		<?php if(is_sticky(get_the_ID())){ ?>
            			<span class="sticky">顶</span>
            		<?php } ?>
                	<?php the_title(); ?>
                </h1>
			    <span class="post-date"><?php the_time('Y年m月d日') ?></span>
			    <span class="post-tag"><?php the_tags("","",""); ?></span>
			    <span class="post-review">阅读次数 : <span data-hk-page="current">49</span></span>
			    <div class="post-content">
			  		<?php the_content(); ?>
			    </div>
			</article>
    	</div>
    	<?php else : ?>
		<div class="errorbox">
			没有文章！
		</div>
		<?php endif; ?>
    	<div class="post-paginator">
		    <div class="post-links">
		    	<section id="postNextPrev">
			        <div class="post-prev">
			       		<?php previous_post_link('下一篇<br>%link'); ?>
			        </div>
			        <div class="post-next">
			        	<?php next_post_link('下一篇<br>%link'); ?>
			        </div>
		        </section>
		    </div>
		</div>
		<section id="comments" class="comments">
			<?php comments_template(); ?>
			<?php bg_recent_comments(get_the_ID()); ?>
		</section>
    </div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
