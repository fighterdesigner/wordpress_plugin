<?php

/*
*@package PicturesGallery
*/

namespace Inc\Base;

class Enqueue_pictures_gallery
{
    
    public static function register_pictures_gallery() {
        
        add_action('admin_enqueue_scripts', array(self::class, 'admin_enqueue_gallery'));
        add_action('wp_enqueue_scripts', array(self::class, 'wp_enqueue_gallery'));
        
    }
    
    public static function admin_enqueue_gallery($hook) {        
        
        if('toplevel_page_pictures_gallery' != $hook) {
            return;
        }
        
        wp_enqueue_style( 'pictures_gallery', PICSGALLERY_URL . 'assets/style.css');
        wp_enqueue_style( 'bootstrap', PICSGALLERY_URL . 'assets/bootstrap.min.css');
        wp_enqueue_style( 'swiper_framework', PICSGALLERY_URL . 'assets/swiper-bundle.min.css');
        wp_enqueue_style( 'all_fontawsome', PICSGALLERY_URL . 'assets/all.min.css');
        wp_enqueue_style( 'fontawsome', PICSGALLERY_URL . 'assets/font-awesome.min.css');
        
        wp_enqueue_media();
        
        wp_enqueue_script('pictures_gallery', PICSGALLERY_URL . 'assets/script.js', array(), '1.0.0', true);
        wp_enqueue_script( 'bootstrap', PICSGALLERY_URL . 'assets/bootstrap.bundle.min.js', array(), '', true);
        wp_enqueue_script( 'swiper_framework', PICSGALLERY_URL . 'assets/swiper-bundle.min.js', array(), '', false);
        
        }
        
        public static function wp_enqueue_gallery() {
        
        wp_enqueue_style( 'swiper_framework', PICSGALLERY_URL . 'assets/swiper-bundle.min.css');
        
        wp_enqueue_script( 'swiper_framework', PICSGALLERY_URL . 'assets/swiper-bundle.min.js', array(), '', false);
        
        }

    
}