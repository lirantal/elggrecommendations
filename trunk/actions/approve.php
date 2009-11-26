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

// get object details
$entity_guid = (int) get_input('entity_guid');
$object = get_entity($entity_guid);

// make sure the current user actually owns this object
if ( ($_SESSION['user']->guid == $object->recommendation_to) ) {
	
	// grab the object 
	$myObject = new ElggObject($object->guid);
	$myObject->recommendation_approved = 1;
	
	system_message(elgg_echo('recommendations:success:approved'));
	forward($_SERVER['HTTP_REFERER']);
 
	
} else {

	system_message(elgg_echo('recommendations:error:notapproved'));
	forward($_SERVER['HTTP_REFERER']);
}


?>
