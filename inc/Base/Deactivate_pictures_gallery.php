<?php

/*
* @package: PicturesGalleryPlugin
*/

namespace Inc\Base;

class Deactivate_pictures_gallery {
    
    public static function register_pictures_gallery() {
    
         register_deactivation_hook( PICSGALLERY_FILE_PATH, array(self::class, 'deactivate_pictures_gallery') );
        
    }
    
    public static function deactivate_pictures_gallery() {
        
       flush_rewrite_rules();
        
    }
}