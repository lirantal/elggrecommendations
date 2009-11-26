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

	$english = array(
	
		// General Items
	
			'recommendations:recommendations_lowercase' => "recommendations",
			'recommendations:has' => "has",
			'recommendations:or' => "or",
			
			'recommendations:recommendations' => "Recommendations",
			'recommendations:new_recommendation' => "New Recommendation",
			'recommendations:my_recommendations' => "Recommendations received",
			'recommendations:my_recommendations_to_friends' => "Recommendations given",
			'recommendations:view_recommendations' => "View Recommendations",
			'recommendations:selectfriend' => "Select friend...",
			'recommendations:send' => "Send recommendation",
			
			'recommendations:recommend' => "Recommend",
			'recommendations:this_user' => "this user",
			'recommendations:by' => "by",
			'recommendations:readmore' => "read more",
			
			'recommendations:title' => "Title",
			'recommendations:title:helper' => "",
			'recommendations:text' => "Recommendation text",
			'recommendations:text:helper' => "Please provide an honest and truthful recommendation",
			
			'recommendations:friends_you_recommended' => "Friends you recommended",
			'recommendations:recommendations_of' => "Recommendations of",
			'recommendations:approve' => "Approve Recommendation",
			'recommendations:withdraw' => "Withdraw Recommendation",
			
			'recommendations:wasrecommendedby' => "was recommended by",
			
		// river messages
		
			'recommendations:river:created' => "%s recommended %s",
			'recommendations:river:create' => ", read recommendation",
		
		// error messages
			'recommendations:error:recommendation_text_empty' => "Recommendation text is mandatory",
			'recommendations:error:cantsaveobject' => "Can't save recommendation. Please try later",
			'recommendations:error:cant_recommend_yourself' => "You can't recommend yourself but you can ask your friends to...",
			'recommendations:error:choosefriend' => "You need to specify a friend to recommend. It is possible that you are not friends with this user",
			'recommendations:error:delete' => "Can't delete recommendation. Please try later",
			'recommendations:error:notowner' => "Can't delete recommendation because you are not the owner of this recommendation",
			'recommendations:error:notapproved' => "Can't approve recommendation because you are not the owner of this recommendation",
			'recommendations:error:withdraw' => "Can't withdraw recommendation because the user already approved it",
			'recommendations:error:cant_recommend_more_than_once' => "Can't recommend this user more than one time",
			'recommendations:error:general_error' => "An error occured while attempting to recommend a user",
			
		// success messages
			'recommendations:success:saved' => "Successfuly saved recommendation",
			'recommendations:success:withdraw' => "Successfuly withdrawn recommendation from user",
			'recommendations:success:deleted' => "Successfuly removed recommendation from your profile",
			'recommendations:success:approved' => "Successfuly approved recommendation, it will now appear on your profile",
			
		// widget 
			'recommendations:widget:display_number' => "How many recommendations to show?",
			'recommendations:widget:recommendations_received' => "Recommendations received widget",
			'recommendations:widget:recommendations_received:helper' => "",
			
		// plugin settings
			'recommendations:settings:add_menu_entry' => "Add menu toolbar entry?",
			'recommendations:settings:multiple_recommendations' => "Allow user to recommend more than once?",
			'recommendations:settings:' => "",
			
	);
					
	add_translation("en", $english);

?>
