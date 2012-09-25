<?php get_header(); ?>
<div id="post_content">
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
<div id="post">
<h1><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
<p class="post"><?php the_time('F jS, Y') ?></p>
<p class="post">Posted by: <?php the_author(); ?></p>
<p class="post_category">
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
<?php the_content(); ?>
</div><!--/post-->
<div id="comments">
<?php comments_template('', true); ?>
</div><!--/comments-->
<?php endwhile; ?>
<?php else : ?>
<h2 class="center">Not Found</h2>
<p class="center">Sorry, but the page you are looking for can not be found.</p>
<?php endif; ?>
</div><!--/content-->
<?php get_footer(); ?>