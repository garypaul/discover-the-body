<?php 
/**
 * The standard course row template used to display basic course information
 */
?>
<tr>

	<td><a class="courses-col-name" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></td>
	<td class="courses-col-dates">
	<?php 
		$start_date = get_field('start_date');
		if($start_date):
			$stamp = DateTime::createFromFormat('Ymd', $start_date);
			if($stamp):
				echo $stamp->format('M-j-Y'); 
			endif;
		else:
			the_field('course_semester');
		endif;
	?>

		<?php 
		$duration = get_field('duration');
		if($duration):
			echo '<div class="course-duration">';
			the_field('duration');
			echo '</div>';
		endif;
		?>

	</td>
	<td class="courses-col-location">
		
		<?php
			$post_object = get_field('location');
			if($post_object):
					$map_url = 'http://maps.apple.com/maps?z=12&amp;t=m&amp;q=loc:'.get_field("map", $post_object->ID); ?>
					<a target='_BLANK' title='Open map in new window' href='<?php echo $map_url; ?>'>
							<?php echo get_the_title($post_object->ID); ?>
					</a>
			<?php	endif; ?>
	</td>
	<td class="coursescol-register">
		<?php 
		if($start_date){
			$stamp = DateTime::createFromFormat('Ymd', $start_date);
			if($stamp && $stamp < new DateTime()) {
				echo '<span class="button-quiet" >Expired</a>';
			} 
			else { ?>
				 <a class="button" href="<?php the_permalink(); ?>">Register</a> 	
			<?php }
		}
		else{ // If there's no start_date yet, just assume it's in the future ?>
			<a class="button" href="<?php the_permalink(); ?>">Register</a>
		<?php } ?>
	</td>

	<!--td -->
		<?php 
		//echo forge_list_terms('course-types', 'name', $post_id ); 
		//$course_type = get_the_terms( $post_id, 'course-types' ); 
		/*foreach($course_type as $type ){
			$image = wp_get_attachment_image_src(get_field('logo', $type->taxonomy."_".$type->term_id), 'small-logo'); ?>				 
			<img src="<?php echo $image[0]; ?>">
	<?php 		
		} */

	?><!--/td -->
	

	<!--td><?php echo get_the_date('m/d/Y'); ?></td -->
	
	<!-- <td><?php if(get_field('close_captioned')) { echo "close captioned"; }?></td> -->
	
</tr>