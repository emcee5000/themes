<?php get_header(); ?>
<div id="content" style="width:940px;">
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
<div id="post_preview">
<h2><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
<?php the_time('F jS, Y') ?>
<p class="post">Posted by: <?php the_author(); ?></p>
<p class="post">
Category:
<?php
foreach((get_the_category()) as $category) { 
    echo '<a href ="';
	echo get_category_link($category->cat_ID);;
	echo '">';
	echo $category->category_nicename . ' ';
	echo '</a>'; 
} 
?>
</p>
<p><?php the_excerpt(); ?></p>
<br class="reset"/>
</div><!--/post_preview-->
<?php endwhile; ?>
<div id="paging">
<p class="left"><?php next_posts_link('&laquo; Older Posts') ?></p>
<p class="right"><?php previous_posts_link('Newer Posts &raquo;') ?></p>
</div><!--/paging-->
<?php else : ?>
<h2 class="center">Not Found</h2>
<p class="center">Sorry, but you are looking for something that isn't here.</p>
<?php endif; ?>
</div><!--/content-->
<?php get_footer(); ?>