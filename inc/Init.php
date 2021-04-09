<?php 

/*
* @package: PicturesGalleryPlugin
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
            Pages\Admin::class,
            Base\Enqueue::class,
            Base\Activate::class
        ];
        
    }
    
    
    
    
    /*
    * Loop through all the classes and initiate them
    */
    public static function register_services() {
        
            foreach( self::get_services() as $class ) {
                
                $service = self::instantiate( $class );
                
                if( method_exists( $service, 'register') ) {
                    $service->register();
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
