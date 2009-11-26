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
 
?>

<?php

	set_context('recommendations');

	$recommendation = get_entity($vars['entity']->guid);
	$friendlytime = friendly_time($recommendation->time_created);
	$recommending_user = get_entity($recommendation->owner_guid);
	$recommended_user = get_entity($recommendation->recommendation_to);
	$title = $recommendation->title;
	$description = $recommendation->description;
	
	$title = elgg_echo("recommendations:recommendations_of")." ".$recommended_user->name;

?>

<p>

<div class="contentWrapper">

	<br/>
<?
$icon = elgg_view(
					"profile/icon", array(
								'entity' => $recommended_user,
								'size' => 'small',
				  )
			);
?>
<?=$icon?>
<?=$title?>

	<br/>
	<br/>
	
	<p>
		<h5>
		<?=$recommendation->title?>
		</h5>
	</p>
		
	<p>
		<?=$recommendation->description?>
	</p>
			<p class="strapline">
			<a href='<?=$recommended_user->getUrl()?>'><?=$recommended_user->name?></a>
			<?=elgg_echo('recommendations:wasrecommendedby')?>
			<a href='<?=$recommending_user->getUrl()?>'><?=$recommending_user->name?></a> <?=$friendlytime?>
			</p>
	</p>


</div>

</p>
