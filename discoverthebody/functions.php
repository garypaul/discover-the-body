<?php
/*
Author: Eddie Machado
URL: htp://themble.com/bones/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images, 
sidebars, comments, ect.
*/

// Get Bones Core Up & Running!
require_once('library/bones.php');            // core functions (don't remove)
require_once('library/plugins.php');          // plugins & extra functions (optional)
//require_once('library/custom-post-type.php'); // custom post type example

// Options panel
//require_once('library/options-panel.php');

// Shortcodes
require_once('library/shortcodes.php');

// Admin Functions (commented out by default)
// require_once('library/admin.php');         // custom admin functions


/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'wpf-featured', 639, 300, true );
add_image_size ( 'wpf-home-featured', 1000, 400, true );
//add_image_size( 'bones-thumb-600', 600, 150, false );
add_image_size( 'bones-thumb-300', 300, 100, true );
add_image_size( 'small-logo', 50, 50, true );

/* 
to add more sizes, simply copy a line from above 
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 300 sized image, 
we would use the function:
<?php the_post_thumbnail( 'bones-thumb-300' ); ?>
for the 600 x 100 image:
<?php the_post_thumbnail( 'bones-thumb-600' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function bones_register_sidebars() {
    register_sidebar(array(
    	'id' => 'sidebar1',
    	'name' => 'Main Sidebar',
    	'description' => 'Used on every page BUT the homepage page template.',
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h4 class="widgettitle">',
    	'after_title' => '</h4>',
    ));
    
    register_sidebar(array(
    	'id' => 'sidebar2',
    	'name' => 'Courses Sidebar',
    	'description' => 'Used only on the courses page template.',
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h4 class="widgettitle">',
    	'after_title' => '</h4>',
    ));
    
    register_sidebar(array(
        'id' => 'author',
        'name' => 'Authors Sidebar',
        'description' => 'Used only on the author page template.',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widgettitle">',
        'after_title' => '</h4>',
    ));
    
    /* 
    to add more sidebars or widgetized areas, just copy
    and edit the above sidebar code. In order to call 
    your new sidebar just use the following code:
    
    Just change the name to whatever your new
    sidebar's id is, for example:
    
    
    
    To call the sidebar in your template, you can just copy
    the sidebar.php file and rename it to your sidebar's name.
    So using the above example, it would be:
    sidebar-sidebar2.php
    */
} // don't remove this bracket!

/************* ENQUEUE CSS AND JS *****************/

function theme_styles()  
{ 
    // Bring in Open Sans from Google fonts
    wp_register_style( 'open-sans', 'http://fonts.googleapis.com/css?family=Open+Sans:300,800');
    // This is the compiled css file from SCSS
    wp_register_style( 'app', get_template_directory_uri() . '/stylesheets/app.css', array(), '3.0', 'all' );
    wp_register_style( 'foundation', get_template_directory_uri() . '/stylesheets/foundation.css', array(), '3.0', 'all' );
    wp_register_style( 'flexslider', get_template_directory_uri() . '/stylesheets/flexslider.css', array(), '3.0', 'all' );
	wp_register_style( 'dropdown', get_template_directory_uri() . '/stylesheets/drop-down-style.css', array(), '3.0', 'all' );
    
    wp_enqueue_style( 'open-sans' );
    wp_enqueue_style( 'foundation' );
    wp_enqueue_style( 'app' );
    wp_enqueue_style( 'flexslider' );
   // wp_enqueue_style( 'dropdown' );
}

add_action('wp_enqueue_scripts', 'theme_styles');

/************* ENQUEUE JS *************************/

/* pull jquery from google's CDN. If it's not available, grab the local copy. Code from wp.tutsplus.com :-) */

$url = 'http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js'; // the URL to check against  
$test_url = @fopen($url,'r'); // test parameters  
if( $test_url !== false ) { // test if the URL exists  

    function load_external_jQuery() { // load external file  
        wp_deregister_script( 'jquery' ); // deregisters the default WordPress jQuery  
        wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js'); // register the external file  
        wp_enqueue_script('jquery'); // enqueue the external file  
    }  

    add_action('wp_enqueue_scripts', 'load_external_jQuery'); // initiate the function  
} else {  

    function load_local_jQuery() {  
        wp_deregister_script('jquery'); // initiate the function  
        wp_register_script('jquery', get_template_directory_uri() . '/js/jquery.min.js', __FILE__, false, '1.10.2', true); // register the local file  
        wp_enqueue_script('jquery'); // enqueue the local file  
    }  

    add_action('wp_enqueue_scripts', 'load_local_jQuery'); // initiate the function  
}  

/* load modernizr from foundation */
/*function modernize_it(){
    wp_register_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.foundation.js' ); 
    wp_enqueue_script( 'modernizr' );
}*/

//add_action( 'wp_enqueue_scripts', 'modernize_it' );

function foundation_js(){
/*    wp_register_script( 'foundation-reveal', get_template_directory_uri() . '/js/foundation/jquery.reveal.js' ); 
    wp_enqueue_script( 'foundation-reveal', 'jQuery', '1.1', true );
    wp_register_script( 'foundation-orbit', get_template_directory_uri() . '/js/foundation/jquery.orbit-1.4.0.js' ); 
    wp_enqueue_script( 'foundation-orbit', 'jQuery', '1.4.0', true );
    wp_register_script( 'foundation-custom-forms', get_template_directory_uri() . '/js/foundation/jquery.customforms.js' ); 
    wp_enqueue_script( 'foundation-custom-forms', 'jQuery', '1.0', true );
    wp_register_script( 'foundation-placeholder', get_template_directory_uri() . '/js/foundation/jquery.placeholder.min.js' ); 
    wp_enqueue_script( 'foundation-placeholder', 'jQuery', '2.0.7', true );
    wp_register_script( 'foundation-tooltips', get_template_directory_uri() . '/js/foundation/jquery.tooltips.js' ); 
    wp_enqueue_script( 'foundation-tooltips', 'jQuery', '2.0.1', true );
    wp_register_script( 'foundation-app', get_template_directory_uri() . '/js/app.js' ); 
    wp_enqueue_script( 'foundation-app', 'jQuery', '1.0', true );
    wp_register_script( 'foundation-off-canvas', get_template_directory_uri() . '/js/foundation/off-canvas.js' ); 
    wp_enqueue_script( 'foundation-off-canvas', 'jQuery', '1.0', true );*/
/*    wp_register_script( 'flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js' ); 
    wp_enqueue_script( 'flexslider', 'jQuery', '1.0', true );*/

}

add_action('wp_enqueue_scripts', 'foundation_js');

function wp_foundation_js(){
//    wp_register_script( 'wp-foundation-js', get_template_directory_uri() . '/library/js/scripts.js', 'jQuery', '1.0', true);
//    wp_enqueue_script( 'wp-foundation-js' );
}

add_action('wp_enqueue_scripts', 'wp_foundation_js');

/************* COMMENT LAYOUT *********************/
		
// Comment Layout
function bones_comments($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?>>
		<article id="comment-<?php comment_ID(); ?>" class="panel clearfix">
			<div class="comment-author vcard row clearfix">
                <div class="twelve columns">
                    <div class="
                        <?php
                        $authID = get_the_author_meta('ID');
                                                    
                        if($authID == $comment->user_id)
                            echo "panel callout";
                        else
                            echo "panel";
                        ?>
                    ">
                        <div class="row">
            				<div class="avatar two columns">
            					<?php echo get_avatar($comment,$size='75',$default='<path_to_url>' ); ?>
            				</div>
            				<div class="ten columns">
            					<?php printf(__('<h4 class="span8">%s</h4>'), get_comment_author_link()) ?>
            					<time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time('F jS, Y'); ?> </a></time>
            					
            					<?php edit_comment_link(__('Edit'),'<span class="edit-comment">', '</span>'); ?>
                                
                                <?php if ($comment->comment_approved == '0') : ?>
                   					<div class="alert-box success">
                      					<?php _e('Your comment is awaiting moderation.') ?>
                      				</div>
            					<?php endif; ?>
                                
                                <?php comment_text() ?>
                                
                                <!-- removing reply link on each comment since we're not nesting them -->
            					<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
		</article>
    <!-- </li> is added by wordpress automatically -->
<?php
} // don't remove this bracket!

// Add grid classes to comments
function add_class_comments($classes){
    array_push($classes, "twelve", "columns");
    return $classes;
}
add_filter('comment_class', 'add_class_comments');

/************* SEARCH FORM LAYOUT *****************/

// Search Form
function bones_wpsearch($form) {
    $form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
    <label class="screen-reader-text" for="s">' . __('Search for:', 'bonestheme') . '</label>
    <input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="Search the Site..." />
    <input type="submit" id="searchsubmit" value="'. esc_attr__('Search') .'" />
    </form>';
    return $form;
} // don't remove this bracket!

/****************** password protected post form *****/

add_filter( 'the_password_form', 'custom_password_form' );

//Below, Alec replaced /wp-pass.php with /wp-login.php?action=postpass as WordPress dropped wp-pass.php in 3.4. Pat on the back!
function custom_password_form() {
	global $post;
	$label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
	$o = '<div class="clearfix"><form action="' . get_option('siteurl') . '/wp-login.php?action=postpass" method="post">
	' . __( "<p>This post is password protected. To view it please enter your password below:</p>" ) . '
	<div class="row collapse">
        <div class="twelve columns"><label for="' . $label . '">' . __( "Password:" ) . ' </label></div>
        <div class="eight columns">
            <input name="post_password" id="' . $label . '" type="password" size="20" class="input-text" />
        </div>
        <div class="four columns">
            <input type="submit" name="Submit" class="postfix button nice blue radius" value="' . esc_attr__( "Submit" ) . '" />
        </div>
	</div>
    </form></div>
	';
	return $o;
}

/*********** update standard wp tag cloud widget so it looks better ************/

// filter tag clould output so that it can be styled by CSS
function add_tag_class( $taglinks ) {
    $tags = explode('</a>', $taglinks);
    $regex = "#(.*tag-link[-])(.*)(' title.*)#e";
        foreach( $tags as $tag ) {
            $tagn[] = preg_replace($regex, "('$1$2 label radius tag-'.get_tag($2)->slug.'$3')", $tag );
        }
    $taglinks = implode('</a>', $tagn);
    return $taglinks;
}

add_action('wp_tag_cloud', 'add_tag_class');

add_filter( 'widget_tag_cloud_args', 'my_widget_tag_cloud_args' );

function my_widget_tag_cloud_args( $args ) {
	$args['number'] = 20; // show less tags
	$args['largest'] = 9.75; // make largest and smallest the same - i don't like the varying font-size look
	$args['smallest'] = 9.75;
	$args['unit'] = 'px';
	return $args;
}

add_filter('wp_tag_cloud','wp_tag_cloud_filter', 10, 2);

function wp_tag_cloud_filter($return, $args)
{
  return '<div id="tag-cloud"><p>'.$return.'</p></div>';
}

function add_class_the_tags($html){
    $postid = get_the_ID();
    $html = str_replace('<a','<a class="label success radius"',$html);
    return $html;
}
add_filter('the_tags','add_class_the_tags',10,1);

// Enable shortcodes in widgets
add_filter('widget_text', 'do_shortcode');

// Disable jump in 'read more' link
function remove_more_jump_link($link) {
	$offset = strpos($link, '#more-');
	if ($offset) {
		$end = strpos($link, '"',$offset);
	}
	if ($end) {
		$link = substr_replace($link, '', $offset, $end-$offset);
	}
	return $link;
}
add_filter('the_content_more_link', 'remove_more_jump_link');

// Remove height/width attributes on images so they can be responsive
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 );
add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 );

function remove_thumbnail_dimensions( $html ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}

 
//Replaces "current-menu-item" with "active"
function current_to_active($text){
        $replace = array(
                //List of menu item classes that should be changed to "active"
                'current_page_item' => 'active',
                'current_page_parent' => 'active',
                'current_page_ancestor' => 'active',
        );
        $text = str_replace(array_keys($replace), $replace, $text);
                return $text;
        }
add_filter ('wp_nav_menu','current_to_active');
 
function excerpt($limit) {
	$excerpt = explode(' ', get_the_excerpt(), $limit);
	if (count($excerpt)>=$limit) {
		array_pop($excerpt);
		$excerpt = implode(" ",$excerpt).'?';
	} else {
		$excerpt = implode(" ",$excerpt);
	}
	$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
	return $excerpt;
}


//used for listing terms related to a post
function forge_list_terms($taxonomy, $format = "link", $postID = NULL ){

	if($postID == NULL){
		$postID = $post->ID;
	}
	$terms = get_the_terms( $postID, $taxonomy ); 
	if ( $terms && ! is_wp_error( $terms ) ) { 

		$term_output = array();
	
		foreach ( $terms as $term ) {
			
			if($format == 'name'){
				$term_output[] =  $term->name;			

			}
			elseif($format == 'link'){
				$term_output[] = "<a href='".get_term_link($term->slug, $taxonomy)."' class='term-link'>".$term->name."</a>";

			}else{
				$term_output[0] = "The format provided is not supported. ";
			}

		
		}
							
		$terms = join( ", ", $term_output );
		
	}
	return 	$terms;							

}

//used for listing terms from a taxonomy
function forge_taxonomy_terms($taxonomy, $format = "link"){

	$terms = get_terms( $taxonomy ); 
	if ( $terms && ! is_wp_error( $terms ) ) { 

		$term_output = array();
		$theTax = "";
		foreach ( $terms as $term ) {
			
			if($format == 'name'){
				$term_output[] =  $term->name;			

			}
			elseif($format == 'link'){
				$term_output[] = "<a href='".get_term_link($term->slug, $taxonomy)."' class='term-link'>".$term->name."</a>";

			}elseif($format == 'checkbox'){
				$checked = '';
				if(!empty( $_GET[$term->taxonomy] )) {
					foreach( (array) $_GET[$term->taxonomy] as $category_id ){
						if($category_id == $term->term_id ){
							$checked = 'checked="checked"';
						} // end of if statement
					} // end of foreach
				} // end of if statement

				$term_output[] = '<label for="'. $term->taxonomy .'_' . $term->term_id . '"><input type="checkbox" name="'. $term->taxonomy .'[]" id="'.$term->taxonomy .'_' . $term->term_id . '" value="' . $term->term_id . '" '. $checked .' >&nbsp;' . $term->name . '</label>';
				
			}elseif($format == 'dropdown'){
				$term_output[] = '<option value="' . $term->term_id . '">' . $term->name . '</option>';
				$theTax = $term->taxonomy; 
			}
			else{
				$term_output[0] = "The format provided is not supported. ";
			}

		
		}


		if($format == 'checkbox'){
			$theTerms = join( " ", $term_output );
		}elseif($format == 'dropdown'){
			$theTerms = "<select name='".$theTax."'><option>Please select one</option>".join( "", $term_output )."</select>";
		}else{
			$theTerms = join( ", ", $term_output );
		}

							
		
	}
	return 	$theTerms;							

}

function get_vimeo_id($vimeo){
	return (int) substr(parse_url($vimeo, PHP_URL_PATH), 1);
}

add_filter('wp_nav_menu_items', 'add_login_logout_link', 10, 2);
function add_login_logout_link($items, $args) {
        ob_start();
        wp_loginout('index.php');
        $loginoutlink = ob_get_contents();
        ob_end_clean();
        if( $args->theme_location == 'top_menu' )
	        $items = '<li class="login">'. $loginoutlink .'</li>' . $items;
    
	    return $items;
}

function thisismyurl_the_content( $id = NULL ) {
	if ( !$id ) {
		global $post;
		$id = $post->ID;
	}
	 
	echo thisismyurl_get_the_content( $id );
}
 
function thisismyurl_get_the_content( $id = NULL ) {
 
	if ( !$id ) {
		global $post;
		$id = $post->ID;
	}
	 
	$post_data = get_post( $id );
	$the_content = str_replace( ']]>',']]&gt>', apply_filters( 'the_content', $post_data->post_content ) );
	 
	return $the_content;
}

add_action( 'init' , 'sensei_add_custom_fields_to_lessons' );
function sensei_add_custom_fields_to_lessons() {
  add_post_type_support( 'lesson' , 'custom-fields' );
}


/* ======= Ajax Query Filters ======= */
add_action( 'wp_ajax_filter', 'filter_query' );
add_action( 'wp_ajax_nopriv_filter', 'filter_query' );
function filter_query($content){

   if ( !wp_verify_nonce( $_POST['nonce'], "filter")) {
      exit("No naughty business please");
   }   

	// get the taxonomies to use in the query.
    $testing = $_POST['taxonomies']; 
    
    $course_types = array(); 
    $course_subjects = array(); 
	$course_ceu = array(); 
	$author_ids = array(); 
	
	if(!empty($testing)){
		foreach($testing as $test){
			if($test['tax']== 'course-types'){
				$course_types[] = $test['term']; 
			}elseif($test['tax']== 'course-subjects'){
				$course_subjects[] = $test['term'];
			}elseif($test['tax']== 'course-ceu'){
				$course_ceu[] = $test['term']; 
			}elseif($test['tax']== 'author'){
				$author_ids[] = $test['term'];	
			}elseif($test['tax']== 'date'){				
				$date = explode("-", $test['term']);
			}
	
		}    
    }

    if( !empty($course_types) ){
	    $course_type_query	= array(
				'taxonomy' => 'course-types',
				'field' => 'slug',
				'terms' => $course_types
			);
    }

    if( !empty($course_subjects) ){
	    $course_subject_query	= array(
				'taxonomy' => 'course-subjects',
				'field' => 'slug',
				'terms' => $course_subjects
			);
    }
    
    if( !empty($course_ceu) ){
	    $course_ceu_query	= array(
				'taxonomy' => 'course-ceu',
				'field' => 'slug',
				'terms' => $course_ceu
			);
    }        

    if( !empty($author_ids) ){
	    $meta_query	= array('relation' => 'OR'); 
				
		foreach($author_ids as $author){		
			$meta_query[] =	array(
				'key' => 'author',
				'value' => $author
				); 
			}
    } 
    
    if( !empty($date) ){
	    $year = $date[0];
	    $month = $date[1]; 
    }     
    
    $course_args = array(
	    'post_type' => 'course',
	    'posts_per_page' => -1,
	    'post_status' => 'publish',  
    	'tax_query' => array(
			'relation' => 'AND',
			$course_type_query,
			$course_subject_query,
			$course_ceu_query
		),
		'meta_query' => $meta_query,
		'year' => $year, 
		'monthnum' => $month
    ); 
    
    $course_html = "";

    $course = new WP_Query($course_args);

    if($course->have_posts()){

	    while($course->have_posts() ): $course->the_post(); 
	
			$course_html .= '<tr><td><a href="'. get_permalink() .'">'.get_the_title().'</a></td>';
			
			$course_html .= '<td>';
			
			$course_type = get_the_terms( $post->ID, 'course-types' ); 
			
			foreach($course_type as $type ){
		
					$image = wp_get_attachment_image_src(get_field('logo', $type->taxonomy."_".$type->term_id), 'small-logo');			 
		
					$course_html .= '<img src="'. $image[0].' ">';
			}
			
			$course_html .= '</td>';
			
			$course_html .= '<td>'.get_field('duration').'</td>';
			
			$course_html .= '<td>';
			
			$stamp = get_field('expiry_date')/1000; 
		
			$course_html .= date("m/d/Y", $stamp).'</td>';
			
			$course_html .= '<td>'. get_the_date('m/d/Y').'</td>';
			
			$course_html .= '<td>'.get_field('ceus').'</td>';
		
			$course_html .= '</tr>';
	    
	    endwhile; 
	
	}else{
		$course_html .= '<tr><td><h2>Sorry, but there are no courses matching your selections.</h2></td></tr>';
	}
	//$test = join(", ", $array_dump);

	$test = print_r($testing, true); 

    $content = $course_html;

    echo $content; 
	exit(); 

}



add_action( 'wp_ajax_re-order', 'reorder_filter_query' );
add_action( 'wp_ajax_nopriv_re-order', 'reorder_filter_query' );
function reorder_filter_query($content){

   if ( !wp_verify_nonce( $_POST['nonce'], "filter")) {
      exit("No naughty business please");
   }   

	// get the taxonomies to use in the query.
    $testing = $_POST['taxonomies']; 
	$order_type = $_POST['orderby'];
	    
    $course_types = array(); 
    $course_subjects = array(); 
	$course_ceu = array(); 
	$author_ids = array(); 
	
	if(!empty($testing)){
		foreach($testing as $test){
			if($test['tax']== 'course-types'){
				$course_types[] = $test['term']; 
			}elseif($test['tax']== 'course-subjects'){
				$course_subjects[] = $test['term'];
			}elseif($test['tax']== 'course-ceu'){
				$course_ceu[] = $test['term']; 
			}elseif($test['tax']== 'author'){
				$author_ids[] = $test['term'];	
			}elseif($test['tax']== 'date'){				
				$date = explode("-", $test['term']);
			}
	
		}    
    }

    if( !empty($course_types) ){
	    $course_type_query	= array(
				'taxonomy' => 'course-types',
				'field' => 'slug',
				'terms' => $course_types
			);
    }

    if( !empty($course_subjects) ){
	    $course_subject_query	= array(
				'taxonomy' => 'course-subjects',
				'field' => 'slug',
				'terms' => $course_subjects
			);
    }
    
    if( !empty($course_ceu) ){
	    $course_ceu_query	= array(
				'taxonomy' => 'course-ceu',
				'field' => 'slug',
				'terms' => $course_ceu
			);
    }        

    if( !empty($author_ids) ){
	    $meta_query	= array('relation' => 'OR'); 
				
		foreach($author_ids as $author){		
			$meta_query[] =	array(
				'key' => 'author',
				'value' => $author
				); 
			}
    } 

	if( !empty($order_type) ){
		 $ordered = $_POST['orderby'];
		 if($ordered == 'duration'){
			 $ordered = "meta_value";
			 $meta_key = "duration"; 
		 }elseif($ordered == 'expiry'){
			 $ordered = "meta_value";
			 $meta_key = "expiry_date"; 			 
		 }elseif($ordered == 'released'){
			 $ordered = "date";
		 }elseif($ordered == 'ceu'){
			 $ordered = "meta_value";
			 $meta_key = "ceus"; 			 
		 }elseif($ordered == 'taxonomy'){
			 $ordered = "meta_value";
			 $meta_key = "course_type_filtering"; 			 
		 }
		 
		 
	}
    
    if( !empty($date) ){
	    $year = $date[0];
	    $month = $date[1]; 
    }     
	if($ordered == 'meta_value'){
    
	    $course_args = array(
		    'post_type' => 'course',
		    'posts_per_page' => -1,
		    'post_status' => 'publish',  
	    	'tax_query' => array(
				'relation' => 'AND',
				$course_type_query,
				$course_subject_query,
				$course_ceu_query
			),
			'meta_query' => $meta_query,
			'year' => $year, 
			'monthnum' => $month,
			'orderby' => $ordered,
			'order' => $_POST['order'], 
			'meta_key' => $meta_key
	    ); 
    } else {
	    $course_args = array(
		    'post_type' => 'course',
		    'posts_per_page' => -1,
		    'post_status' => 'publish',  
	    	'tax_query' => array(
				'relation' => 'AND',
				$course_type_query,
				$course_subject_query,
				$course_ceu_query
			),
			'meta_query' => $meta_query,
			'year' => $year, 
			'monthnum' => $month,
			'orderby' => $ordered,
			'order' => $_POST['order']
	    ); 
	    
    }

    $course_html = "";

    $course = new WP_Query($course_args);

    if($course->have_posts()){

	    while($course->have_posts() ): $course->the_post(); 
	
			$course_html .= '<tr><td><a href="'. get_permalink() .'">'.get_the_title().'</a></td>';
			
			$course_html .= '<td>';
			
			$course_type = get_the_terms( $post->ID, 'course-types' ); 
			
			foreach($course_type as $type ){
		
					$image = wp_get_attachment_image_src(get_field('logo', $type->taxonomy."_".$type->term_id), 'small-logo');			 
		
					$course_html .= '<img src="'. $image[0].' ">';
			}
			
			$course_html .= '</td>';
			
			$course_html .= '<td>'.get_field('duration').'</td>';
			
			$course_html .= '<td>';
			
			$stamp = get_field('expiry_date')/1000; 
		
			$course_html .= date("m/d/Y", $stamp).'</td>';
			
			$course_html .= '<td>'. get_the_date('m/d/Y').'</td>';
			
			$course_html .= '<td>'.get_field('ceus').'</td>';
		
			$course_html .= '</tr>';
	    
	    endwhile; 
	
	}else{
		$course_html .= '<tr><td><h2>Sorry, but there are no courses matching your selections.</h2></td></tr>';
	}
	//$test = join(", ", $array_dump);

	$test = print_r($testing, true); 

    $content = $course_html;

    echo $content; 
	exit(); 

}


/* Get Archives for custom post type. Used on the courses to list months with courses post in them. */ 
function forge_wp_get_archives($args = '') {
	global $wpdb, $wp_locale;
	$nonce = wp_create_nonce("filter");


	$defaults = array(
		'type' => 'monthly', 'limit' => '',
		'format' => 'html', 'before' => '',
		'after' => '', 'show_post_count' => false,
		'echo' => 1, 'order' => 'DESC', 'post_type' => 'post'
	);

	$r = wp_parse_args( $args, $defaults );
	extract( $r, EXTR_SKIP );

	if ( '' == $type )
		$type = 'monthly';

	if ( '' != $limit ) {
		$limit = absint($limit);
		$limit = ' LIMIT '.$limit;
	}
	if ( '' == $post_type ) {
		$post_type = 'post'; 
	}

	$order = strtoupper( $order );
	if ( $order !== 'ASC' )
		$order = 'DESC';

	// this is what will separate dates on weekly archive links
	$archive_week_separator = '&#8211;';

	// over-ride general date format ? 0 = no: use the date format set in Options, 1 = yes: over-ride
	$archive_date_format_over_ride = 0;

	// options for daily archive (only if you over-ride the general date format)
	$archive_day_date_format = 'Y/m/d';

	// options for weekly archive (only if you over-ride the general date format)
	$archive_week_start_date_format = 'Y/m/d';
	$archive_week_end_date_format	= 'Y/m/d';

	if ( !$archive_date_format_over_ride ) {
		$archive_day_date_format = get_option('date_format');
		$archive_week_start_date_format = get_option('date_format');
		$archive_week_end_date_format = get_option('date_format');
	}

	//filters
	$where = apply_filters( 'getarchives_where', "WHERE post_type = '".$post_type."' AND post_status = 'publish'", $r );
	$join = apply_filters( 'getarchives_join', '', $r );

	$output = '';

	if ( 'monthly' == $type ) {
		$query = "SELECT YEAR(post_date) AS `year`, MONTH(post_date) AS `month`, count(ID) as posts FROM $wpdb->posts $join $where GROUP BY YEAR(post_date), MONTH(post_date) ORDER BY post_date $order $limit";
		$key = md5($query);
		$cache = wp_cache_get( 'wp_get_archives' , 'general');
		if ( !isset( $cache[ $key ] ) ) {
			$arcresults = $wpdb->get_results($query);
			$cache[ $key ] = $arcresults;
			wp_cache_set( 'wp_get_archives', $cache, 'general' );
		} else {
			$arcresults = $cache[ $key ];
		}
		if ( $arcresults ) {
			$afterafter = $after;
			foreach ( (array) $arcresults as $arcresult ) {
				$url = get_month_link( $arcresult->year, $arcresult->month );
				/* translators: 1: month name, 2: 4-digit year */
				$text = sprintf(__('%1$s %2$d'), $wp_locale->get_month($arcresult->month), $arcresult->year);
				if ( $show_post_count )
					$after = '&nbsp;('.$arcresult->posts.')' . $afterafter;
				if($post_type == 'post' ){
					$output .= get_archives_link($url, $text, $format, $before, $after);
				}else {
					$output .= "<li><a href='#' class='filter' data-taxonomy='date' data-slug='".$arcresult->year."-".$arcresult->month."' data-nonce='" . $nonce . "'><span class='filter-name'>".$text."</span>".$after."</a></li>"; 
				}
				
			}
		}
	} elseif ('yearly' == $type) {
		$query = "SELECT YEAR(post_date) AS `year`, count(ID) as posts FROM $wpdb->posts $join $where GROUP BY YEAR(post_date) ORDER BY post_date $order $limit";
		$key = md5($query);
		$cache = wp_cache_get( 'wp_get_archives' , 'general');
		if ( !isset( $cache[ $key ] ) ) {
			$arcresults = $wpdb->get_results($query);
			$cache[ $key ] = $arcresults;
			wp_cache_set( 'wp_get_archives', $cache, 'general' );
		} else {
			$arcresults = $cache[ $key ];
		}
		if ($arcresults) {
			$afterafter = $after;
			foreach ( (array) $arcresults as $arcresult) {
				$url = get_year_link($arcresult->year);
				$text = sprintf('%d', $arcresult->year);
				if ($show_post_count)
					$after = '&nbsp;('.$arcresult->posts.')' . $afterafter;
				$output .= get_archives_link($url, $text, $format, $before, $after);
			}
		}
	} elseif ( 'daily' == $type ) {
		$query = "SELECT YEAR(post_date) AS `year`, MONTH(post_date) AS `month`, DAYOFMONTH(post_date) AS `dayofmonth`, count(ID) as posts FROM $wpdb->posts $join $where GROUP BY YEAR(post_date), MONTH(post_date), DAYOFMONTH(post_date) ORDER BY post_date $order $limit";
		$key = md5($query);
		$cache = wp_cache_get( 'wp_get_archives' , 'general');
		if ( !isset( $cache[ $key ] ) ) {
			$arcresults = $wpdb->get_results($query);
			$cache[ $key ] = $arcresults;
			wp_cache_set( 'wp_get_archives', $cache, 'general' );
		} else {
			$arcresults = $cache[ $key ];
		}
		if ( $arcresults ) {
			$afterafter = $after;
			foreach ( (array) $arcresults as $arcresult ) {
				$url	= get_day_link($arcresult->year, $arcresult->month, $arcresult->dayofmonth);
				$date = sprintf('%1$d-%2$02d-%3$02d 00:00:00', $arcresult->year, $arcresult->month, $arcresult->dayofmonth);
				$text = mysql2date($archive_day_date_format, $date);
				if ($show_post_count)
					$after = '&nbsp;('.$arcresult->posts.')'.$afterafter;
				$output .= get_archives_link($url, $text, $format, $before, $after);
			}
		}
	} elseif ( 'weekly' == $type ) {
		$week = _wp_mysql_week( '`post_date`' );
		$query = "SELECT DISTINCT $week AS `week`, YEAR( `post_date` ) AS `yr`, DATE_FORMAT( `post_date`, '%Y-%m-%d' ) AS `yyyymmdd`, count( `ID` ) AS `posts` FROM `$wpdb->posts` $join $where GROUP BY $week, YEAR( `post_date` ) ORDER BY `post_date` $order $limit";
		$key = md5($query);
		$cache = wp_cache_get( 'wp_get_archives' , 'general');
		if ( !isset( $cache[ $key ] ) ) {
			$arcresults = $wpdb->get_results($query);
			$cache[ $key ] = $arcresults;
			wp_cache_set( 'wp_get_archives', $cache, 'general' );
		} else {
			$arcresults = $cache[ $key ];
		}
		$arc_w_last = '';
		$afterafter = $after;
		if ( $arcresults ) {
				foreach ( (array) $arcresults as $arcresult ) {
					if ( $arcresult->week != $arc_w_last ) {
						$arc_year = $arcresult->yr;
						$arc_w_last = $arcresult->week;
						$arc_week = get_weekstartend($arcresult->yyyymmdd, get_option('start_of_week'));
						$arc_week_start = date_i18n($archive_week_start_date_format, $arc_week['start']);
						$arc_week_end = date_i18n($archive_week_end_date_format, $arc_week['end']);
						$url  = sprintf('%1$s/%2$s%3$sm%4$s%5$s%6$sw%7$s%8$d', home_url(), '', '?', '=', $arc_year, '&amp;', '=', $arcresult->week);
						$text = $arc_week_start . $archive_week_separator . $arc_week_end;
						if ($show_post_count)
							$after = '&nbsp;('.$arcresult->posts.')'.$afterafter;
						$output .= get_archives_link($url, $text, $format, $before, $after);
					}
				}
		}
	} elseif ( ( 'postbypost' == $type ) || ('alpha' == $type) ) {
		$orderby = ('alpha' == $type) ? 'post_title ASC ' : 'post_date DESC ';
		$query = "SELECT * FROM $wpdb->posts $join $where ORDER BY $orderby $limit";
		$key = md5($query);
		$cache = wp_cache_get( 'wp_get_archives' , 'general');
		if ( !isset( $cache[ $key ] ) ) {
			$arcresults = $wpdb->get_results($query);
			$cache[ $key ] = $arcresults;
			wp_cache_set( 'wp_get_archives', $cache, 'general' );
		} else {
			$arcresults = $cache[ $key ];
		}
		if ( $arcresults ) {
			foreach ( (array) $arcresults as $arcresult ) {
				if ( $arcresult->post_date != '0000-00-00 00:00:00' ) {
					$url  = get_permalink( $arcresult );
					if ( $arcresult->post_title )
						$text = strip_tags( apply_filters( 'the_title', $arcresult->post_title, $arcresult->ID ) );
					else
						$text = $arcresult->ID;
					$output .= get_archives_link($url, $text, $format, $before, $after);
				}
			}
		}
	}
	if ( $echo )
		echo $output;
	else
		return $output;
}


function orderby_tax_clauses( $clauses, $wp_query ) {
    global $wpdb;
    $taxonomies = get_taxonomies();
    foreach ($taxonomies as $taxonomy) {
        if ( isset( $wp_query->query['orderby'] ) && $taxonomy == $wp_query->query['orderby'] ) {
            $clauses['join'] .=<<<SQL
LEFT OUTER JOIN {$wpdb->term_relationships} ON {$wpdb->posts}.ID={$wpdb->term_relationships}.object_id
LEFT OUTER JOIN {$wpdb->term_taxonomy} USING (term_taxonomy_id)
LEFT OUTER JOIN {$wpdb->terms} USING (term_id)
SQL;
            $clauses['where'] .= " AND (taxonomy = '{$taxonomy}' OR taxonomy IS NULL)";
            $clauses['groupby'] = "object_id";
            $clauses['orderby'] = "GROUP_CONCAT({$wpdb->terms}.name ORDER BY name ASC) ";
            $clauses['orderby'] .= ( 'ASC' == strtoupper( $wp_query->get('order') ) ) ? 'ASC' : 'DESC';
        }
    }
    return $clauses;
}

    add_filter('posts_clauses', 'orderby_tax_clauses', 10, 2 );


function custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


// Customizing Profile Page

function hide_instant_messaging( $contactmethods ) {
unset($contactmethods['aim']);
unset($contactmethods['yim']);
unset($contactmethods['jabber']);
unset($contactmethods['user_fb']);
unset($contactmethods['user_tw']);
unset($contactmethods['google_profile']);
return $contactmethods;
}
add_filter('user_contactmethods','hide_instant_messaging',10,1);


function modify_contact_methods($profile_fields) {

	// Add new fields
	$profile_fields['pharmacy'] = 'Pharmacy Number';

	return $profile_fields;
}
add_filter('user_contactmethods', 'modify_contact_methods');

/*
add_action( 'show_user_profile', 'pharmacy_fields' );
add_action( 'edit_user_profile', 'pharmacy_fields' );
 
function pharmacy_fields( $user ) { ?>
 
<h3>Pharmacist Number</h3>
 
<table class="form-table">
 
	<tr>
		<th><label for="social">Pharmacy Number <?php echo "hello ".$_POST['pharmacy']; ?></label></th>
		 
		<td>
		<input type="text" name="pharmacy" id="pharmacy" placeholder="Pharmacy #" value="<?php echo the_author_meta('pharmacy'); ?>"class="regular-text" />
		<span class="description">Please enter your pharmacy number.</span>
		</td>
	</tr>

 
</table>

<?php 
}
*/

add_action( 'personal_options_update', 'save_pharmacy_fields' );
add_action( 'edit_user_profile_update', 'save_pharmacy_fields' );
 
function save_pharmacy_fields( $user_id ) {
 
	if ( !current_user_can( 'edit_user', $user_id ) ){
	return false;
	}
	 
	update_usermeta( $user_id, 'pharmacy', $_POST['pharmacy'] );

}

/**
* WordPress function for redirecting users based on custom user meta
*/
function my_login_redirect( $url, $request, $user ){
	if( $user && is_object( $user ) && is_a( $user, 'WP_User' ) ) {
		if( '' == get_user_meta( $user->ID, 'pharmacy', true ) ) {
		$url = home_url('/your-profile/');
		}
	}
	return $url;
}
 
add_filter('login_redirect', 'my_login_redirect', 10, 3 );

/* ADDED: GARY */
/**
* WooCommerce Customizations
*/
/** 
 * Change on single product panel "Product Description"
 * since it already says "features" on tab.
 */
add_filter('woocommerce_product_description_heading',
'isa_product_description_heading');
 
function isa_product_description_heading() {
    return __('Course Description', 'woocommerce');
}
// Hide product Images
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );

function my_short_page_template_body_classes( $classes ){
    if( is_page() ){
        $template = get_page_template_slug(); // returns an empty string if it's loading the default template (page.php)
        if( $template === '' ){
            $classes[] = 'default-page';
        } else {
            $classes[] = sanitize_html_class( str_replace( '.php', '', $template ) );
        }
    }
    return $classes;
}
add_filter( 'body_class', 'my_short_page_template_body_classes' );

add_filter( 'woocommerce_get_availability', 'change_out_of_stock' );

function change_out_of_stock($availability)
{
    $availability['availability'] = str_ireplace( 'Out of stock', 'Not available for purchase', $availability['availability']);
return $availability;
}