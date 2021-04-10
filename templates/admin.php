<?php 

    require_once PICSGALLERY_PATH . '/vendor/autoload.php';

    use Inc\Base\Gallery_pictures_gallery;

    global $wpdb;
    $table_name = $wpdb->prefix . 'pictures_gallery_plugin';

    $message;



    // Verify if the nama aalreday exist
    function validate_name() {
        
        global $wpdb;
        $table_name = $wpdb->prefix . 'pictures_gallery_plugin';
        
        $gallery_name = esc_attr($_POST['name_holder']); 
        
        $results = $wpdb->get_results( "SELECT * FROM $table_name WHERE gallery_name = '$gallery_name'");
        
        if(count($results) == 0 ) {
            
            return true;
            
        }else {
            
            return false;
        }
        
    }


    // Insert data into the data base
    function insert_data() {
        
    if(isset($_POST['submit'])) {

        $gallery_name = esc_attr($_POST['name_holder']);
        $gallery_ids = esc_attr($_POST['ids_holder']);
        
        global $wpdb;
        $table_name = $wpdb->prefix . 'pictures_gallery_plugin';
        global $message;
        
        if(!validate_name()) {
            
            $message = "<div class='alert alert-danger position-fixed alert-dismissible fade show' style='bottom: 0; right: 15px; z-index: 999'>The name already exist<i class='fas fa-times close' data-dismiss='alert' aria-label='close'></i></div>";
            
            return;
            
        }
        
        if(empty($gallery_ids)) {
            
            $message = "<div class='alert alert-danger position-fixed alert-dismissible fade show' style='bottom: 0; right: 15px; z-index: 999'>Please select at least one image<i class='fas fa-times close' data-dismiss='alert' aria-label='close'></i></div>";
            
            return;
            
            
        }
        
           $wpdb->insert( 
            $table_name, 
            array( 
                'gallery_name' => $gallery_name, 
                'gallery_ids' => $gallery_ids, 
            ) 
        );
        
        $message = "<div class='alert alert-success position-fixed alert-dismissible fade show' style='bottom: 0; right: 15px; z-index: 999'>Gallery was created<i class='fas fa-times close' data-dismiss='alert' aria-label='close'></i></div>";
        
    }
        
    }
    insert_data();
    // End of Inserting into database


    // Delete data from the data base

    if(isset($_POST['delete_btn'])) {
        
        $gallery_id = esc_attr($_POST['gallery_id']);
        
        $wpdb->delete( $table_name, array( 'id' => $gallery_id ) );
        
        
    }


    $mygallerys = $wpdb->get_results( "SELECT * FROM $table_name");

    foreach($mygallerys as $mygallery) {
        
        $gridgallery = 'picturesgallery'.$mygallery->id;
        
        $gridgallery = new Gallery_pictures_gallery($mygallery->gallery_name, $mygallery->gallery_ids);
        $gridgallery->register_pictures_gallery();
        
    }


?>

<div class="container">

<h1 class="mt-3">Pictures Gallery Plugin</h1>

<?php
    
    global $message;
    echo $message;
    
?>

<form class="col-12 col-md-7 my-5" method="post">
   
    <div class="form-group">
    <label for="input_field_text">Gallery name:</label>
    <input class="form-control" name="name_holder" type="text" id="input_field_text" value="" placeholder="Gallery name..." required autocomplete="off">
    <div class="valid-feedback">
        Looks good!
    </div>
    <div class="invalid-feedback">
        The name should be only [a-z], [A-Z], [0-9], "_".
      </div>
    </div>
    
    <div class="form-group">
    <input id="ids_holder" name="ids_holder" type="hidden">
    <label for="select_images">Gallery images:</label>
    <button class="button w-100 py-1" id="select_images">Upload pictures</button>
    </div>

    <input id="submit_btn" class="btn btn-dark w-100 py-2 mt-2" type="submit" name="submit" value="Create">

</form>

<div id="success-alert" class="alert alert-success fade position-fixed" style="bottom: 0; right: 15px;z-index: 99" role="alert">
    The code has been <strong>copied</strong>
</div>

<?php

if(empty($mygallerys)) {
    
    ?>
    
    <div class="alert alert-warning col-12 col-md-8 text-center mx-auto" role="alert">
      You don't have any gallerys yet ! create some
    </div>
    
    <?php
    
}else {
    
foreach($mygallerys as $mygallery) {
    
?>
<div class="accordion" id="accordionExample">
                                          
                      <div class="border my-3">
                       
                        <div class="card-header d-flex flex-row align-items-center justify-content-between bg-white border-0" id="headingOne">
                         
                          <div type="button" data-toggle="collapse" data-target="#collapseOne<?php echo $mygallery->id; ?>" aria-expanded="true" aria-controls="collapseOne" class="mb-0 h5 text-muted">
                           <?php echo $mygallery->gallery_name; ?>
                              <i class="fas fa-angle-down ml-2 text-dark"></i>
                          </div>
                          
                          <form method="post">
                             <input name="gallery_id" type="hidden" value="<?php echo $mygallery->id; ?>">
                              <button class="bg-transparent border-0" name="delete_btn" type="submit"><i class="fas fa-trash-alt text-danger"></i></button>
                          </form>
                          
                        </div>

                        <div id="collapseOne<?php echo $mygallery->id; ?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                          <div class="card-body border-top mx-3">
                          <div class="row my-3">
                             
                              <ul class="list-group col-12 col-md-6">
                              <li class="list-group-item bg-dark text-light mb-0" aria-current="true">For developers</li>
                              <li class="list-group-item">
                                 
                                  <code id="code_for_dev_<?php echo $mygallery->gallery_name;?>" class="text-info bg-dark">&lt;&#63;php echo do_shortcode("[<?php echo $mygallery->gallery_name; ?>]"); &#63;&gt;</code>
                                  
                                  <button onclick="CopyCodeText(event)" class="button col-12 col-md-8 d-block mx-auto mt-3">Copy</button>
                                  
                              </li>
                              </ul>
                              
                              <ul class="list-group col-12 col-md-6">
                              <li class="list-group-item bg-dark text-light mb-0" aria-current="true">Past this code in a post or a page</li>
                              
                              <li class="list-group-item">
                                  <code id="code_<?php echo $mygallery->gallery_name;?>" class="text-info bg-dark">[<?php echo $mygallery->gallery_name; ?>]</code>
                                  
                                  <button onclick="CopyCodeText(event)" class="button col-12 col-md-8 d-block mx-auto mt-3">Copy</button>
                                  
                              </li>
                              </ul>
                              
                          </div>
                           <div class="w-100">
                                <?php echo do_shortcode("[$mygallery->gallery_name]"); ?>
                            </div>
                          </div>
                        </div>
                        
                      </div>
</div>    
 
    
<?php
}
}
?>
</div>