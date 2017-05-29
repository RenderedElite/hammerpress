<?php get_header(); ?>
<section id="content" role="main">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<?php if ( is_active_sidebar( 'above-post' ) ) : ?>
         <?php dynamic_sidebar( 'above-post' ); ?>
<?php endif; ?>
<?php get_template_part( 'entry' ); ?>
<?php if ( ! post_password_required() ) comments_template( '', true ); ?>
<?php endwhile; endif; ?>
<footer class="footer">
<?php if ( is_active_sidebar( 'below-post' ) ) : ?>
         <?php dynamic_sidebar( 'below-post' ); ?>
<?php endif; ?>
<?php get_template_part( 'nav', 'below-single' ); ?>
</footer>
</section>

<?php get_footer(); ?>
