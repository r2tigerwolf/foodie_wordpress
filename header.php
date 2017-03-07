<?php
	/*-----------------------------------------------------------------------------------*/
	/* This template will be called by all other template files to begin 
	/* rendering the page and display the header/nav
	/*-----------------------------------------------------------------------------------*/
?>
<!DOCTYPE html>
<html class="no-skrollr" <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title>
	<?php bloginfo('name'); // show the blog name, from settings ?> | 
	<?php is_front_page() ? bloginfo('description') : wp_title(''); // if we're on the home page, show the description, from the site's settings - otherwise, show the title of the post or page ?>
</title>

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php // We are loading our theme directory style.css by queuing scripts in our functions.php file, 
	// so if you want to load other stylesheets,
	// I would load them with an @import call in your style.css
?>

<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->

<?php wp_head(); 
// This fxn allows plugins, and Wordpress itself, to insert themselves/scripts/css/files
// (right here) into the head of your website. 
// Removing this fxn call will disable all kinds of plugins and Wordpress default insertions. 
// Move it if you like, but I would keep it around.
?>
</head>

<body 
	<?php body_class(); 
	// This will display a class specific to whatever is being loaded by Wordpress
	// i.e. on a home page, it will return [class="home"]
	// on a single post, it will return [class="single postid-{ID}"]
	// and the list goes on. Look it up if you want more.
	?>
>
<header id="masthead" class="site-header">
    <a class="expand-sidebar" href="javascript:void(0);"><img id="expandIcon" src="<?php echo get_template_directory_uri(); ?>/images/expand-icon-red.png" border="0" /></a>
    <div id="sidebar" role="sidebar" class="span4">
        <div id="sidebar-menu-title"><h1>Menu</h1></div>
		<?php get_sidebar(); // This will display whatever we have written in the sidebar.php file, according to admin widget settings ?>
        <div class="mobile-navigation">
			<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); // Display the user-defined menu in Appearance > Menus ?>
            <div class="clear"></div>
		</div><!-- .site-navigation .main-navigation -->
        <div class="clear"></div>
	</div><!-- #sidebar -->
    <div class="social-media">
        <a href="javascript:void(0);"><img src="<?php echo get_template_directory_uri(); ?>/images/social_media/FB-f-Logo__blue_72.png" border="0" /></a><br />
        <a href="javascript:void(0);"><img src="<?php echo get_template_directory_uri(); ?>/images/social_media/In-2C-75px-R.png" border="0" /></a><br />
        <a href="javascript:void(0);"><img src="<?php echo get_template_directory_uri(); ?>/images/social_media/Instagram-v051916.png" border="0" /></a><br />
        <a href="javascript:void(0);"><img src="<?php echo get_template_directory_uri(); ?>/images/social_media/Twitter_Social_Icon_Rounded_Square_Color.png" border="0" /></a><br />
        <a href="javascript:void(0);"><img src="<?php echo get_template_directory_uri(); ?>/images/social_media/YouTube-social-squircle_red_128px.png" border="0" /></a>
    </div>
	<div class="container center main-navigation-container">
	
		<nav class="site-navigation main-navigation">
			<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); // Display the user-defined menu in Appearance > Menus ?>
		</nav><!-- .site-navigation .main-navigation -->
	</div>
	<div class="center brand-container">

		<div id="brand">
			<h1 class="site-title">
				<a href="<?php echo esc_url( home_url( '/' ) ); // Link to the home page ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); // Title it with the blog name ?>" rel="home"><?php bloginfo( 'name' ); // Display the blog name ?></a>
			</h1>
			<h4 class="site-description">
				<?php bloginfo( 'description' ); // Display the blog description, found in General Settings ?>
			</h4>
		</div><!-- /brand -->
		
		<div class="clear"></div>
	</div><!--/container -->
		
</header><!-- #masthead .site-header -->


<?php
    $args = array(
        'post_type' => 'post'
    );
    
    $postcounter = 0;
    $post_query = new WP_Query($args);

    if($post_query->have_posts() && is_home() ) {
        while($post_query->have_posts() ) {
            $post_query->the_post();
            
            $imageinfo = pathinfo(getImageURL(1)); // Get the first Image information. path, name, type
            
            $imagepieces = explode('-', $imageinfo['basename']);  // explode to separate original name from the size.
            
            $imagename = str_replace('-' . end($imagepieces), '', $imageinfo['basename']); // remove the last occurance of '-', which is the size (-WxH) 
            
            if(count($imagepieces) > 1) {
                $fullsize_image = $imageinfo['dirname'] . '/' . $imagename . '.' . $imageinfo['extension'];   // If imagename has size attached to it.
            } else {
                $fullsize_image = getImageURL(1); // if imagename is in it's original form
            }                     

            $categories = apply_filters( 'the_category_list', get_the_category( $post->ID ), $post->ID ); // Get all categories of the post
            
            $category = array();
            
            foreach($categories as $key => $val) {$category[] = strtolower($val->name);} //put categories in an array
            
            if(in_array("parallax", $category)) { // If post is in 'Parallax' category
?>
                 <div class="parallax-image-wrapper parallax-image-wrapper-50"
                		data-anchor-target="#dragons<?=$postcounter;?> + .gap"
                		data-bottom-top="transform:translate3d(0px, 300%, 0px)"
                		data-top-bottom="transform:translate3d(0px, 0%, 0px)">
                
                		<div class="parallax-image parallax-image-50"
                			style="background-image:url(<?=$fullsize_image;?>)"
                			data-anchor-target="#dragons<?=$postcounter;?> + .gap"
                			data-bottom-top="transform: translate3d(0px, -60%, 0px);"
                			data-top-bottom="transform: translate3d(0px, 60%, 0px);"
                		></div>
                </div>
        <?php
            }
            $postcounter++;
        }
    }
?>
<ul id="nav" data-0="position:fixed;" data-top-top="position:fixed;top:0;" data-edge-strategy="set"></ul>

<div id="skrollr-body">
<main  class="main-fluid"><!-- start the page containter -->
