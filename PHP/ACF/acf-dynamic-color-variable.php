<?php
/* Advanced Custom Fields - Dynamic Color Variable 
 * Adds an inline <style> to the front-end with a dynamic
 * color value based on a pre-selected Color Picker field using a CSS3 variable.
 * 
 * You can then, apply this CSS variable to any color value by using the var(--acf-{$field_name}-color) value.
 * 
 * @author: Nicholas Zein
 * @link: https://github.com/zeinnicholas/My-Code-Snippets-Collection
 *
 * @version: 	1.0.0
 * @published: 	2020-10-17
 * @updated: 	2020-10-18
 *
 * @params: $is_options_page = false;   $color_field = get_field_object( '$field_name' );    $default_color = '#000';     
 *          $dynamic_color = $color_field['value'];      $final_color = $default_color || $dynamic_color;
 *          --acf-{$css_var}-color: $final_color;
 * 
 * @note: With this approach you won't need to define a default color within the field settings.
 *        This helps avoiding conflicts. We will define the color here as the $default_color
 *        in case a color isn't defined.
 *
 * @reference: https://www.advancedcustomfields.com/resources/color-picker/
 * @reference: https://www.advancedcustomfields.com/resources/get_field_object/
 * @reference: https://www.advancedcustomfields.com/resources/get-values-from-an-options-page/
 * @reference: https://www.w3schools.com/css/css3_variables.asp
 * @reference: https://codex.wordpress.org/Conditional_Tags
*/
function codesnippets_acf_dynamic_color_variable() {

    /* You can edit the following values to whatever you want */

    // If you're using a field from an Options Page, set the value below to true. If not, leave it as false.
    $is_options_page = false;

    // Insert the field name as a variable. Replace 'my_color_picker' with the name of your field.
    $field_name = 'my_color_picker';

    // Set a default color in HEX format. Later we will replace it with a dynamic color if one is found.
    $default_color = '#000';


    /* That's all, stop editing! Happy publishing. ;) */

    // Here we set a variable for the final color
    $final_color = $default_color;

    // Then we set an easy to type CSS variable name based on the field name. 
    // This replaces any underscores (_) with dashes (-)
    $css_var = str_replace('_', '-', $field_name );

    // Check if ACF is active. If it does, then apply these settings.
    // If it doesn't the color will fall back to the $default_color
    if ( class_exists( 'ACF' ) ) {

        // Check if you're using a field from an options page or not
        if ( $is_options_page ) {
            // Get the field object from the options page so we can use its returned array objects
            $color_field = get_field_object( $field_name, 'option' );
        } else {
            // Get the field object so we can use its returned array objects
            $color_field = get_field_object( $field_name );
        }
    
        // Get the field value.
        $dynamic_color = $color_field['value'];
    
        // We check if the $dynamic_color exists and change the value of the $final_color;
        if ( $dynamic_color != '' ) {
            $final_color = $dynamic_color;
        }
    }

    /* Alright, I lied, you can edit the code below ^^' */

    /* To avoid this code to output everywhere, you can use conditionals here. 
     * Just uncomment the lines 82 and 91 and apply your conditional tags.
     * For a list of conditional tags and how to use them see: https://codex.wordpress.org/Conditional_Tags
     */

    // if ( is_singular( $post_types = 'post' ) ) { // <!-- Uncomment if you want to set conditionals -->

        // Now we are ready to output our CSS. We are going to use CSS variables to make it easy to modify the CSS on the frontend.
        echo '<style id="acf-' . $css_var . '-css">
                :root {
                    --acf-' . $css_var . '-color: ' . $final_color . ';
                }
              </style>';

    // } // <!-- Uncomment if you want to set conditionals -->

}
add_action( 'wp_head', 'codesnippets_acf_dynamic_color_variable', 10 );