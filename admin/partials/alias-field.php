<?php
    if (!defined('ABSPATH')) exit; // Exit if accessed directly

    $options = get_option( 'rebrandly_aliasing_options' );
    echo "
        <input 
            id='rebrandly_aliasing_plugin_setting_alias'
            name='rebrandly_aliasing_options[alias]'
            class='rb-aliasing-alias'
            placeholder='e.g. 46e8ac9583d7e0c513485aef06045733.rebrandly.cc'
            type='text'
            value='" . esc_attr( $options['alias'] ) . "' 
        />";
?>