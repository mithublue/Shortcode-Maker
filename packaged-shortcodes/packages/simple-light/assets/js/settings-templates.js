(function ($) {
    $(document).ready(function () {
        /**
         * tabs
         */
        Vue.component('smps_simple_light_tabs_settings',{
            template : '#smps_simple_light_tabs_settings',
            data : function () {
                return {
                    type : 'tabs',
                    tab_data : {},
                    tab_template : {
                        'title' : 'Tab Label',
                        'content' : 'Tab content'
                    },
                    types : {
                        'tabs' : 'Tabs',
                        'pills' : 'Pills'
                    }
                }
            },
            methods : {
                add_tab : function () {
                    Vue.set(this.tab_data,'tab_' + new Date().getTime(),JSON.parse(JSON.stringify(this.tab_template)));
                },
                insert_shortcode : function () {
                    console.log((JSON.stringify(this.tab_data)));
                    console.log('[smps_sl_tabs type=' + this.type + ' tab_data=' + JSON.stringify(this.tab_data) + ']');
                    var tab_data_str = '';
                    for( k in this.tab_data ){
                        tab_data_str = tab_data_str + k + ':' + this.tab_data[k]['title'] + '|' + this.tab_data[k]['content'] + ',';
                    }
                    var shortcode = '[smps_sl_tabs tab_data="' + tab_data_str + '" type="' + this.type + '" ]';
                    tinyMCE.activeEditor.selection.setContent( shortcode );
                }
            },
        });

        /**
         * accordion
         */
        Vue.component('smps_simple_light_accordion_settings',{
            template : '#smps_simple_light_accordion_settings',
            data : function () {
                return {
                    acc_data : {},
                    acc_template : {
                        'title' : 'Item Label',
                        'content' : 'Item content'
                    }
                }
            },
            methods : {
                add_item : function () {
                    Vue.set(this.acc_data,'acc_' + new Date().getTime(),JSON.parse(JSON.stringify(this.acc_template)));
                },
                insert_shortcode : function () {
                    var acc_data_str = '';
                    for( k in this.acc_data ){
                        acc_data_str = acc_data_str + k + ':' + this.acc_data[k]['title'] + '|' + this.acc_data[k]['content'] + ',';
                    }
                    var shortcode = '[smps_sl_accordion acc_data="' + acc_data_str + '"]';
                    console.log(shortcode);
                    tinyMCE.activeEditor.selection.setContent( shortcode );
                }
            },
        });

        /**
         * table
         */
        Vue.component('smps_simple_light_table_settings',{
            template : '#smps_simple_light_table_settings',
            data : function () {
                return {
                    table_data : {},
                    col_template : {}
                }
            },
            methods : {
                add_col : function () {
                    var col_val = '';/*'td_' + new Date().getTime()*/
                    var col_key = new Date().getTime();
                    Vue.set(this.col_template, col_key, col_val );
                    console.log(this.col_template);

                    for( var k in this.table_data ) {
                        Vue.set( this.table_data[k],col_key,col_val);
                    }
                },
                add_row : function () {
                    Vue.set( this.table_data, 'tr_' + new Date().getTime(), JSON.parse( JSON.stringify( this.col_template ) ) );
                },
                remove_td : function ( t_key, c_key ) {
                    Vue.delete( this.table_data[t_key],c_key);
                },
                remove_row : function ( t_key ) {
                    console.log(t_key);
                    Vue.delete( this.table_data, t_key );
                },
                insert_shortcode : function () {
                    var shortcode = '[smps_sl_table type="' + this.type + '" header="' + this.header + '" header_alignment="' + this.header_alignment + '"' +
                        ' body="' + this.body + '" footer="' + this.footer + '" footer_alignment="'+ this.footer_alignment +'"]';
                    tinyMCE.activeEditor.selection.setContent( shortcode );
                }
            },
            ready : function () {
                this.add_col();
                this.add_row();
            }
        });

        Vue.component( 'smps_simple_light_panel_settings', {
            template : '#smps_simple_light_panel_settings',
            data : function () {
                return {
                    'type' : 'primary',
                    'types' : {
                        'primary' : 'Primary',
                        'success' : 'Success',
                        'info' : 'Info',
                        'warning' : 'Warning',
                        'danger' : 'Danger',
                        'default' : 'Default'
                    },
                    'header' : 'Panel Title',
                    'header_alignment' : 'left',
                    'header_alignments' : {
                        'right' : 'Right',
                        'center' : 'Center',
                        'left' : 'Left'
                    },
                    'body' : 'Panel content !',
                    'footer' : 'Footer text',
                    'footer_alignment' : 'left',
                    'footer_alignments' : {
                        'right' : 'Right',
                        'center' : 'Center',
                        'left' : 'Left'
                    }
                }
            },
            methods : {
                insert_shortcode : function () {
                    var shortcode = '[smps_sl_panel type="' + this.type + '" header="' + this.header + '" header_alignment="' + this.header_alignment + '"' +
                        ' body="' + this.body + '" footer="' + this.footer + '" footer_alignment="'+ this.footer_alignment +'"]';
                    tinyMCE.activeEditor.selection.setContent( shortcode );
                }
            }
        } );
        Vue.component('smps_simple_light_alert_settings',{
            template : '#smps_simple_light_alert_settings',
            data : function () {
                return {
                    type : 'success',
                    types : {
                        'primary' : 'Primary',
                        'success' : 'Success',
                        'info' : 'Info',
                        'warning' : 'Warning',
                        'danger' : 'Danger',
                        'default' : 'Default'
                    },
                    content : '',
                    dismissable : true
                }
            },
            methods : {
                insert_shortcode : function () {
                    var shortcode = '[smps_sl_alert type="' + this.type + '"  content="' + this.content + '" dismissable="' + this.dismissable + '"]';
                    tinyMCE.activeEditor.selection.setContent( shortcode );
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
                    text_align : 'left',
                    text_aligns : {
                        'right' : 'Right',
                        'center' : 'Center',
                        'left' : 'Left'
                    },
                    text : 'Lorem ipsum dolor sit amet, consectetur adipisicing elit',
                    type : 'h2',
                    types : {
                        h1 : 'h1',
                        h2 : 'h2',
                        h3 : 'h3',
                        h4 : 'h4',
                        h5 : 'h5',
                        h6 : 'h6'
                    }
                }
            },
            methods : {
                insert_shortcode : function () {
                    var shortcode = '[smps_sl_heading text_align="'+ this.text_align +'" text="'+ this.text +'" type="' + this.type + '"]';
                    tinyMCE.activeEditor.selection.setContent( shortcode );
                }
            }
        })

        /**
         * Quote
         */
        Vue.component('smps_simple_light_quote_settings',{
            template : '#smps_simple_light_quote_settings',
            data : function () {
                return {
                    alignment : 'left',
                    alignments : {
                        'right' : 'Right',
                        'left' : 'Left'
                    },
                    quote : 'Lorem ipsum dolor sit amet, consectetur adipisicing elit',
                    author : 'John Doe'
                }
            },
            methods : {
                insert_shortcode : function () {
                    var shortcode = '[smps_sl_quote alignment="'+ this.alignment +'" quote="'+ this.quote +'" author="' + this.author + '"]';
                    tinyMCE.activeEditor.selection.setContent( shortcode );
                }
            }
        })
    });
}(jQuery));