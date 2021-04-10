<?php

/*
* @package: PicturesGallery
*/

/*

    Plugin Name: Pictures Gallery
    Plugin URI: https://github.com/fighterdesigner/wordpress_plugin
    Description: this plugin would help you create multiple galleries, and you could put them in any place in your theme.
    Version: 1.0.0
    Author: Fighter Designer
    Author URI: https://www.fighterdesigner.com
    License: GPLv2 or later
    Text Domain: pictures-gallery

*/

/*

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.

*/

defined('ABSPATH') or die("You can't access this file");

if( file_exists(dirname(__FILE__) . '/vendor/autoload.php') ) {
    require_once dirname(__FILE__) . '/vendor/autoload.php';
}

global $wpdb;

define('PICSGALLERY_PATH', plugin_dir_path(__FILE__));
define('PICSGALLERY_URL', plugin_dir_url(__FILE__));
define('PICSGALLERY_FILE_PATH', __FILE__);


if( class_exists( 'Inc\\Init' ) ) {
    Inc\Init::register_services_pictures_gallery();
}


use Inc\Base\Gallery_pictures_gallery; 

$table_name = $wpdb->prefix . 'pictures_gallery_plugin';

$mygallerys = $wpdb->get_results( "SELECT * FROM $table_name");

    foreach($mygallerys as $mygallery) {
        
        $gridgallery = 'picturesgallery'.$mygallery->id;
        
        $gridgallery = new Gallery_pictures_gallery($mygallery->gallery_name, $mygallery->gallery_ids);
        $gridgallery->register_pictures_gallery();
        
    }
