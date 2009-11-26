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
	
$recommendationsEnableMenuEntry = $vars['entity']->recommendationsEnableMenuEntry;
if (!$recommendationsEnableMenuEntry)
	$recommendationsEnableMenuEntry['No'] = '0';


$recommendationsMultipleRecommendations = $vars['entity']->recommendationsMultipleRecommendations;
if (!$recommendationsMultipleRecommendations)
	$recommendationsMultipleRecommendations['No'] = '0';

?>

<p>
	<?php echo elgg_echo('recommendations:settings:add_menu_entry'); ?>
	
	<?php
		echo elgg_view('input/pulldown', array(
			'internalname' => 'params[recommendationsEnableMenuEntry]',
			'options_values' => array(
				'1' => elgg_echo('Yes'),
				'0' => elgg_echo('No'),
			),
			'value' => $recommendationsEnableMenuEntry
		));
	?>
	
	<br/><br/>

</p>


<p>
	<?php echo elgg_echo('recommendations:settings:multiple_recommendations'); ?>
	
	<?php
		echo elgg_view('input/pulldown', array(
			'internalname' => 'params[recommendationsMultipleRecommendations]',
			'options_values' => array(
				'1' => elgg_echo('Yes'),
				'0' => elgg_echo('No'),
			),
			'value' => $recommendationsMultipleRecommendations
		));
	?>
	
	<br/><br/>

</p>


<p>Please donate
<br/>
<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&amp;hosted_button_id=5786512" title="PayPal - The safer, easier way to pay online."><img src="https://www.paypal.com/en_GB/i/btn/btn_donate_SM.gif" border="0" alt="image" style="border: 0px; border: 0px;" /></a>
</p>
