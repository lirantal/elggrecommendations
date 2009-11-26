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

	// get entity_id of which we want to recommend
	// if it isn't set, -1 is set by default and we handle that error
	$entity_id = get_input("entity_id", 0);
	if ($entity_id)
		$recommended_user = get_entity($entity_id);

?>

<div class="contentWrapper">
<form action="<?php echo $vars['url']; ?>action/recommendations/new" enctype="multipart/form-data" method="post">



<p>
	<label>
		<select name="recommendation_to">
		<?php if ($entity_id): ?>
			<option value="<?=$recommended_user->guid?>"><?=$recommended_user->name?></option>
			<option value=""></option>
		<?php else: ?>
			<option value=""><?=elgg_echo('recommendations:selectfriend');?></option>
		<?php endif; ?>
		<?php
			$friends = get_user_friends($_SESSION['user']->getGUID(), null, 1000, 0);
			foreach($friends as $friend):
		?>	
			<option value="<?=$friend->guid?>"><?=$friend->name?></option>
		<?php endforeach; ?>
		</select>
	</label>
</p>


<p>
	<label>
		<?php echo elgg_echo("recommendations:title"); ?><br />
		<?php echo elgg_view('input/text', array('internalname' => 'recommendation_title',
												'value' => $vars['entity']->title,
												)); ?>
		<p class="description"><?php echo elgg_echo('recommendations:title:helper') ?> </p>
	</label>
</p>

<p>
	<label>
		<?php echo elgg_echo("recommendations:text"); ?><br />
		<?php echo elgg_view('input/longtext', array('internalname' => 'recommendation_text',
												'value' => $vars['entity']->description,
												)); ?>
		<p class="description"><?php echo elgg_echo('recommendations:text:helper') ?> </p>
	</label>
</p>


<p><input type="submit" value="<?php echo elgg_echo('recommendations:send'); ?>" /></p>
 
</form>
</div>
