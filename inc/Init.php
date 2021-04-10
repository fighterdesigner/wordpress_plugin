<?php 

/*
* @package: PicturesGallery
*/

namespace Inc;

final class Init
{
    
    
    /*
    * Store all the classes inside an array
    *@return of an array of classes
    */
    public static function get_services() {
        
        return [
            Pages\Admin_pictures_gallery::class,
            Base\Enqueue_pictures_gallery::class,
            Base\Activate_pictures_gallery::class
        ];
        
    }
    
    
    
    
    /*
    * Loop through all the classes and initiate them
    */
    public static function register_services_pictures_gallery() {
        
            foreach( self::get_services() as $class ) {
                
                $service = self::instantiate( $class );
                
                if( method_exists( $service, 'register_pictures_gallery') ) {
                    $service->register_pictures_gallery();
                }
                
            }
        }
    
    
    
    
    
    /*
    * Initiate the classes
    */
    public static function instantiate( $class ) {
        
        $service = new $class;
        return $service;
        
    }
    
    
}
