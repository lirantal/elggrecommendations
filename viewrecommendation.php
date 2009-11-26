<?php
/**
 *	Recommendations Plugin
 *
 *	@package recommendations
 *	@author Liran Tal <liran.tal@gmail.com>
 *	@license GNU General Public License (GPL) version 2
 *	@copyright (c) Liran Tal of Enginx 2009
 *	@link http://www.enginx.com
 */

// required a logged-in user
gatekeeper();

set_context('recommendations');

require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");

// add side menu navigation links
add_submenu_item(elgg_echo('recommendations:my_recommendations'),	$CONFIG->wwwroot."pg/recommendations/".$_SESSION['user']->username."/view/");
add_submenu_item(elgg_echo('recommendations:my_recommendations_to_friends'),	$CONFIG->wwwroot."pg/recommendations/".$_SESSION['user']->username."/viewfriends/");
add_submenu_item(elgg_echo('recommendations:new_recommendation'),	$CONFIG->wwwroot."pg/recommendations/".$_SESSION['user']->username."/new/");

$recommended_user_id = get_input("entity_id", $_SESSION['user']->getGUID());
$recommended_user = get_user($recommended_user_id);
$recommendation_id = get_input("recommendation_id");

if ($recommendation_id && ($myObject = get_entity($recommendation_id)) ) {

	$body = elgg_view('object/viewrecommendation', array('entity' => $myObject, 
													'full' => true)
											);

	$title = $myObject->title;
	
	$layout_canvas = "two_column_left_sidebar";
	$layout_view = elgg_view_layout($layout_canvas, '', $body);
	
	page_draw($title, $layout_view);
			
} else {
	
	register_error(elgg_echo("recommendations:error:objectnotfound"));
	forward();
}


?>
