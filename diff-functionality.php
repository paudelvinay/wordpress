<?php 
/* shortcode to show  different special character/image as per the role
 * on 27th July 2020
*/
add_shortcode('show_special_char','show_special_char');

function show_special_char($atts){
  if( ! is_user_logged_in() ) return '';
    $user = wp_get_current_user();
    $atts = shortcode_atts(
        array(
            'text' => '',
            'role' => '', //comma separated for multiple role
            'image' => '',
        ), $atts, 'special_char' );

    $roles = explode(',', $atts["role"]);
    $content= '';
    //if multiple roles are passed 
    if ( is_array($roles) && !empty(array_intersect($roles, (array)$user->roles) ) ) {

            $content = !empty($atts['text']) ? $atts['text'] : '';
            $content .= !empty($atts['image']) ? '<img src="'.$atts['image'].'">' :'';
    } else if( $atts["role"]!="" && in_array($atts["role"], (array)$user->roles) ) {
            $content = !empty($atts['text'])?$atts['text']:'';
            $content .= !empty($atts['image']) ? '<img src="'.$atts['image'].'">' :'';         
    }
  return $content;
}
