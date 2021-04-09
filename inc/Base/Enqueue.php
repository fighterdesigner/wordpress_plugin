<?php

/*
*@package PicturesGalleryPlugin
*/

namespace Inc\Base;

class Enqueue
{
    
    public static function register() {
        
        add_action('admin_enqueue_scripts', array(self::class, 'admin_enqueue'));
        add_action('wp_enqueue_scripts', array(self::class, 'wp_enqueue'));
        
    }
    
    public static function admin_enqueue($hook) {        
        
        if('toplevel_page_pictures_gallery_plugin' != $hook) {
            return;
        }
        
        wp_enqueue_style( 'pictures_gallery', PLUGIN_URL . 'assets/style.css');
        wp_enqueue_style( 'bootstrap', PLUGIN_URL . 'assets/bootstrap.min.css');
        wp_enqueue_style( 'swiper_framework', PLUGIN_URL . 'assets/swiper-bundle.min.css');
        
        wp_enqueue_media();
        
        wp_enqueue_script('pictures_gallery', PLUGIN_URL . 'assets/script.js', array(), '1.0.0', true);
        wp_enqueue_script( 'bootstrap', PLUGIN_URL . 'assets/bootstrap.bundle.min.js', array(), '', true);
        wp_enqueue_script( 'fontawesome_js', 'https://kit.fontawesome.com/4bbb366569.js?ver=4.5.1');
        wp_enqueue_script( 'swiper_framework', PLUGIN_URL . 'assets/swiper-bundle.min.js', array(), '', false);
        
        }
        
        public static function wp_enqueue() {
        
        wp_enqueue_style( 'swiper_framework', PLUGIN_URL . 'assets/swiper-bundle.min.css');
        
        wp_enqueue_script( 'swiper_framework', PLUGIN_URL . 'assets/swiper-bundle.min.js', array(), '', false);
        
        }

    
}