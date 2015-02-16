<?php
/*
If you would like to edit this file, copy it to your current theme's directory and edit it there.
Theme My Login will always look in your theme's directory first, before using this default template.
*/
?>
<div class="login profile" id="theme-my-login<?php $template->the_instance(); ?>">
	<?php $template->the_action_template_message( 'profile' ); ?>
	<?php $template->the_errors(); ?>
	<form id="your-profile" action="<?php $template->the_action_url( 'profile' ); ?>" method="post">
		<?php wp_nonce_field( 'update-user_' . $current_user->ID ); ?>
		<p>
			<input type="hidden" name="from" value="profile" />
			<input type="hidden" name="checkuser_id" value="<?php echo $current_user->ID; ?>" />
		</p>

		<?php if ( has_action( 'personal_options' ) ) : ?>

		<h3><?php _e( 'Personal Options' ); ?></h3>

		<table class="form-table">
		<?php do_action( 'personal_options', $profileuser ); ?>
		</table>

		<?php endif; ?>

		<?php do_action( 'profile_personal_options', $profileuser ); ?>

		<div class="row">
			<div class="twelve columns">
			
				<div class="profile alert alert-box status">
					<p>Your profile has not been completed yet. Please enter your name and pharmacy number to complete your profile.</p>
				</div>
				<div class="status profile alert-box success">
					<p>Thank you for completing your registration. <a href="<?php echo home_url(); ?>">View our courses</a></p>
				</div>
			
			</div>
			
			<div class="six columns">
							
				<h3><?php _e( 'Account Info' ); ?></h3>
		
				<table class="form-table">
				<tr>
					<th><label for="user_login"><?php _e( 'Username' ); ?></label></th>
					<td><input type="text" name="user_login" id="user_login" value="<?php echo esc_attr( $profileuser->user_login ); ?>" disabled="disabled" class="regular-text" /> <span class="description"><?php _e( 'Your username cannot be changed.', 'theme-my-login' ); ?></span></td>
				</tr>
		
				<tr>
					<th><label for="first_name"><?php _e( 'First Name' ); ?></label></th>
					<td><input type="text" name="first_name" id="first_name" value="<?php echo esc_attr( $profileuser->first_name ); ?>" class="regular-text" /></td>
				</tr>
		
				<tr>
					<th><label for="last_name"><?php _e( 'Last Name' ); ?></label></th>
					<td><input type="text" name="last_name" id="last_name" value="<?php echo esc_attr( $profileuser->last_name ); ?>" class="regular-text" /></td>
				</tr>
				
				<tr>
					<th><label for="email"><?php _e( 'E-mail' ); ?> <span class="description"><?php _e( '(required)' ); ?></span></label></th>
					<td><input type="text" name="email" id="email" value="<?php echo esc_attr( $profileuser->user_email ); ?>" class="regular-text" /><span class="description"><?php _e( 'Your email may not be correct if you logged in with Twitter, please be sure to update it.', 'theme-my-login' ); ?></span></td>
				</tr>
				
				<tr>
					<th><label for="social">Pharmacist Registration Number</label></th>
					 
					<td>						
						<input type="text" name="pharmacy" id="pharmacy" placeholder="Pharmacist Registration Number" value="<?php echo get_user_meta($current_user->ID, 'pharmacy', true); ?>"class="regular-text" />
					</td>
				</tr>
				
				</table>
			</div>
			
			<div class="six columns">	
				<h3><?php _e( 'Change Password' ); ?></h3>
		
				<table class="form-table">
		
				<?php
				$show_password_fields = apply_filters( 'show_password_fields', true, $profileuser );
				if ( $show_password_fields ) :
				?>
				<tr id="password">
					<th><label for="pass1"><?php _e( 'New Password' ); ?></label></th>
					<td><input type="password" name="pass1" id="pass1" size="16" value="" autocomplete="off" /> <span class="description"><?php _e( 'If you would like to change the password type a new one. Otherwise leave this blank.' ); ?></span><br />
						<input type="password" name="pass2" id="pass2" size="16" value="" autocomplete="off" /> <span class="description"><?php _e( 'Type your new password again.' ); ?></span><br />
						<div id="pass-strength-result"><?php _e( 'Strength indicator', 'theme-my-login' ); ?></div>
						<p class="description indicator-hint"><?php _e( 'Hint: The password should be at least seven characters long. To make it stronger, use upper and lower case letters, numbers and symbols like ! " ? $ % ^ &amp; ).' ); ?></p>
					</td>
				</tr>
				<?php endif; ?>
				</table>
			</div>
		</div>
		<?php do_action( 'show_user_profile', $profileuser ); ?>

			<input type="hidden" name="action" value="profile" />
			<input type="hidden" name="instance" value="<?php $template->the_instance(); ?>" />
			<input type="hidden" name="user_id" id="user_id" value="<?php echo esc_attr( $current_user->ID ); ?>" />
			<input type="submit" class="button-primary" value="<?php esc_attr_e( 'Update Profile' ); ?>" name="submit" />
			<a href="<?php echo home_url('/courses/') ?>" class="button" id="profile-courses" >View Courses</a>
	</form>
</div>
<script>
jQuery(function($){
	var first_name = $('#first_name');
	var last_name = $('#last_name');
	var pharm_input = jQuery('#pharmacy');
	var placeholder = pharm_input.attr('placeholder');
	if(pharm_input.val() == placeholder || first_name.val() == "" || last_name.val() == ""){
	   $('.profile.alert').slideToggle(); 
	}
<?php if($_GET['updated'] == true){ ?>
	
	if(pharm_input.val() != placeholder && first_name.val() != "" && last_name.val() != ""){
	   $('.profile.success').slideToggle(); 
	}
<?php } ?>

}); 
</script>
