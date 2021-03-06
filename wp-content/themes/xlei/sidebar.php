        <div class="sidebar">
            <div class="social-links">
                <ul>
                    <li class="social-link" title="github"><a href="https://github.com/xleiy" target="_blank" class="link-github"><i class="icon icon-github"></i></a></li>
                    <li class="social-link" title="twitter"><a href="https://twitter.com/xleiyao" target="_blank" class="link-twitter"><i class="icon icon-twitter"></i></a></li>
                    <li class="social-link" title="weibo"><a href="http://weibo.com/xleiyme" target="_blank" class="link-weibo"><i class="icon icon-weibo"></i></a></li>
                    <li class="social-link"><a href="mailto:xlei1139987950@gmail.com" target="_self" class="link-mail"><i class="icon icon-mail"></i></a></li>
                </ul>
            </div>
             <!-- 近期文章 -->
            <div class="recent-posts widget">
                <h3 class="widget-title"> 近期文章</h3>
                <div class="widget-content">
                    <ul class="post-list">
                        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Second_sidebar') ) : ?>        
                            <?php
                                $posts = get_posts('numberposts=6&orderby=post_date');
                                foreach($posts as $post) {
                                    setup_postdata($post);
                                    echo '<li  class="post-list-item"><a class="post-list-link" href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
                                }
                                $post = $posts[0];
                            ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
            <!-- 标签 -->
            <div class="tag-lists widget" style="min-height: 150px;">
                <h3 class="widget-title"> 分类</h3>
                <div class="widget-content">
                    <p style="overflow-y: scroll;max-height: 200px;">
                    <?php $categories = get_categories();
                        foreach ($categories as $cat) {
                            $catid = $cat->cat_ID;
                            ?>
                            <a href="<?php echo get_category_link($catid);?>" title="<?php echo strip_tags(category_description($catid)); ?>"><?php echo get_cat_name($catid); ?></a>
                        <?php } ?>
                    </p>
                </div>
            </div>
            <!-- 标签 -->
            <div class="tag-lists widget" style="min-height: 150px;">
                <h3 class="widget-title"> 标签</h3>
                <div class="widget-content">
                <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Third_sidebar') ) : ?> 
                    <p style="overflow-y: scroll;max-height: 200px;"><?php wp_tag_cloud('smallest=12&largest=12'); ?></p>
                <?php endif; ?>
                </div>
            </div>
            <!-- 归档 -->
            <div class="archive-lists widget">
                <h3 class="widget-title"> 归档</h3>
                <div class="widget-content">
                    <ul class="archive-list">
                    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Fourth_sidebar') ) : ?> 
                            <?php wp_get_archives('limit=10'); ?> 
                    <?php endif; ?>                       
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>