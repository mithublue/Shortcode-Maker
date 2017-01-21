<template id="smps_simple_light_tabs_settings">
    <form class="shortcode_settings_form">
        <div class="form-group">
            <select v-model="type" class="form-control">
                <option v-for="(name,label) in types" :value="name">{{ label }}</option>
            </select>
        </div>
        <div class="mb10">
            <a class="btn btn-default" href="javascript:" @click="add_tab()"><?php _e( 'Add Tab', 'sm' ); ?></a>
        </div>
        <div v-for="(key, each_tab) in tab_data">
            <div class="form-group">
                <label><?php _e( 'Tab title', 'sm' ); ?></label>
                <input type="text" v-model="each_tab.title" class="form-control">
            </div>
            <div class="form-group">
                <label><?php _e( 'Tab content', 'sm' ); ?></label>
                <textarea v-model="each_tab.content" cols="30" rows="10" class="form-control"></textarea>
            </div>
        </div>
        <button type="button" class="btn btn-primary" @click="insert_shortcode()">Insert</button>
    </form>
</template>
<template id="smps_simple_light_accordion_settings">
    <form class="shortcode_settings_form">
        <div class="mb10">
            <a class="btn btn-default" href="javascript:" @click="add_item()"><?php _e( 'Add Item', 'sm' ); ?></a>
        </div>
        <div v-for="(key, each_acc) in acc_data">
            <div class="form-group">
                <label><?php _e( 'Accordion title', 'sm' ); ?></label>
                <input type="text" v-model="each_acc.title" class="form-control">
            </div>
            <div class="form-group">
                <label><?php _e( 'Accordion content', 'sm' ); ?></label>
                <textarea v-model="each_acc.content" cols="30" rows="10" class="form-control"></textarea>
            </div>
        </div>
        <button type="button" class="btn btn-primary" @click="insert_shortcode()">Insert</button>
    </form>
</template>
<template id="smps_simple_light_table_settings">
    {{ $data | json }}
    <form class="shortcode_settings_form">
        <div class="mb10">
            <a class="btn btn-default" href="javascript:" @click="add_row()"><?php _e( 'Add Row', 'sm' ); ?></a>
            <a class="btn btn-default" href="javascript:" @click="add_col()"><?php _e( 'Add Column', 'sm' ); ?></a>
        </div>
        <div class="form-group">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <tr v-for="( t_key, t_val ) in table_data">
                        <td v-for="( c_key, c_val) in t_val ">
                            <input type="text" v-model="c_val">
                            <!--<a href="javascript:" class="btn btn-danger br0" @click="remove_td(t_key, c_key)"><i class="glyphicon glyphicon-minus"></i></a>-->
                        </td>
                        <td><a href="javascript:" class="btn btn-danger br0 pull-right btn-xs" @click="remove_row(t_key)" data-val="{{ t_key }}">Remove</a></td>
                    </tr>
                </table>
            </div>
        </div>
    </form>
</template>
<!--panel-->
<template id="smps_simple_light_panel_settings">
    <form class="shortcode_settings_form">
        <div class="form-group">
            <label><?php _e('Type','sm'); ?></label>
            <select v-model="type" class="form-control">
                <option v-for="(name,label) in types" :value="name">{{ label }}</option>
            </select>
        </div>
        <div class="form-group">
            <label><?php _e('Title','sm'); ?></label>
            <input type="text" v-model="header" class="form-control">
        </div>
        <div class="form-group">
            <label><?php _e('Title Alignment','sm'); ?></label>
            <select v-model="header_alignment" class="form-control">
                <option v-for="(name,label) in header_alignments" :value="name">{{ label }}</option>
            </select>
        </div>
        <div class="form-group">
            <label><?php _e('Content','sm'); ?></label>
            <textarea v-model="body" cols="30" rows="10" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label><?php _e('Footer','sm'); ?></label>
            <input type="text" v-model="footer" class="form-control">
        </div>
        <div class="form-group">
            <label><?php _e('Footer Alignment','sm'); ?></label>
            <select v-model="footer_alignment" class="form-control">
                <option v-for="(name,label) in footer_alignments" :value="name">{{ label }}</option>
            </select>
        </div>
        <button type="button" class="btn btn-primary" @click="insert_shortcode()">Insert</button>
    </form>
</template>
<template id="smps_simple_light_alert_settings">
    <form class="shortcode_settings_form">
        <div class="form-group">
            <label><?php _e('Type','sm'); ?></label>
            <select v-model="type" class="form-control">
                <option v-for="(name,label) in types" :value="name">{{ label }}</option>
            </select>
        </div>
        <div class="form-group">
            <label><?php _e('Text','sm'); ?></label>
            <textarea v-model="content" cols="30" rows="10" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label><input type="checkbox" v-model="dismissable" > <?php _e('Dismissable','sm'); ?></label>
        </div>
        <button type="button" class="btn btn-primary" @click="insert_shortcode()"> <?php _e('Insert','sm'); ?></button>
    </form>
</template>
<template id="smps_simple_light_heading_settings">
    <form class="shortcode_settings_form">
        <div class="form-group">
            <label><?php _e('Text Align','sm'); ?></label>
            <select v-model="text_align" class="form-control">
                <option v-for="(name,label) in text_aligns" :value="name">{{ label }}</option>
            </select>
        </div>
        <div class="form-group">
            <label><?php _e('Heading','sm'); ?></label>
            <textarea v-model="text" cols="30" rows="10" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label><?php _e('Type','sm'); ?></label>
            <select v-model="type" class="form-control">
                <option v-for="(name,label) in types" :value="name">{{ label }}</option>
            </select>
        </div>
        <button type="button" class="btn btn-primary" @click="insert_shortcode()"> <?php _e('Insert','sm'); ?></button>
    </form>
</template>
<template id="smps_simple_light_quote_settings">
    <form class="shortcode_settings_form">
        <div class="form-group">
            <label><?php _e('Text Align','sm'); ?></label>
            <select v-model="alignment" class="form-control">
                <option v-for="(name,label) in alignments" :value="name">{{ label }}</option>
            </select>
        </div>
        <div class="form-group">
            <label><?php _e('Quote','sm'); ?></label>
            <textarea v-model="quote" cols="30" rows="10" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label><?php _e('Author','sm'); ?></label>
            <input type="text" v-model="author" class="form-control">
        </div>
        <button type="button" class="btn btn-primary" @click="insert_shortcode()"> <?php _e('Insert','sm'); ?></button>
    </form>
</template>