<?php

/*
* @package: PicturesGalleryPlugin
*/

namespace Inc\Pages;

 class Admin
 
 {
    
    
    public static function register() {
        
        add_action('admin_menu', array( self::class, 'add_admin_pages'));
        
    }
    
    
    
    
    
    public static function add_admin_pages() {
        
        add_menu_page('Pictures Gallery', 'Pictures Gallery', 'manage_options', 'pictures_gallery_plugin', array( self::class, 'admin_index'),'dashicons-images-alt
        ',25);
        
    }
    
    
    
    
    
    public static function admin_index() {
        
        require_once PLUGIN_PATH . 'templates/admin.php';
        
    }
    
    
    
}
