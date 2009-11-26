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

// add side menu navigation links
add_submenu_item(elgg_echo('recommendations:my_recommendations'),	$CONFIG->wwwroot."pg/recommendations/".$_SESSION['user']->username."/view/");
add_submenu_item(elgg_echo('recommendations:my_recommendations_to_friends'),	$CONFIG->wwwroot."pg/recommendations/".$_SESSION['user']->username."/viewfriends/");
add_submenu_item(elgg_echo('recommendations:new_recommendation'),	$CONFIG->wwwroot."pg/recommendations/".$_SESSION['user']->username."/new/");

$title = "";
$body = elgg_view('forms/recommendations/new');
$body = elgg_view_layout('two_column_left_sidebar','', elgg_view_title($title) . $body);

echo page_draw($title, $body);
	
?>
