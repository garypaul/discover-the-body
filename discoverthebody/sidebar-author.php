				<div id="sidebar-author" class="sidebar twelve columns" role="complementary">
				
						<?php if ( is_active_sidebar( 'author' ) ) : ?>

							<?php dynamic_sidebar( 'author' ); ?>

						<?php else : ?>

							<!-- This content shows up if there are no widgets defined in the backend. -->
							
							<!-- div class="alert-box">Please activate some Widgets.</div -->

						<?php endif; ?>

				</div>
