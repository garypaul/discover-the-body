<?php 
global $authorID;

$args = array(
	'post_type' => 'course', 
	'posts_per_page' => -1,
	'meta_query' => array(
		array(
			'key' => 'author',
			'value' => $authorID,
		)
	)
); 
$courses = new WP_Query($args); 

if ($courses->have_posts()) : ?>
		
	<table class="courses">
	
		<tr>
			
			<th>Course</th>
			<th>Start Date</th>
			<th>Location</th>
			<th>&nbsp;</th>
			
		</tr>
	
	<?php while ($courses->have_posts()) : $courses->the_post(); ?>
	
		<?php get_template_part( 'content', 'course_row' ); ?>					
							
	
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
