<?php
	$page_owner = page_owner_entity();
	$recommended_user_id = $page_owner->guid;
	$count = recommendations_count($recommended_user_id);
?>
<p>
	<a href="<?= $vars['url']."pg/recommendations/".$vars['entity']->username."/view/".$vars['entity']->guid ?>">
		<img src="<?= $vars['url']."mod/recommendations/graphics/thumbs_up.png" ?>" alt="" border="0" width="15" />
		(<?=$count?>)
		<?=elgg_echo('recommendations:recommendations')?>
	</a>
</p>
