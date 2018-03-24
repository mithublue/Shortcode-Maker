(function ($) {
    $(document).ready(function () {
        /**
         * tabs
         */
        Vue.component('smps_simple_light_tabs_settings',{
            template : '#smps_simple_light_tabs_settings',
            data : function () {
                return {
                    component_name : 'tabs',
                    s : {
                        type : 'tabs',
                        tab_data : {}
                    },
                    tab_target : '',
                    content_target : '',
                    types : {
                        'tabs' : 'Tabs',
                        'pills' : 'Pills'
                    },
                    tab_template : {
                        'title' : 'Tab Label',
                        'content' : 'Tab content'
                    },
                    x_data: {}
                }
            },
            methods : {
                add_tab : function () {
                    Vue.set(this.s.tab_data,'tab_' + new Date().getTime(),JSON.parse(JSON.stringify(this.tab_template)));
                },
                insert_shortcode : function () {
                    sm_object.insert_shortcode( this.s, 'smps_sl_tabs' );
                },
                remove_tab : function ( tab_key ) {
                    Vue.delete( this.s.tab_data, tab_key );
                }
            },
            mounted : function () {
                sm_object.merge_settings(this,this.component_name);
                if ( smps_app.edit_target_item == this.component_name ) {
                    this.s = smps_app.edit_target_item_data;
                }
            }
        });

        /**
         * accordion
         */
        Vue.component('smps_simple_light_accordion_settings',{
            template : '#smps_simple_light_accordion_settings',
            data : function () {
                return {
                    component_name : 'accordion',
                    s : {
                        acc_data : {},
                    },
                    target_acc : '',
                    target_content : '',
                    acc_template : {
                        'title' : 'Item Label',
                        'content' : 'Item content'
                    },
                    x_data: {}
                }
            },
            methods : {
                add_item : function () {
                    Vue.set(this.s.acc_data,'acc_' + new Date().getTime(),JSON.parse(JSON.stringify(this.acc_template)));
                },
                insert_shortcode : function () {
                    sm_object.insert_shortcode( this.s, 'smps_sl_accordion' );
                },
                remove_accordion : function (key) {
                    Vue.delete(this.s.acc_data,key);
                }
            },
            mounted : function () {
                sm_object.merge_settings(this,this.component_name);
                if ( smps_app.edit_target_item == this.component_name ) {
                    this.s = smps_app.edit_target_item_data;
                }
            }
        });

        /**
         * table
         */
        Vue.component('smps_simple_light_table_settings',{
            template : '#smps_simple_light_table_settings',
            data : function () {
                return {
                    component_name : 'table',
                    s : {
                        table_data : {},
                        col_template : {},
                        col_tracker : []
                    },
                    x_data: {}
                }
            },
            methods : {
                add_col : function () {
                    var col_val = '';/*'td_' + new Date().getTime()*/
                    var col_key = 'td_' + new Date().getTime();
                    Vue.set(this.s.col_template, col_key, col_val );

                    for( var k in this.s.table_data ) {
                        Vue.set( this.s.table_data[k],col_key,col_val);
                    }

                    //col nums
                    this.s.col_tracker.push(this.s.col_tracker.length);
                },
                add_row : function () {
                    Vue.set( this.s.table_data, 'tr_' + new Date().getTime(), this.s.col_template /*JSON.parse( JSON.stringify(  ) )*/ );
                },
                remove_col : function (col_number) {
                    console.log(col_number);
                    //remove col of table data
                    for( var k in this.s.table_data ) {
                        Vue.delete( this.s.table_data[k], Object.keys(this.s.table_data[k])[col_number] );
                    }
                    //remove col of col template
                    Vue.delete( this.s.col_template, Object.keys(this.s.col_template)[col_number]);
                    //remove from col tracker
                    this.s.col_tracker.splice( -1, 1 );
                },
                remove_td : function ( t_key, c_key ) {
                    Vue.delete( this.s.table_data[t_key],c_key);
                },
                remove_row : function ( t_key ) {
                    Vue.delete( this.s.table_data, t_key );
                    if( !Object.keys(this.s.table_data).length ) {
                        this.s.col_template = {};
                        this.s.col_tracker = [];
                    }
                },
                insert_shortcode : function () {
                    sm_object.insert_shortcode( this.s, 'smps_sl_table' );
                }
            },
            mounted : function () {
                sm_object.merge_settings(this,this.component_name);

                /*this.add_col();
                this.add_row();*/

                if ( smps_app.edit_target_item == this.component_name ) {
                    this.s = smps_app.edit_target_item_data;
                }
            }
        });

        Vue.component( 'smps_simple_light_panel_settings', {
            template : '#smps_simple_light_panel_settings',
            data : function () {
                return {
                    x_data: {}
                }
            },
            methods : {
            },
            ready : function () {
                sm_object.merge_settings(this,this.component_name);
            }
        } );
        //alert
        Vue.component('smps_simple_light_alert_settings',{
            template : '#smps_simple_light_alert_settings',
            data : function () {
                return {
                    component_name : 'alert',
                    s : {
                        type : 'success',
                        content : '',
                        dismissable : true
                    },
                    types : sm_common_props.style_types,
                    x_data: {}
                }
            },
            methods : {
                insert_shortcode : function () {
                    sm_object.insert_shortcode( this.s, 'smps_sl_alert' );
                }
            },
            mounted : function () {
                sm_object.merge_settings(this,this.component_name);
                if ( smps_app.edit_target_item == this.component_name ) {
                    console.log(smps_app.edit_target_item_data);
                    this.s = smps_app.edit_target_item_data;
                }
            }
        });

        /**
         * heading
         */
        Vue.component( 'smps_simple_light_heading_settings', {
            template : '#smps_simple_light_heading_settings',
            data : function () {
                return {
                    component_name : 'heading',
                    s : {
                        text_align : 'left',
                        text : 'Lorem ipsum dolor sit amet, consectetur adipisicing elit',
                        type : 'h2',
                    },
                    text_aligns : {
                        'right' : 'Right',
                        'center' : 'Center',
                        'left' : 'Left'
                    },
                    types : {
                        h1 : 'h1',
                        h2 : 'h2',
                        h3 : 'h3',
                        h4 : 'h4',
                        h5 : 'h5',
                        h6 : 'h6'
                    },
                    x_data: {}
                }
            },
            methods : {
                insert_shortcode : function () {
                    sm_object.insert_shortcode( this.s, 'smps_sl_heading' );
                }
            },
            mounted : function () {
                sm_object.merge_settings(this,this.component_name);
                if ( smps_app.edit_target_item == this.component_name ) {
                    this.s = smps_app.edit_target_item_data;
                }
            }
        });

        /**
         * Quote
         */
        Vue.component('smps_simple_light_quote_settings',{
            template : '#smps_simple_light_quote_settings',
            data : function () {
                return {
                    component_name : 'quote',
                    s : {
                        alignment : 'left',
                        quote : 'Lorem ipsum dolor sit amet, consectetur adipisicing elit',
                        author : 'John Doe'
                    },
                    alignments : {
                        'right' : 'Right',
                        'left' : 'Left'
                    },
                    x_data: {}
                }
            },
            methods : {
                insert_shortcode : function () {
                    sm_object.insert_shortcode( this.s, 'smps_sl_quote' );
                }
            },
            mounted : function () {
                sm_object.merge_settings(this,this.component_name);
                if ( smps_app.edit_target_item == this.component_name ) {
                    this.s = smps_app.edit_target_item_data;
                }
            }
        });

        Vue.component( 'smps_simple_light_button_settings',{
            template : '#smps_simple_light_button_settings',
            data : function () {
                return {
                    component_name : 'button',
                    s : {
                        type : 'success',
                        enable_text : true,
                        text : 'Button',
                        enable_icon : false,
                        icon : '',
                        shape : 'rounded',
                        size : '',
                        redirection_type : 'same_page',
                        open_newtab : false,
                        url : 'http://',
                        page : '',
                    },
                    types : sm_common_props.style_types,
                    shapes : {
                        'rounded' : 'Rounded',
                        'normal' : 'Normal'
                    },
                    sizes : {
                        'lg' : 'Large',
                        '' : 'Default',
                        'sm' : 'Small',
                        'xs' : 'Mini',
                        'block' : 'Block'
                    },
                    redirection_types : {
                        'to_page' : 'To a Page',
                        'same_page' : 'Same Page',
                        'url' : 'Set Manually'
                    },
                    pages : {},
                    x_data: {}
                }
            },
            methods : {

                insert_shortcode : function () {
                    sm_object.insert_shortcode( this.s, 'smps_sl_button' );
                }
            },
            mounted : function () {
                sm_object.merge_settings(this,this.component_name);
                if ( smps_app.edit_target_item == this.component_name ) {
                    this.s = smps_app.edit_target_item_data;
                }
            }
        } );

        Vue.component('smps_simple_light_spoiler_settings', {
            template : '#smps_simple_light_spoiler_settings',
            data : function () {
                return {
                    x_data: {}
                }
            },
            methods : {
            },
            mounted : function () {
                sm_object.merge_settings(this,this.component_name);
            }
        });

        /* list */
        Vue.component( 'smps_simple_light_list_settings',{
            template : '#smps_simple_light_list_settings',
            data : function () {
                return {
                    component_name : 'list',
                    s : {
                        items : [],
                        list_type : 'ul',
                        class : '',
                        id : ''
                    },
                    x_data: {}
                }
            },
            methods : {
                add_item : function () {
                    this.s.items.push({ label : 'Item list'});
                },
                item_up : function (k) {
                    if ( k <= 0 ) return;
                    var temp_val = this.s.items[k];
                    this.s.items.splice(k,1);
                    this.s.items.splice( (k-1),0, temp_val );
                },
                item_down : function (k) {
                    if ( k >= this.s.items.length ) return;
                    var temp_val = this.s.items[k];
                    this.s.items.splice(k,1);
                    this.s.items.splice( (k + 1),0, temp_val );
                },
                item_remove : function (k) {
                    this.s.items.splice(k,1);
                },
                insert_shortcode : function () {
                    sm_object.insert_shortcode( this.s, 'smps_sl_list' );
                }
            },
            mounted : function () {
                sm_object.merge_settings(this,this.component_name);
                if ( smps_app.edit_target_item == this.component_name ) {
                    this.s = smps_app.edit_target_item_data;
                }
            }
        });

        /*highlight*/
        Vue.component( 'smps_simple_light_highlight_settings',{
            template : '#smps_simple_light_highlight_settings',
            data : function () {
                return {
                    component_name : 'highlight',
                    s : {
                        background : '',
                        text_color : '',
                        class : '',
                        id : '',
                        content : ''
                    },
                    x_data: {}
                }
            },
            methods : {
                insert_shortcode : function () {
                    sm_object.insert_shortcode( this.s, 'smps_sl_highlight' );
                }
            },
            mounted : function () {
                sm_object.merge_settings(this,this.component_name);
                $('.colorpicker').wpColorPicker();

                if ( smps_app.edit_target_item == this.component_name ) {
                    this.s = smps_app.edit_target_item_data;
                }
            }
        });

        //member_content
        Vue.component( 'smps_simple_light_restricted_content_settings', {
            template : '#smps_simple_light_restricted_content_settings',
            data : function () {
                return {
                    component_name : 'restricted_content',
                    s : {
                        //message : 'This content is for registered users only. Please %login%.',

                        bg_color : '',
                        login_text : 'This content is for registered users only. Please %login%.',
                        login_link_url : 'default',
                        restricted_content : 'This content is visible for loggedin users only'
                    },
                    x_data: {}
                }
            },
            methods : {
                insert_shortcode : function () {
                    sm_object.insert_shortcode( this.s, 'smps_sl_restricted_content' );
                }
            },
            mounted : function () {
                sm_object.merge_settings(this,this.component_name);

                $('.colorpicker').wpColorPicker();

                if ( smps_app.edit_target_item == this.component_name ) {
                    this.s = smps_app.edit_target_item_data;
                }
            }
        });

        //youtube
        Vue.component( 'smps_simple_light_youtube_settings', {
            template : '#smps_simple_light_youtube_settings',
            data : function () {
                return {
                    component_name : 'youtube',
                    s : {
                        url : '',
                        width : '600',
                        height : '400',
                        responsive : 'yes',
                        controls : 0,
                        autohide : 2,
                        show_title_bar : 'yes',
                        autoplay : 'no',
                        loop : 'no',
                        related_videos : 'no',
                        full_screen_button : 'yes',
                        modestbranding : 'no',
                        class : '',
                    },

                    controls_opt : {
                        0 : 'Hide Controls',
                        1 : 'Show Controls',
                        2 : 'Show Control When Playback is Started'
                    },
                    autohide_opt : {
                        0 : 'Do not hide controls',
                        1 : 'Hide all controls on mouseout',
                        2 : 'Hide progressbar on mouseout'
                    },
                    x_data: {}
                }
            },
            methods : {
                insert_shortcode : function () {
                    sm_object.insert_shortcode( this.s, 'smps_sl_youtube' );
                }
            },
            mounted : function () {
                sm_object.merge_settings(this,this.component_name);
                if ( smps_app.edit_target_item == this.component_name ) {
                    this.s = smps_app.edit_target_item_data;
                }
            }
        });

        //vimeo
        Vue.component( 'smps_simple_light_vimeo_settings', {
            template : '#smps_simple_light_vimeo_settings',
            data : function () {
                return {
                    component_name : 'vimeo',
                    s : {
                        url : 'https://vimeo.com/api/oembed.json?url=https%3A//vimeo.com/76979871',
                        width : '600',
                        height : '400',
                        loop : 'yes',
                        autoplay : 'no',
                        class : '',
                        Id : ''
                    },
                    x_data: {}
                }
            },
            methods : {
                insert_shortcode : function () {
                    sm_object.insert_shortcode( this.s, 'smps_sl_vimeo' );
                }
            },
            mounted : function () {
                sm_object.merge_settings(this,this.component_name);
                if ( smps_app.edit_target_item == this.component_name ) {
                    this.s = smps_app.edit_target_item_data;
                }

            }
        });

        //image
        Vue.component( 'smps_simple_light_image_settings', {
            template : '#smps_simple_light_image_settings',
            data : function () {
                return {
                    component_name : 'image',
                    s : {
                        src : '',
                        width : '600',
                        height : '400',
                        responsive : 'yes',
                        class : '',
                        Id : ''
                    },
                    x_data: {}
                }
            },
            methods : {
                insert_shortcode : function () {
                    sm_object.insert_shortcode( this.s, 'smps_sl_image' );
                }
            },
            mounted : function () {
                sm_object.merge_settings(this,this.component_name);

                var this_comp = this;
                $('.upload_image_button').click(function() {

                    formfield = $('.upload_image').attr('name');
                    tb_show( '', 'media-upload.php?type=image&amp;TB_iframe=true' );
                    return false;
                });

                window.send_to_editor = function(html) {
                    imgurl = $(html).attr('src');
                    this_comp.s.src = imgurl;
                    tb_remove();
                }

                if ( smps_app.edit_target_item == this.component_name ) {
                    this.s = smps_app.edit_target_item_data;
                }
            }
        });

        //scheduler
        Vue.component( 'smps_simple_light_scheduler_settings', {
            template : '#smps_simple_light_scheduler_settings',
            data : function () {
                return {
                    component_name : 'scheduler',
                    s : {
                        timespans : [
                            {from : '', to : ''}
                        ],
                        alternative_text : '',
                        content : '',
                        class : '',
                        Id : ''
                    },
                    x_data: {}
                }
            },
            methods : {
                add_timeslot : function () {
                    Vue.set(this.s.timespans,this.s.timespans.length,{from:'',to:''});
                    this.reset_datepicker();

                },
                remove_timeslot : function (k) {
                    this.s.timespans.splice(k,1);
                },
                reset_datepicker : function () {
                    this.$nextTick(function () {
                        $('.datepicker').datetimepicker();
                    });
                },
                insert_shortcode : function () {
                    sm_object.insert_shortcode( this.s, 'smps_sl_scheduler' );
                }
            },
            mounted : function () {
                sm_object.merge_settings(this,this.component_name);
                this.reset_datepicker();
                if ( smps_app.edit_target_item == this.component_name ) {
                    this.s = smps_app.edit_target_item_data;
                }
            }
        });
    });

    //post_loop
    Vue.component( 'smps_simple_light_post_loop_settings',{
        template : '#smps_simple_light_post_loop_settings',
        data : function () {
            return {
                component_name : 'post_loop',
                s : {
                    category__in : '',
                    author : '',
                    posts_per_page : 5,
                    nopaging : 1,
                    orderby : 'date',
                    post_status : 'publish',
                    tag : '',
                    order : 'DESC',
                    class : '',
                    Id : ''
                },
                order_opts : { 'DESC' : 'DESC', 'ASC' : 'ASC' },
                x_data: {}
            }
        },
        methods : {
            insert_shortcode : function () {
                sm_object.insert_shortcode( this.s, 'smps_sl_' + this.component_name );
            }
        },
        created : function () {
            sm_object.merge_settings(this,this.component_name);
            if ( smps_app.edit_target_item == this.component_name ) {
                this.s = smps_app.edit_target_item_data;
            }
        }
    } );

    //page_loop
    Vue.component( 'smps_simple_light_page_loop_settings',{
        template : '#smps_simple_light_page_loop_settings',
        data : function () {
            return {
                component_name : 'page_loop',
                s : {
                    posts_per_page : 5,
                    nopaging : 1,
                    orderby : 'date',
                    post_status : 'publish',
                    order : 'DESC',
                    class : '',
                    Id : ''
                },
                order_opts : { 'DESC' : 'DESC', 'ASC' : 'ASC' },
                orderby_opts :  sm_settings_data.page_loop.orderby,
                post_status_opts : sm_settings_data.page_loop.post_statuses,
                x_data: {}
            }
        },
        methods : {
            insert_shortcode : function () {
                sm_object.insert_shortcode( this.s, 'smps_sl_' + this.component_name );
            }
        },
        mounted : function () {
            sm_object.merge_settings(this,this.component_name);
            if ( smps_app.edit_target_item == this.component_name ) {
                this.s = smps_app.edit_target_item_data;
            }
        }
    } );

    //post meta
    Vue.component( 'smps_simple_light_post_meta_settings',{
        template : '#smps_simple_light_post_meta_settings',
        data : function () {
            return {
                component_name : 'post_meta',
                s : {
                    id : '',
                    key : '',
                    default_value : '',
                    class : '',
                    Id : ''
                },
                x_data: {}
            }
        },
        methods : {
            insert_shortcode : function () {
                sm_object.insert_shortcode( this.s, 'smps_sl_' + this.component_name );
            }
        },
        mounted : function () {
            sm_object.merge_settings(this,this.component_name);
            if ( smps_app.edit_target_item == this.component_name ) {
                this.s = smps_app.edit_target_item_data;
            }
        }
    } );

    //option
    Vue.component( 'smps_simple_light_option_settings',{
        template : '#smps_simple_light_option_settings',
        data : function () {
            return {
                component_name : 'option',
                s : {
                    name : '',
                    value : '',
                    class : '',
                    Id : ''
                },
                x_data: {}
            }
        },
        methods : {
            insert_shortcode : function () {
                sm_object.insert_shortcode( this.s, 'smps_sl_' + this.component_name );
            }
        },
        mounted : function () {
            sm_object.merge_settings(this,this.component_name);
            if ( smps_app.edit_target_item == this.component_name ) {
                this.s = smps_app.edit_target_item_data;
            }
        }
    } );

    //category_list
    Vue.component( 'smps_simple_light_category_list_settings',{
        template : '#smps_simple_light_category_list_settings',
        data : function () {
            return {
                component_name : 'category_list',
                s : {
                    title_li : 'Categories',
                    parent_id : 0,
                    exclude : [],
                    hide_empty : 1,
                    hierarchical : 1,
                    order : 'ASC',
                    separator : '<br/>',
                    show_count : 1,
                    show_option_all : '',
                    show_option_none : 'No categories',
                    class : '',
                    Id : ''
                },
                order_opts : { 'DESC' : 'DESC', 'ASC' : 'ASC' },
                x_data: {}
            }
        },
        methods : {
            insert_shortcode : function () {
                sm_object.insert_shortcode( this.s, 'smps_sl_' + this.component_name );
            }
        },
        mounted : function () {
            sm_object.merge_settings(this,this.component_name);
            if ( smps_app.edit_target_item == this.component_name ) {
                this.s = smps_app.edit_target_item_data;
            }
        }
    } );

    //menu
    Vue.component( 'smps_simple_light_menu_settings',{
        template : '#smps_simple_light_menu_settings',
        data : function () {
            return {
                component_name : 'menu',
                s : {
                    name : '',
                    class : '',
                    Id : ''
                },
                x_data: {}
            }
        },
        methods : {
            insert_shortcode : function () {
                sm_object.insert_shortcode( this.s, 'smps_sl_' + this.component_name );
            }
        },
        mounted : function () {
            sm_object.merge_settings(this,this.component_name);

            if ( smps_app.edit_target_item == this.component_name ) {
                this.s = smps_app.edit_target_item_data;
            }
        }
    } );

    /*custom shortcode*/
    Vue.component('sm_custom_shortcode',{
        template : '#sm_custom_shortcode',
        props : ['tag','id'],
        data : function () {
            return {
                shortcode_atts : {},
                x_data: {}
            };
        },
        methods : {
            insert_shortcode : function () {
                var atts_string = '';

                for( v in _this.shortcode_atts ) {
                    atts_string = atts_string + ' ' + v + '="' + _this.shortcode_atts[v] + '"';
                }
                tinyMCE.activeEditor.selection.setContent('[' + _this.tag + ' ' + atts_string + '][/' + _this.tag + ']' );
                smps_app.dismiss_settings_panel();
            }
        },
        created : function () {
            _this = this;
            $.post(
                ajaxurl,
                {
                    action : 'sm_get_shortcode_atts',
                    shortcode_id : _this.id,
                    tag : _this.tag
                },
                function( data ) {
                    if( data.success == true ) {
                        _this.shortcode_atts = data.data.shortcode_atts
                    } else {
                        tinyMCE.activeEditor.selection.setContent('[' + _this.tag + '][/' + _this.tag + ']' );
                        smps_app.dismiss_settings_panel();
                    }
                }
            );
        },
        mounted: function () {
            sm_object.merge_settings(this,this.component_name);
        }
    });


    sm_object.insert_shortcode = function ( settings_data, shortcode_name ) {
        //var data = encodeURIComponent(JSON.stringify(settings_data));
        var data = btoa(JSON.stringify(settings_data));
        var shortcode = '[' + shortcode_name + ' data="' + data + '" ]';
        tinyMCE.activeEditor.selection.setContent( shortcode );
        smps_app.dismiss_settings_panel();
    }

    sm_object.merge_settings = function (_this,component_name) {

        if( typeof sm_settings_data[component_name] != 'undefined' ) {
            _this.s = Object.assign({},_this.s,sm_settings_data[component_name].s);
            _this.x_data = Object.assign({},sm_settings_data[component_name].data);
        }
        console.log(_this.$data);
    }

}(jQuery));