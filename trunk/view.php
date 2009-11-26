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

// forcing viewtype (gallery or listing)
set_input("search_viewtype", "list");

// add side menu navigation links
add_submenu_item(elgg_echo('recommendations:my_recommendations'),	$CONFIG->wwwroot."pg/recommendations/".$_SESSION['user']->username."/view/");
add_submenu_item(elgg_echo('recommendations:my_recommendations_to_friends'),	$CONFIG->wwwroot."pg/recommendations/".$_SESSION['user']->username."/viewfriends/");
add_submenu_item(elgg_echo('recommendations:new_recommendation'),	$CONFIG->wwwroot."pg/recommendations/".$_SESSION['user']->username."/new/");

// view recommendations the user has given to his friends
$viewfriends = get_input("viewfriends");

// get entity_id of which we want to recommend
// if not specified, by default we're listing our recommendations...
$recommended_user_id = get_input("entity_id", 0);

// get recommending user (this user)
$recommending_user_id = $_SESSION['user']->getGUID();

// just to be on the safe side that we're not listing the recommendations of the entire
// site, if entity_id is 0, we fall back to the user's guid
if ($recommended_user_id == 0)
	$recommended_user_id = $recommending_user_id;

$recommended_user = get_user($recommended_user_id);


$body = "<br/>";
$url_to_recommend = $CONFIG->wwwroot."pg/recommendations/".$_SESSION['user']->username."/new/".$recommended_user_id;


// view recommendations the user has made for friends
if ($viewfriends == 1) {
	
	$title = elgg_echo("recommendations:friends_you_recommended");
	
	$body .= list_entities('object','recommendations', $recommending_user_id, 15, true, true, true);

// view recommendations this user received
} else {
	
	$title = elgg_echo("recommendations:recommendations_of")." ".$recommended_user->name;
	
	$count = recommendations_count($recommended_user_id);
	$body .= "<div class='contentWrapper'>".$recommended_user->name." ".elgg_echo('recommendations:has')." <b>".
				$count."</b> ".elgg_echo('recommendations:recommendations_lowercase');
	
	if ($recommended_user_id != $recommending_user_id) {
		
		if (user_is_friend($recommending_user_id, $recommended_user_id)) {
			// only display the 'recommend this user' link if users are friends
			$body .= "<br/>".
						"<a href='$url_to_recommend' />".
						"<img src='" . $CONFIG->url ."mod/recommendations/graphics/thumbs_up.png'  alt='' border='0' width='15' />".
						elgg_echo('recommendations:recommend') ." </a> " . $recommended_user->name . " <br/><br/>";
		}
		
		$body .= "</div>";
		
		$metadata_values = array(
								"recommendation_approved" => "1",
								"recommendation_to" => $recommended_user_id,
							);

		$body .= list_entities_from_metadata_multi($metadata_values, 
				'object','recommendations', 0, 15, true, true, true);
		
	} else {
		
		$body .= "</div>";
		$body .= list_entities_from_metadata('recommendation_to', $recommended_user_id, 
				'object','recommendations', 0, 15, true, true, true);
	}
}


$body = elgg_view_layout('two_column_left_sidebar', '', elgg_view_title($title) . $body);

page_draw($title, $body);

?>
