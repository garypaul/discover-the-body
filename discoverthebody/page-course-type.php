<?php 
/* 
* Template Name: Course Type
*/ 
get_header(); ?>
			
			<div id="content" role="main">
			
				<div class="row">
					<?php $courseType; ?>

					<?php if(get_field('course_type')){
						$courseType = get_field('course_type');
					} ?>
					<?php 
						$args = array(
							'post_type' => 'course', 
							'posts_per_page' => -1,
							'tax_query' => array(
								array(
									'taxonomy' => 'course-types',
									'field' => 'ID',
									'terms' => $courseType,
									'operator' => 'IN'
								)
							)
						); 
						$courses = new WP_Query($args); 
						

						
					?>
					<div class="post-count twelve columns"><p><strong><?php echo $courses->found_posts; ?> Courses</strong></p></div>
					
					<div class="twelve columns filters-container">
						<div class="panel">

							<p><strong>selected filters:</strong>
							<span class="my-filters">
							</span>
							</p>
						</div>
					</div>
					
					<div id="main" class="twelve columns clearfix" >
						<div class="row">
						
						<div class="two columns">

							<div class="filter">
								
								<ul class="filters">
									
									
									<!-- <li>
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
									</li> -->
	
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
						
						</div>
						
						<div class="ten columns">

							<h1><?php the_title(); ?></h1>
							<section class="course-list">	
	
							<?php 
	
	
							if ($courses->have_posts()) : ?>
								<table class="courses">
	
									<thead>
								
										<tr>
											
											<!--<th>Course Title <span class="order-container" data-order="title"> <a href="#" class="filter-up" data-orderby="DESC" data-nonce="<?php echo $nonce ?>"></a><a href="#" class="filter-down" data-orderby="ASC" data-nonce="<?php echo $nonce ?>"></a> </span> </th>
											<th>Type <span class="order-container" data-order="taxonomy"><a href="#" class="filter-up" data-orderby="DESC" data-nonce="<?php echo $nonce ?>"></a><a href="#" class="filter-down" data-orderby="ASC" data-nonce="<?php echo $nonce ?>"></a></span></th>
											<th>Duration  <span class="order-container" data-order="duration"><a href="#" class="filter-up" data-orderby="DESC" data-nonce="<?php echo $nonce ?>"></a><a href="#" class="filter-down" data-orderby="ASC" data-nonce="<?php echo $nonce ?>"></a></span></th>
											<th>Expiry  <span class="order-container" data-order="expiry"><a href="#" class="filter-up" data-orderby="DESC" data-nonce="<?php echo $nonce ?>"></a><a href="#" class="filter-down" data-orderby="ASC" data-nonce="<?php echo $nonce ?>"></a></span></th>
											<th>Released  <span class="order-container" data-order="released"><a href="#" class="filter-up" data-orderby="DESC" data-nonce="<?php echo $nonce ?>"></a><a href="#" class="filter-down" data-orderby="ASC" data-nonce="<?php echo $nonce ?>"></a></span></th>
											<th>CEUs  <span class="order-container" data-order="ceu"><a href="#" class="filter-up" data-orderby="DESC" data-nonce="<?php echo $nonce ?>"></a><a href="#" class="filter-down" data-orderby="ASC" data-nonce="<?php echo $nonce ?>"></a></span></th>-->
											<th>Course Title <span class="order-container" data-order="title"> <a href="#" class="filter-up" data-orderby="DESC" data-nonce="<?php echo $nonce ?>"></a><a href="#" class="filter-down" data-orderby="ASC" data-nonce="<?php echo $nonce ?>"></a> </span> </th>
											<th>Type <span class="order-container" data-order="taxonomy"><a href="#" class="filter-up" data-orderby="DESC" data-nonce="<?php echo $nonce ?>"></a><a href="#" class="filter-down" data-orderby="ASC" data-nonce="<?php echo $nonce ?>"></a></span></th>
											<th>Date  <span class="order-container" data-order="date"><a href="#" class="filter-up" data-orderby="DESC" data-nonce="<?php echo $nonce ?>"></a><a href="#" class="filter-down" data-orderby="ASC" data-nonce="<?php echo $nonce ?>"></a></span></th>
											<th>Location  <span class="order-container" data-order="location"><a href="#" class="filter-up" data-orderby="DESC" data-nonce="<?php echo $nonce ?>"></a><a href="#" class="filter-down" data-orderby="ASC" data-nonce="<?php echo $nonce ?>"></a></span></th>
											<th>Level <span class="order-container" data-order="level"><a href="#" class="filter-up" data-orderby="DESC" data-nonce="<?php echo $nonce ?>"></a><a href="#" class="filter-down" data-orderby="ASC" data-nonce"<?php echo $nonce ?>"></a></span></th>
											<th>Registration  <span class="order-container" data-order="registration"><a href="#" class="filter-up" data-orderby="DESC" data-nonce="<?php echo $nonce ?>"></a><a href="#" class="filter-down" data-orderby="ASC" data-nonce="<?php echo $nonce ?>"></a></span></th>
											<th>Deadline <span class="order-container" data-order="deadline"><a href="#" class="filter-up" data-orderby="DESC" data-nonce="<?php echo $nonce ?>"></a><a href="#" class="filter-down" data-orderby="ASC" data-nonce="<?php echo $nonce ?>"></a></span></th>
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
											
											
											<td><?php the_field('ceus'); ?></td>
										
										</tr>					
	
									
									<?php endwhile; ?>		
	
									</tbody>
	
								</table>
	
							
						<?php else : ?>
						
							<article id="post-not-found">
							   <h3>There are currently no courses of that type. </h3>
							</article>
							
							<?php endif; ?>

							</section>
						</div>
				
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
		
		$('.order-container').on('click', 'a', function(e){
			e.preventDefault(); 
			var nonce = jQuery(this).attr("data-nonce");
			var order = jQuery(this).data('orderby'); 
			var filter_container = $('.my-filters');
			var tax_names = [];
 			var taxonomies = filter_container.find("[data-taxonomy]"); 
			var order_type = jQuery(this).parent().attr('data-order'); 	

			taxonomies.each(function(){
				var key = $(this).data('taxonomy');
				var value = $(this).data('slug'); 
				tax_names.push({'tax': key, 'term': value}); 
			});
				
			
			$.ajax({
	            type: 'POST',
	            url: '<?php echo admin_url( 'admin-ajax.php' ) ?>',
	            data: {"action" : "re-order", 'nonce': nonce, 'taxonomies': tax_names, 'orderby': order_type, 'order': order  },
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