<?php 
/* 
* Template Name: Courses (No Filter)
*/ 
get_header(); ?>
			
			<div id="content" role="main">
			
				<div class="row">
			
					<div id="main" class="twelve columns clearfix" >
	

						<section class="course-list">	

						<?php 

						$args = array(
							'post_type' => 'course'
							,'posts_per_page' => -1
							,'meta_key' => 'start_date'
							,'orderby' => 'meta_value'
							,'order' => 'DESC'
							,'meta_query' => array(
								array(
									'key' => 'start_date',
									'value' => date("Ymd"), // Set today's date (note the similar format)
                					'compare' => '>=', // Return the ones less than today's date'compare' => '<',
									'type' => 'NUMERIC'
								)
							)
							
						); 


						$today= getdate();

						$old_args = array(
							'post_type' => 'course'
							,'posts_per_page' => -1
							,'meta_key' => 'start_date'
							,'orderby' => 'meta_value'
							,'order' => 'DESC'
							,'meta_query' => array(
								array(
									'key' => 'start_date',
									'value' => date("Ymd"), // Set today's date (note the similar format)
                					'compare' => '<', // Return the ones less than today's date'compare' => '<',
									'type' => 'NUMERIC'
								)
							)
							
						); 


						$courses = new WP_Query($args); 
						$old_courses = new WP_Query($old_args);

						if ($courses->have_posts()) : ?>
							

							<table class="courses" cellspacing="0">
								<thead>
									<tr>
										<th>Courses</th>
										<th>Start Date</th>
										<th>Location</th>
										<th>&nbsp;</th>
									</tr>
									
								</thead>

								<tbody border=1 class="">
							
								<?php while ($courses->have_posts()) : $courses->the_post(); ?>

									<?php get_template_part( 'content', 'course_row' ); ?>					

									<tr>
										<td colspan="4" class="summary">
											<?php the_excerpt(); ?>					
										</td>
									</tr>

								
								<?php endwhile; ?>		

								</tbody>

							</table>

							<?php 
								if ($old_courses->have_posts()): ?>

									<table class="courses courses-expired" cellspacing="0">
									<thead>
										<tr>
											<th>Previous Courses</th>
											<th>Date</th>
											<th>Location</th>
											<th>&nbsp;</th>
										</tr>
							
									</thead>

									<tbody border=1 class="">
								
									<?php while ($old_courses->have_posts()) : $old_courses->the_post(); ?>

										<?php get_template_part( 'content', 'course_row' ); ?>					

										<tr>
											<td colspan="4" class="summary">
												<?php the_excerpt(); ?>					
											</td>
										</tr>

									
									<?php endwhile; ?>		

									</tbody>

									</table>

								<?php endif; ?>



<!--
<?php    
/*
    $course_args = array(
	    'post_type' => 'course',
	    'posts_per_page' => -1,
	    'post_status' => 'publish',  
		'meta_query' => array(
			'relation' => 'OR',
			array(
				'key' => 'author',
				'value' => '64',
			),
			array(
				'key' => 'author',
				'value' => '189',
			)
		)
    ); 
    $test_courses = new WP_Query($course_args);
	while($test_courses->have_posts()): $test_courses->the_post();
		the_title(); 
		echo " | "; 
	endwhile; 
*/
?>	
-->					
						</section>
						<?php else : ?>
						
						<article id="post-not-found">
						    <header>
						    	<h1>Not Found</h1>
						    </header>
						    <section class="post_content">
						    	<p>Sorry, but the requested resource was not found on this site.</p>
						    </section>
						    <footer>
						    </footer>
						</article>
						
						<?php endif; ?>

						<a href="#" class="back-top">back to top</a>
					</div> <!-- end #main -->
				</div>
			</div> <!-- end #content -->
<?php /*
<script>

	jQuery(document).ready(function($){	

		$('.close-filters').click(function(){
			var that = $(this); 
			if(that.hasClass('closed')){
				that.removeClass('closed');
				that.text('close filters');
			}else{
				that.text('open filters');
				that.addClass('closed');
			}
			$('.filters').slideToggle();
		});	
		
		
		// run query filters on course list
		$('.filters').find('a.filter').click(function(e){
			if($(this).hasClass('disabled')){
		        e.preventDefault(); 
		        return;
			}
			
			e.preventDefault();

			var that = $(this).parent().html();

			if($(this).data('taxonomy')== 'date'){
				$('.my-filters').find("[data-taxonomy='date']").remove(); 
			} 
			
			$(this).addClass('disabled');

			var nonce = jQuery(this).attr("data-nonce");

			var tax_names = [];
	
			var filter_container = $('.my-filters'); 
			
			filter_container.append(that); 
	
			var taxonomies = filter_container.find("[data-taxonomy]"); 
	
			taxonomies.each(function(){
				var key = $(this).data('taxonomy');
				var value = $(this).data('slug'); 
				tax_names.push({'tax': key, 'term': value}); 
			});
			
			$.ajax({
	            type: 'POST',
	            url: '<?php echo admin_url( 'admin-ajax.php' ) ?>',
	            data: {"action" : "filter", 'nonce': nonce, 'taxonomies': tax_names },
	            dataType: 'html',
	            success: function(data){
	                if (data) {
	
						$('.courses tbody').html(data); 
	                } else {
	                    alert('An error occured');
	                }
	            }
	        });			
		});
		
		// remove query filters 
		
		$('.my-filters').on('click', 'a.filter', function(e) {
			
			e.preventDefault();
			var that = $(this).parent().html(); 
			
			var nonce = jQuery(this).attr("data-nonce");
			var tax_names = [];

			var the_term = $(this).data('slug');
	
			console.log(the_term); 

			$('.filters').find("[data-slug='"+the_term+"']").removeClass('disabled'); 
	
			var filter_container = $('.my-filters'); 

			$(this).remove(); 

			var taxonomies = filter_container.find("[data-taxonomy]"); 
	
			taxonomies.each(function(){
				var key = $(this).data('taxonomy');
				var value = $(this).data('slug'); 
				tax_names.push({'tax': key, 'term': value}); 
			});
			
			$.ajax({
	            type: 'POST',
	            url: '<?php echo admin_url( 'admin-ajax.php' ) ?>',
	            data: {"action" : "filter", 'nonce': nonce, 'taxonomies': tax_names },
	            dataType: 'html',
	            success: function(data){
	                if (data) {
	
						$('.courses tbody').html(data); 
	                } else {
	                    alert('An error occured');
	                }
	            }
	        });			
		});		
		
	});

</script>
*/ ?>
<?php get_footer(); ?>