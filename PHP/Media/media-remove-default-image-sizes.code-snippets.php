<?php

/**
 * Media - Remove Default Image Sizes
 *
 * A snippet that allows you to remove the default image sizes generated by WordPress, especially the medium_large, 1536x1536, and 2048x2048 sizes that can't be removed using other methods.
 */
/**
 * Remove Default Image Sizes
 * Uncomment (remove the '//' at the beginnig of each line) the sizes you want to resize.
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
 * @original_author: https://wordpress.stackexchange.com/users/26350/birgire
 * @reference: https://wordpress.stackexchange.com/posts/251810/revisions
 */
function codesnippets_remove_default_image_sizes( $sizes ) {
    return array_filter( $sizes, function( $val ) {
//        return 'thumbnail'      !== $val; // Filter out 'thumbnail'
//        return 'medium'         !== $val; // Filter out 'medium'
        return 'medium_large'   !== $val; // Filter out 'medium_large'
//        return 'large'          !== $val; // Filter out 'large'
        return '1536x1536'      !== $val; // Filter out '1536x1536'
        return '2048x2048'      !== $val; // Filter out '2048x2048'
    });
}
add_filter( 'intermediate_image_sizes', 'codesnippets_remove_default_image_sizes' );
