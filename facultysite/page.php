<?php get_header(); ?>
<div id="wrap">
<div id="leftNav">
<ul>
<?php if(!$post->post_parent){
$children = wp_list_pages("title_li=&child_of=".$post->ID."&echo=0");
}else{
if($post->ancestors)
{
$ancestors = end($post->ancestors);
$children = wp_list_pages("title_li=&child_of=".$ancestors."&echo=0");
}
}
if ($children) {
?>
<ul> <?php echo $children; ?></ul>
<?php } ?>
</ul>
</div><!--/leftNav-->
<div id="content">
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
</div><!--/wrap-->
<?php get_footer(); ?>