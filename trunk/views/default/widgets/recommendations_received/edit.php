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

<p>
	<?php echo elgg_echo('recommendations:widget:display_number'); ?>
	
	<select name="params[limit]">
		<option value="5" <?php if ($vars['entity']->limit == 5) echo " selected=\"yes\" "; ?>>5</option>
		<option value="8" <?php if ((!$vars['entity']->limit) || ($vars['entity']->limit == 8)) echo " selected=\"yes\" "; ?>>8</option>
		<option value="12" <?php if ($vars['entity']->limit == 12) echo " selected=\"yes\" "; ?>>12</option>
		<option value="15" <?php if ($vars['entity']->limit == 15) echo " selected=\"yes\" "; ?>>15</option>
	</select>
	
	<!-- <input type="hidden" name="params[group_guid]" value="<?php echo get_input('group_guid'); ?>" /> -->
</p>
