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

.recommendations_buttons {
	padding:0 0 3px 4px;
	margin:0;
	font-size: 90%;
	color:#666666;
}


.recommendations .delete_message a {
	display:block;
	float:right;
	cursor: pointer;
	width:14px;
	height:14px;
	margin:0 3px 4px 5px;
	background: url("<?php echo $vars['url']; ?>_graphics/icon_customise_remove.png") no-repeat 0 0;
	text-indent: 15px;
}
.recommendations .delete_message a:hover {
	background-position: 0 -16px;
}

