<?php get_header(); ?>
<div id="content" style="width:940px;">
<div id="results">
<h1>Search Results for "<?php the_search_query(); ?>"</h1>
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
<h2><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
<?php the_excerpt(); ?>
<hr />
<?php endwhile; ?>
</div><!--/results-->
<?php else : ?>
<div id="results">
<h2>Sorry, no results were found. Please try another search term.</h2>
</div><!--/results-->
<?php endif; ?>
</div><!--/content-->
</div><!--/wrap-->
<?php get_footer(); ?>