 <?php /* 

partial file, used with content-single-course.php 

DESCRIPTION: This contains all the public custom fields for the course.

*/ ?>


<?php 

	// fields 
	$start_date = DateTime::createFromFormat('Ymd', get_field('start_date'));
	$instructors = get_field('instructors') ; 
	$end_date = DateTime::createFromFormat('Ymd', get_field('end_date'));
	$duration = get_field('duration') ; 
	$course_number = get_field('course_number') ; 
	$course_key = get_field('course_key'); 
	$course_days = get_field('course_days'); 
	$course_semester = get_field('course_semester');

	if($start_date):?>
		<section class="course-dates">
			<h2>Course Dates</h2>
			<p>
				<?php if($start_date): ?>
					<span class="course-dates-startlabel">Start date:</span> <?php echo $start_date->format('F j, Y'); ?> 
				<?php else: ?> 
					<span class="course-dates-semester">
						<?php the_field('course_semester'); ?> 
					</span>
				<?php endif;?>
			</p>

		<!--
		<?php if($end_date): ?>
			<p>End date: <?php echo $end_date->format('F j, Y'); ?></p>
		<?php endif; ?>
		-->
		<?php if($duration): ?>
			<p><?php echo $duration;  ?></p>
		<?php endif; ?>

		</section>
	<?php endif; ?>
<?php  do_action( 'sensei_course_single_meta' ); ?>
			<?php
			$post_object = get_field('location');
			if($post_object):
					$map_url = 'http://maps.apple.com/maps?z=12&amp;t=m&amp;q=loc:'.get_field("map", $post_object->ID); ?>
					<h2>Location</h2>
					<p><?php echo the_field("address", $post_object->ID); ?></p>
					<a target='_BLANK' title='Open map in new window' href='<?php echo $map_url; ?>'>
							(view map)
					</a>
			<?php	endif; ?>	
		<?php 
		if($instructors): ?>
			<section class="course-instructors">
			<h2>Course Instructors</h2>
			<?php
			foreach ($instructors as $post) : 
				setup_postdata($post); ?>
				<p class="instructor-name"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></p>
			<?php 
			endforeach; wp_reset_postdata(); ?>
			</section>
		
		<?php endif; // if instructors ?>






<!--div class="courseMeta">
	<div class="courseMeta-item courseMeta-startDate">
		<span class="courseMeta-title">Start Date</span>
		<span class="courseMeta-data">Nov-01-2013</span>
	</div>
	<div class="courseMeta-item courseMeta-endDate">
		<span class="courseMeta-title">End Date</span>
		<span class="courseMeta-data">Nov-03-2013</span>
	</div>
	<div class="courseMeta-item courseMeta-days">
		<span class="courseMeta-title">Days</span>
		<span class="courseMeta-data">Sa,Su,M</span>
	</div>
	<div class="courseMeta-item courseMeta-duration">
		<span class="courseMeta-title">Duration</span>
		<span class="courseMeta-data">3 days</span>
	</div>
</div -->