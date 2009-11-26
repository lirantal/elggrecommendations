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

set_context('recommendations');
 
$recommendation = $vars['entity'];
$recommending_user = get_entity($recommendation->owner_guid);
$recommended_user = get_entity($recommendation->recommendation_to);
$friendlytime = friendly_time($recommendation->time_created);

$short_recommendation = substr($recommendation->description, 0, 140);


// the following checks if the current user is the one being recommend, if so
// we set the entity to be that of the recommended user so that we always
// show the icon of the other user (the one recommended or recommending)
// instead of showing our own icons next to recommendations
if ( ($_SESSION['user']->guid == $recommending_user->guid) )
	$entity = $recommended_user;
else
	$entity = $recommending_user;

$icon = elgg_view(
					"profile/icon", array(
								'entity' => $entity,
								'size' => 'small',
				  )
			);

$info .= "<div class='recommendations'>";

// if the user is the receiver of this recommendation we allow deletion of recommendations
if ( ($_SESSION['user']->guid == $recommended_user->guid) ) {
	$info .= "<div class='delete_message'>" . elgg_view("output/confirmlink",array(
									'href' => $vars['url'] . "action/recommendations/delete?entity_guid=" . $recommendation->guid,
									//'text' => elgg_echo('delete'),
									'confirm' => elgg_echo('deleteconfirm'),
								)) . "</div>";
}
				   
$info .= "<p><b><a href=\"" . $recommendation->getUrl() . "\">" . $recommendation->title . "</a></b></p>";

$info .= "<p>".$short_recommendation.
		" <a href='".$recommendation->getUrl()."'>".
			elgg_echo('recommendations:readmore').
		"</a></p>";

// if the user is reciever of these recommendations we provide with a link to approve
// these recommendations so they can appear in his recommendations list
if ( ($_SESSION['user']->guid == $recommended_user->guid) ) {
	// if the recommendation is not approved we display a link to approve it
	if ( $recommendation->recommendation_approved == 0 ) {
		$info .= "<div class='groupdetails'>";
		$info .= "<a href='". $vars['url'] . "action/recommendations/approve?entity_guid=" . $recommendation->guid ."'>" .
					elgg_echo('recommendations:approve') . "</a>";
		$info .= "</div>";
	}
}


// if the user is recommending user we allow him to withdraw the message if
// it hasn't been approved yet
if ( ($_SESSION['user']->guid == $recommending_user->guid) ) {
	// if the recommendation is not approved we display a link to withdraw it
	if ( $recommendation->recommendation_approved == 0 ) {
		$info .= "<div class='groupdetails'>";
		$info .= "<a href='". $vars['url'] . "action/recommendations/withdraw?entity_guid=" . $recommendation->guid ."'>" .
					elgg_echo('recommendations:withdraw') . "</a>";
		$info .= "</div>";
	}
}


$info .= "<div class='clearfloat'></div>";

$info .= "<i>";
$info .= "<a href='".$recommended_user->getUrl()."'>".$recommended_user->name."</a> ";
$info .= elgg_echo('recommendations:wasrecommendedby');
$info .= " <a href='".$recommending_user->getUrl()."'>".$recommending_user->name . "</a> ". $friendlytime;
$info .= "</i>";
$info .= "</div>";

echo elgg_view_listing($icon, $info);


?>
