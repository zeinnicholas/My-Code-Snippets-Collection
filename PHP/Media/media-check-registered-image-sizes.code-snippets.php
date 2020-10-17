<?php

/**
 * Media - Check Registered Image Sizes
 *
 * Do not leave this snippet active!
 * 
 * A simple snippet that checks for the currently registered image sizes and shows them in your dashboard as a one-time-only dismissible admin Notice.
 * 
 * This snippet helps you see all of the registered image sizes in your site, so you can further decide which image size to edit or remove, while also having the opportunity to see their registered name in case you need to use them somewhere else.
 */
/**
 * Get all the registered image sizes along with their dimensions and show them as an Admin Notice
 *
 * @author: Nicholas Zein
 * @link: https://github.com/zeinnicholas/My-Code-Snippets-Collection
 *
 * @version: 	1.0.0
 * @published: 	2020-10-16
 * @updated: 	2020-10-16
 *
 * @params: array( $sizes )
 *
 * @reference: https://developer.wordpress.org/reference/functions/get_intermediate_image_sizes/
 */
function codesnippets_check_registered_image_sizes() {
    $sizes = array();

    $get_intermediate_image_sizes = get_intermediate_image_sizes();
    $wp_additional_image_sizes = wp_get_additional_image_sizes();
 
	echo '<div class="notice notice-info is-dismissible">';
		echo '<h3>Currently Registered Image Sizes</h3>';
		echo '<ul class="codesnippets-image-sizes">';

			// Create the full array with sizes and crop info
			foreach( $get_intermediate_image_sizes as $_size ) {
				if ( in_array( $_size, array( 'thumbnail', 'medium', 'large' ) ) ) {
					$sizes[ $_size ]['width'] 	= get_option( $_size . '_size_w' );
					$sizes[ $_size ]['height'] 	= get_option( $_size . '_size_h' );
					$sizes[ $_size ]['crop'] 	= (bool) get_option( $_size . '_crop' );
				} elseif ( isset( $wp_additional_image_sizes[ $_size ] ) ) {
					$sizes[ $_size ] = array( 
						'width' 	=> $wp_additional_image_sizes[ $_size ]['width'],
						'height' 	=> $wp_additional_image_sizes[ $_size ]['height'],
						'crop' 		=> $wp_additional_image_sizes[ $_size ]['crop']
					);
				}
				echo '<li><strong>' . $_size . '</strong>';
				echo '<ul class="codesnippets-image-dimensions"><li>Width: <strong>' . $sizes[ $_size ]['width'] . '</strong></li>';
				echo '<li>Height: <strong>' . $sizes[ $_size ]['height'] . '</strong></li>';
				if ( $sizes[ $_size ]['crop'] == 1 ) {
					echo '<li>Crop: <strong>Cropped</strong></li></ul></li>';
				} else {
					echo '<li>Crop: <strong>Uncropped</strong></li></ul></li>';
				}
			}

		echo '</ul> <!-- End of Sizes -->';
	echo '</div> <!-- End of Notice -->';
}
add_action( 'admin_notices', 'codesnippets_check_registered_image_sizes' );

function codesnippets_check_registered_image_sizes_styles() {
	echo '<style>.codesnippets-image-sizes{line-height:1.2em}.codesnippets-image-sizes>li{margin-bottom:0.8em}.codesnippets-image-dimensions{font-size:10px;text-indent:1.2em;line-height:1.2em;}.codesnippets-image-dimensions li:not(last-child){margin-bottom:0}</style>';
}
add_action( 'admin_head', 'codesnippets_check_registered_image_sizes_styles' );
