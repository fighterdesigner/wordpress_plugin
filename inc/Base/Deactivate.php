<?php

/*
* @package: PicturesGalleryPlugin
*/

namespace Inc\Base;

class Deactivate {
    
    public static function register() {
    
         register_deactivation_hook( FILE_PATH, array(self::class, 'deactivate') );
        
    }
    
    public static function deactivate() {
        
       flush_rewrite_rules();
        
    }
}