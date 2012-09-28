<?php 
function pointelle_ss_get_sliders(){
	global $wpdb,$table_prefix;
	$slider_meta = $table_prefix.POINTELLE_SLIDER_META; 
	$sql = "SELECT * FROM $slider_meta";
 	$sliders = $wpdb->get_results($sql, ARRAY_A);
	return $sliders;
}
function pointelle_get_slider_posts_in_order($slider_id) {
    global $wpdb, $table_prefix;
	$table_name = $table_prefix.POINTELLE_SLIDER_TABLE;
	$slider_posts = $wpdb->get_results("SELECT * FROM $table_name WHERE slider_id = '$slider_id' ORDER BY slide_order ASC, date DESC", OBJECT);
	return $slider_posts;
}
function get_pointelle_slider_name($slider_id) {
    global $wpdb, $table_prefix;
	$table_name = $table_prefix.POINTELLE_SLIDER_META;
	$slider_obj = $wpdb->get_results("SELECT * FROM $table_name WHERE slider_id = '$slider_id'", OBJECT);
	$slider_name = $slider_obj->slider_name;
	return $slider_name;
}
function pointelle_ss_get_post_sliders($post_id){
    global $wpdb,$table_prefix;
	$slider_table = $table_prefix.POINTELLE_SLIDER_TABLE; 
	$sql = "SELECT * FROM $slider_table 
	        WHERE post_id = '$post_id';";
	$post_sliders = $wpdb->get_results($sql, ARRAY_A);
	return $post_sliders;
}
function pointelle_ss_post_on_slider($post_id,$slider_id){
    global $wpdb,$table_prefix;
	$slider_postmeta = $table_prefix.POINTELLE_SLIDER_POST_META;
    $sql = "SELECT * FROM $slider_postmeta  
	        WHERE post_id = '$post_id' 
			AND slider_id = '$slider_id';";
	$result = $wpdb->query($sql);
	if($result == 1) { return TRUE; }
	else { return FALSE; }
}
function pointelle_ss_slider_on_this_post($post_id){
    global $wpdb,$table_prefix;
	$slider_postmeta = $table_prefix.POINTELLE_SLIDER_POST_META;
    $sql = "SELECT * FROM $slider_postmeta  
	        WHERE post_id = '$post_id';";
	$result = $wpdb->query($sql);
	if($result == 1) { return TRUE; }
	else { return FALSE; }
}
//Checks if the post is already added to slider
function pointelle_slider($post_id,$slider_id = '1') {
	global $wpdb, $table_prefix;
	$table_name = $table_prefix.POINTELLE_SLIDER_TABLE;
	$check = "SELECT id FROM $table_name WHERE post_id = '$post_id' AND slider_id = '$slider_id';";
	$result = $wpdb->query($check);
	if($result == 1) { return TRUE; }
	else { return FALSE; }
}
function is_post_on_any_pointelle_slider($post_id) {
	global $wpdb, $table_prefix;
	$table_name = $table_prefix.POINTELLE_SLIDER_TABLE;
	$check = "SELECT post_id FROM $table_name WHERE post_id = '$post_id' LIMIT 1;";
	$result = $wpdb->query($check);
	if($result == 1) { return TRUE; }
	else { return FALSE; }
}
function is_pointelle_slider_on_slider_table($slider_id) {
	global $wpdb, $table_prefix;
	$table_name = $table_prefix.POINTELLE_SLIDER_TABLE;
	$check = "SELECT * FROM $table_name WHERE slider_id = '$slider_id' LIMIT 1;";
	$result = $wpdb->query($check);
	if($result == 1) { return TRUE; }
	else { return FALSE; }
}
function is_pointelle_slider_on_meta_table($slider_id) {
	global $wpdb, $table_prefix;
	$table_name = $table_prefix.POINTELLE_SLIDER_META;
	$check = "SELECT * FROM $table_name WHERE slider_id = '$slider_id' LIMIT 1;";
	$result = $wpdb->query($check);
	if($result == 1) { return TRUE; }
	else { return FALSE; }
}
function is_pointelle_slider_on_postmeta_table($slider_id) {
	global $wpdb, $table_prefix;
	$table_name = $table_prefix.POINTELLE_SLIDER_POST_META;
	$check = "SELECT * FROM $table_name WHERE slider_id = '$slider_id' LIMIT 1;";
	$result = $wpdb->query($check);
	if($result == 1) { return TRUE; }
	else { return FALSE; }
}
function get_pointelle_slider_for_the_post($post_id) {
    global $wpdb, $table_prefix;
	$table_name = $table_prefix.POINTELLE_SLIDER_POST_META;
	$sql = "SELECT slider_id FROM $table_name WHERE post_id = '$post_id' LIMIT 1;";
	$slider_postmeta = $wpdb->get_row($sql, ARRAY_A);
	$slider_id = $slider_postmeta['slider_id'];
	return $slider_id;
}
function pointelle_slider_word_limiter( $text, $limit = 50 , $dots='' ) {
    $text = str_replace(']]>', ']]&gt;', $text);
	//Not using strip_tags as to accomodate the 'retain html tags' feature
	//$text = strip_tags($text);
	
    $explode = explode(' ',$text);
    $string  = '';

    if(count($explode) <= $limit){
        $dots = '';
    }
    for($i=0;$i<$limit;$i++){
        $string .= $explode[$i]." ";
    }
    if ($dots) {
        $string = substr($string, 0, strlen($string));
    }
    return $string.$dots;
}
function pointelle_sslider_admin_url( $query = array() ) {
	global $plugin_page;

	if ( ! isset( $query['page'] ) )
		$query['page'] = $plugin_page;

	$path = 'admin.php';

	if ( $query = build_query( $query ) )
		$path .= '?' . $query;

	$url = admin_url( $path );

	return esc_url_raw( $url );
}
function pointelle_slider_table_exists($table, $db) { 
	$tables = mysql_list_tables ($db); 
	while (list ($temp) = mysql_fetch_array ($tables)) {
		if ($temp == $table) {
			return TRUE;
		}
	}
	return FALSE;
}
?>