<?php
/*tabs*/
add_action( 'sm_bottom_settings_tabs', function () {
    ?>
    <p class="alert alert-danger"><?php _e( 'Pro Features', 'sm' ); ?></p>
    <div class="form-group">
        <label><?php _e( 'Layout Type', 'sm' ); ?></label>
        <select class="form-control" disabled>
            <option><?php _e( 'Select Layout Type', 'sm' ); ?></option>
        </select>
    </div>
    <?php
});
/*alert*/
add_action( 'sm_bottom_settings_alert', function() {
    ?>
    <p class="alert alert-danger"><?php _e( 'Pro Features', 'sm' ); ?></p>
    <div class="form-group">
        <div class="mb10">
            <label><?php _e( 'Heading Text', 'sm' ); ?></label>
            <input type="text" class="form-control" disabled>
        </div>
        <div class="mb10">
            <label><?php _e( 'Footer Text', 'sm' ); ?></label>
            <input type="text" class="form-control" disabled>
        </div>
    </div>
    <?php
});
/*button*/
add_action( 'sm_bottom_settings_button', function() {
    ?>
    <div class="form-group">
        <p class="alert alert-danger"><?php _e( 'Pro Features', 'sm' ); ?></p>
        <div class="mb10">
            <label><input disabled type="checkbox"><?php _e( 'Is Outlined ?', 'sm' ); ?></label>
        </div>
        <div class="mb10">
            <label><input disabled type="checkbox"><?php _e( 'Is Active ?', 'sm' ); ?></label>
        </div>
        <div class="mb10">
            <label><input disabled type="checkbox"><?php _e( 'Is Disabled ?', 'sm' ); ?></label>
        </div>
    </div>
    <?php
});
