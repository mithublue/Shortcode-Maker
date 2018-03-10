<?php

class SM_Ajax_Action {

    public static function init() {
        add_action( 'wp_ajax_sm_dismiss_feature_notice', array( 'SM_Ajax_Action', 'dissmiss_feature_notice' ) );
        add_action( 'wp_ajax_sm_dissmiss_modification_notice', array( __CLASS__, 'dissmiss_modification_notice' ) );
    }

    public static function dissmiss_feature_notice() {
        if( isset( $_POST['feature_notice_dissmiss'] ) && $_POST['feature_notice_dissmiss'] == 1 ) {
            update_option( 'sm_dismiss_feature_notice', $_POST['feature_notice_dissmiss'] );
        }
    }

    public static function dissmiss_modification_notice() {
        $notices = sm_get_notice('sm_admin_notices' );
        $notices['modification_notice']['is_dismissed'] = true;
        if ( update_option( 'sm_admin_notices', $notices ) ) {
            echo wp_send_json_success();
        }
    }
}

SM_Ajax_Action::init();