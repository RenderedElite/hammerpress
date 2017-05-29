<?php
/* Template Name: Home */
?>
<?php get_header(); ?>

<div id="homepage-banner">
<?php if ( has_post_thumbnail() ) {
  the_post_thumbnail();
  ?>
    <h1 class="home-title"><?php the_title(); ?></h1>
  <?php

} ?>

</div>

<section id="content" role="main">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<header class="header">
<h2 class="entry-title"><?php the_title(); ?></h2> <?php edit_post_link(); ?>
</header>
<section class="entry-content">
<?php the_content(); ?>
<div class="entry-links"><?php wp_link_pages(); ?></div>
<div id="home-widgets">
    <?php if ( is_active_sidebar( 'home-widget-1' ) ) : ?>
         <?php dynamic_sidebar( 'home-widget-1' ); ?>
    <?php endif; ?>
    <?php if ( is_active_sidebar( 'home-widget-2' ) ) : ?>
         <?php dynamic_sidebar( 'home-widget-2' ); ?>
    <?php endif; ?>
</div>
</section>
</article>
<?php endwhile; endif; ?>
</section>
<?php get_footer(); ?>
