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

	
	$page_owner = page_owner_entity();
	if ($page_owner) {
		$user_guid = $page_owner->getGUID();
	} else
		exit;

	$limit = get_input('limit', 5);
	$offset = 0;
	
	if ($vars['entity']->limit)
		$limit = $vars['entity']->limit;
	
	$recommendationsCount = recommendations_count($user_guid);
	$metadata_values = array(
							"recommendation_approved" => "1",
							"recommendation_to" => $user_guid,
						);

	$result = "";
	$icon = "<img src='".$vars['url']."mod/recommendations/graphics/thumbs_up.png"."' alt='' border='0' width='15' />";
	$result .= $icon. " " .elgg_echo("recommendations:recommendations_of")." ".$page_owner->name;
	$result .= "<br/><br/>";
	$entities = get_entities_from_metadata_multi($metadata_values, 
				'object','recommendations', 0, 15, true, true, true);
	
	var_dump($entities);
	
	$result .= elgg_view_entity_list($entities, $recommendationsCount, $offset, $limit, false, false, false);
	
	echo $result;

?>
