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

global $CONFIG;

/**
 *	requires plugin functions
 */
require_once(dirname(__FILE__)."/models/model.php");

/**
 *	recommendations_plugin_init
 *	
 *	performs plugin initialization function calls
 */
function recommendations_plugin_init() {
	global $CONFIG;
	
	// register a page handler for the /pg/ urls
	register_page_handler('recommendations','recommendations_page_handler');
	
	// sets up the URL handler for the object view 
	register_entity_url_handler('recommendations_url', 'object', 'recommendations');
	
	// register our own permissions security check plugin hook
	register_plugin_hook('permissions_check', 'all', 'recommendations_permissions_check');
		
	// extend css view
	extend_view('css','recommendations/css');
	
	// add links on profile view page
	extend_profile_menu_actions();
	
	// add menu toolbar entry
	$enableMenuEntry = get_plugin_setting('recommendationsEnableMenuEntry', 'recommendations');
	if ($enableMenuEntry)
		add_menu(elgg_echo('recommendations:recommendations'), $CONFIG->wwwroot . "pg/recommendations/" . $_SESSION['user']->username);

	// add widget
	add_widget_type('recommendations_received', elgg_echo('recommendations:widget:recommendations_received'),
		elgg_echo('recommendations:widget:recommendations_received:helper'));
	
}



/**
 *	recommendations_permissions_check
 *	
 *	@param	$hook_name		the name of the current event hook
 *	@param	$entity_type	a valid elgg entity type (user, object ,etc)
 *	@param	$return_value	
 *	@param	$params			array of parameters, holds the entity object and user object
 *	@return	boolean			returns true or false for access levels, or null if not in context
 */
function recommendations_permissions_check($hook_name, $entity_type, $return_value, $params) {

	$entity = $params['entity'];
	$user   = $params['user'];
	
	if (get_context() != 'recommendations')
		return null;
	
	if ($entity->subtype == get_subtype_id('object', 'recommendations'))
		return true;

	return null;
} 


/**
 *	extend_profile_menu_actions
 *	
 *	extends the profile/menu/actions view of the user profile, thus showing a
 *	recommendations link under the profile image in the profile view
 */
function extend_profile_menu_actions() {
	global $CONFIG;
	
	if (get_context() == 'profile') {	
		extend_view("profile/menu/actions", "recommendations/menu/actions");
		// add menu link to the Edit Profile page
		//add_submenu_item(elgg_echo('recommendations:recommendations'), $CONFIG->wwwroot . "mod/recommendations/view.php");
	}
}


/**
 * recommendations page handler
 *
 * @param array $page Array of page elements, forwarded by the page handling mechanism
 */
function recommendations_page_handler($page) {
	global $CONFIG;
	
	// URLs $page array:
	//		0 = <username>
	//		1 = <action>
	//		2 = <entityId>
	//		3 = <recommendationId>
	// URLs Syntax Format:  /pg/recommendations/<user>/<action>
	// URLs Syntax Example: /pg/recommendations/lirantal/new
	// URLs Syntax Example: /pg/recommendations/lirantal/view/2
	// in this example, 2 is the guid of the person we're recommending
	
	// The first component of the URL is the username
	if (isset($page[0]) && $page[0]) {
		set_input('username',$page[0]);
	}
	
	// The second component of the URL is the action
	if (isset($page[1]) && $page[1]) {
		switch ($page[1]) {
			case "view":
				set_input('entity_id', $page[2]);
				include(dirname(__FILE__) . "/view.php");
				break;
			case "viewrecommendation":
				set_input('entity_id', $page[2]);
				set_input('recommendation_id', $page[3]);
				include(dirname(__FILE__) . "/viewrecommendation.php");
				break;
			case "viewfriends":
				set_input('viewfriends', '1');
				include(dirname(__FILE__) . "/view.php");
				break;
			case "new":
				set_input('entity_id', $page[2]);
				include(dirname(__FILE__) . "/new.php");
				break;
			default:
				set_input('entity_id', $page[2]);
				include(dirname(__FILE__) . "/view.php");
				break;
		}
	} else {
		set_input('entity_id', $page[2]);
		include(dirname(__FILE__) . "/view.php");
	}
	
	return true;
}


function recommendations_url($entity) {

	global $CONFIG;

	$id = $entity->owner_guid;
	$object_guid = $entity->guid;
	return $CONFIG->url . "pg/recommendations/".$_SESSION['user']->username."/viewrecommendation/".$id."/".$object_guid."/";
	
}


// register recommendations CRUD
register_action("recommendations/new", false, $CONFIG->pluginspath . "recommendations/actions/new.php");
register_action("recommendations/delete", false, $CONFIG->pluginspath . "recommendations/actions/delete.php");
register_action("recommendations/approve", false, $CONFIG->pluginspath . "recommendations/actions/approve.php");
register_action("recommendations/withdraw", false, $CONFIG->pluginspath . "recommendations/actions/withdraw.php");

// plugin init hook
register_elgg_event_handler('init','system','recommendations_plugin_init');


?>
