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
 
// making sure the user is logged in
gatekeeper();

set_context('recommendations');

// grab all our post input into local variables
//$object_guid = get_input('object_guid');

$recommendation_title = get_input('recommendation_title');
$recommendation_text = get_input('recommendation_text');
$recommendation_to = get_input('recommendation_to');
$recommendation_by = $_SESSION['user']->getGUID();

// the recommendation is by default, only viewed by registered users
$access = get_input('access', ACCESS_LOGGED_IN);

//the composer of the recommendation will not be the owner of it 
//but rather the receiver of it will be, otherwise uncomment the following line
//$object_ownerguid = get_input('object_ownerguid', $_SESSION['user']->getGUID());

// we do not allow the user to recommend itself
if ($recommendation_by == $recommendation_to) {
	register_error(elgg_echo("recommendations:error:cant_recommend_yourself"));
	forward($_SERVER['HTTP_REFERER']);
}


//get plugin settings to check whether it is allowed or not to recommend a user more than once
//by the same user

$recommendationsMultipleRecommendations = get_plugin_setting('recommendationsMultipleRecommendations', 'recommendations');
if (recommendations_count_by_user($recommendation_to, $recommendation_by) == -1) {
	register_error(elgg_echo("recommendations:error:general_error"));
	forward($_SERVER['HTTP_REFERER']);
} else if (recommendations_count_by_user($recommendation_to, $recommendation_by) >= 1) {
	register_error(elgg_echo("recommendations:error:cant_recommend_more_than_once"));
	forward($_SERVER['HTTP_REFERER']);
}


// users must be friends, the receiving user must exist, as well as the sender
if ( (!user_is_friend($recommendation_by, $recommendation_to)) 
	|| ($recommendation_to == 0) || ($recommendation_by == 0) ) {
	register_error(elgg_echo("recommendations:error:choosefriend"));
	forward($_SERVER['HTTP_REFERER']);
}

if (empty($recommendation_text)) {
	// if no text was provided for the recommendation we deny it
	register_error(elgg_echo("recommendations:error:recommendation_text_empty"));
	forward($_SERVER['HTTP_REFERER']);
} else {
	// if text was provided we create an ElggObject entity with a unique subtype
	// of our objects name 
	
	// if this is an editing of an existing object then we create
	// a new object based on an existing guid
	// otherwise we simply create a new object instance
	
	// the following is commented due to the fact that we don't want to allow
	// editing of recommendations by neither person
	
	/*
	if ($object_guid)
		$myObject = new ElggObject($object_guid);
	else
		$myObject = new ElggObject();
	*/
	
	
	$myObject = new ElggObject();
		
	$myObject->title = $recommendation_title;
	$myObject->description = $recommendation_text;
	$myObject->access_id = $access;
	$myObject->subtype = "recommendations";
	
	$myObject->owner_guid = $recommendation_by;

	// attempting to save the object
	if (!$myObject->save()) {
		// if saving was at fault we redirect to an error page
		register_error(elgg_echo("recommendations:error:cantsaveobject"));
		forward($_SERVER['HTTP_REFERER']);
	} else {
		// if saving of the object was successful
		// we create and assign metadata for this object based
		// on the post input we received
		$myObject->recommendation_to = $recommendation_to;
		$myObject->recommendation_approved = 0;

		system_message(elgg_echo("recommendations:success:saved"));
		
		// add to river
		add_to_river('river/object/recommendations/create', 'create', $_SESSION['user']->guid, $myObject->guid);
		
		//forward($myObject->getURL());
		forward($vars['url'] . 'pg/recommendations/' . $_SESSION['user']->username . '/viewfriends');
	}
}
?>
