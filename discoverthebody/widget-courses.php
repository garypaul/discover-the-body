<?php 
$args = array(
	'post_type' => 'course', 
	'posts_per_page' => -1
	
); 
$courses = new WP_Query($args); 

if ($courses->have_posts()) : ?>
	<table class="courses">
	
		<tr>
			
			<th>Course Title</th>
			<th>Type</th>
			<th>Duration</th>
			<th>Expiry</th>
			<th>Released</th>
			<th><span class="cc">Close Caption</span></th>
			<th>CEUs</th>
			
		</tr>
	
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
			
			<td><?php if(get_field('close_captioned')) { echo "<span class='close-captioned'>close captioned</span>"; }?></td>
			
			<td><?php the_field('ceus'); ?></td>
		
		</tr>					
	
	<?php endwhile; ?>		
		
	</table>

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
