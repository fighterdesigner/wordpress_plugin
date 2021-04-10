<?php

/*
* @package: PicturesGallery
*/

namespace Inc\Base;

class Gallery_pictures_gallery
{
    
        public $gallery_name;
        public $gallery_ids;
    
        public function __construct($gallery_name, $gallery_ids) {
            
            $this->gallery_name = $gallery_name;
            $this->gallery_ids = $gallery_ids;
            
        }
    
        public function register_pictures_gallery() {
            add_shortcode($this->gallery_name, array($this,'pictures_gallery_shortcode'));
        }
    
    
        public function pictures_gallery_shortcode( $attr ) {
            
        $post = get_post();
                
            
        /**
         * Filters the default gallery shortcode output.
         *
         * If the filtered output isn't empty, it will be used instead of generating
         * the default gallery template.
         *
         * @since 2.5.0
         * @since 4.2.0 The `$instance` parameter was added.
         *
         * @see gallery_shortcode()
         *
         * @param string $output   The gallery output. Default empty.
         * @param array  $attr     Attributes of the gallery shortcode.
         * @param int    $instance Unique numeric ID of this gallery shortcode instance.
         */
        $output = apply_filters( 'post_gallery', '', $attr );

        if ( ! empty( $output ) ) {
            return $output;
        }

        $html5 = current_theme_supports( 'html5', 'gallery' );
            
        $atts  = shortcode_atts(
            array(
                'order'      => 'ASC',
                'orderby'    => 'menu_order ID',
                'id'         => $post ? $post->ID : 0,
                'include'    => $this->gallery_ids,
            ),
            $attr,
            'gallery'
        );

        $id = (int) $atts['id'];

        if ( ! empty( $atts['include'] ) ) {
            $_attachments = get_posts(
                array(
                    'include'        => $atts['include'],
                    'post_status'    => 'inherit',
                    'post_type'      => 'attachment',
                    'post_mime_type' => 'image',
                    'order'          => $atts['order'],
                    'orderby'        => $atts['orderby'],
                )
            );

            $attachments = array();
            foreach ( $_attachments as $key => $val ) {
                $attachments[ $val->ID ] = $_attachments[ $key ];
            }
            
        } elseif ( ! empty( $atts['exclude'] ) ) {
            $attachments = get_children(
                array(
                    'post_parent'    => $id,
                    'exclude'        => $atts['exclude'],
                    'post_status'    => 'inherit',
                    'post_type'      => 'attachment',
                    'post_mime_type' => 'image',
                    'order'          => $atts['order'],
                    'orderby'        => $atts['orderby'],
                )
            );
        } else {
            $attachments = get_children(
                array(
                    'post_parent'    => $id,
                    'post_status'    => 'inherit',
                    'post_type'      => 'attachment',
                    'post_mime_type' => 'image',
                    'order'          => $atts['order'],
                    'orderby'        => $atts['orderby'],
                )
            );
        }

        if ( empty( $attachments ) ) {
            return '';
        }

            
            $output .= "
            <style type='text/css'>
                .swiper-container {
                    width: 100%;
                    height: 400px
                }
                .swiper-slide {
                    background-position: center;
                    background-size: cover
                }
                
                @media screen and (max-width: 599px) {
                
                .swiper-container {
                    height: 250px
                }
                .swiper-button-next, .swiper-button-prev {
                    display: none;
                }
                
                
                }
            </style>\n\t\t";
            
            $output .= "<div class='swiper-container gallery-{$this->gallery_name}'><div class='swiper-wrapper'>";



        foreach ( $attachments as $id => $attachment ) {

            
            $image_output = wp_get_attachment_image_url($id,'');


            $output .= "
                <div class='swiper-slide' style='background-image: url($image_output)'>
                </div>";

        }

            
        $output .= "
            </div>\n";    
            
        $output .= "<div class='swiper-button-next'></div>
    <div class='swiper-button-prev'></div>\n";    
            
        $output .= "
            </div>\n";
            
        $output .= "
            
            <script type='application/javascript' defer>
            
                var swiper_{$this->gallery_name} = new Swiper('.gallery-{$this->gallery_name}', {
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                      },
                    mousewheel: true,
                    keyboard: true,
                    loop: true,
                });
            
            </script>
        
        
        ";    

        return $output;
    }
    
    
    
    
}