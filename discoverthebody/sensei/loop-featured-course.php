<?php
/**
 * The Template for outputting Course Archive items
 *
 * Override this template by copying it to yourtheme/sensei/loop-course.php
 *
 * @author 		WooThemes
 * @package 	Sensei/Templates
 * @version     1.0.0
 */

global $woothemes_sensei, $post, $wp_query, $shortcode_override, $course_excludes;
// Handle Query Type
$query_type = 'featuredcourses';
if ( isset( $_GET[ 'action' ] ) && ( '' != esc_html( $_GET[ 'action' ] ) ) ) {
    $query_type = esc_html( $_GET[ 'action' ] );
} // End If Statement
if ( '' != $shortcode_override ) {
	$query_type = $shortcode_override;
} // End If Statement
if ( !is_array( $course_excludes ) ) { $course_excludes = array(); } ?>
<?php 
// Check that query returns results
// Handle Pagination
$paged = $wp_query->get( 'paged' );
    // Check for pagination settings
    if ( isset( $woothemes_sensei->settings->settings[ 'course_archive_amount' ] ) && ( 0 < absint( $woothemes_sensei->settings->settings[ 'course_archive_amount' ] ) ) ) { 
    	$amount = absint( $woothemes_sensei->settings->settings[ 'course_archive_amount' ] );
    } else {
    	$amount = $wp_query->get( 'posts_per_page' );
    } // End If Statement
    // This is not a paginated page (or it's simply the first page of a paginated page/post)
    $course_includes = array();
    $posts_array = $woothemes_sensei->post_types->course->course_query( $amount, $query_type, $course_includes, $course_excludes );
    if ( count( $posts_array ) > 0 ) { ?>
    	
			<?php $rowcount = 0; ?>
    	    
    	    <?php foreach ($posts_array as $post_item){
    			// Make sure the other loops dont include the same post twice!
    			array_push( $course_excludes, $post_item->ID );
    			// Get meta data	
    			$post_id = absint( $post_item->ID );
    			$post_title = $post_item->post_title;
    			$user_info = get_userdata( absint( $post_item->post_author ) );
    			$author_link = get_author_posts_url( absint( $post_item->post_author ) );
    			$author_display_name = $user_info->display_name;
    			$author_id = $post_item->post_author;
    			?>
    			<article class="<?php echo join( ' ', get_post_class( array( 'course', 'post' ), $post_id ) ); ?> twelve columns">
    				
                    <a href="<?php echo get_permalink( $post_id ); ?>" title="<?php echo esc_attr( $post_title ); ?>">
                        <?php
        				// Image
    					echo get_the_post_thumbnail( $post_id, 'medium' );

        				?>
                    </a>
    				
    				<header class="entry">
    						<!-- <p><?php echo forge_list_terms('course-types', 'name', $post_id ); ?></p> -->
    					
	    					<h2><a href="<?php echo get_permalink( $post_id ); ?>" title="<?php echo esc_attr( $post_title ); ?>"><?php echo $post_title; ?></a></h2>

    				</header>
                    <p><?php echo $post_item->post_excerpt ?></p>
    			</article>
			<?php
    		$rowcount++; 
    		if($rowcount == 2 ){
	    		echo "</div><div class='row'>"; $rowcount = 0; 
    		}	
    		} // End For Loop
    		
    		if ( '' != $shortcode_override && ( $amount <= count( $posts_array ) ) ) {
    			// echo sensei_course_archive_next_link( $query_type );
    		} // End If Statement ?>
    	      
    
    <?php } // End If Statement ?>
