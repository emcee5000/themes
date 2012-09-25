<?php

// Enable Thumbnails

add_theme_support( 'post-thumbnails');
set_post_thumbnail_size( 250, 250 ); // 250 pixels wide by 250 pixels tall, box resize mode
// additional image sizes
// delete the next line if you do not need additional image sizes
add_image_size( 'category-thumb', 600, 999, true ); //300 pixels wide (and unlimited height)


// Make theme available for translation
// Translations can be filed in the /languages/ directory
load_theme_textdomain( 'your-theme', TEMPLATEPATH . '/languages' );

$locale = get_locale();
$locale_file = TEMPLATEPATH . "/languages/$locale.php";
if ( is_readable($locale_file) )
        require_once($locale_file);


// Get the page number
function get_page_number() {
    if (get_query_var('paged')) {
        print ' | ' . __( 'Page ' , 'your-theme') . get_query_var('paged');
    }
} // end get_page_number


// THIS INCLUDES THE THUMBNAIL IN OUR RSS FEED
function insertThumbnailRSS($content) {
global $post;
if ( has_post_thumbnail( $post->ID ) ){
$content = '' . get_the_post_thumbnail( $post->ID, 'thumbnail' ) . '' . $content;
}
return $content;
}

add_filter('the_excerpt_rss', 'insertThumbnailRSS');
add_filter('the_content_feed', 'insertThumbnailRSS');

// For category lists on category archives: Returns other categories except the current one (redundant)
function cats_meow($glue) {
        $current_cat = single_cat_title( '', false );
        $separator = "\n";
        $cats = explode( $separator, get_the_category_list($separator) );
        foreach ( $cats as $i => $str ) {
                if ( strstr( $str, ">$current_cat<" ) ) {
                        unset($cats[$i]);
                        break;
                }
        }
        if ( empty($cats) )
                return false;

        return trim(join( $glue, $cats ));
} // end cats_meow


// For tag lists on tag archives: Returns other tags except the current one (redundant)
function tag_ur_it($glue) {
        $current_tag = single_tag_title( '', '',  false );
        $separator = "\n";
        $tags = explode( $separator, get_the_tag_list( "", "$separator", "" ) );
        foreach ( $tags as $i => $str ) {
                if ( strstr( $str, ">$current_tag<" ) ) {
                        unset($tags[$i]);
                        break;
                }
        }
        if ( empty($tags) )
                return false;

        return trim(join( $glue, $tags ));
} // end tag_ur_it



/***  WIDGETS  ***/
// Check if widget area is active   source: http://themeshaper.com/registering-new-sidebars-for-custom-page-templates-the-smart-way/
function is_pagetemplate_active($pagetemplate = '') {
 global $wpdb;
 $sql = "select meta_key from $wpdb->postmeta where meta_key like '_wp_page_template' and meta_value like '" . $pagetemplate . "'";
 $result = $wpdb->query($sql);
 if ($result) { return TRUE; } else { return FALSE; } } // is_pagetemplate_active()
// Register widgetized areas
if ( function_exists('register_sidebars') ) {
        register_sidebar(array(
        'name' => 'Sidebar',
        'id' => 'sidebar-widgetarea',
        'description' => __('This is right sidebar & is the primary widget area.', 'sidebar-widgetarea'),
        'before_widget' => '<div id="%1$s" class="%2$s widget sidebar-widget">',
        'after_widget' => "</div>",
        'before_title' => '<h3 class="widget-title sidebar-widget-title">',
        'after_title' => '</h3>' ));  
 
        register_sidebar(array(
        'name' => 'SidebarInside',
        'id' => 'sidebarinside-widgetarea',
        'description' => __('Widget area for the inside pages.', 'footerL-widgetarea'),
        'before_widget' => '<section id="fwal"><div id="%1$s" class="%2$s widget footer-widget fw-left">',
        'after_widget' => '</div></section>',
        'before_title' => '<h3 class="widget-title footer-widget-title fw-left-title">',
        'after_title' => '</h3>' ));
/*
        register_sidebar(array(
        'name' => 'Footer, middle left',
        'id' => 'footerml-widgetarea',
        'description' => __('Widget area for the footer, middle left side.', 'footerML-widgetarea'),
        'before_widget' => '<section id="fwar"><div id="%1$s" class="widget %2$s fw-rightblock">',
        'after_widget' => '</div></section>',
        'before_title' => '<h3 class="widgettitle fw-rightblock-title">',
        'after_title' => '</h3>',       ));
 
        register_sidebar(array(
        'name' => 'Footer, middle right',
        'id' => 'footermr-widgetarea',
        'description' => __('Widget area for the footer, middle right side.', 'footerMR-widgetarea'),
        'before_widget' => '<section id="fwar"><div id="%1$s" class="widget %2$s fw-rightblock">',
        'after_widget' => '</div></section>',
        'before_title' => '<h3 class="widgettitle fw-rightblock-title">',
        'after_title' => '</h3>',       ));
       
        register_sidebar(array(
        'name' => 'Footer, right',
        'id' => 'footerr-widgetarea',
        'description' => __('Widget area for the footer, right side.', 'footerR-widgetarea'),
        'before_widget' => '<section id="fwar"><div id="%1$s" class="widget %2$s fw-rightblock">',
        'after_widget' => '</div></section>',
        'before_title' => '<h3 class="widgettitle fw-rightblock-title">',
        'after_title' => '</h3>',       ));
*/
           
function emp_template_widgets_init() {    
  if(is_pagetemplate_active('page-altsidebar.php') || is_pagetemplate_active('page-altsidebar-noslidertimecomments.php') ||
         is_pagetemplate_active('page-altsidebar-nothingelse.php') ) {            
  register_sidebar( array (
        'name' => 'Page Template - Alternate',
        'id' => 'sidebaralt-widgetarea',
        'description' => __('This is the sidebar for an alternative sidebar page template.', 'sidebarAlt-widgetarea'),
        'before_widget' => '<div id="%1$s" class="%2$s widget sidebarAlt-widget">',
        'after_widget' => "</div>",
        'before_title' => '<h3 class="widget-title sidebarAlt-widget-title">',
        'after_title' => '</h3>' ));  
 } // end test for active template
 
 if(is_pagetemplate_active('page-WPECsidebar.php')) {            
  register_sidebar( array (
        'name' => 'Page Template - WPEC',
        'id' => 'sidebarwpec-widgetarea',
        'description' => __('This is the sidebar for a WPEC page.', 'sidebarWPEC-widgetarea'),
        'before_widget' => '<div id="%1$s" class="%2$s widget sidebarWPEC-widget">',
        'after_widget' => "</div>",
        'before_title' => '<h3 class="widget-title sidebarWPEC-widget-title">',
        'after_title' => '</h3>' ));  
 } // end test for active template
} // test_template_widgets_init()
add_action ( 'init' , 'emp_template_widgets_init' );
 
        register_sidebar( array(
                'name' => 'Page Template - 404',
                'id' => '404-widgetarea',
                'description' => __('Widget area for 404 error pages.', '404'),
                'before_widget' => '<div id="%1$s" class="%2$s widget 404-widget">',
                'after_widget' => '</div>',
                'before_title' => '<h3 class="widget-title 404-widget-title">',
                'after_title' => '</h3>'        ));
} // end widget areas





//// Register widgetized areas
//function theme_widgets_init() {
//
//// Area 1
//
//	register_sidebar( array(
//		'name' => __( 'Main Sidebar', 'twentyeleven' ),
//		'id' => 'sidebar-1',
//		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
//		'after_widget' => "</aside>",
//		'before_title' => '<h3 class="widget-title">',
//		'after_title' => '</h3>',
//	) );
//
//  //register_sidebar( array (
//  //'name' => 'Primary Widget Area',
//  //'id' => 'primary_widget_area',
//  //'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
//  //'after_widget' => "</li>",
//  //      'before_title' => '<h3 class="widget-title">',
//  //      'after_title' => '</h3>',
//  //) );
//  //
//  //      // Area 2
//  //register_sidebar( array (
//  //'name' => 'Secondary Widget Area',
//  //'id' => 'secondary_widget_area', 
//  //'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
//  //'after_widget' => "</li>",
//  //      'before_title' => '<h3 class="widget-title">',
//  //      'after_title' => '</h3>',
//  //) );
//} // end theme_widgets_init
//
//add_action( 'widgets_init', 'theme_widgets_init' );




// Produces an avatar image with the hCard-compliant photo class
function commenter_link() {
        $commenter = get_comment_author_link();
        if ( ereg( '<a[^>]* class=[^>]+>', $commenter ) ) {
                $commenter = ereg_replace( '(<a[^>]* class=[\'"]?)', '\\1url ' , $commenter );
        } else {
                $commenter = ereg_replace( '(<a )/', '\\1class="url "' , $commenter );
        }
        $avatar_email = get_comment_author_email();
        $avatar = str_replace( "class='avatar", "class='photo avatar", get_avatar( $avatar_email, 80 ) );
        echo $avatar . ' <span class="fn n">' . $commenter . '</span>';
} // end commenter_link


// Custom callback to list comments in the your-theme style
function custom_comments($comment, $args, $depth) {
  $GLOBALS['comment'] = $comment;
        $GLOBALS['comment_depth'] = $depth;
  ?>
        <li id="comment-<?php comment_ID() ?>" <?php comment_class() ?>>
                <div class="comment-author vcard"><?php commenter_link() ?></div>
                <div class="comment-meta"><?php printf(__('Posted %1$s at %2$s <span class="meta-sep">|</span> <a href="%3$s" title="Permalink to this comment">Permalink</a>', 'your-theme'),
                                        get_comment_date(),
                                        get_comment_time(),
                                        '#comment-' . get_comment_ID() );
                                        edit_comment_link(__('Edit', 'your-theme'), ' <span class="meta-sep">|</span> <span class="edit-link">', '</span>'); ?></div>
  <?php if ($comment->comment_approved == '0') _e("\t\t\t\t\t<span class='unapproved'>Your comment is awaiting moderation.</span>\n", 'your-theme') ?>
          <div class="comment-content">
                <?php comment_text() ?>
                </div>
                <?php // echo the comment reply link
                        if($args['type'] == 'all' || get_comment_type() == 'comment') :
                                comment_reply_link(array_merge($args, array(
                                        'reply_text' => __('Reply','your-theme'), 
                                        'login_text' => __('Log in to reply.','your-theme'),
                                        'depth' => $depth,
                                        'before' => '<div class="comment-reply-link">', 
                                        'after' => '</div>'
                                )));
                        endif;
                ?>
<?php } // end custom_comments


// Custom callback to list pings
function custom_pings($comment, $args, $depth) {
       $GLOBALS['comment'] = $comment;
        ?>
                <li id="comment-<?php comment_ID() ?>" <?php comment_class() ?>>
                        <div class="comment-author"><?php printf(__('By %1$s on %2$s at %3$s', 'your-theme'),
                                        get_comment_author_link(),
                                        get_comment_date(),
                                        get_comment_time() );
                                        edit_comment_link(__('Edit', 'your-theme'), ' <span class="meta-sep">|</span> <span class="edit-link">', '</span>'); ?></div>
    <?php if ($comment->comment_approved == '0') _e('\t\t\t\t\t<span class="unapproved">Your trackback is awaiting moderation.</span>\n', 'your-theme') ?>
            <div class="comment-content">
                        <?php comment_text() ?>
                        </div>
<?php } // end custom_pings