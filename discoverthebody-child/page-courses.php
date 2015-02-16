<?php 
/* 
* Template Name: Courses
*/ 
get_header(); ?>
			FOOOOOOOOOOOOOOOOOOOOOO
			<div id="content" role="main">
			
				<div class="row">
			
					<div id="main" class="twelve columns clearfix" >
	

						<div class="filter">
							<h2>Filter this list of Courses</h2>
							<a href="#" class="close-filters">close filters</a>
							<div class="panel">
								<p>your filters:</p>
								<div class="my-filters">
								</div>
							
							</div>
							
							
							<ul class="block-grid five-up filters">
								
								<!--<li>
									<h4>Accreditation</h4>
									<ul>
									<?php  
										$nonce = wp_create_nonce("filter");
										
										$course_types = get_terms('course-types');
										foreach($course_types as $course_meta){
											
											echo "<li><a href='".$course_meta->term_id."' class='filter' data-taxonomy='".$course_meta->taxonomy."' data-slug='".$course_meta->slug."' data-nonce='" . $nonce . "'> <span class='filter-name'>".$course_meta->name."</span> (". $course_meta->count .")</a></li>";
											
										}										 
									?>
									</ul>
								</li>-->

								<li>
									<h4>Subject</h4>
									<ul>
									<?php  
										$course_subjects = get_terms('course-subjects');
										foreach($course_subjects as $course_meta){
											
											echo "<li><a href='".$course_meta->term_id."' class='filter' data-taxonomy='".$course_meta->taxonomy."' data-slug='".$course_meta->slug."' data-nonce='" . $nonce . "'> <span class='filter-name'>".$course_meta->name."</span> (". $course_meta->count .")</a></li>";
											
										}										 
									?>
									</ul>
								</li>
							
								<!--<li>
									<h4>CEU</h4>
									<ul>
									<?php  
										$course_ceu = get_terms('course-ceu');
										foreach($course_ceu as $course_meta){
											
											echo "<li><a href='".$course_meta->term_id."' class='filter' data-taxonomy='".$course_meta->taxonomy."' data-slug='".$course_meta->slug."' data-nonce='" . $nonce . "'> <span class='filter-name'>".$course_meta->name."</span> (". $course_meta->count .")</a></li>";
											
										}										 
									?>
									</ul>
								</li>-->
								<li>
										<h4>Level</h4>
										<ul>
											<?php
												$course_level = get_terms('course_level');
												foreach($course_level as $course_meta){
													echo "<li><a href='".$course_meta->term_id."' class='filter' data-taxonomy='".$course_meta->taxonomy."' data-slug='".$course_meta->slug."' data-nonce='" . $nonce . "'> <span class='filter-name'>".$course_meta->name."</span> (". $course_meta->count .")</a></li>";
												}
											?>
										</ul>
									</li>
								<li>
									<h4>Author</h4>
									<ul>
									<?php  
										$author_args = array(
											'post_type' => 'course-authors', 
											'posts_per_page' => -1
										);
										$authors = get_posts($author_args); 
										foreach($authors as $course_meta){
											
											$author_courses_arg = array(
												'post_type' => 'course',
												'posts_per_page' => -1,
												'meta_query' => array(
													array(
														'key' => 'author',
														'value' => $course_meta->ID,
													)
												)
											); 
											$authors_courses = get_posts($author_courses_arg);  
											echo "<li><a href='".$course_meta->ID."' class='filter' data-taxonomy='author' data-slug='".$course_meta->ID."' data-nonce='" . $nonce . "'> <span class='filter-name' >".$course_meta->post_title ."</span> (". count($authors_courses) .")</a></li>";
											
										}										 
									?>
									</ul>
								</li>
								
								<li>
								<h4>Released </h4>
								<?php $archives = forge_wp_get_archives( array( 'type' => 'monthly',  'echo' => false, 'post_type' => 'course', 'show_post_count' => true) ); ?>								
									<ul>
										<?php echo $archives; ?>
									</ul>
								</li>
							
							</ul>
						</div>

						<section class="course-list">	

						<?php 
						$args = array(
							'post_type' => 'course', 
							'posts_per_page' => -1
							
						); 
						$courses = new WP_Query($args); 

						if ($courses->have_posts()) : ?>
							<table class="courses">

								<thead>
							
									<tr>
										
										<!--<th>Course Title</th>
										<th>Type</th>
										<th>Duration</th>
										<th>Expiry</th>
										<th>Released</th>
										<th>CEUs</th>-->
										<th>Course Title</th>
										<th>Type</th>
										<th>Date</th>
										<th>Location</th>
										<th>Level</th>
										<th>Registration</th>
										<th>Deadline</th>
										
									</tr>

								</thead>

								<tbody border=1>
							
								<?php while ($courses->have_posts()) : $courses->the_post(); ?>

									<tr>
									
										<td><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></td>
									
										<td><?php //echo forge_list_terms('course-types', 'name', $post_id ); 
											$course_type = get_the_terms( $post_id, 'course-types' ); 
											foreach($course_type as $type ){
												$image = wp_get_attachment_image_src(get_field('logo', $type->taxonomy."_".$type->term_id), 'small-logo'); ?>				 
												<img src="<?php echo $image[0]; ?>">
										<?php 		
											}

										?></td>
										
										<td><?php the_field('duration'); ?></td>
										
										<td>
										<?php 
											$stamp = get_field('expiry_date')/1000; 
											echo date('m/d/Y', $stamp); 
										?>
										</td>
										
										<td><?php echo get_the_date('m/d/Y'); ?></td>
										
										<!-- <td><?php if(get_field('close_captioned')) { echo "close captioned"; }?></td> -->
										
										<td><?php the_field('ceus'); ?></td>
									
									</tr>					

								
								<?php endwhile; ?>		

								</tbody>

							</table>

<!--
<?php    
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
<?php get_footer(); ?>