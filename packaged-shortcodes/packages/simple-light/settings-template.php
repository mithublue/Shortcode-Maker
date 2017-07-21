<template id="smps_simple_light_tabs_settings">
    <form class="shortcode_settings_form">
        <div class="bs-container">
            <div class="form-group">
                <select v-model="s.type" class="form-control">
                    <option v-for="(name,label) in types" :value="name">{{ label }}</option>
                </select>
            </div>
            <div class="mb10">
                <a class="btn btn-default" href="javascript:" @click="add_tab()"><?php _e( 'Add Tab', 'sm' ); ?></a>
            </div>
            <!-- Nav tabs -->
            <ul class="nav nav-{{ s.type }}">
                <li v-for="(tab_key, tab_object) in s.tab_data">
                    <a href="#{{ tab_key }}" data-toggle="tab">
                        <template v-if="tab_target != tab_key">
                            {{ tab_object.title }}
                            <a href="javascript:" class="btn btn-xs" @click="tab_target = tab_key"><i class="fa fa-edit"></i></a>
                            <a href="javascript:" class="btn btn-xs br0" @click="remove_tab(tab_key)"><i class="fa fa-remove"></i></a>
                        </template>
                        <input type="text" v-model="tab_object.title" v-if="tab_target == tab_key">
                        <a href="javascript:" class="btn br0 btn-xs" v-if="tab_target == tab_key" @click="tab_target = ''"><strong><?php _e( 'Save', 'sm' ); ?></strong></a>
                    </a>
                </li>
                <li><a href="javascript:" @click="add_tab()"><i class="fa fa-plus"></i></a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content mt20 mb20">
                <div v-for="(tab_key, tab_object) in s.tab_data" class="tab-pane fade" :id="tab_key">
                    <template v-if="content_target != tab_key">
                        {{ tab_object.content }}
                        <a href="javascript:" class="btn pull-right btn-default" @click="content_target = tab_key"><i class="fa fa-edit"></i></a>
                    </template>
                    <textarea class="form-control" v-model="tab_object.content" cols="30" rows="10" v-if="content_target == tab_key"></textarea>
                    <a href="javascript:" class="btn btn-default br3 mt20" v-if="content_target == tab_key" @click="content_target = ''"><?php _e( 'Save', 'sm' ); ?></a>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-primary" data-dismiss="modal" @click="insert_shortcode()"> <?php _e('Insert','sm'); ?></button>
    </form>
</template>
<template id="smps_simple_light_accordion_settings">
    <form class="shortcode_settings_form">
        <div class="bs-container mb10">
            <div class="mb10">
                <a class="btn btn-default" href="javascript:" @click="add_item()"><?php _e( 'Add Item', 'sm' ); ?></a>
            </div>
            <div class="panel-group" id="accordion">
                <div class="panel panel-default"  v-for="(key, each_acc) in s.acc_data">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <template v-if="target_acc != key">
                                <a data-toggle="collapse" data-parent="#accordion" href="#{{ key }}">{{ each_acc.title }}</a>
                                <a href="javascript:" class="btn btn-xs btn-default br0 " @click="target_acc = key"><i class="fa fa-edit"></i></a>
                                <a href="javascript:" class="btn btn-xs btn-default br0 " @click="remove_accordion(key)"><i class="fa fa-remove"></i></a>
                            </template>
                            <input type="text" v-model="each_acc.title" v-if="target_acc == key" class="form-control">
                            <a href="javascript:" class="btn btn-default br3 mt10" v-if="target_acc == key" @click="target_acc = ''"><?php _e( 'Save', 'sm' ); ?></a>
                        </h4>
                    </div>
                    <div :id="key" class="panel-collapse collapse">
                        <div class="panel-body" @dblclick="target_content = key">
                            <template v-if="target_content != key">
                                {{ each_acc.content }}
                                <a href="javascript:" class="btn btn-default br3 mt10 pull-right" @click="target_content = key"><i class="fa fa-edit"></i></a>
                            </template>
                            <textarea v-model="each_acc.content" cols="30" rows="10" class="form-control" v-if="target_content == key"></textarea>

                            <a href="javascript:" class="btn btn-default br3 mt10" v-if="target_content == key" @click="target_content = ''"><?php _e( 'Save', 'sm' ); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-primary" data-dismiss="modal" @click="insert_shortcode()"> <?php _e('Insert','sm'); ?></button>
    </form>
</template>
<template id="smps_simple_light_table_settings">
    <form class="shortcode_settings_form">
        <div class="mb10">
            <a class="btn btn-default" href="javascript:" @click="add_row()"><?php _e( 'Add Row', 'sm' ); ?></a>
            <a class="btn btn-default" href="javascript:" @click="add_col()"><?php _e( 'Add Column', 'sm' ); ?></a>
        </div>
        <div class="form-group">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <tr>
                        <td v-for="col_number in s.col_tracker">
                            <a href="javascript:" class="btn btn-xs btn-default br3 pull-right" @click="remove_col(col_number)"><i class="fa fa-remove"></i></a>
                        </td>
                    </tr>
                    <tr v-for="( t_key, t_val ) in s.table_data">
                        <td v-for="( c_key, c_val) in t_val ">
                            <input type="text" class="form-control" v-model="c_val">
                            <!--<a href="javascript:" class="btn btn-danger br0" @click="remove_td(t_key, c_key)"><i class="glyphicon glyphicon-minus"></i></a>-->
                        </td>
                        <td><a href="javascript:" class="btn btn-default pull-right btn-xs" @click="remove_row(t_key)" data-val="{{ t_key }}"><i class="fa fa-remove"></i></a></td>
                    </tr>
                </table>
            </div>
        </div>
        <button type="button" class="btn btn-primary" data-dismiss="modal" @click="insert_shortcode()"> <?php _e('Insert','sm'); ?></button>
    </form>
</template>
<!--panel-->
<template id="smps_simple_light_panel_settings">
    <form class="shortcode_settings_form">
        <div class="form-group">
            <label><?php _e('Type','sm'); ?></label>
            <select v-model="s.type" class="form-control">
                <option v-for="(name,label) in types" :value="name">{{ label }}</option>
            </select>
        </div>
        <div class="form-group">
            <label><?php _e('Title','sm'); ?></label>
            <input type="text" v-model="s.header" class="form-control">
        </div>
        <div class="form-group">
            <label><?php _e('Title Alignment','sm'); ?></label>
            <select v-model="s.header_alignment" class="form-control">
                <option v-for="(name,label) in header_alignments" :value="name">{{ label }}</option>
            </select>
        </div>
        <div class="form-group">
            <label><?php _e('Content','sm'); ?></label>
            <textarea v-model="s.body" cols="30" rows="10" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label><?php _e('Footer','sm'); ?></label>
            <input type="text" v-model="s.footer" class="form-control">
        </div>
        <div class="form-group">
            <label><?php _e('Footer Alignment','sm'); ?></label>
            <select v-model="s.footer_alignment" class="form-control">
                <option v-for="(name,label) in footer_alignments" :value="name">{{ label }}</option>
            </select>
        </div>
        <button type="button" class="btn btn-primary" data-dismiss="modal" @click="insert_shortcode()"> <?php _e('Insert','sm'); ?></button>
    </form>
</template>
<template id="smps_simple_light_alert_settings">
    <form class="shortcode_settings_form">
        <div class="form-group">
            <label><?php _e('Type','sm'); ?></label>
            <select v-model="s.type" class="form-control">
                <option v-for="(name,label) in types" :value="name">{{ label }}</option>
            </select>
        </div>
        <div class="form-group">
            <label><?php _e('Text','sm'); ?></label>
            <textarea v-model="s.content" cols="30" rows="10" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label><input type="checkbox" v-model="s.dismissable" > <?php _e('Dismissable','sm'); ?></label>
        </div>
        <button type="button" class="btn btn-primary" data-dismiss="modal" @click="insert_shortcode()"> <?php _e('Insert','sm'); ?></button>
    </form>
</template>
<template id="smps_simple_light_heading_settings">
    <form class="shortcode_settings_form">
        <div class="form-group">
            <label><?php _e('Text Align','sm'); ?></label>
            <select v-model="s.text_align" class="form-control">
                <option v-for="(name,label) in text_aligns" :value="name">{{ label }}</option>
            </select>
        </div>
        <div class="form-group">
            <label><?php _e('Heading','sm'); ?></label>
            <textarea v-model="s.text" cols="30" rows="10" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label><?php _e('Type','sm'); ?></label>
            <select v-model="s.type" class="form-control">
                <option v-for="(name,label) in types" :value="name">{{ label }}</option>
            </select>
        </div>
        <button type="button" class="btn btn-primary" data-dismiss="modal" @click="insert_shortcode()"> <?php _e('Insert','sm'); ?></button>
    </form>
</template>
<template id="smps_simple_light_quote_settings">
    <form class="shortcode_settings_form">
        <div class="form-group">
            <label><?php _e('Text Align','sm'); ?></label>
            <select v-model="s.alignment" class="form-control">
                <option v-for="(name,label) in alignments" :value="name">{{ label }}</option>
            </select>
        </div>
        <div class="form-group">
            <label><?php _e('Quote','sm'); ?></label>
            <textarea v-model="s.quote" cols="30" rows="10" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label><?php _e('Author','sm'); ?></label>
            <input type="text" v-model="s.author" class="form-control">
        </div>
        <button type="button" class="btn btn-primary" data-dismiss="modal" @click="insert_shortcode()"> <?php _e('Insert','sm'); ?></button>
    </form>
</template>
<template id="smps_simple_light_button_settings">
    <?php
    $pages = get_posts(array('post_type' => 'page'));
    ?>
    <form class="shortcode_settings_form">
        <!--types-->
        <div class="form-group">
            <label><?php _e( 'Type', 'sm' ); ?></label>
            <select v-model="s.type" class="form-control">
                <option v-for="(name,label) in types" :value="name">{{ label }}</option>
            </select>
        </div>
        <div class="form-group">
            <label><?php _e( 'Shape', 'sm' ); ?></label>
            <select v-model="s.shape" class="form-control">
                <option v-for="(name,label) in shapes" :value="name">{{ label }}</option>
            </select>
        </div>
        <!--size-->
        <div class="form-group">
            <label><?php _e( 'Size', 'sm' ); ?></label>
            <select v-model="s.size" class="form-control">
                <option v-for="(name,label) in sizes" :value="name">{{ label }}</option>
            </select>
        </div>
        <!--text-->
        <div class="form-group">
            <label><input type="checkbox" v-model="s.enable_text"> <?php _e( 'Enable Text', 'sm' ); ?></label>
        </div>
        <div class="form-group" v-if="s.enable_text">
            <input type="text" v-model="s.text" class="form-control">
        </div>
        <!--icon-->
        <div class="form-group">
            <label><input type="checkbox" v-model="s.enable_icon"> <?php _e( 'Enable Icon', 'sm' ); ?></label>
        </div>
        <div class="form-group" v-if="s.enable_icon">
            <input type="text" v-model="s.icon" class="form-control">
        </div>
        <!--redirection-->
        <div class="form-group">
            <label><?php _e( 'Redirect to', 'sm' ); ?></label>
            <select v-model="s.redirection_type" class="form-control">
                <option v-for="(name,label) in redirection_types" :value="name">{{ label }}</option>
            </select>
        </div>
        <!--if redirection = page-->
        <div class="form-group" v-if="s.redirection_type == 'to_page'">
            <label><?php _e( 'Select redirection page', 'sm' ); ?></label>
            <select v-model="s.page" class="form-control">
                <?php foreach ( $pages as $page ) :?>
                <option value="<?php echo $page->ID; ?>"><?php echo get_the_title($page->ID); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <!--if redirection = url -->
        <div class="form-group" v-if="s.redirection_type == 'url'">
            <label><?php _e( 'Redirect URL', 'sm' ); ?></label>
            <input type="text" v-model="s.url" class="form-control">
        </div>
        <!--open in newtab-->
        <div class="form-group">
            <label><input type="checkbox" v-model="s.open_newtab"> <?php _e( 'Open in New Tab', 'sm' ); ?></label>
        </div>
        <button type="button" class="btn btn-primary" data-dismiss="modal" @click="insert_shortcode()"> <?php _e('Insert','sm'); ?></button>
    </form>
</template>
<template id="smps_simple_light_spoiler_settings">
    <form class="shortcode_settings_form">
        <div class="form-group">
            <label><?php _e('Title','smps'); ?></label>
            <input type="text" class="form-control" v-model="s.title">
        </div>
        <div class="form-group">
            <label><?php _e('Open by default','smps'); ?></label>
            <select v-model="s.is_open" id="">
                <option :value="k" v-for="(k, v) in open_opts">{{ v }}</option>
            </select>
        </div>
        <div class="form-group">
            <label><?php _e('Style','smps'); ?></label>
            <select v-model="s.style" id="">
                <option :value="k" v-for="(k, v) in styles">{{ v }}</option>
            </select>
        </div>
        <div class="form-group">
            <label><?php _e('Class','smps'); ?></label>
            <input type="text" class="form-control" v-model="s.class">
        </div>
        <div class="form-group">
            <label><?php _e('Content','smps'); ?></label>
            <p><textarea v-model="s.content" cols="150" rows="10"></textarea></p>
        </div>
        <button type="button" class="btn btn-primary" data-dismiss="modal" @click="insert_shortcode()"> <?php _e('Insert','sm'); ?></button>
    </form>
</template>
<template id="smps_simple_light_list_settings">
    <form class="shortcode_settings_form">
        <div class="mb5">
            <label><?php _e( 'List type' , 'smps' ); ?></label>
            <select v-model="s.list_type" class="form-control">
                <option value="ol"><?php _e( 'Ordered', 'smps' ); ?></option>
                <option value="ul"><?php _e( 'Unordered', 'smps' ); ?></option>
            </select>
        </div>
        <div class="mb5">
            <label><?php _e( 'Class', 'smps' ); ?></label>
            <input type="text" class="form-control" v-model="s.class">
        </div>
        <div class="mb10">
            <label><?php _e( 'Id', 'smps' ); ?></label>
            <input type="text" class="form-control" v-model="s.id">
        </div>
        <a href="javascript:" class="btn btn-default" @click="add_item()"><?php _e( 'Add Item', 'smps'); ?></a>
        <table class="mb5">
            <tr v-for="(k, item) in s.items">
                <td>
                    <input type="text" v-model="item.label">
                    <a @click="item_up(k)" href="javascript:" class="btn btn-default btn-xs"><i class="fa fa-arrow-up"></i></a>
                    <a @click="item_down(k)" href="javascript:" class="btn btn-default btn-xs"><i class="fa fa-arrow-down"></i></a>
                    <a @click="item_remove(k)" href="javascript:" class="btn btn-default btn-xs"><i class="fa fa-remove"></i></a>
                </td>
            </tr>
        </table>
        <button type="button" class="btn btn-primary" data-dismiss="modal" @click="insert_shortcode()"> <?php _e('Insert','sm'); ?></button>
    </form>
</template>
<template id="smps_simple_light_highlight_settings">
    <form class="shortcode_settings_form">
        <div class="mb5">
            <label><?php _e('Background','smps'); ?></label>
            <input type="text" v-model="s.background" class="colorpicker">
        </div>
        <div class="mb5">
            <label><?php _e('Text Color','smps'); ?></label>
            <input type="text" v-model="s.text_color" class="colorpicker">
        </div>
        <div class="mb5">
            <label><?php _e('Class','smps'); ?></label>
            <input type="text" class="form-control" v-model="s.class">
        </div>
        <div class="mb5">
            <label><?php _e('Id','smps'); ?></label>
            <input type="text" v-model="s.id" class="form-control">
        </div>
        <div class="mb5">
            <label><?php _e('Content','smps'); ?></label>
            <textarea v-model="s.content" id="" cols="30" rows="10" class="form-control"></textarea>
        </div>
        <button type="button" class="btn btn-primary" data-dismiss="modal" @click="insert_shortcode()"> <?php _e('Insert','sm'); ?></button>
    </form>
</template>
<template id="smps_simple_light_restricted_content_settings">
    <form class="shortcode_settings_form">
        <div class="mb5">
            <label><?php _e( 'Background Color', 'smps'); ?></label>
            <input type="text" class="colorpicker" v-model="s.bg_color">
        </div>
        <div class="mb5">
            <label><?php _e( 'Login Text', 'smps'); ?></label>
            <input type="text" class="form-control" v-model="s.login_text">
        </div>
        <div class="mb5">
            <label><?php _e( 'login_link_url', 'smps'); ?></label>
            <input type="text" class="form-control" v-model="s.login_link_url">
        </div>
        <div class="mb5">
            <label><?php _e( 'Restricted content', 'smps'); ?></label>
            <textarea class="form-control" v-model="s.restricted_content"></textarea>
        </div>
        <button type="button" class="btn btn-primary" data-dismiss="modal" @click="insert_shortcode()"> <?php _e('Insert','sm'); ?></button>
    </form>
</template>
<template id="smps_simple_light_note_settings">
    <form class="shortcode_settings_form">
        <div class="mb5">
            <label><?php _e( 'Background Color', 'smps'); ?></label>
            <input type="text" class="colorpicker" v-model="s.bg_color">
        </div>
        <div class="mb5">
            <label><?php _e( 'Text Color', 'smps'); ?></label>
            <input type="text" class="colorpicker" v-model="s.text_color">
        </div>
        <div class="mb5">
            <label><?php _e( 'Radius', 'smps'); ?></label>
            <input type="number" class="form-control" v-model="s.radius">
        </div>
        <div class="mb5">
            <label><?php _e('Class','smps'); ?></label>
            <input type="text" class="form-control" v-model="s.class">
        </div>
        <div class="mb5">
            <label><?php _e('Id','smps'); ?></label>
            <input type="text" class="form-control" v-model="s.Id">
        </div>
        <div class="mb5">
            <label><?php _e( 'Content', 'smps'); ?></label>
            <textarea class="form-control" v-model="s.content"></textarea>
        </div>
        <button type="button" class="btn btn-primary" data-dismiss="modal" @click="insert_shortcode()"> <?php _e('Insert','sm'); ?></button>
    </form>
</template>
<template id="smps_simple_light_youtube_settings">
    <form class="shortcode_settings_form">
        <div class="mb5">
            <label><?php _e( 'URL', 'smps' ); ?></label>
            <input type="url" v-model="s.url">
        </div>
        <div class="mb5">
            <label><?php _e( 'Width', 'smps' ); ?></label>
            <input type="number" v-model="s.width">
        </div>
        <div class="mb5">
            <label><?php _e( 'Height', 'smps' ); ?></label>
            <input type="number" v-model="s.height">
        </div>
        <div class="mb5">
            <label><?php _e( 'Responsive', 'smps' ); ?></label>
            <select v-model="s.responsive">
                <option value="yes"><?php _e( 'Yes', 'smps' ); ?></option>
                <option value="no"><?php _e( 'No', 'smps' ); ?></option>
            </select>
        </div>
        <div class="mb5">
            <label><?php _e( 'Controls', 'smps' ); ?></label>
            <select v-model="s.controls">
                <option :value="k" v-for="(k, label) in controls_opt">{{ label }}</option>
            </select>
        </div>
        <div class="mb5">
            <label><?php _e( 'Autohide', 'smps' ); ?></label>
            <select v-model="s.autohide">
                <option :value="k" v-for="(k, label) in autohide_opt">{{ label }}</option>
            </select>
        </div>
        <div class="mb5">
            <label><?php _e( 'Show title bar', 'smps' ); ?></label>
            <select v-model="s.show_title_bar">
                <option value="yes"><?php _e( 'Yes', 'smps' ); ?></option>
                <option value="no"><?php _e( 'No', 'smps' ); ?></option>
            </select>
        </div>
        <div class="mb5">
            <label><?php _e( 'Autoplay', 'smps' ); ?></label>
            <select v-model="s.autoplay">
                <option value="yes"><?php _e( 'Yes', 'smps' ); ?></option>
                <option value="no"><?php _e( 'No', 'smps' ); ?></option>
            </select>
        </div>
        <div class="mb5">
            <label><?php _e( 'Loop', 'smps' ); ?></label>
            <select v-model="s.loop">
                <option value="yes"><?php _e( 'Yes', 'smps' ); ?></option>
                <option value="no"><?php _e( 'No', 'smps' ); ?></option>
            </select>
        </div>
        <div class="mb5">
            <label><?php _e( 'Related videos', 'smps' ); ?></label>
            <select v-model="s.related_videos">
                <option value="yes"><?php _e( 'Yes', 'smps' ); ?></option>
                <option value="no"><?php _e( 'No', 'smps' ); ?></option>
            </select>
        </div>
        <div class="mb5">
            <label><?php _e( 'Full screen button', 'smps' ); ?></label>
            <select v-model="s.full_screen_button">
                <option value="yes"><?php _e( 'Yes', 'smps' ); ?></option>
                <option value="no"><?php _e( 'No', 'smps' ); ?></option>
            </select>
        </div>
        <div class="mb5">
            <label><?php _e('Class','smps'); ?></label>
            <input type="text" class="form-control" v-model="s.class">
        </div>
        <button type="button" class="btn btn-primary" data-dismiss="modal" @click="insert_shortcode()"> <?php _e('Insert','sm'); ?></button>
    </form>
</template>
<template id="smps_simple_light_vimeo_settings">
    <form class="shortcode_settings_form">
        <div class="mb5">
            <label><?php _e( 'URL', 'smps' ); ?></label>
            <input type="s.url" v-model="s.url">
        </div>
        <div class="mb5">
            <label><?php _e( 'Width', 'smps' ); ?></label>
            <input type="submit.number" v-model="s.width">
        </div>
        <div class="mb5">
            <label><?php _e( 'Height', 'smps' ); ?></label>
            <input type="s.number" v-model="s.height">
        </div>
        <div class="mb5">
            <label><?php _e( 'Loop', 'smps' ); ?></label>
            <select v-model="s.loop">
                <option value="yes"><?php _e( 'Yes', 'smps' ); ?></option>
                <option value="no"><?php _e( 'No', 'smps' ); ?></option>
            </select>
        </div>
        <div class="mb5">
            <label><?php _e( 'Autoplay', 'smps' ); ?></label>
            <select v-model="s.autoplay">
                <option value="yes"><?php _e( 'Yes', 'smps' ); ?></option>
                <option value="no"><?php _e( 'No', 'smps' ); ?></option>
            </select>
        </div>
        <div class="mb5">
            <label><?php _e('Class','smps'); ?></label>
            <input type="text" class="form-control" v-model="s.class">
        </div>
        <div class="mb5">
            <label><?php _e('Id','smps'); ?></label>
            <input type="text" class="form-control" v-model="s.Id">
        </div>
        <button type="button" class="btn btn-primary" data-dismiss="modal" @click="insert_shortcode()"> <?php _e('Insert','sm'); ?></button>
    </form>
</template>
<template id="smps_simple_light_image_settings">
    <form class="shortcode_settings_form">
        <div class="mb5">
            <label><?php _e( 'Src', 'smps' ); ?></label>
            <div>
                <img :src="s.src" alt="image" v-if="s.src" width="100">
            </div>
            <input class="upload_image form-control mb5" type="text" size="36" v-model="s.src" />
            <input class="upload_image_button btn btn-default" type="button" value="<?php _e('Upload Image','smps');?>" />
            <input class="upload_image_button btn btn-default" type="button" value="<?php _e('Remove Image','smps');?>" v-if="s.src" @click="s.src='';return false" />
        </div>
        <div class="mb5">
            <label><?php _e( 'Width', 'smps' ); ?></label>
            <input type="number" v-model="s.width" class="form-control">
        </div>
        <div class="mb5">
            <label><?php _e( 'Height', 'smps' ); ?></label>
            <input type="number" v-model="s.height" class="form-control">
        </div>
        <div class="mb5">
            <label><?php _e( 'Responsive', 'smps' ); ?></label>
            <select v-model="s.responsive" class="form-control">
                <option value="yes"><?php _e( 'Yes', 'smps' ); ?></option>
                <option value="no"><?php _e( 'No', 'smps' ); ?></option>
            </select>
        </div>
        <div class="mb5">
            <label><?php _e('Class','smps'); ?></label>
            <input type="text" class="form-control" v-model="s.class">
        </div>
        <div class="mb5">
            <label><?php _e('Id','smps'); ?></label>
            <input type="text" class="form-control" v-model="s.Id">
        </div>
        <button type="button" class="btn btn-primary" data-dismiss="modal" @click="insert_shortcode()"> <?php _e('Insert','sm'); ?></button>
    </form>
</template>
<template id="smps_simple_light_scheduler_settings">
    <form class="shortcode_settings_form">
        <a href="javascript:" class="btn btn-default" @click="add_timeslot()"><?php _e( 'Add another time slot', 'smps'); ?></a>
        <div v-for="(k,slot) in s.timespans" class="row mb5">
            <div class="col-sm-5">
                <label><?php _e( 'From', 'smps' ); ?></label>
                <input type="text" class="datepicker form-control" v-model="slot.from">
            </div>
            <div class="col-sm-5">
                <label><?php _e( 'To', 'smps' ); ?></label>
                <input type="text" class="datepicker form-control" v-model="slot.to">
            </div>
            <div class="col-sm-2">
                <a href="javascript:" class="btn btn-default pull-right btn-xs br0" @click="remove_timeslot(k)"><i class="fa fa-remove"></i></a>
            </div>
        </div>
        <div class="mb5">
            <label><?php _e('Class','smps'); ?></label>
            <input type="text" class="form-control" v-model="s.class">
        </div>
        <div class="mb5">
            <label><?php _e('Id','smps'); ?></label>
            <input type="text" class="form-control" v-model="s.Id">
        </div>
        <div class="mb5">
            <label><?php _e('Alternative text','smps'); ?></label>
            <textarea cols="30" rows="10" v-model="s.alternative_text"></textarea>
        </div>
        <div class="mb5">
            <label><?php _e('Content','smps'); ?></label>
            <textarea cols="30" rows="10" v-model="s.content"></textarea>
        </div>
        <button type="button" class="btn btn-primary" data-dismiss="modal" @click="insert_shortcode()"> <?php _e('Insert','sm'); ?></button>
    </form>
</template>