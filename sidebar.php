<section id="sidebar" role="complementary" class="hp-col">

  <section id="branding">
  <?php if ( get_theme_mod( 'hammerpress_logo' ) ) : ?>
<a href="<?php echo esc_url( home_url( '/' ) ); ?>" id="site-logo" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo get_theme_mod( 'hammerpress_logo' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"></a>
<?php else : ?>
<h1 id="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>             
<?php endif; ?>
<div id="site-description"><?php bloginfo( 'description' ); ?></div>
	</section>
  <div id="search">
<?php get_search_form(); ?>
</div>
 <nav id="menu" role="navigation">
  <?php wp_nav_menu( array( 'theme_location' => 'main-menu' ) ); ?>
 </nav>

<?php if ( is_active_sidebar( 'primary-widget-area' ) ) : ?>
<div id="primary" class="widget-area">
<ul class="xoxo">
<?php dynamic_sidebar( 'primary-widget-area' ); ?>
</ul>
</div>
<?php endif; ?>
</section>
