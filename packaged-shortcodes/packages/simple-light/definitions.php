<?php
$items = Smps_Simple_Light::settings()['items'];
foreach ( $items as $item => $label ) {
    add_shortcode( 'smps_sl_'.$item, array( 'Smps_Simple_Light_Shortcodes', 'render_'.$item ) );
}

class Smps_Simple_Light_Shortcodes {

    public static function render_tabs( $atts, $content, $tag ) {

        $atts = shortcode_atts( array(
            'data' => '{}'
        ), $atts, $tag );

        $data = json_decode(stripslashes(urldecode($atts['data'])),true);

        ?>
        <div class="bs-container">
            <!-- Nav tabs -->
            <ul class="nav nav-<?php echo $data['type']; ?>">
                <?php
                $output = '';
                $i = 0;
                foreach ( $data['tab_data'] as $tab_key => $tab ) : $i++; ?>
                    <li class="<?php echo $i == 1? 'active':''; ?>"><a href="#<?php echo $tab_key ; ?>" data-toggle="tab"><?php echo $tab['title']; ?></a>
                    </li>
                    <?php
                    ob_start();
                    ?>
                    <div class="tab-pane fade <?php echo $i == 1? 'in active':''; ?>" id="<?php echo $tab_key; ?>">
                        <?php echo nl2br($tab['content']); ?>
                    </div>
                    <?php
                    $output .= ob_get_contents();
                    ob_end_clean();
                    ?>
                <?php endforeach; ?>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <?php echo $output; ?>
            </div>
        </div>
<?php
    }

    public static function render_accordion( $atts, $content, $tag ) {

        $atts = shortcode_atts( array(
            'data' => '{}'
        ), $atts, $tag );

        $data = json_decode(stripslashes(urldecode($atts['data'])),true);

        ?>
        <div class="bs-container">
            <div class="panel-group" id="accordion">
                <?php
                $output = '';
                $i = 0;
                foreach ( $data['acc_data'] as $acc_key => $accordion ) : $i++; ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#<?php echo $acc_key; ?>"><?php echo $accordion['title']; ?></a>
                            </h4>
                        </div>
                        <div id="<?php echo $acc_key; ?>" class="panel-collapse collapse <?php echo isset( $data['opened_tab'] ) && $i == $data['opened_tab'] ? 'in' : ''; ?>">
                            <div class="panel-body">
                                <?php echo $accordion['content']; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
<?php
    }

    /**
     * Render table
     * @param $atts
     * @param $content
     * @param $tag
     */
    public static function render_table( $atts, $content, $tag ) {

        $atts = shortcode_atts( array(
            'data' => '{}'
        ), $atts, $tag );

        $data = json_decode(stripslashes(urldecode($atts['data'])),true);
        ?>
        <div class="bs-container">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <!--<thead>
                    <tr>
                        <?php /*foreach ( $atts['table_data']['thead'] as $key => $label ) : */?>
                        <th><?php /*echo $label; */?></th>
                        <?php /*endforeach;*/?>
                    </tr>
                    </thead>-->
                    <tbody>
                    <?php foreach ( $data['table_data']/*['tbody']*/ as $key => $tr ) : ?>
                        <tr>
                            <?php foreach ( $tr as $k => $td ) : ?>
                                <td><?php echo $td; ?></td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php
    }


    public static function render_panel( $atts, $content, $tag ) {
        $atts = shortcode_atts( array(
            'data' => '{}'
        ), $atts, $tag );

        $data = json_decode(stripslashes(urldecode($atts['data'])),true);

        ?>
        <div class="bs-container">
            <div class="panel panel-<?php echo $data['type']; ?>">
                <?php if( !empty( $data['header'] ) ) : ?>
                    <div class="panel-heading text-<?php echo $data['header_alignment']; ?>">
                        <?php echo $data['header']; ?>
                    </div>
                <?php endif; ?>
                <?php if( !empty( $data['body'] ) ) : ?>
                    <div class="panel-body">
                        <?php echo nl2br($data['body']); ?>
                    </div>
                <?php endif; ?>
                <?php if( !empty( $data['footer'] ) ) : ?>
                    <div class="panel-footer text-<?php echo $data['footer_alignment']; ?>">
                        <?php echo $data['footer']; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php
    }

    public static function render_alert( $atts, $content, $tag ) {

        $atts = shortcode_atts( array(
            'data' => '{}'
        ), $atts, $tag );

        $data = json_decode(stripslashes(urldecode($atts['data'])),true);
        ?>
        <div class="bs-container">
            <div class="alert alert-<?php echo $data['type']; ?> alert-<?php echo $data['dismissable'] == 'true' ? 'dismissable' : ''; ?>">
                <?php if( $data['dismissable'] == 'true' ) : ?>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?php endif; ?>
                <?php echo $data['content']; ?>
            </div>
        </div>
    <?php
    }


    public static function render_heading( $atts, $content, $tag ) {

        //
        $atts = shortcode_atts( array(
            'data' => '{}'
        ), $atts, $tag );

        $data = json_decode(stripslashes(urldecode($atts['data'])),true);
        ?>
        <div class="bs-container">
            <<?php echo $data['type'] ; ?> class="text-<?php echo $data['text_align'];?>"><?php echo $data['text'];?></<?php echo $data['type'];?>>
        </div>
    <?php
    }

    /**
     * quote
     * @param $atts
     * @param $content
     * @param $tag
     */
    public static function render_quote( $atts, $content, $tag ) {
        $atts = shortcode_atts( array(
            'data' => '{}'
        ), $atts, $tag );

        $data = json_decode(stripslashes(urldecode($atts['data'])),true);
        ?>
        <div class="bs-container">
            <blockquote class="pull-<?php echo $data['alignment'];?>">
                <p><?php echo $data['quote']; ?></p>
                <?php if( $data['author'] ) : ?>
                    <small><?php echo $data['author']; ?>
                        <!--<cite title="Source Title">Source Title</cite>-->
                    </small>
                <?php endif; ?>
            </blockquote>
        </div>
    <?php
    }

    /**
     * button
     * @param $atts
     * @param $content
     * @param $tag
     */
    public static function render_button( $atts, $content, $tag ) {
        $atts = shortcode_atts( array(
            'data' => '{}'
        ), $atts, $tag );

        $data = json_decode(stripslashes(urldecode($atts['data'])),true);
        ?>
        <div class="bs-container" style="display: inline;">
            <?php
            switch ( $data['redirection_type'] ) {
                case 'url' :
                    $redirect_to = $data['url'];
                    break;
                case 'same_page' :
                    $redirect_to = '';
                    break;
                case 'to_page' :
                    $redirect_to = get_permalink($data['page']);
                    break;
            }
            ?>
            <a href="<?php echo $redirect_to; ?>" <?php echo $data['open_newtab'] == 'true' ? 'target="_blank"' : '' ;?> class="btn btn-<?php echo $data['type']; ?> btn-<?php echo $data['size']; ?> <?php echo $data['shape'] == 'normal' ? 'br0' : ''; ?>">
                <?php
                if( $data['icon'] == 'true' ) :
                    ?>
                    <i class="glyphicon glyphicon-<?php echo $data['icon']; ?>"></i>
                    <?php
                    endif;
                ?>
                <?php echo $data['enable_text'] == 'true' ? $data['text'] : ''; ?>
            </a>
        </div>
        <?php
    }


    /**
     * Spoiler
     * @param $atts
     * @param $content
     * @param $tag
     */
    public static function render_spoiler( $atts, $content, $tag ) {

        $atts = shortcode_atts( array(
            'data' => '{}'
        ), $atts, $tag );

        $data = json_decode(stripslashes(urldecode($atts['data'])),true);
        ?>
        <div class="bs-container sm-spoiler">
            <div class="panel panel-<?php echo $data['style']; ?> <?php echo $data['is_open'] == 'yes' ? 'sm-open' : 'sm-close'; ?>">
                <div class="panel-heading"><i class="fa fa-plus sm-heading-open"></i><i class="fa fa-minus sm-heading-close"></i> <?php echo $data['title']; ?></div>
                <div class="panel-body sm-spoiler-body">
                    <?php echo $data['content']; ?>
                </div>
            </div>
        </div>
<?php

    }

    /**
     * list
     * @param $atts
     * @param $content
     * @param $tag
     */
    public static function render_list( $atts, $content, $tag ) {
        $atts = shortcode_atts( array(
            'data' => '{}'
        ), $atts, $tag );

        $data = json_decode(stripslashes(urldecode($atts['data'])),true);


        echo '<'.$data['list_type'].' class="'.$data['class'].'" id="'.$data['id'].'">';
        foreach ( $data['items'] as $item ) {
            echo '<li>'.$item['label'].'</li>';
        }
        echo '</'.$data['list_type'].'>';

        /*list shortcode definition goes here*/

    }

    /**
     * Highlight
     * @param $atts
     * @param $content
     * @param $tag
     */
    public static function render_highlight( $atts, $content, $tag ) {

        $atts = shortcode_atts( array(
            'data' => '{}'
        ), $atts, $tag );

        $data = json_decode(stripslashes(urldecode($atts['data'])),true);

        /*highlight shortcode definition goes here*/
        echo '<span class="'.$data['class'].'" id="'.$data['id'].'" style="background:'. $data['background'] .';color:'.$data['text_color'].';">' . $data['content'] . '</span>';
    }

    /**
     * Member content (member_content)
     * @param $atts
     * @param $content
     * @param $tag
     */
    public static function render_restricted_content( $atts, $content, $tag ) {

        $atts = shortcode_atts( array(
            'data' => '{}'
        ), $atts, $tag );

        $data = json_decode(stripslashes(urldecode($atts['data'])),true);

        /*memberContent shortcode definition goes here*/
        if( is_user_logged_in() ) {
            echo nl2br($data['restricted_content']);
        } else {
            $data['login_text'] = str_replace( '%login%', '<a href="'.wp_login_url().'">login</a>',$data['login_text']);
            echo '<span style="background:'. $data['bg_color'] .';">'. $data['login_text'] .'</span>';
        }
    }

    /**
     * Note (note)
     * @param $atts
     * @param $content
     * @param $tag
     */
    public static function render_note( $atts, $content, $tag ) {
        $atts = shortcode_atts( array(
            'data' => '{}'
        ), $atts, $tag );

        $data = json_decode(stripslashes(urldecode($atts['data'])),true);

        pri($data);
        /*Note shortcode definition goes here*/
        ?>
        <div class="bs-container">
            <div class="well <?php echo $data['class']; ?>" id="<?php echo $data['Id']; ?>"
            style="background-color: <?php echo $data['bg_color']; ?>; color: <?php echo $data['text_color']; ?>;
                -webkit-border-radius: <?php echo $data['radius']; ?>px;-moz-border-radius: <?php echo $data['radius']; ?>px;border-radius: <?php echo $data['radius']; ?>px;
                "
            ><?php echo $data['content']; ?></div>
        </div>

<?php
    }

    /**
     * Youtube (youtube)
     * @param $atts
     * @param $content
     * @param $tag
     */
    public static function render_youtube( $atts, $content, $tag ) {
        $atts = shortcode_atts( array(
            'data' => '{}'
        ), $atts, $tag );

        $data = json_decode(stripslashes(urldecode($atts['data'])),true);

        /*Youtube shortcode definition goes here*/
        $video_id = ( preg_match( '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $data['url'], $match ) ) ? $match[1] : false;

        if( !$video_id ) return;
        ?>
        <iframe id="ytplayer" class="<?php echo $data['class']; ?>"
                type="text/html"
                width="<?php echo $data['width']; ?>"
                height="<?php echo $data['height']; ?>"
                src="https://www.youtube.com/embed/<?php echo $video_id; ?>?autoplay=<?php echo $data['autoplay'] == 'no' ? 0 : 1; ?>&controls=<?php echo $data['controls']; ?>&autohide=<?php echo $data['autohide']; ?>&loop=<?php echo $data['loop']; ?>&rel=<?php echo $data['related_videos'] == 'no' ? 0 : 1; ?>&fs=<?php echo $data['full_screen_button'] == 'no' ? 0 : 1; ?>&modestbranding=<?php echo $data['modestbranding'] == 'no' ? 0 : 1; ?>"
                frameborder="0"></iframe>
<?php
    }

    /**
     * Vimeo (vimeo)
     * @param $atts
     * @param $content
     * @param $tag
     */
    public static function render_vimeo( $atts, $content, $tag ) {
        $atts = shortcode_atts( array(
            'data' => '{}'
        ), $atts, $tag );

        $data = json_decode(stripslashes(urldecode($atts['data'])),true);

        pri($data);
        /*Vimeo shortcode definition goes here*/
        ?>
        <iframe src="https://player.vimeo.com/video/225888984?autoplay=<?php echo $data['autoplay'] == 'no' ? 0 : 1; ?>&loop=<?php echo $data['loop'] == 'no' ? 0 : 1; ?>"
                id="<?php echo $data['Id'];?>"
                class="<?php echo $data['class'];?>"
                width="<?php echo $data['width']; ?>"
                height="<?php echo $data['height']; ?>"
                frameborder="0"
                webkitallowfullscreen
                mozallowfullscreen
                allowfullscreen></iframe>
<?php
    }

    /**
     * Image (image)
     * @param $atts
     * @param $content
     * @param $tag
     */
    public static function render_image( $atts, $content, $tag ) {
        $atts = shortcode_atts( array(
            'data' => '{}'
        ), $atts, $tag );

        $data = json_decode(stripslashes(urldecode($atts['data'])),true);
pri($data);
        ?>
        <img src="<?php echo $data['src'];?>" width="<?php echo $data['width']?$data['width'] : '';?>" height="<?php echo $data['height']?$data['height']:'';?>"
             class="<?php echo $data['class'];?> <?php echo $data['responsive'] == 'yes' ? 'img-responsive':''; ?>"
             id="<?php echo $data['Id'];?>"
             alt="">
<?php
        /*Image shortcode definition goes here*/
    }

    /**
     * Scheduler (scheduler)
     * @param $atts
     * @param $content
     * @param $tag
     */
    public static function render_scheduler( $atts, $content, $tag ) {
        $atts = shortcode_atts( array(
            'data' => '{}'
        ), $atts, $tag );

        $data = json_decode(stripslashes(urldecode($atts['data'])),true);

        $time = time();
        $viewable = 0;

        foreach ( $data['timespans'] as $key => $timespan ) {
            if( $time >= strtotime($timespan['from'] ) && $time <= strtotime($timespan['to']) ) {
                $viewable = 1;
                break;
            }
        }

        if( $viewable == 1 ) {
            echo $data['content'];
        } else {
            echo $data['alternative_text'];
        }

        /*Image shortcode definition goes here*/
    }


    public static function render_post_loop( $atts, $content, $tag ) {

        $atts = shortcode_atts( array(
            'data' => '{}'
        ), $atts, $tag );

        $data = json_decode(stripslashes(urldecode($atts['data'])),true);

        $args = array();

        $args = array(

//////Author Parameters - Show posts associated with certain author.
            //'author' => 1,2,3,                        //(int) - use author id [use minus (-) to exclude authors by ID ex. 'author' => -1,-2,-3,]
//////Category Parameters - Show posts associated with certain categories.
            //'category__in' => array( 2, 6 ),          //(array) - use category id.
            //'category__not_in' => array( 2, 6 ),      //(array) - use category id.


//////Post & Page Parameters - Display content based on post and page parameters.
            //'p' => 1,                               //(int) - use post id.
            //'name' => 'hello-world',                //(string) - use post slug.
            //'page_id' => 1,                         //(int) - use page id.
            //'pagename' => 'sample-page',            //(string) - use page slug.
            //'pagename' => 'contact_us/canada',      //(string) - Display child page using the slug of the parent and the child page, separated ba slash
            //'post_parent' => 1,                     //(int) - use page id. Return just the child Pages.
            //'post__in' => array(1,2,3),             //(array) - use post ids. Specify posts to retrieve.
            //'post__not_in' => array(1,2,3),         //(array) - use post ids. Specify post NOT to retrieve.
            //NOTE: you cannot combine 'post__in' and 'post__not_in' in the same query

//////Pagination Parameters
            //'paged' => get_query_var('page'),       //(int) - number of page. Show the posts that would normally show up just on page X when usinthe "Older Entries" link.
            //NOTE: You should set get_query_var( 'page' ); if you want your query to work with pagination. Since Wordpress 3.0.2, you dget_query_var( 'page' ) instead of get_query_var( 'paged' ). The pagination parameter 'paged' for WP_Query() remains the same.
//////Offset Parameter
            //'offset' => 3,                          //(int) - number of post to displace or pass over.
//////Order & Orderby Parameters - Sort retrieved posts.
            //Possible Values:
            //'ASC' - ascending order from lowest to highest values (1, 2, 3; a, b, c).
            //'DESC' - descending order from highest to lowest values (3, 2, 1; c, b, a).
            //'orderby' => 'date',                    //(string) - Sort retrieved posts by parameter. Defaults to 'date'.
            //Possible Values://
            //'none' - No order (available with Version 2.8).
            //'ID' - Order by post id. Note the captialization.
            //'author' - Order by author.
            //'title' - Order by title.
            //'date' - Order by date.
            //'modified' - Order by last modified date.
            //'parent' - Order by post/page parent id.
            //'rand' - Random order.
            //'comment_count' - Order by number of comments (available with Version 2.9).
            //'menu_order' - Order by Page Order. Used most often for Pages (Order field in the EdiPage Attributes box) and for Attachments (the integer fields in the Insert / Upload MediGallery dialog), but could be used for any post type with distinct 'menu_order' values (theall default to 0).
            //'meta_value' - Note that a 'meta_key=keyname' must also be present in the query. Note alsthat the sorting will be alphabetical which is fine for strings (i.e. words), but can bunexpected for numbers (e.g. 1, 3, 34, 4, 56, 6, etc, rather than 1, 3, 4, 6, 34, 56 as yomight naturally expect).
            //'meta_value_num' - Order by numeric meta value (available with Version 2.8). Also notthat a 'meta_key=keyname' must also be present in the query. This value allows for numericasorting as noted above in 'meta_value'.
            //'post__in' - Preserve post ID order given in the post__in array (available with Version 3.5).
);

        if( $data['category__in'] ) {
            $args['category__in'] = $data['category__in'];
        }

        if( $data['author'] ) {
            $args['author'] = $data['author'];
        }


        if( $data['posts_per_page'] ) {
            $args['posts_per_page'] = $data['posts_per_page'];
        }

        if( $data['orderby'] ) {
            $args['orderby'] = $data['orderby'];
        }

        /*if( $data['post_type'] ) {
            $args['post_type'] = $data['post_type'];
        }*/

        if( $data['post_status'] ) {
            $args['post_status'] = $data['post_status'];
        }

        if( $data['tag'] ) {
            $args['tag'] = $data['tag'];
        }

        if( $data['order'] ) {
            $args['order'] = $data['order'];
        }

        if( $data['nopaging'] ) {
            $args['nopaging'] = $data['nopaging'];
        }

        $the_query = new WP_Query( $args );
// The Loop
        if ( $the_query->have_posts() ) :
            ?>
            <div class="smps_post_loop">
                <?php
                while ( $the_query->have_posts() ) : $the_query->the_post();
                    echo get_the_ID();
                    ?>
                    <div class="sm_each_post">
                        <div class="thumbnail">
                            <?php the_post_thumbnail(); ?>
                        </div>
                        <div class="title">
                            <?php the_title(); ?>
                        </div>
                        <div>
                            <?php the_content(); ?>
                        </div>
                    </div>
                    <?php
                endwhile; ?>
            </div>
        <?php
        endif;
// Reset Post Data
        wp_reset_postdata();
    }



    /**
     *
     */
    public static function render_page_loop( $atts, $content, $tag ) {

        $atts = shortcode_atts( array(
            'data' => '{}'
        ), $atts, $tag );

        $data = json_decode(stripslashes(urldecode($atts['data'])),true);

    }

    public static function render_post_meta( $atts, $content, $tag ) {

        $atts = shortcode_atts( array(
            'data' => '{}'
        ), $atts, $tag );

        $data = json_decode(stripslashes(urldecode($atts['data'])),true);

    }

    public static function render_option( $atts, $content, $tag ) {

        $atts = shortcode_atts( array(
            'data' => '{}'
        ), $atts, $tag );

        $data = json_decode(stripslashes(urldecode($atts['data'])),true);

    }

    public static function render_category_list( $atts, $content, $tag ) {

        $atts = shortcode_atts( array(
            'data' => '{}'
        ), $atts, $tag );

        $data = json_decode(stripslashes(urldecode($atts['data'])),true);

    }

    public static function render_menu( $atts, $content, $tag ) {

        $atts = shortcode_atts( array(
            'data' => '{}'
        ), $atts, $tag );

        $data = json_decode(stripslashes(urldecode($atts['data'])),true);

    }

    public static function __callStatic ($method, $args) {
        do_action( 'smps_reder_shortcode', $method, $args);
        return false;
    }
}

