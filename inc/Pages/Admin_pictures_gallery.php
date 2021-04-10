<?php

/*
* @package: PicturesGallery
*/

namespace Inc\Pages;

 class Admin_pictures_gallery
 
 {
    
    
    public static function register_pictures_gallery() {
        
        add_action('admin_menu', array( self::class, 'add_admin_pages_pictures_gallery'));
        
    }
    
    
    
    
    
    public static function add_admin_pages_pictures_gallery() {
        
        add_menu_page('Pictures Gallery', 'Pictures Gallery', 'manage_options', 'pictures_gallery', array( self::class, 'admin_index_pictures_gallery'),'dashicons-images-alt
        ',25);
        
    }
    
    
    
    public static function admin_index_pictures_gallery() {
        
        require_once PICSGALLERY_PATH . 'templates/admin.php';
        
    }
    
    
    
}
