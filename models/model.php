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
 * recommendations_count
 * returns the total recommendations for a given user guid
 *
 * @param	$recommended_user_id	the guid of the user being recommended
 * @return	$count					total recommendations for this user id
 */
function recommendations_count($recommended_user_id) {
	
	if (!$recommended_user_id) {
		$page_owner = page_owner_entity();
		if (!$page_owner)
			return 0;
		
		$recommended_user_id = $page_owner->guid;
	}
	
	$metadata_values = array(
								"recommendation_approved" => "1",
								"recommendation_to" => $recommended_user_id,
							);
	$count = get_entities_from_metadata_multi($metadata_values, 
				'object','recommendations', 0, 15, 0, null, 0, true, "AND");
	
	return $count;
}



/**
 * recommendations_count_by_user
 * returns the total recommendations for a user guid by a specific user guid
 *
 * @param	$recommended_user_id	the guid of the user being recommended
 * @param	$recommending_user_id	the guid of the user recommending
 * @return	$count					total recommendations for this user id or -1 for error
 */
function recommendations_count_by_user($recommended_user_id, $recommending_user_id) {
	
	if (!$recommending_user_id)
		return -1;
	
	if (!$recommended_user_id) {
		$page_owner = page_owner_entity();
		if (!$page_owner)
			return -1;
		
		$recommended_user_id = $page_owner->guid;
	}
	
	$metadata_values = array(
								"recommendation_approved" => "1",
								"recommendation_to" => $recommended_user_id,
							);
	$count = get_entities_from_metadata_multi($metadata_values, 
				'object','recommendations', $recommending_user_id, 15, 0, null, 0, true, "AND");
	
	return $count;
}
