<?php

/**
 * Cleanup - Deregister Unused Taxonomies
 *
 * This snippet allows you to deregister unwanted or unused Taxonomies from your website in order to reduce database bloat.
 * 
 * This snippet doesn't remove any entries from your database. If you already have Terms under these taxonomies, they will be kept on your database.
 */
/**
 * Deregister Unused Taxonomies
 * Add to the line:24 the name of the image sizes that you DON'T want to remove, separated by commas
 * and wrapped by ''
 * 
 * @author: Nicholas Zein
 * @link: https://github.com/zeinnicholas/My-Code-Snippets-Collection
 *
 * @version: 	1.0.0
 * @published: 	2020-10-16
 * @updated: 	2020-10-16
 *
 * @params: $taxonomies as array( $taxonomy )
 * @examples: 'post_tag', 'product_tag'
 * 
 * @original_author: https://gist.github.com/joshuadavidnelson/
 * @reference: https://joshuadnelson.com/code/remove-default-wordpress-taxonomies/
 */
function codesnippets_deregister_unused_taxonomies() { 
    global $wp_taxonomies;
    $taxonomies = array( 'post_tag' );
    foreach( $taxonomies as $taxonomy ) {
        if ( taxonomy_exists( $taxonomy ) )
            unset( $wp_taxonomies[$taxonomy] );
    }
}
add_action( 'init', 'codesnippets_deregister_unused_taxonomies');
