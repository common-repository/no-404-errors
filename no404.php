<?php
/*
Plugin Name: No 404 Errors
Plugin URI: http://bramernic.com/no404
Description: Prevent garbage being displayed if a shared hosting service intercepts 404 errors in an unfriendly way.
Version: 0.1.1
Author: Mike Whitaker
Author URI: http://bramernic.com
*/

/*  Copyright 2010 Mike Whitaker <mike@bramernic.com>

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


/**
 * Main action handler
 *
 * @package No404
 * @since 0.1
 *
 * Trap 404 errors and redirect them to a specific page instead.
 */
function no404_redirect() {
	if ( !is_404() )
		return;
	
	wp_redirect( get_permalink( get_option('new404_page_no') ), 301 );
	exit();
}

/**
 * Filter to keep the inbuilt 404 handlers at bay
 *
 * @package No404
 * @since 0.1
 *
 */
function no404_redirect_canonical_filter($redirect, $request) {
	
	if ( is_404() ) {
		// 404s are our domain now - keep redirect_canonical out of it!
		return false;
	}
	
	// redirect_canonical is good to go
	return $redirect;
}


/**
 * Set up administration
 *
 * @package No404
 * @since 0.1
 */
function no404_setup_admin() {
	add_options_page( 'No 404 Errors', 'No 404 Errors', 5, __FILE__, 'no404_options_page' );
}

/**
 * Options page
 *
 * @package No404
 * @since 0.1
 */
function no404_options_page() {
	?>
	<div class="wrap">
	<h2>No 404 Errors</h2>
	
	<form method="post" action="options.php">
	<?php wp_nonce_field('update-options'); ?>
	
	<table class="form-table">
	
	<tr valign="top">
		<th scope="row"><?php _e('Page Number to redirect to:') ?></th>
		<td>
			<input name="new404_page_no" value="<?php echo htmlspecialchars(get_option('new404_page_no')); ?>" /><br />
		</td>
	</tr>
	
	</table>
	
	<input type="hidden" name="action" value="update" />
	<input type="hidden" name="page_options" value="new404_page_no" />
	
	<p class="submit">
	<input type="submit" name="Submit" value="<?php _e('Save Changes') ?>" />
	</p>
	
	</form>
	</div>
	<?php
}
// Set up plugin

add_action( 'template_redirect', 'no404_redirect' );
add_filter( 'redirect_canonical', 'no404_redirect_canonical_filter', 10, 2 );
add_action( 'admin_menu', 'no404_setup_admin' );
add_option( 'new404_page_no', '' );

?>
