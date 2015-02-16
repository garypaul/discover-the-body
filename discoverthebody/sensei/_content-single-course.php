<?php
/**
 * The template for displaying product content in the single-course.php template
 *
 * Override this template by copying it to yourtheme/sensei/content-single-course.php
 *
 * @author 		WooThemes
 * @package 	Sensei/Templates
 * @version     1.0.0
 */
global $woothemes_sensei, $post, $current_user;
	 	
// Get User Meta
get_currentuserinfo();
// Check if the user is taking the course
$is_user_taking_course = WooThemes_Sensei_Utils::sensei_check_for_activity( array( 'post_id' => $post->ID, 'user_id' => $current_user->ID, 'type' => 'sensei_course_start' ) );
?>
	<?php
	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked woocommerce_show_messages - 10
	 */
	if ( WooThemes_Sensei_Utils::sensei_is_woocommerce_activated() ) {
		do_action( 'woocommerce_before_single_product' );
	} // End If Statement
	?>
<?php 
// if user clicks complete lesson. Set the lesson as complete. 
if ( isset( $_POST['quiz_complete'] ) && wp_verify_nonce( $_POST[ 'woothemes_sensei_complete_lesson_noonce' ], 'woothemes_sensei_complete_lesson_noonce' ) && ( isset( $_POST['post_id']) ) ) {

					$completed_post = $_POST['post_id']; 

                    // Mark lesson as complete
                    $args = array(
                                        'post_id' => $completed_post,
                                        'username' => $current_user->user_login,
                                        'user_email' => $current_user->user_email,
                                        'user_url' => $current_user->user_url,
                                        'data' => 'Lesson completed by the user',
                                        'type' => 'sensei_lesson_end', /* FIELD SIZE 20 */
                                        'parent' => 0,
                                        'user_id' => $current_user->ID
                                    );
                    $activity_logged = WooThemes_Sensei_Utils::sensei_log_activity( $args );
}
?>
        	<article <?php post_class( array( 'course', 'post' ) ); ?>>
    			
    			<div class="row">		

	                <header class="twelve columns">

	                	<div class="left">
			                <?php $course_author = get_field('author'); ?>
			                <h2><?php the_title(); ?> <span class="author"><a href="<?php echo get_permalink($course_author->ID); ?>"><?php  echo $course_author->post_title; ?></a></span></h2>
	        			</div>

	        			<div class="right">
	        				<!--<?php course_single_meta(); ?>-->
	        				<!--<span><input type="submit" name="register_button" class="quiz-submit complete" value="<?php _e( 'Register', 'woothemes-sensei' ); ?>"/></span>-->
	        				<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
								<input type="hidden" name="cmd" value="_s-xclick">
								<input type="hidden" name="hosted_button_id" value="<?php the_field('course_key'); ?>">
								<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
								<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
							</form>
	        				<?php 
		        				if(!is_user_logged_in()){ ?>
		    				        <!-- echo "<a href='".wp_register('', '', false)."' class='button create-account'>Create Account</a>";  -->
		    				        <a href="<?php bloginfo('url'); ?>/wp-login.php?action=register" class="button create account">Create Account</a>
		        				<?php }
		        				
	        				?>
			                	<!--<a class="addthis_button_compact button sharethis-button">Share This Page</a>-->

	                	</div>              
	                </header>

					<!--<?php 
						$course_id = 0;
						if(isset($_GET['lesson-id']) && $_GET['lesson-id']) {
							$course_id = $_GET['lesson-id'] - 1; 
						}
						$course_lessons = $woothemes_sensei->frontend->course->course_lessons( $post->ID ); 
					?>-->
	               				
	               	<section class="seven columns">			
		   				
		   				<!--<?php 

							$lesson_video_embed = get_post_meta( $course_lessons[$course_id]->ID, '_lesson_video_embed', true );

		   				    if ( 'http' == substr( $lesson_video_embed, 0, 4) ) {
						        // V2 - make width and height a setting for video embed
						        $lesson_video_embed = wp_oembed_get( esc_url( $lesson_video_embed )/*, array( 'width' => 100 , 'height' => 100)*/ );
						    } // End If Statement
						    ?>
						
						    <div class="flex-video widescreen vimeo"><?php echo html_entity_decode($lesson_video_embed); ?></div>					
					        <?php $user_lesson_end =  WooThemes_Sensei_Utils::sensei_get_activity_value( array( 'post_id' => $course_lessons[$course_id]->ID, 'user_id' => $current_user->ID, 'type' => 'sensei_lesson_end', 'field' => 'comment_content' ) ); 
					        
						        
						        if ( '' == $user_lesson_end && is_user_logged_in() && $is_user_taking_course) { 
					        
					        ?>

			        		<form method="POST" action="<?php echo esc_url( get_permalink() ); ?>">

					          <!--  <input type="hidden" name="<?php echo esc_attr( 'woothemes_sensei_complete_lesson_noonce' ); ?>" id="<?php echo esc_attr( 'woothemes_sensei_complete_lesson_noonce' ); ?>" value="<?php echo esc_attr( wp_create_nonce( 'woothemes_sensei_complete_lesson_noonce' ) ); ?>" />

								<input type="hidden" name="post_id" value="<?php echo $course_lessons[$course_id]->ID; ?>" />

					            <span><input type="submit" name="quiz_complete" class="quiz-submit complete" value="<?php _e( 'Complete Lesson', 'woothemes-sensei' ); ?>"/></span>

					        </form>-->
					        
					        <?php } ?>

					        <div class="row summary-overview">

					        	<div class="four columns">

			        				<?php 
			        				
			        				if(is_user_logged_in() && !$is_user_taking_course && !isset($_POST['course_start'])){
				        				course_single_meta(); 
			        				}elseif(!is_user_logged_in()){ ?>
	
			    				        <!-- echo "<a href='".wp_register('', '', false)."' class='button create-account'>Create Account</a>";  -->
			    				        <a href="<?php bloginfo('url'); ?>/wp-login.php?action=register" class="button create account">Create Account</a>
			        				
			        				<?php }elseif($is_user_taking_course || isset($_POST['course_start'])){ ?>
	
									<!--<?php $exam = get_field('course_exam'); 
										if($exam){
											
											$exam_link = get_permalink($exam[0]->ID); 
											echo '<a href="'. $exam_link .'" class="button">Take Quiz</a>'; 

										}
									?>	

									<?php $slides = get_field('slides'); 
										if($slides){
											
											echo '<a href="'. $slides .'" class="button">Download Slides</a>'; 

										}
									?>

									<?php $download = get_field('mp4'); 
										if($download ){
											
											echo '<a href="'. $download .'" class="button">Download MP4</a>'; 

										}
									?>	

									<?php $feedback = get_field('course_feedback'); 
										if($feedback ){
										
											$feedback_link = get_permalink($feedback[0]->ID); 
											echo '<a href="'. $feedback_link .'" class="button">Course Feedback</a>'; 

										}
									}
									?>		-->
					
					               	</div> <!-- .four-columns -->
					               </div> <!-- .summary-overview -->
					               	<div class="row">
					               	<section class="eight columns lesson-content">

						               	<!--<h2>Lesson Summary</h2> -->
						               	
										<?php 
										 
										thisismyurl_the_content($course_lessons[$course_id]->ID); 
										
										$custom_fields = get_post_custom($course_lessons[$course_id]->ID);
										
										$test_meta = get_post_meta($course_lessons[$course_id]->ID); 
										?>
										
					               	</section>
					               	
					               	<section class="entry fix summary-overview">

							               	<h2>Course Overview</h2>
							               	<?php the_content(); ?>

							               	<p><span>Author</span> <?php $author = get_field('author') ; echo $author->post_title; ?></p>
							
							               	<p><span>Duration</span> <?php the_field('duration'); ?></p>

							               	<p><span>Released</span> <?php echo get_the_date('m/d/Y'); ?></p>
							
							               	<p><span>Expires </span> 			
							               	<?php 
								               	$stamp = get_field('expiry_date')/1000; 
								               	echo date('m/d/Y', $stamp); 
								               	?>
								            </p>

								    	</section>
							   		</div> <!-- END .row -->
					               	

					        </div>
	               	</section>
	               	
	               	<div class="five columns">
						
	   		 			<!--<?php course_single_lessons(); ?>

	   		 			<section class="entry fix summary-overview">

	                	<h2>Course Overview</h2>
	                	<?php the_content(); ?>

						<p><span>Author</span> <?php $author = get_field('author') ; echo $author->post_title; ?></p>
						
						<p><span>Duration</span> <?php the_field('duration'); ?></p>

						<p><span>Released</span> <?php echo get_the_date('m/d/Y'); ?></p>
						
						<p><span>Expires </span> 			
						<?php 
							$stamp = get_field('expiry_date')/1000; 
							echo date('m/d/Y', $stamp); 
						?>
						</p>

	                </section>-->
	
	               	</div>

    			</div>				
	 			                
            </article><!-- .post -->

