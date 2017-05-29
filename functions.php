<?php
add_action( 'after_setup_theme', 'hammerpress_setup' );
function hammerpress_setup()
{
load_theme_textdomain( 'hammerpress', get_template_directory() . '/languages' );
add_theme_support( 'title-tag' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails' );
global $content_width;
if ( ! isset( $content_width ) ) $content_width = 640;
register_nav_menus(
array( 'main-menu' => __( 'Main Menu', 'hammerpress' ) )
);
}
add_action( 'wp_enqueue_scripts', 'hammerpress_load_scripts' );
function hammerpress_load_scripts()
{
wp_enqueue_script( 'jquery' );
wp_enqueue_script('bootstrap-js', get_stylesheet_directory_uri().'/js/bootstrap.min.js', array('jquery'), NULL, true);
wp_enqueue_script('viewportchecker-js', get_stylesheet_directory_uri().'/js/jquery.viewportchecker.min.js', array('jquery'), NULL, true);
wp_enqueue_script('matchheight-js', get_stylesheet_directory_uri().'/js/jquery.matchHeight.js', array('jquery'), NULL, true);
wp_enqueue_script('stickyfill-js', get_stylesheet_directory_uri().'/js/stickyfill.min.js', array('jquery'), NULL, true);
wp_enqueue_script('custom-js', get_stylesheet_directory_uri().'/js/hammerpressscripts.js', array('jquery'), NULL, true);
wp_enqueue_style('bootstrap-css', get_stylesheet_directory_uri().'/css/bootstrap.min.css', false, NULL, 'all');
wp_enqueue_style('fontawesome-css', get_stylesheet_directory_uri().'/font-awesome/css/font-awesome.min.css', false, NULL, 'all');
wp_enqueue_style('animate-css', get_stylesheet_directory_uri().'/css/animate.css', false, NULL, 'all');
wp_enqueue_style('hammerpress-css', get_stylesheet_directory_uri().'/css/hammerpress.css', false, NULL, 'all');
}
add_action( 'comment_form_before', 'hammerpress_enqueue_comment_reply_script' );
function hammerpress_enqueue_comment_reply_script()
{
if ( get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }
}
add_filter( 'the_title', 'hammerpress_title' );
function hammerpress_title( $title ) {
if ( $title == '' ) {
return '&rarr;';
} else {
return $title;
}
}
add_filter( 'wp_title', 'hammerpress_filter_wp_title' );
function hammerpress_filter_wp_title( $title )
{
return $title . esc_attr( get_bloginfo( 'name' ) );
}
add_action( 'widgets_init', 'hammerpress_widgets_init' );
function hammerpress_widgets_init()
{
register_sidebar( array (
'name' => __( 'Sidebar Widget Area', 'hammerpress' ),
'id' => 'primary-widget-area',
'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
'after_widget' => "</li>",
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
) );
register_sidebar( array (
'name' => __( 'Home Widget - Left', 'hammerpress' ),
'id' => 'home-widget-1',
'before_widget' => '<li id="%1$s" class="col-md-6 widget-container %2$s">',
'after_widget' => "</li>",
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
) );
register_sidebar( array (
'name' => __( 'Home Widget - Right', 'hammerpress' ),
'id' => 'home-widget-2',
'before_widget' => '<li id="%1$s" class="col-md-6 widget-container %2$s">',
'after_widget' => "</li>",
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
));
register_sidebar( array (
'name' => __( 'Above Post', 'hammerpress' ),
'id' => 'above-post',
'before_widget' => '<div id="%1$s" class="post-widget-container %2$s">',
'after_widget' => "</div>",
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
));
register_sidebar( array (
'name' => __( 'Below Post', 'hammerpress' ),
'id' => 'below-post',
'before_widget' => '<div id="%1$s" class="post-widget-container %2$s">',
'after_widget' => "</div>",
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
));
}
function hammerpress_custom_pings( $comment )
{
$GLOBALS['comment'] = $comment;
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
<?php
}
add_filter( 'get_comments_number', 'hammerpress_comments_number' );
function hammerpress_comments_number( $count )
{
if ( !is_admin() ) {
global $id;
$comments_by_type = &separate_comments( get_comments( 'status=approve&post_id=' . $id ) );
return count( $comments_by_type['comment'] );
} else {
return $count;
}
}
function hammerpress_customize_register( $wp_customize ) {
    $wp_customize->add_setting( 'hammerpress_logo',
        'sanitize_callback' == 'esc_url_raw'
    );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'hammerpress_logo', array(
        'label'    => __( 'Upload Logo (replaces text)', 'hammerpress' ),
        'section'  => 'title_tagline',
        'settings' => 'hammerpress_logo',
        'sanitize_callback' => 'esc_url_raw'
    ) ) );
}
add_action( 'customize_register', 'hammerpress_customize_register' );
function hammerpress_register_theme_customizer( $wp_customize ){

	/*
	 * Failsafe is safe
	 */
	if ( ! isset( $wp_customize ) ) {
		return;
	}

 	$wp_customize->add_section('theme_colors', array(
		'title' => __('Theme Colors', 'hammerpress'),
		'priority' => 30,
	));

	$wp_customize->add_setting(
      'primary_color',
      array(
        'default' => '#f7931d',
        'sanitize_callback' => 'sanitize_hex_color',
      )
    );

    $wp_customize->add_control(
      new \WP_Customize_Color_Control(
        $wp_customize,
        'primary_color',
        array(
          'label' => __('Primary Color', 'hammerpress'),
          'section' => 'colors',
          'settings' => 'primary_color'
        )
      )
    );
}
// Settings API options initilization and validation.
add_action( 'customize_register', 'hammerpress_register_theme_customizer' );

function hammerpress_customizer_css() {
?>
	<style type="text/css">

	/* ------------Primary Colors ----------- */
	a, .widget-title, .menu a:hover {color: <?php echo get_theme_mod ('primary_color'); ?>;}

	input[type=submit], .post-edit-link, btn-primary, h1.home-title {background: <?php echo get_theme_mod ('primary_color');?>;}

	#branding, .menu a:hover, li.comment {
	border-color: <?php echo get_theme_mod ('primary_color');?>;
	}

	</style>

<?php
} // end hammerpress_customizer_css
add_action( 'wp_head', 'hammerpress_customizer_css');

/**
 * Registers the Theme Customizer Preview with WordPress.
 *
 * @package		 hammerpress
 */
function hammerpress_customizer_live_preview() {
	wp_enqueue_script(
		'hammerpress-theme-customizer',
		get_stylesheet_directory_uri() . '/js/theme-customizer.js',
		array( 'jQuery','customize-preview' ),
		'0.3.0',
		true
	);
} // end hammerpress_customizer_live_preview

add_action( 'customize_preview_init', 'hammerpress_customizer_live_preview' );

$hammerpress_bg = array(
	'default-color'          => 'f7f7f7',
	'wp-head-callback'       => '_custom_background_cb',
);
add_theme_support( 'custom-background', $hammerpress_bg );
