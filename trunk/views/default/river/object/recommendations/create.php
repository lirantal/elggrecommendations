<?php

	$performed_by = get_entity($vars['item']->subject_guid);
	$object = get_entity($vars['item']->object_guid);
	$recommended_user = get_entity($object->recommendation_to);
	$url = $object->getURL();
	
	$url = "<a href=\"{$performed_by->getURL()}\">{$performed_by->name}</a>";
	$string = sprintf(elgg_echo("recommendations:river:created"),$url, $recommended_user->name) . " ";
	$string .= " <a href=\"" . $object->getURL() . "\">" . elgg_echo("recommendations:river:create") . "</a>";
	
	if ( ($_SESSION['user']->guid == $recommended_user->guid) ) {
		$string .= elgg_echo('recommendations:or') ." <a href='". $vars['url'] . "action/recommendations/approve?entity_guid=" . $object->guid ."'>" .
					elgg_echo('recommendations:approve') . "</a>";
	}
	
?>

<?php echo $string; ?>
