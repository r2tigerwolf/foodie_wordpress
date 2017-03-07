<?php
	/*-----------------------------------------------------------------------------------*/
	/* This file will be referenced every time a template/page loads on your Wordpress site
	/* This is the place to define custom fxns and specialty code
	/*-----------------------------------------------------------------------------------*/

// Define the version so we can easily replace it throughout the theme
define( 'NAKED_VERSION', 1.0 );

/*-----------------------------------------------------------------------------------*/
/*  Set the maximum allowed width for any content in the theme
/*-----------------------------------------------------------------------------------*/
if ( ! isset( $content_width ) ) $content_width = 900;

/*-----------------------------------------------------------------------------------*/
/* Add Rss feed support to Head section
/*-----------------------------------------------------------------------------------*/
add_theme_support( 'automatic-feed-links' );


/*-----------------------------------------------------------------------------------*/
/* Register main menu for Wordpress use
/*-----------------------------------------------------------------------------------*/
register_nav_menus( 
	array(
		'primary'	=>	__( 'Primary Menu', 'naked' ), // Register the Primary menu
		// Copy and paste the line above right here if you want to make another menu, 
		// just change the 'primary' to another name
	)
);
function show_posts_nav() {
    global $wp_query;
    return ($wp_query->max_num_pages > 1);
}

function print_content( $more_link_text = null, $strip_teaser = false) {
	$content = get_the_content( $more_link_text, $strip_teaser );

	/**
	 * Filter the post content.
	 *
	 * @since 0.71
	 *
	 * @param string $content Content of the current post.
	 */
	$content = apply_filters( 'the_content', $content );
	$content = str_replace( ']]>', ']]&gt;', $content );
	return $content;
}

function getImageURL($num) {
    global $more;
    $more = 1;
    $link = get_permalink();
    $content = get_the_content();
    $count = substr_count($content, '<img');
    $start = 0;
    for($i=1;$i<=$count;$i++) {
        $imgBeg = strpos($content, '<img', $start);
        $post = substr($content, $imgBeg);
        $imgEnd = strpos($post, '>');
        $postOutput = substr($post, 0, $imgEnd+1);
        $postOutput = preg_replace('/width="([0-9]*)" height="([0-9]*)"/', '',$postOutput);
        $image[$i] = $postOutput;
        $start=$imgEnd+1;
    }
    if(stristr($image[$num],'<img')) {
        $doc = new DOMDocument();
        $doc->loadHTML($image[$num]);
        $imageTags = $doc->getElementsByTagName('img');
    
        foreach($imageTags as $tag) {
            
            return ($tag->getAttribute('src'));   
            
        }
       // echo '<a href="'.$link.'">'.$image[$num]."</a>";
        //center_short_content(); 
    } 
    $more = 0;
}
function getImage($num) {
    global $more;
    $more = 1;
    $link = get_permalink();
    $content = get_the_content();
    $count = substr_count($content, '<img');
    $start = 0;
    for($i=1;$i<=$count;$i++) {
        $imgBeg = strpos($content, '<img', $start);
        $post = substr($content, $imgBeg);
        $imgEnd = strpos($post, '>');
        $postOutput = substr($post, 0, $imgEnd+1);
        $postOutput = preg_replace('/width="([0-9]*)" height="([0-9]*)"/', '',$postOutput);;
        $image[$i] = $postOutput;
        $start=$imgEnd+1;
    }
    if(stristr($image[$num],'<img')) { 
        echo '<a href="'.$link.'">'.$image[$num]."</a>";
        //center_short_content(); 
    } 
    $more = 0;
}
function short_content( $more_link_text = null, $strip_teaser = false, $character_no = 100) {
	$content = get_the_content( $more_link_text, $strip_teaser );

	/**
	 * Filter the post content.
	 *
	 * @since 0.71
	 *
	 * @param string $content Content of the current post.
	 */
	$content = apply_filters( 'the_content', $content );
	$content = str_replace( ']]>', ']]&gt;', $content );
    $content = preg_replace('/<(\s*)img[^<>]*>/i', '', $content);
	$content = trim(getSnippet($content, $character_no));
    getImage(1);
    echo $content . "...";
    echo "<a class=\"read-more\" href=\"".esc_url( apply_filters( 'the_permalink', get_permalink( $post ), $post ) )."\">Read More </a>";
}


function getSnippet( $str, $wordCount = 10 ) {
  return implode( '', array_slice( preg_split('/([\s,\.;\?\!]+)/', $str, $wordCount*2+1, PREG_SPLIT_DELIM_CAPTURE), 0, $wordCount*2-1 ) );
}

/*-----------------------------------------------------------------------------------*/
/* Activate sidebar for Wordpress use
/*-----------------------------------------------------------------------------------*/
function naked_register_sidebars() {
	register_sidebar(array(				// Start a series of sidebars to register
		'id' => 'sidebar', 					// Make an ID
		'name' => 'Sidebar',				// Name it
		'description' => 'Take it on the side...', // Dumb description for the admin side
		'before_widget' => '<div>',	// What to display before each widget
		'after_widget' => '</div>',	// What to display following each widget
		'before_title' => '<h3 class="side-title">',	// What to display before each widget's title
		'after_title' => '</h3>',		// What to display following each widget's title
		'empty_title'=> '',					// What to display in the case of no title defined for a widget
		// Copy and paste the lines above right here if you want to make another sidebar, 
		// just change the values of id and name to another word/name
	));
} 
// adding sidebars to Wordpress (these are created in functions.php)
add_action( 'widgets_init', 'naked_register_sidebars' );

/*-----------------------------------------------------------------------------------*/
/* Enqueue Styles and Scripts
/*-----------------------------------------------------------------------------------*/

function naked_scripts()  { 

	// get the theme directory style.css and link to it in the header
	wp_enqueue_style('style.css', get_stylesheet_directory_uri() . '/style.css');
    wp_enqueue_style('custom.css', get_stylesheet_directory_uri() . '/custom.css');
	
	// add fitvid
	wp_enqueue_script( 'naked-fitvid', get_template_directory_uri() . '/js/jquery.fitvids.js', array( 'jquery' ), NAKED_VERSION, true );
	
	// add theme scripts
	wp_enqueue_script( 'naked', get_template_directory_uri() . '/js/theme.min.js', array(), NAKED_VERSION, true );
  
    // custom script
	wp_enqueue_script( 'naked-custom', get_template_directory_uri() . '/js/custom.js', array(), NAKED_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'naked_scripts' ); // Register this fxn and allow Wordpress to call it automatcally in the header
