<?php
/*
*@package GridGalleryPlugin
*/

if( !defined('WP_UNINSTALL_PLUGIN') ) {
    die;
}
/*This is the file that tregired when we uninstall the plgin, it clears all the data base related informations that this plugin creates*/

$books = get_posts(array( 'post_type'=>'book', 'numberposts'=> -1 ) );

foreach($books as $book) {
    wp_delete_post( $book->ID, true );
}