jQuery(function(){
    // safeti aleat
    jQuery(window).on('beforeunload',function(){
        return('Did you save it?');
    });
    // if this is Submit, escape alert
    jQuery('form').on('submit',function(){
        jQuery(window).off('beforeunload');
    });
});

jQuery(document).ready(function($){
    var custom_uploader;
// var media_id = new Array(2);
// media_id[0] = "head_logo";
// media_id[1] = "foot_logo";

//for (i = 0; i < media_id.length; i++) {

        // var media_btn = '#media_' + media_id[i];
        // var media_target = '#' + media_id[i];
        jQuery('.media_btn').click(function(e) {
            media_target = jQuery(this).attr('id').replace(/media_/g,'#');
            e.preventDefault();
            if (custom_uploader) {
                custom_uploader.open();
                return;
            }
            custom_uploader = wp.media({
                title: 'Choose Image',
                library: {
                    type: 'image'
                },
                button: {
                    text: 'Choose Image'
                },
                multiple: false,
            });
            custom_uploader.on('select', function() {
                var images = custom_uploader.state().get('selection');
                images.each(function(file){
                    //$('#head_logo').append('<img src="'+file.toJSON().url+'" />');
                    jQuery(media_target).attr('value', file.toJSON().url );
                });
            });
            custom_uploader.open();
        });
//}

});