<?php
/*
Template Name: Home Widget
*/
?>

<?php get_header(); ?>
<div class="postDivider"></div>
<div id="mainWrapper">
	    <div id="sidebar" class="clearfix"><?php dynamic_sidebar('SidebarInside'); ?></div>
<div id="mainContainer">
 <?php if (have_posts()) : while (have_posts()) : the_post();?>
 <div id="content">
 <h1 id="post-<?php the_ID(); ?>"><?php the_title();?></h1>
 <div class="entrytext">
  <?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>
 </div>
 <div id="sidebar"><?php dynamic_sidebar('Sidebar'); ?></div>
 </div>
 <?php endwhile; endif; ?>
 <?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>
</div>

</div>
<?php get_footer(); ?>






