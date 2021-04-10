<?php

/*
* @package: PicturesGallery
*/

namespace Inc\Base;

class Activate_pictures_gallery {
    
    public static function register_pictures_gallery() {
        
        global $jal_db_version;
        $jal_db_version = '1.0';
        
        register_activation_hook( PICSGALLERY_FILE_PATH, array(self::class, 'pictures_gallery_table_install') );
        
    }
            

    public static function pictures_gallery_table_install() {
        global $wpdb;
        global $jal_db_version;

        $table_name = $wpdb->prefix . 'pictures_gallery_plugin';

        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            gallery_name text NOT NULL,
            gallery_ids text NOT NULL,
            PRIMARY KEY  (id)
        ) $charset_collate;";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );

        add_option( 'jal_db_version', $jal_db_version );
        
        flush_rewrite_rules();
    }
     
    
}
