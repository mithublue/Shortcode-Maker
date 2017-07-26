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


    public static function render_post_loop() {



        $args = array(

//////Author Parameters - Show posts associated with certain author.
            'author' => 1,2,3,                        //(int) - use author id [use minus (-) to exclude authors by ID ex. 'author' => -1,-2,-3,]
            'author_name' => '',              //(string) - use 'user_nicename' (NOT name)

//////Category Parameters - Show posts associated with certain categories.
            'cat' => 5,//(int) - use category id.
            'category_name' => 'staff', 'news',       //(string) - use category slug (NOT name).
            'category__and' => array( 2, 6 ),         //(array) - use category id.
            'category__in' => array( 2, 6 ),          //(array) - use category id.
            'category__not_in' => array( 2, 6 ),      //(array) - use category id.

//////Tag Parameters - Show posts associated with certain tags.
            'tag' => 'cooking',                       //(string) - use tag slug.
            'tag_id' => 5,                            //(int) - use tag id.
            'tag__and' => array( 2, 6),               //(array) - use tag ids.
            'tag__in' => array( 2, 6),                //(array) - use tag ids.
            'tag__not_in' => array( 2, 6),            //(array) - use tag ids.
            'tag_slug__and' => array( 'red', 'blue'), //(array) - use tag slugs.
            'tag_slug__in' => array( 'red', 'blue'),  //(array) - use tag slugs.

//////Taxonomy Parameters - Show posts associated with certain taxonomy.
            //Important Note: tax_query takes an array of tax query arguments arrays (it takes an array of arrays)
            //This construct allows you to query multiple taxonomies by using the relation parameter in the first (outer) array to describe the boolean relationship between the taxonomy queries.
            'tax_query' => array(                     //(array) - use taxonomy parameters (available with Version 3.1).
                'relation' => 'AND',                      //(string) - Possible values are 'AND' or 'OR' and is the equivalent of ruuning a JOIN for each taxonomy
                array(
                    'taxonomy' => 'color',                //(string) - Taxonomy.
                    'field' => 'slug',                    //(string) - Select taxonomy term by ('id' or 'slug')
                    'terms' => array( 'red', 'blue' ),    //(int/string/array) - Taxonomy term(s).
                    'include_children' => true,           //(bool) - Whether or not to include children for hierarchical taxonomies. Defaults to true.
                    'operator' => 'IN'                    //(string) - Operator to test. Possible values are 'IN', 'NOT IN', 'AND'.
                ),
                array(
                    'taxonomy' => 'actor',
                    'field' => 'id',
                    'terms' => array( 103, 115, 206 ),
                    'include_children' => false,
                    'operator' => 'NOT IN'
                )
            ),
//////Post & Page Parameters - Display content based on post and page parameters.
            'p' => 1,                               //(int) - use post id.
            'name' => 'hello-world',                //(string) - use post slug.
            'page_id' => 1,                         //(int) - use page id.
            'pagename' => 'sample-page',            //(string) - use page slug.
            'pagename' => 'contact_us/canada',      //(string) - Display child page using the slug of the parent and the child page, separated ba slash
            'post_parent' => 1,                     //(int) - use page id. Return just the child Pages.
            'post__in' => array(1,2,3),             //(array) - use post ids. Specify posts to retrieve.
            'post__not_in' => array(1,2,3),         //(array) - use post ids. Specify post NOT to retrieve.
            //NOTE: you cannot combine 'post__in' and 'post__not_in' in the same query
//////Type & Status Parameters - Show posts associated with certain type or status.
            'post_type' => array(                   //(string / array) - use post types. Retrieves posts by Post Types, default value is 'post';
                'post',                         // - a post.
                'page',                         // - a page.
                'revision',                     // - a revision.
                'attachment',                   // - an attachment. The default WP_Query sets 'post_status'=>'published', but atchments default to 'post_status'=>'inherit' so you'll need to set the status to 'inherit' or 'any'.
                'my-post-type',                 // - Custom Post Types (e.g. movies)
            ),
            'post_status' => array(                 //(string / array) - use post status. Retrieves posts by Post Status, default value i'publish'.
                'publish',                      // - a published post or page.
                'pending',                      // - post is pending review.
                'draft',                        // - a post in draft status.
                'auto-draft',                   // - a newly created post, with no content.
                'future',                       // - a post to publish in the future.
                'private',                      // - not visible to users who are not logged in.
                'inherit',                      // - a revision. see get_children.
                'trash'                         // - post is in trashbin (available with Version 2.9).
            ),
            //NOTE: The 'any' keyword available to both post_type and post_status queries cannot be used within an array.
            'post_type' => 'any',                    // - retrieves any type except revisions and types with 'exclude_from_search' set to true.
            'post_status' => 'any',                  // - retrieves any status except those from post types with 'exclude_from_search' set to true.

//////Pagination Parameters
            'posts_per_page' => 10,                 //(int) - number of post to show per page (available with Version 2.1). Use 'posts_per_page'=-1 to show all posts. Note if the query is in a feed, wordpress overwrites this parameter with the stored 'posts_per_rss' option. Treimpose the limit, try using the 'post_limits' filter, or filter 'pre_option_posts_per_rss' and return -1
            'posts_per_archive_page' => 10,         //(int) - number of posts to show per page - on archive pages only. Over-rides showposts anposts_per_page on pages where is_archive() or is_search() would be true
            'nopaging' => false,                    //(bool) - show all posts or use pagination. Default value is 'false', use paging.
            'paged' => get_query_var('page'),       //(int) - number of page. Show the posts that would normally show up just on page X when usinthe "Older Entries" link.
            //NOTE: You should set get_query_var( 'page' ); if you want your query to work with pagination. Since Wordpress 3.0.2, you dget_query_var( 'page' ) instead of get_query_var( 'paged' ). The pagination parameter 'paged' for WP_Query() remains the same.
//////Offset Parameter
            'offset' => 3,                          //(int) - number of post to displace or pass over.
//////Order & Orderby Parameters - Sort retrieved posts.
            'order' => 'DESC',                      //(string) - Designates the ascending or descending order of the 'orderby' parameter. Defaultto 'DESC'.
            //Possible Values:
            //'ASC' - ascending order from lowest to highest values (1, 2, 3; a, b, c).
            //'DESC' - descending order from highest to lowest values (3, 2, 1; c, b, a).
            'orderby' => 'date',                    //(string) - Sort retrieved posts by parameter. Defaults to 'date'.
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


//////Sticky Post Parameters - Show Sticky Posts or ignore them.
            'ignore_sticky_posts' => false,         //(bool) - ignore sticky posts or not. Default value is false, don't ignore. Ignore/excludsticky posts being included at the beginning of posts returned, but the sticky post will still be returned in the natural order othat list of posts returned.
            //NOTE: For more info on sticky post queries see: http://codex.wordpress.org/Class_Reference/WP_Query#Sticky_Post_Parameters


//////Time Parameters - Show posts associated with a certain time period.
            'year' => 2012,                         //(int) - 4 digit year (e.g. 2011).
            'monthnum' => 3,                        //(int) - Month number (from 1 to 12).
            'w' =>  25,                             //(int) - Week of the year (from 0 to 53). Uses the MySQL WEEK command. The mode is dependenon the "start_of_week" option.
            'day' => 17,                            //(int) - Day of the month (from 1 to 31).
            'hour' => 13,                           //(int) - Hour (from 0 to 23).
            'minute' => 19,                         //(int) - Minute (from 0 to 60).
            'second' => 30,                         //(int) - Second (0 to 60).
//////Custom Field Parameters - Show posts associated with a certain custom field.
            'meta_key' => 'key',                    //(string) - Custom field key.
            'meta_value' => 'value',                //(string) - Custom field value.
            'meta_value_num' => 10,                 //(number) - Custom field value.
            'meta_compare' => '=',                  //(string) - Operator to test the 'meta_value'. Possible values are '!=', '>', '>=', '<', or ='. Default value is '='.
            'meta_query' => array(                  //(array) - Custom field parameters (available with Version 3.1).
                array(
                    'key' => 'color',                  //(string) - Custom field key.
                    'value' => 'blue',                 //(string/array) - Custom field value (Note: Array support is limited to a compare value of 'IN', 'NOT IN', 'BETWEEN', or 'NOT BETWEEN')
                    'type' => 'CHAR',                  //(string) - Custom field type. Possible values are 'NUMERIC', 'BINARY', 'CHAR', 'DATE', 'DATETIME', 'DECIMAL', 'SIGNED', 'TIME', 'UNSIGNED'. Default value is 'CHAR'.
                    'compare' => '=',                  //(string) - Operator to test. Possible values are '=', '!=', '>', '>=', '<', '<=', 'LIKE', 'NOT LIKE', 'IN', 'NOT IN', 'BETWEEN', 'NOT BETWEEN'. Default value is '='.
                ),
                array(
                    'key' => 'price',
                    'value' => array( 1,200 ),
                    'compare' => 'NOT LIKE'
                )
            ),

//////Permission Parameters - Display published posts, as well as private posts, if the user has the appropriate capability:
    'perm' => 'readable',                    //(string) Possible values are 'readable', 'editable' (possible more ie all capabilitiealthough I have not tested)
//////Parameters relating to caching
    'no_found_rows' => false,               //(bool) Default is false. WordPress uses SQL_CALC_FOUND_ROWS in most queries in order timplement pagination. Even when you donâ€™t need pagination at all. By Setting this parameter to true you are telling wordPress not tcount the total rows and reducing load on the DB. Pagination will NOT WORK when this parameter is set to true. For more informatiosee: http://flavio.tordini.org/speed-up-wordpress-get_posts-and-query_posts-functions
    'cache_results' => true,                //(bool) Default is true
    'update_post_term_cache' => true,       //(bool) Default is true
    'update_post_meta_cache' => true,       //(bool) Default is true
    //NOTE Caching is a good thing. Setting these to false is generally not advised. For more info on usage see: http://codex.wordpresorg/Class_Reference/WP_Query#Permission_Parameters
//////Search Parameter
    's' => '',                              //(string) - Passes along the query string variable from a search. For example usage see: http://www.wprecipes.com/how-to-display-the-number-of-results-in-wordpress-search
    'exact' => true,                         //(bool) - flag to make it only match whole titles/posts - Default value is false. For more information see: https://gist.github.com/2023628#gistcomment-285118
    'sentence' => true,                      //(bool) - flag to make it do a phrase search - Default value is false. For more information see: https://gist.github.com/2023628#gistcomment-285118
//////Post Field Parameters
    //Not sure what these do. For more info see: http://codex.wordpress.org/Class_Reference/WP_Query#Post_Field_Parameters
//////Filters
    //For more information on available Filters see: http://codex.wordpress.org/Class_Reference/WP_Query#Filters
);
    }


    public static function __callStatic ($method, $args) {
        do_action( 'smps_reder_shortcode', $method, $args);
        return false;
    }
}