<?php
/*
Plugin Name: CommentWidgetizer
Plugin URI: http://www.photos-dauphine.com/wp-commentwidgetizer
Description: This simple widget takes any of the approved comments made on your site and displays it in the sidebar.
Author: www.photos-dauphine.com
Version: 1.0.0
Stable tag: 1.0.0
Author URI: http://www.photos-dauphine.com/
*/

/*  Copyright 2010 PHD - http://www.photos-dauphine.com  (email : http://www.photos-dauphine.com/ecrire )

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

//echo get_bloginfo('wpurl');

// Retrieve plugin version from above header
global $WPCW_SELF_VERSION;
global $WPCW_SELF_VERSION_STABLE;
foreach(array_slice(file(__FILE__), 0, 10) as $line) {$expl = explode(':', $line);  if (trim(current($expl))== 'Version') $WPCW_SELF_VERSION = trim(next($expl)); else if (trim(current($expl))== 'Stable tag') $WPCW_SELF_VERSION_STABLE = trim(next($expl));}

// Load localized language file
$wpcw_dir = basename(dirname(__FILE__));
load_plugin_textdomain('commentwidgetizer', 'wp-content/plugins/' . $wpcw_dir, $wpcw_dir);


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//	Init CommentWidgetizer widget
//
function wpcw_widget($args) {
	
	$wpcw_options = get_option('wpcw_widget');
    extract($args);    //on extrait les variables natives d'affichage telles que $before_widget
	
	$comment = wpwc_get_comment($wpcw_options['comment_source']);
	$message = $comment->content;
	$author = $comment->author;

	echo $before_widget;
    echo $before_title . $wpcw_options['title'] . $after_title;
	// Insert the selected comment
	if (!empty($message)) {
		if (empty($author))
			$author = __('Anonymous', 'commentwidgetizer');
		$author = " <span style=\"font-style:normal\">(" . $author . ")</span>";
	} else {
		$message = __('No comment yet available', 'commentwidgetizer');
		$author = "";
	}
				
	echo "<div class=\"textwidget\" style=\"font-style:italic;font-size:0.9em;padding-top:5px\">" . $message . $author . "</div>";
	
	if (trim($wpcw_options['text']) != '')
		echo '<div class="textwidget">' . $wpcw_options['text'] . '</div>';
		
    echo $after_widget; 
}

//////////////////////
//
function wpcw_widget_control() {
    $options = get_option('wpcw_widget');
	
    if ($_POST["wpcw_widget_submit"]) {
		$options['title'] = strip_tags(stripslashes($_POST["wpcw_widget_title"]));
		$options['comment_source'] = $_POST["wpcw_widget_comment_source"];
		$options['select_mode'] = $_POST["wpcw_widget_select_mode"];
		$options['text'] = stripslashes($_POST["wpcw_widget_text"]);
		update_option('wpcw_widget', $options);
    }
	
    $wpcw_widget_title = htmlspecialchars($options['title'], ENT_QUOTES);
	if (empty($wpcw_widget_title))
		$wpcw_widget_title = 'Comment Widgetizer';
	$wpcw_widget_comment_source = $options['comment_source'];
	if (empty($wpcw_widget_comment_source))
		$wpcw_widget_comment_source = '0';
	$wpcw_widget_select_mode = $options['select_mode'];
    $wpcw_widget_text = htmlspecialchars($options['text'], ENT_QUOTES);
    ?>
  
    <p><label for="wpcw_widget_title"><?php _e('Title', 'commentwidgetizer'); ?> : </label><br/>
    <input id="wpcw_widget_title" name="wpcw_widget_title" size="30" value="<?php echo $wpcw_widget_title; ?>" type="text"></p>
    <p><label for="wpcw_widget_comment_source"><?php _e('Post or page IDs (ex : 12,34)', 'commentwidgetizer'); ?></label><br/>
    <input id="wpcw_widget_comment_source" name="wpcw_widget_comment_source" size="30" value="<?php echo $wpcw_widget_comment_source; ?>" type="text"></p>
    <p><label for="wpcw_widget_select_mode"><?php _e('Comment selection method', 'commentwidgetizer'); ?> : </label><br/>
    <select name="wpcw_widget_select_mode">
    <option value="1" <?php echo ($wpcw_widget_select_mode==1 ? "selected" : "") . '>'; _e('Random', 'commentwidgetizer') ?>&nbsp;</option>
    <?php //<option value="2" <?php echo ($wpcw_widget_select_mode==2 ? "selected" : "") . '>'; _e('Last created', 'commentwidgetizer') ?>&nbsp;</option>  ?>
    </select></p>
    <p><label for="wpcw_widget_text"><?php _e('Text (optional)', 'commentwidgetizer'); ?> : </label><br/>
    <textarea name="wpcw_widget_text" cols="28" rows="6"><?php echo $wpcw_widget_text ?></textarea></p>
    
    <input type="hidden" id="wpcw_widget_submit" name="wpcw_widget_submit" value="1" /></p>
<?php
}

//////////////////////////////////////////////////
//
function init_commentwidgetizer_widget(){
	wp_register_sidebar_widget("CommentWidgetizer", "CommentWidgetizer", "wpcw_widget", array('description'=>__('Displays any of the comments made on your site in the sidebar widget', 'commentwidgetizer')));     
	register_widget_control('CommentWidgetizer', 'wpcw_widget_control', null, null);
}
 
add_action("plugins_loaded", "init_commentwidgetizer_widget");


//////////////////////////////////////////////////
//
function wpwc_get_comment($csv_post_ids, $select_by="random"){
	$result = new StdClass;

	$post_ids=explode(',', $csv_post_ids);
	$comments = array();
		
	foreach($post_ids as $post_id) {
		$tmp_comments = get_comments('post_id=' . $post_id . '&status=approve');
		if (empty($comments))
			$comments = $tmp_comments;
		else
			$comments=array_merge($comments, $tmp_comments);
	}
			
	$i = rand(0, sizeof($comments)-1);

	$result->content = $comments[$i]->comment_content;
	$result->author = $comments[$i]->comment_author;
	
	return $result;

}
