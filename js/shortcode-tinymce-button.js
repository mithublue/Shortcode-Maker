;(function( $ ) {
    tinymce.PluginManager.add('pushortcodes', function( editor )
    {
        var shortcodeValues = [];
        jQuery.each(shortcodes_button, function(i)
        {
            shortcodeValues.push({text: shortcodes_button[i], value:i});
        });

        editor.addButton('pushortcodes', {
            //type: 'listbox',
            text: 'Shortcodes',
            onclick : function(e){
                $.post(
                    ajaxurl,
                    {
                        action : 'show_shortcodes',
                        shortcode_array :  shortcode_array
                    },
                    function(data){
                        $('#wpwrap').append(data);
                    }
                )
            },
            values: shortcodeValues
        });
    });

    $(document).on( 'click', '#sm-modal .close', function(){
        $(this).parent().parent().remove();
    }).on( 'click', '.sm_shortcode_list li',function(){
        var selector = $(this);
        console.log('['+selector.text()+'][/'+selector.text()+']');
        tinyMCE.activeEditor.selection.setContent('['+selector.text().trim()+'][/'+selector.text().trim()+']' );
        $('#sm-modal').remove();
    });

}(jQuery));
