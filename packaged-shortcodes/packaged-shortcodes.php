<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class SM_Packaged_Shortcodes {

    /**
     * @var Singleton The reference the *Singleton* instance of this class
     */
    private static $instance;

    /**
     * Returns the *Singleton* instance of this class.
     *
     * @return Singleton The *Singleton* instance.
     */
    public static function get_instance() {
        if ( null === self::$instance ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function __construct() {

        add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts_styles' ) );
        add_action( 'shortcode_maker_activation_task', array( $this, 'set_data_on_activation' ) );
        add_action( 'admin_notices', array( $this, 'show_admin_notices' ) );


        $this->includes();
    }

    public function includes() {
        $sm_get_shortcode_packages = sm_get_shortcode_packages();
        foreach ( $sm_get_shortcode_packages as $package_slug => $package_label ) {
            include_once SHORTCODE_MAKER_ROOT.'/packaged-shortcodes/packages/'.$package_slug.'/'.$package_slug.'.php';
        }

        include_once 'packaged-shortcodes-admin.php';
        include_once 'packaged-shortcodes-settings.php';
    }


    public function show_admin_notices() {
        global $pagenow;
        if( SHORTCODE_MAKER_VERSION >= 5.0 ) {
            if( !in_array( $pagenow, array( 'post.php', 'post-new.php' ) ) ) return;

            if( !get_option( 'sm_dismiss_feature_notice' ) ) {
                require_once SHORTCODE_MAKER_ROOT . '/documentation/documentation.php';
                ?>
                <div class="notice notice-info is-dismissible sm_feature_notice">
                    <p><?php _e( 'Shortcode maker is now more advanced with builtin packages and shortcode editable feature, <a href="javascript:" data-toggle="modal" data-target="#sm_doc_modal" class="sm_doc_link" style="color: #FFFFFF;font-weight: bold;">click here to learn more !</a>', 'sample-text-domain' ); ?></p>
                </div>
                <?php
            }
        }
    }


    /**
     * enqueue admin scripts
     * and styles
     * @param $hook
     */
    public function admin_enqueue_scripts_styles( $hook ) {

        if( in_array( $hook, array(
            'sm_shortcode_page_smps_shortcode_packages',
            'post-new.php',
            'post.php'
        ) ) ) {
            //colorpicker
            wp_enqueue_style('wp-color-picker');

            wp_enqueue_style( 'smps-swal-css', SHORTCODE_MAKER_ASSET_PATH.'/css/sweetalert.css' );
            wp_enqueue_style( 'sm-post-css', SHORTCODE_MAKER_ASSET_PATH.'/css/sm-post.css' );
            //timepicker addon css
            wp_enqueue_style( 'sm-timepicker-css', SHORTCODE_MAKER_ASSET_PATH.'/css/timepicker-addon.css' );

            wp_enqueue_script( 'smps-swal-js', SHORTCODE_MAKER_ASSET_PATH.'/js/sweetalert.min.js', array( 'jquery' ) );
            wp_enqueue_script( 'sm-post-js', SHORTCODE_MAKER_ASSET_PATH.'/js/sm-post.js', array( 'jquery','sm-vue', 'wp-color-picker','jquery-ui-datepicker' ), false, true );
            //timepicker addon
            wp_enqueue_script('sm-timepicker-addon', SHORTCODE_MAKER_ASSET_PATH.'/js/timepicker-addon.js', array('jquery-ui-datepicker'));

        }

    }

    /**
     * save data on plugin activation
     */
    function set_data_on_activation() {
        $sm_shortcode_packages = sm_get_shortcode_packages();
        if( empty( $sm_shortcode_packages ) ) {
            $all_packages = sm_get_all_shortcode_packages();
            sm_save_shortcode_packages( $all_packages );
        }
    }
}

SM_Packaged_Shortcodes::get_instance();