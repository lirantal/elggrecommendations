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

// get object to delete
$entity_guid = (int) get_input('entity_guid');
$object = get_entity($entity_guid);

// make sure the current user actually owns this object
if ( ($_SESSION['user']->guid == $object->recommendation_to) ) {
	
	// grab the object 
	$myObject = new ElggObject($object->guid);
	if(!$myObject->delete()) {
		register_error(elgg_echo('recommendations:error:delete'));
		forward($_SERVER['HTTP_REFERER']);
	}
	
	system_message(elgg_echo('recommendations:success:deleted'));
	forward($_SERVER['HTTP_REFERER']);
	
} else {

	system_message(elgg_echo('recommendations:error:notowner'));
	forward($_SERVER['HTTP_REFERER']);
}


?>
