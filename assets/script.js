jQuery(function($){
    
    var mediaGallery;
    
    $( '#select_images' ).click(function( event ) {
        event.preventDefault();

        if ( mediaGallery ) {
            mediaGallery.open();
            return;
        }

        // create new media frame
        // You have to create new frame every time to control the Library state as well as selected images
        mediaGallery = wp.media.frames.wp_media_frame = wp.media({
            multiple: 'add'
        });
        
        mediaGallery.open();
        
        
 mediaGallery.on('select', function() {
            
            var pictures = mediaGallery.state().get('selection').toJSON();
            var ids = '';
                        
            for(var i=0; i < pictures.length; i++) {
                                
                ids += pictures[i].id + ",";
                
            }
                             
            $('#ids_holder').val(ids);
            
                                                
        });        

    });

});



function CopyCodeText(event) {
    
    const success_alert = document.getElementById("success-alert");
    
    // get the id of the code element
    let code_id =  event.path[1].children[0].attributes[0].value;
        
    // select the code node
    let select_code = document.getElementById(code_id);
    
    // select the contet of the code elemnt    
    const selection = window.getSelection();
    const range = document.createRange();
    range.selectNodeContents(select_code);
    selection.removeAllRanges();
    selection.addRange(range);
    
    // launch the copy command to copy the selected content
    document.execCommand("copy");
    
    // remove the heighlight
    selection.removeAllRanges();
    
    //add the show class to the success alert
    success_alert.classList.add("show");
    
    
    // remove it after 2s
    setTimeout(function() {
        success_alert.classList.remove("show");
    }, 2000);
    
    
}

(function() {
    
    const button = document.getElementById("submit_btn");
    const input = document.getElementById("input_field_text");
    
    const regex = /\W/;
    
    input.addEventListener('keyup', () => {
        
    if(regex.test(input.value)) {
     
        input.classList.add('is-invalid');
        input.classList.remove('is-valid');
        
        button.disabled = true;
        
    }else {
        input.classList.add('is-valid');
        input.classList.remove('is-invalid');
        
        button.disabled = false;
    }    
        
        
    });
    
    
})();

