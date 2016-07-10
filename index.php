<?php
/*
Plugin Name: Shortcode Maker
Description: A plugin to to let users make shortcodes of their own and use them in wp editor
Plugin URI:
Author URI:
Author: Mithu A Quayium
Text Domain: sm
Version: 2.0
License: GPL2
*/

/**
 * Copyright (c) YEAR Mithu A Quayium (email: cemithu06@gmail.com). All rights reserved.
 *
 * Released under the GPL license
 * http://www.opensource.org/licenses/gpl-license.php
 *
 * This is an add-on for WordPress
 * http://wordpress.org/
 *
 * **********************************************************************
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 * **********************************************************************
 */
class shortcode_maker{

	private $shorcode_array = array();

    function __construct(){

        $this->shorcode_array = get_option('shortcode_list');

        add_action('init',array($this,'register_shortcode'));
		add_action('save_post',array($this,'save_post_func'));

        add_action('init',array($this,'shortcode_add'));

        add_action('admin_init', array($this, 'sm_shortcode_button'));
        add_action('admin_footer', array($this, 'sm_get_shortcodes'));
		add_action('wp_trash_post',array($this,'remove_shortcode'));

        add_action( 'admin_head', array( $this , 'shortcode_array_js' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts_styles' ) );
        //ajax
        add_action( 'wp_ajax_show_shortcodes', array( $this, 'render_shortcode_modal' ) );

        $this->includes();
	}

    function includes(){
        require_once dirname(__FILE__).'/cc-products-page.php';
    }

    /**
     * Convert shortcode array to js
     */
    function shortcode_array_js() {
        ?>
        <script>
            var shortcode_array = '<?php echo json_encode($this->shorcode_array); ?>';
        </script>
    <?php
    }

    /**
     * Render the shortcode modal
     */
    function render_shortcode_modal() {
        $shortcode_array =  json_decode( stripslashes( $_POST['shortcode_array'] ), true );
        //is_array( $shortcode_array ) ? '' : $shortcode_array = array();
        ?>

        <div id="sm-modal" class="modal">

            <!-- Modal content -->
            <div class="modal-content">
                <span class="close">×</span>
                <h3>Shortcodes - Shortcode Maker</h3>
                <hr/>
                <?php
                echo '<div class="sm_shortcode_list">';
                    echo '<ul>';
                    foreach( $shortcode_array as $id => $shortcode ) {
                        ?>
                        <li>
                            <?php echo $shortcode; ?>
                        </li>
                    <?php
                    }
                    echo '</ul>';
                echo '</div>';
                ?>
            </div>

        </div>
        <?php
        exit;
    }

    /**
     * Register shortcode
     */
	function register_shortcode(){
		$labels = array(
				'name' => _x('Shortcode', 'post type general name'),
				'singular_name' => _x('Shortcode', 'post type singular name'),
				'menu_name' => _x( 'Shortcode', 'admin menu'),
				'name_admin_bar' => _x( 'Shortcode', 'add new on admin bar'),
				'add_new' => _x('Add New Shortcode', 'Shortcode'),
				'add_new_item' => __('Add New Shortcode'),
				'edit_item' => __('Edit Shortcode'),
				'new_item' => __('New Shortcode'),
				'view_item' => __('View Shortcode'),
				'all_items' => __( 'All Shortcode' ),
				'search_items' => __('Search Shortcode'),
				'not_found' =>  __('Nothing found'),
				'not_found_in_trash' => __('Nothing found in Trash'),
				'parent_item_colon' => '',
				
			);
			$args = array(
				'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'query_var' => true,
			'rewrite' => array('slug' => 'sm_shortcode'),
			'capability_type' => 'post',
			'has_archive' => false,
			'hierarchical' => false,
			'menu_position' => 3,
			'supports' => array(
				'title',
				'editor',
				),
		
			);
			register_post_type( 'sm_shortcode' , $args );
	}

    /**
     * shortcode_list option updated
     * @param $post_id
     */
	function save_post_func($post_id){

		if( isset( $_POST['post_type'] ) && $_POST['post_type'] == 'sm_shortcode'){
			$this->shorcode_array[$post_id] = get_the_title($post_id);
			update_option('shortcode_list',$this->shorcode_array);
			
		}
	}

    /**
     * Add shortocode
     */
	function shortcode_add(){

		if(!is_array($this->shorcode_array))return;

		foreach($this->shorcode_array as $each_shortcode){
			add_shortcode($each_shortcode,array($this,'shortcode_content'));
		}
	}

    /**
     * Eacch shortcode definition
     * @param $atts
     * @param null $content
     * @param $tag
     * @return mixed
     */
    function shortcode_content($atts,$content = NULL,$tag){
		if(in_array($tag,$this->shorcode_array)){
			$post_id = array_search($tag,$this->shorcode_array);
			return get_post($post_id)->post_content;
		}
	}


    /**
     * Remove the shortcode if
     * shortcode is deleted
     * @param $post_id
     */
	function remove_shortcode($post_id){

        if(get_post_type($post_id) == 'sm_shortcode'){
            unset($this->shorcode_array[$post_id]);
            update_option('shortcode_list',$this->shorcode_array);
        }
	}


	function sm_shortcode_button()
    {
        if( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
        {
            add_filter( 'mce_external_plugins', array($this, 'sm_add_buttons' ));
            add_filter( 'mce_buttons', array($this, 'sm_register_buttons' ));
        }
    }
	function sm_add_buttons( $plugin_array )
    {
		if(get_bloginfo('version') >= 3.9){
	        $plugin_array['pushortcodes'] = plugin_dir_url( __FILE__ ) . 'js/shortcode-tinymce-button.js';
		}else{
			$plugin_array['pushortcodes'] = plugin_dir_url( __FILE__ ) . 'js/shortcode-tinymce-button-older.js';
		}


        return $plugin_array;
    }
	function sm_register_buttons( $buttons )
    {
        array_push( $buttons, 'separator', 'pushortcodes' );
        return $buttons;
    }
	function sm_get_shortcodes()
    {
        global $shortcode_tags;

        echo '<script type="text/javascript">
        var shortcodes_button = new Array();';

        $count = 0;

        foreach($shortcode_tags as $tag => $code)
        {
            echo "shortcodes_button[{$count}] = '{$tag}';";
            $count++;
        }

        echo '</script>';
    }

    /**
     * Add scripts and styles
     */
    public function enqueue_scripts_styles() {
        wp_enqueue_style( 'sm-style', plugins_url('css/style.css',__FILE__) );
    }
}
new shortcode_maker;