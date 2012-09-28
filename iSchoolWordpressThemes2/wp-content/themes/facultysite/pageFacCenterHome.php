<?php
/*
Template Name: FacCenterHomepage
*/
?>
<?php get_header(); ?>
<div id="content" style="width:940px;">
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
<div id="post">
<h1><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
<?php the_content(); ?>
</div><!--/post-->
<?php endwhile; ?>
<?php else : ?>
<h2 class="center">Not Found</h2>
<p class="center">Sorry, but the page you are looking for can not be found.</p>
<?php endif; ?>
</div><!--/content-->
<?php get_footer(); ?>