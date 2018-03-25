<?php
class CC_News {
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
        add_action( 'admin_menu' , array( $this, 'add_news_page' ) );
        add_action( 'admin_print_scripts' , array( $this, 'admin_print_script_style' ) );
        add_action( 'admin_notices' , array( $this, 'admin_news_notice' ) );
    }

    public function admin_news_notice() {
        $notices = sm_get_notice('sm_admin_notices' );

        $response = wp_remote_get( 'http://blog.cybercraftit.com/api/get_category_posts?slug=news&count=1' );
        $response = $response['body'];
        $response = json_decode($response,true);
        $new_lastest_date = 0;

        if ( !empty( $response['posts'] ) ) {
            $new_lastest_date = strtotime($response['posts'][0]['date']);
        }

        if( $new_lastest_date ) {
            if( !isset( $notices['news_notice']['is_dismissed'] ) || !$notices['news_notice']['is_dismissed'] ) { ?>
                <div class="notice notice-success is-dismissible cc_news_notice">
                    <input type="hidden" value="<?php echo $new_lastest_date; ?>" name="cc_last_news_date">
                    <p><?php _e( '<a href="'.$response['posts'][0]['url'].'" target="_blank" style="text-decoration:none;color:#444444;">'.$response['posts'][0]['title'].'</a>', 'cc' ); ?><?php echo '<a href="'.$response['posts'][0]['url'].'" target="_blank" style="text-decoration:none;color:#444444;float:right;">'.__('Read More','cc').'</a>' ?></p>
                </div>
                <?php
            } elseif( isset( $notices['news_notice']['is_dismissed'] )
                && isset( $notices['news_notice']['last_news_date'] )
                && $notices['news_notice']['last_news_date'] < $new_lastest_date
            ) { ?>
                <div class="notice notice-success is-dismissible cc_news_notice">
                    <input type="hidden" value="<?php echo $new_lastest_date; ?>" name="cc_last_news_date">
                    <p><?php _e( '<a href="'.$response['posts'][0]['url'].'" target="_blank" style="text-decoration:none;color:#444444;">'.$response['posts'][0]['title'].'</a>', 'cc' ); ?><?php echo '<a href="'.$response['posts'][0]['url'].'" target="_blank" style="text-decoration:none;color:#444444;float:right;">'.__('Read More','cc').'</a>' ?></p>
                </div>
                <?php

            }
        }
    }

    public function add_news_page() {
        add_submenu_page ( 'edit.php?post_type=sm_shortcode', 'News', 'News', 'manage_options', __FILE__, array( $this, 'generate_news_page_content' ) );
    }

    public function generate_news_page_content() {
        $response = wp_remote_get( 'http://blog.cybercraftit.com/api/get_category_posts?slug=news&count=10' );
        $response = $response['body'];
        $response = json_decode($response,true);

        if( $response['status'] == 'ok' ) {

            if( isset($response['posts'] ) ) {
                $contents = $response['posts'];
                ?>
                <div class="cc_news_container">
                    <h1>
                        <?php _e('Latest News','cc'); ?>
                    </h1>
                    <?php foreach ( $contents as $k => $content ) { ?>
                    <div class="each_container">
                        <h3><a href="<?php echo $content['url']; ?>"><?php echo $content['title']; ?></a></h3>
                        <div class="content">
                            <?php echo nl2br($content['content']); ?>
                        </div>
                    </div>
                <?php } ?>
                </div>
                <?php
            }
        }


    }

    public function admin_print_script_style() {
        ?>
        <style>
            .cc_news_container h1{
                text-align: center;
                margin:30px 0;
            }
            .cc_news_container .each_container{
                background: #fff;
                padding: 5px 30px;
                margin-bottom: 20px;
            }
            .each_container a{
                color: #444;
                text-decoration: none;
            }
            .each_container p{
                line-height: 30px;
                font-size: 16px;
            }
            .each_container h3{
                font-size: 24px;
            }
            .cc_news_container h1{
                font-size:30px;
            }

        </style>
        <script>


            window.onload = function () {
                (function ($) {
                    $(document).on('click','.cc_news_notice .notice-dismiss',function () {
                        $.post(
                            ajaxurl,
                            {
                                action: 'sm_dissmiss_news_notice',
                                dismiss: true,
                                last_news_date: $(':hidden[name="cc_last_news_date"]').val()
                            },
                            function (data) {
                                console.log(data);
                            }
                        )
                    })
                }(jQuery));
            }

        </script>
<?php
    }
}

CC_News::get_instance();

