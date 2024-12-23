<?
$shop_sql0 = "select * from $MartDesignTable where mart_id ='$mart_id'";
$shop_res0 = mysql_query($shop_sql0, $dbconn);
if( mysql_num_rows($shop_res0) > 0 ){
	$row0 = mysql_fetch_array($shop_res0);

	$top_module = $row0[top_module];
	$left_module = $row0[left_module];
	$icon_module = $row0[icon_module];
	$main_module = $row0[main_module];
	$item_module = $row0[item_module];
	$item_zoom_module = $row0[item_zoom_module];
	$login_module = $row0[login_module];
	$adult_module = $row0[adult_module];
	$page_position = $row0[page_position];
	$menu_expand = $row0[menu_expand];
	$onestep = $row0[onestep];
	$if_self_design_joinmail = $row0[if_self_design_joinmail];
}

$shop_sql1 = "select * from $MartInfoTable where mart_id ='$mart_id'";
$shop_res1 = mysql_query($shop_sql1, $dbconn);
if( mysql_num_rows($shop_res1) > 0 ){
	$row1 = mysql_fetch_array($shop_res1);

	$shopname = $row1[shopname];
	$shopemail  = $row1[email];
	$shoptel1= $row1[tel1];
	$shop_tel = $row1[tel1];
	$shop_fax = $row1[tel2];
	$card_module = $row1[card_module];
}

$shop_sql2 = "select * from $MartMngInfoTable where mart_id ='$mart_id'";
$shop_res2 = mysql_query($shop_sql2, $dbconn);
if( mysql_num_rows($shop_res2) > 0 ){
	$row2 = mysql_fetch_array($shop_res2);

	$logo = $row2[logo];
	$counter = $row2[counter];
	$shopuser = $row2[shopuser];
	$bonus_ok = $row2[bonus_ok];
	$init_bonus = $row2[init_bonus];
	$by_cash_bonus_ok = $row2[by_cash_bonus_ok];
	$init_by_cash_bonus = $row2[init_by_cash_bonus];
	$welcome = $row2[welcome];
	$copyright = $row2[copyright];
	$card_yes = $row2[card_yes];
	$card_url = $row2[card_url];
	$freight_date = $row2[freight_date];
	$freight_limit = $row2[freight_limit];
	$freight_cost = $row2[freight_cost];
	$pur_limit = $row2[pur_limit];
	$card_limit = $row2[card_limit];
	$bonus_limit = $row2[bonus_limit];
	$event_width = $row2[event_width];
	$event_height = $row2[event_height];
	$width = $row2[width];
	$titlecolor = $row2[titlecolor];
	$titletxtcolor  = $row2[titletxtcolor];
	$listcolor  = $row2[listcolor];
	$listtxtcolor  = $row2[listtxtcolor];
	$color  = $row2[color];
	$user_words  = $row2[user_words];
	$if_union  = $row2[if_union];
	$intro  = $row2[intro];
	$if_notice  = $row2[if_notice];
	$if_community  = $row2[if_community];
	$if_coupon  = $row2[if_coupon];
	$if_event  = $row2[if_event];
	$if_chuchon  = $row2[if_chuchon];
	$if_receipt  = $row2[if_receipt];
	$page_title  = $row2[page_title];
	$member_confirm  = $row2[member_confirm];
	$if_poll  = $row2[if_poll];
	$if_catalog  = $row2[if_catalog];
	$if_quiz  = $row2[if_quiz];
	$community_img  = $row2[community_img];
	$account_yes = $row2[account_yes];
	$if_member_price = $row2[if_member_price];
	$if_use_bottom_img = $row2[if_use_bottom_img];
	$if_joinmail = $row2[if_joinmail];
	$if_nomem_use_pass = $row2[if_nomem_use_pass];
	$xpay_id = $row2[xpay_id];
	$xpay_key = $row2[xpay_key];

}

/** 사용안함 mydesign 테이블은 사용안함
$shop_sql3 = "select * from $MyDesignTable where mart_id ='$mart_id'";
$shop_res3 = mysql_query($shop_sql3, $dbconn);
if( mysql_num_rows($shop_res3) > 0 ){
	$row3 = mysql_fetch_array($shop_res3);

	$use_top_menu = $row3[use_top_menu];
	$use_menu_list = $row3[use_menu_list];
	$use_right_menu = $row3[use_right_menu];
}**/

$shop_sql4 = "select * from $MartIntroTable where mart_id ='$mart_id'";
$shop_res4 = mysql_query($shop_sql4, $dbconn);
if( mysql_num_rows($shop_res4) > 0 ){
	$row4 = mysql_fetch_array($shop_res4);

	$intro_type = $row4[intro_type];
	$help = $row4[help];
	$attach = $row4[attach];
	$attach1 = $row4[attach1]; 
	$link = $row4[link]; 
}

// meta 테이블은 더이상 사용안함
/*$shop_sql5 = "select * from $MetaTable where mart_id ='$mart_id'";
$shop_res5 = mysql_query($shop_sql5, $dbconn);
if( mysql_num_rows($shop_res5) > 0 ){
	$row5 = mysql_fetch_array($shop_res5);

	$description = $row5[description];
	$keywords = $row5[keywords];
}*/

if(strstr($icon_module,"icon7") != false){ 
	$shop_sql6 = "select * from $Design2Table where mart_id='$mart_id'";
	$shop_res6 = mysql_query($shop_sql6, $dbconn);
	if( mysql_num_rows($shop_res6) > 0 ){
		$row6 = mysql_fetch_array($shop_res6);

		$top_bg_color1 = $row6[top_bg_color1];
		$top_bg_img1 = $row6[top_bg_img1];
		$top_bg_color2 = $row6[top_bg_color2];
		$top_bg_img2 = $row6[top_bg_img2];
		$top_bg_color3 = $row6[top_bg_color3];
		$top_bg_img3 = $row6[top_bg_img3];
		$top_logo_img = $row6[top_logo_img];
		$top_home_img = $row6[top_home_img];
		$top_intro_img = $row6[top_intro_img];
		$top_guide_img = $row6[top_guide_img];
		$top_member_img = $row6[top_member_img];
		$top_cart_img = $row6[top_cart_img];
		$top_order_search_img = $row6[top_order_search_img];
		$top_board_img = $row6[top_board_img];
		$top_email_img = $row6[top_email_img];
		$left_bg_color = $row6[left_bg_color];
		$left_bg_img = $row6[left_bg_img];
		$left_menu1_color = $row6[left_menu1_color];
		$left_menu1_img = $row6[left_menu1_img];
		$left_menu2_color = $row6[left_menu2_color];
		$left_menu2_img = $row6[left_menu2_img];
		$left_menu3_color = $row6[left_menu3_color];
		$left_menu3_img = $row6[left_menu3_img];
		$left_menu4_color = $row6[left_menu4_color];
		$left_menu4_img = $row6[left_menu4_img];
		$left_menu5_color = $row6[left_menu5_color];
		$left_menu5_img = $row6[left_menu5_img];
		$left_menu5_color = $row6[left_menu5_color];
		$left_font_color1 = $row6[left_font_color1];
		$left_font_color2 = $row6[left_font_color2];
		$left_line_type = $row6[left_line_type];
		$left_line_color = $row6[left_line_color];
		$left_line_bg_color = $row6[left_line_bg_color];
		$left_login_img = $row6[left_login_img];
		$left_list_img = $row6[left_list_img];
		$left_community_img = $row6[left_community_img];
		$left_coupon_img = $row6[left_coupon_img];
		$left_quiz_img = $row6[left_quiz_img];
		$left_catalog_img = $row6[left_catalog_img];
		$if_use_2in1_logo = $row6[if_use_2in1_logo];
	}
	
}

if(strstr($icon_module,"icon8") != false){
	$shop_sql7 = "select * from $Design2_Temp2Table where mart_id='$mart_id'";
	$shop_res7 = mysql_query($shop_sql7, $dbconn);
	if( mysql_num_rows($shop_res7) > 0 ){
		$row7 = mysql_fetch_array($shop_res7);

		$top_bg_color_all = $row7[top_bg_color_all];
		$top_bg_img_all = $row7[top_bg_img_all];
		$top_bg_color1 = $row7[top_bg_color1];
		$top_bg_img1 = $row7[top_bg_img1];
		$top_bg_color2 = $row7[top_bg_color2];
		$top_bg_img2 = $row7[top_bg_img2];
		$top_logo_img = $row7[top_logo_img];
		$top_home_img = $row7[top_home_img];
		$top_login_img = $row7[top_login_img];
		$top_cart_img = $row7[top_cart_img];
		$top_order_search_img = $row7[top_order_search_img];
		$top_intro_img = $row7[top_intro_img];
		$top_guide_img = $row7[top_guide_img];
		$top_member_img = $row7[top_member_img];
		$top_board_img = $row7[top_board_img];
		$top_email_img = $row7[top_email_img];
		$left_bg_color = $row7[left_bg_color];
		$left_bg_img = $row7[left_bg_img];
		$left_menu1_color = $row7[left_menu1_color];
		$left_menu1_img = $row7[left_menu1_img];
		$left_menu2_color = $row7[left_menu2_color];
		$left_menu2_img = $row7[left_menu2_img];
		$left_menu3_color = $row7[left_menu3_color];
		$left_menu3_img = $row7[left_menu3_img];
		$left_font_color1 = $row7[left_font_color1];
		$left_font_color2 = $row7[left_font_color2];
		$left_icon_img = $row7[left_icon_img];
		$left_community_img = $row7[left_community_img];
		$left_coupon_img = $row7[left_coupon_img];
		$left_quiz_img = $row7[left_quiz_img];
		$left_catalog_img = $row7[left_catalog_img];
		$if_use_2in1_logo = $row7[if_use_2in1_logo];
	}
}

if(strstr($icon_module,"icon9") != false){
	$shop_sql8 = "select * from $Design2_Temp3Table where mart_id='$mart_id'";
	$shop_res8 = mysql_query($shop_sql8, $dbconn);
	if( mysql_num_rows($shop_res8) > 0 ){
		$row8 = mysql_fetch_array($shop_res8);
		
		$top_bg_color_all = $row8[top_bg_color_all];
		$top_bg_img_all = $row8[top_bg_img_all];
		$top_bg_line_color = $row8[top_bg_line_color];
		$top_bg_color1 = $row8[top_bg_color1];
		$top_bg_img1 = $row8[top_bg_img1];
		$top_bg_color2 = $row8[top_bg_color2];
		$top_logo_img = $row8[top_logo_img];
		$top_home_img = $row8[top_home_img];
		$top_login_img = $row8[top_login_img];
		$top_cart_img = $row8[top_cart_img];
		$top_order_search_img = $row8[top_order_search_img];
		$top_intro_img = $row8[top_intro_img];
		$top_guide_img = $row8[top_guide_img];
		$top_member_img = $row8[top_member_img];
		$top_board_img = $row8[top_board_img];
		$top_email_img = $row8[top_email_img];
		$top_item_search_img = $row8[top_item_search_img];
		$left_bg_color = $row8[left_bg_color];
		$left_bg_img = $row8[left_bg_img];
		$left_menu1_color = $row8[left_menu1_color];
		$left_menu2_color = $row8[left_menu2_color];
		$left_category1_color = $row8[left_category1_color];
		$left_category2_color = $row8[left_category2_color];
		$left_line_color = $row8[left_line_color];
		$left_font_color1 = $row8[left_font_color1];
		$left_font_color2 = $row8[left_font_color2];
		$left_icon_img = $row8[left_icon_img];
		$left_cateogy_list_img = $row8[left_cateogy_list_img];
		$left_union_sale_img = $row8[left_union_sale_img];
		$left_community_img = $row8[left_community_img];
		$left_coupon_img = $row8[left_coupon_img];
		$left_quiz_img = $row8[left_quiz_img];
		$left_catalog_img = $row8[left_catalog_img];
		$main_total_color = $row8[main_total_color];
		$main_total_img = $row8[main_total_img];
		$main_menu1_color = $row8[main_menu1_color];
		$main_menu1_img = $row8[main_menu1_img];
		$main_menu2_color = $row8[main_menu2_color];
		$main_menu2_img = $row8[main_menu2_img];
		$main_menu3_color = $row8[main_menu3_color];
		$main_menu3_img = $row8[main_menu3_img];
		$main_bg_color = $row8[main_bg_color];
		$main_menu4_color = $row8[main_menu4_color];
		$main_menu4_img = $row8[main_menu4_img];
		$main_menu5_color = $row8[main_menu5_color];
		$main_menu5_img = $row8[main_menu5_img];
		$main_bottom_color = $row8[main_bottom_color];
		$main_font_color = $row8[main_font_color];
		$main_main_img = $row8[main_main_img];
		$main_main_img_flash_height = $row8[main_main_img_flash_height];
		$main_news_img = $row8[main_news_img];
		$main_present_img = $row8[main_present_img];
		$main_poll_img = $row8[main_poll_img];
		$main_chuchon_img = $row8[main_chuchon_img];
		$main_newitem_img = $row8[main_newitem_img];
		$main_partner_img = $row8[main_partner_img];
		$main_right_line_color = $row8[main_right_line_color];
		$main_bottom_line_color = $row8[main_bottom_line_color];
		$if_use_2in1_logo = $row8[if_use_2in1_logo];
	}
}

if(strstr($icon_module,"icon10") != false){
	$shop_sql9 = "select * from $Design2_Temp4Table where mart_id='$mart_id'";
	$shop_res9 = mysql_query($shop_sql9, $dbconn);
	if( mysql_num_rows($shop_res9) > 0 ){
		$row9 = mysql_fetch_array($shop_res9);
		
		$top_bg_color_all = $row9[top_bg_color_all];
		$top_bg_img_all = $row9[top_bg_img_all];
		$top_bg_line_color = $row9[top_bg_line_color];
		$top_bg_color1 = $row9[top_bg_color1];
		$top_bg_color2 = $row9[top_bg_color2];
		$top_logo_img = $row9[top_logo_img];
		$top_login_img = $row9[top_login_img];
		$top_home_img = $row9[top_home_img];
		$top_intro_img = $row9[top_intro_img];
		$top_guide_img = $row9[top_guide_img];
		$top_member_img = $row9[top_member_img];
		$top_cart_img = $row9[top_cart_img];
		$top_order_search_img = $row9[top_order_search_img];
		$top_board_img = $row9[top_board_img];
		$top_email_img = $row9[top_email_img];
		$left_bg_color = $row9[left_bg_color];
		$left_bg_img = $row9[left_bg_img];
		$left_menu1_color = $row9[left_menu1_color];
		$left_menu2_color = $row9[left_menu2_color];
		$left_menu3_color = $row9[left_menu3_color];
		$left_line1_color = $row9[left_line1_color];
		$left_line2_color = $row9[left_line2_color];
		$left_line3_color = $row9[left_line3_color];
		$left_font1_color = $row9[left_font1_color];
		$left_font2_color = $row9[left_font2_color];
		$left_search_img = $row9[left_search_img];
		$left_search_go_img = $row9[left_search_go_img];
		$left_cateogy_list_img = $row9[left_cateogy_list_img];
		$left_union_sale_img = $row9[left_union_sale_img];
		$left_poll_img = $row9[left_poll_img];
		$left_community_img = $row9[left_community_img];
		$left_coupon_img = $row9[left_coupon_img];
		$left_quiz_img = $row9[left_quiz_img];
		$left_catalog_img = $row9[left_catalog_img];
		$main_menu1_color = $row9[main_menu1_color];
		$main_menu1_img = $row9[main_menu1_img];
		$main_menu2_color = $row9[main_menu2_color];
		$main_menu2_img = $row9[main_menu2_img];
		$main_menu3_color = $row9[main_menu3_color];
		$main_menu3_img = $row9[main_menu3_img];
		$main_bottom_color = $row9[main_bottom_color];
		$main_font_color = $row9[main_font_color];
		$main_main_img = $row9[main_main_img];
		$main_main_img_flash_height = $row9[main_main_img_flash_height];
		$main_news_img = $row9[main_news_img];
		$main_hititem_img = $row9[main_hititem_img];
		$main_gift_img = $row9[main_gift_img];
		$main_chuchon_img = $row9[main_chuchon_img];
		$main_newitem_img = $row9[main_newitem_img];
		$main_partner_img = $row9[main_partner_img];
		$main_right_line_color = $row9[main_right_line_color];
		$main_bottom_line_color = $row9[main_bottom_line_color];
		$if_use_2in1_logo = $row9[if_use_2in1_logo];
	}
}

/** 사용안함
if(strstr($icon_module,"icon11") != false){
	$shop_sql10 = "select * from $Design2_Temp5Table where mart_id='$mart_id'";
	$shop_res10 = mysql_query($shop_sql10, $dbconn);
	if( mysql_num_rows($shop_res10) > 0){
		$row10 = mysql_fetch_array($shop_res10);
		
		$top_bg_img = $row10[top_bg_img];
		$top_bg_left_img = $row10[top_bg_left_img];
		$top_bg_left_img_height = $row10[top_bg_left_img_height];
		$top_logo_img = $row10[top_logo_img];
		$top_home_img = $row10[top_home_img];
		$top_login_img = $row10[top_login_img];
		$top_logout_img = $row10[top_logout_img];
		$top_cart_img = $row10[top_cart_img];
		$top_order_search_img = $row10[top_order_search_img];
		$top_intro_img = $row10[top_intro_img];
		$top_guide_img = $row10[top_guide_img];
		$top_member_img = $row10[top_member_img];
		$top_board_img = $row10[top_board_img];
		$top_email_img = $row10[top_email_img];
		$top_news_img = $row10[top_news_img];
		$top_news_more_img = $row10[top_news_more_img];
		$left_bg_color = $row10[left_bg_color];
		$left_bg_img = $row10[left_bg_img];
		$left_menu1_color = $row10[left_menu1_color];
		$left_menu2_color = $row10[left_menu2_color];
		$left_menu3_color = $row10[left_menu3_color];
		$left_line_bg_color = $row10[left_line_bg_color];
		$left_line_type = $row10[left_line_type];
		$left_line_color = $row10[left_line_color];
		$left_font1_color = $row10[left_font1_color];
		$left_font2_color = $row10[left_font2_color];
		$left_cateogy_img = $row10[left_cateogy_img];
		$left_cat_icon_img = $row10[left_cat_icon_img];
		$left_search_img = $row10[left_search_img];
		$left_search_go_img = $row10[left_search_go_img];
		$left_community_img = $row10[left_community_img];
		$left_coupon_img = $row10[left_coupon_img];
		$left_quiz_img = $row10[left_quiz_img];
		$left_catalog_img = $row10[left_catalog_img];
		$left_partner_img = $row10[left_partner_img];
		$left_gift_img = $row10[left_gift_img];
		$left_poll_img = $row10[left_poll_img];
		$if_use_2in1_logo = $row10[if_use_2in1_logo];
	}
}**/

if(strstr($icon_module,"icon7") != false || strstr($icon_module,"icon8") != false || strstr($icon_module,"icon11") != false){
	if($main_module == "" || $main_module == 1){
		$shop_sql11 = "select * from $Design2Table where mart_id='$mart_id'";
		$shop_res11 = mysql_query($shop_sql11, $dbconn);

		if( mysql_num_rows($shop_res11) > 0){
			$row11 = mysql_fetch_array($shop_res11);

			$main_main_img = $row11[main_main_img];
			$main_main_img_flash_height = $row11[main_main_img_flash_height];
			$main_news_title_img = $row11[main_news_title_img];
			$main_news_img = $row11[main_news_img];
			$main_chuchon_title_img = $row11[main_chuchon_title_img];
			$main_chuchon_exp_img = $row11[main_chuchon_exp_img];
			$main_new_title_img = $row11[main_new_title_img];
			$main_new_exp_img = $row11[main_new_exp_img];
			$main_present_title_img = $row11[main_present_title_img];
			$main_partner_img = $row11[main_partner_img];
			$main_bottom_color = $row11[main_bottom_color];
			$main_bottom_img = $row11[main_bottom_img];
			$main_pop_title_img = $row11[main_pop_title_img];
			$main_pop_bg_img = $row11[main_pop_bg_img];
			$main_pop_spt_img = $row11[main_pop_spt_img];
			$main_pop_btm_img = $row11[main_pop_btm_img];
		}
	}

	if($main_module == 2){
		$shop_sql12 = "select * from $Design2_Main2Table where mart_id='$mart_id'";
		$shop_res12 = mysql_query($shop_sql12, $dbconn);

		if( mysql_num_rows($shop_res12) > 0){
			$row12 = mysql_fetch_array($shop_res12);

			$main2_main_img = $row12[main2_main_img];
			$main2_main_img_flash_height = $row12[main2_main_img_flash_height];
			$main2_news_title_img = $row12[main2_news_title_img];
			$main2_news_img = $row12[main2_news_img];
			$main2_chuchon_title_img = $row12[main2_chuchon_title_img];
			$main2_new_title_img = $row12[main2_new_title_img];
			$main2_menu1_bg_color = $row12[main2_menu1_bg_color];
			$main2_menu1_bg_img = $row12[main2_menu1_bg_img];
			$main2_menu2_bg_color = $row12[main2_menu2_bg_color];
			$main2_menu2_bg_img = $row12[main2_menu2_bg_img];
			$main2_menu_bg_color = $row12[main2_menu_bg_color];
			$main2_menu_bg_img = $row12[main2_menu_bg_img];
			$main2_bottom_bg_color = $row12[main2_bottom_bg_color];
			$main2_bottom_bg_img = $row12[main2_bottom_bg_img];
			$main2_partner_img = $row12[main2_partner_img];
		}	
	}
/**	사용안함
	if($main_module == 3){
		$shop_sql13 = "select * from $Design2_Temp2Table where mart_id='$mart_id'";
		$shop_res13 = mysql_query($shop_sql13, $dbconn);

		if( mysql_num_rows($shop_res13) > 0){
			$row13 = mysql_fetch_array($shop_res13);

			$main_main_img = $row13[main_main_img];
			$main_main_img_flash_height = $row13[main_main_img_flash_height];
			$main_news_title_img = $row13[main_news_title_img];
			$main_news_img = $row13[main_news_img];
			$main_chuchon_title_img = $row13[main_chuchon_title_img];
			$main_chuchon_exp_img = $row13[main_chuchon_exp_img];
			$main_new_title_img = $row13[main_new_title_img];
			$main_chuchon_title_bg_color = $row13[main_chuchon_title_bg_color];
			$main_chuchon_title_bg_img = $row13[main_chuchon_title_bg_img];
			$main_news_title_bg_color = $row13[main_news_title_bg_color];
			$main_news_title_bg_img = $row13[main_news_title_bg_img];
			$main_new_title_bg_color = $row13[main_new_title_bg_color];
			$main_new_title_bg_img = $row13[main_new_title_bg_img];
			$main_menu1_bg_color = $row13[main_menu1_bg_color];
			$main_menu1_bg_img = $row13[main_menu1_bg_img];
			$main_menu2_bg_color = $row13[main_menu2_bg_color];
			$main_menu2_bg_img = $row13[main_menu2_bg_img];
			$main_partner_img = $row13[main_partner_img];
			$main_bottom_color = $row13[main_bottom_color];
			$main_bottom_img = $row13[main_bottom_img];
		}
	} **/

	if($main_module == 4){
		$shop_sql14 = "select * from $Design2_Temp5Table where mart_id='$mart_id'";
		$shop_res14 = mysql_query($shop_sql14, $dbconn);

		if( mysql_num_rows($shop_res14) > 0){
			$row14 = mysql_fetch_array($shop_res14);

			$main_banner1_img = $row14[main_banner1_img];
			$main_banner1_height = $row14[main_banner1_height];
			$main_banner1_link = $row14[main_banner1_link];
			$main_banner1_if_newwin = $row14[main_banner1_if_newwin];
			$main_banner2_img = $row14[main_banner2_img];
			$main_banner2_height = $row14[main_banner2_height];
			$main_banner2_link = $row14[main_banner2_link];
			$main_banner2_if_newwin = $row14[main_banner2_if_newwin];
			$main_banner3_img = $row14[main_banner3_img];
			$main_banner3_height = $row14[main_banner3_height];
			$main_banner3_link = $row14[main_banner3_link];
			$main_banner3_if_newwin = $row14[main_banner3_if_newwin];
			$main_chuchon_img = $row14[main_chuchon_img];
			$main_newitem_img = $row14[main_newitem_img];
			$main_planitem_img = $row14[main_planitem_img];
			$main_planitem1_img = $row14[main_planitem1_img];
			$main_planitem1_link = $row14[main_planitem1_link];
			$main_planitem1_if_newwin = $row14[main_planitem1_if_newwin];
			$main_planitem2_img = $row14[main_planitem2_img];
			$main_planitem2_link = $row14[main_planitem2_link];
			$main_planitem2_if_newwin = $row14[main_planitem2_if_newwin];
			$main_union_title_img = $row14[main_union_title_img];
			$main_union_img = $row14[main_union_img];
			$main_hititem_img = $row14[main_hititem_img];
			$main_bottom_color = $row14[main_bottom_color];
			$main_bottom_img = $row14[main_bottom_img];
			$main_union_link = $row14[main_union_link];
			$main_union_if_newwin = $row14[main_union_if_newwin];
		}
	}
}

/** 사용안함
$shop_sql15 = "select * from $Design2_BottomTable where mart_id='$mart_id'";
$shop_res15 = mysql_query($shop_sql15, $dbconn);
if( mysql_num_rows($shop_res15) > 0){
	$row15 = mysql_fetch_array($shop_res15);

	$bottom_img1 = $row15[bottom_img1];
	$bottom_img2 = $row15[bottom_img2];
	$bottom_img3 = $row15[bottom_img3];
	$bottom_img4 = $row15[bottom_img4];
	$bottom_img5 = $row15[bottom_img5];
	$bottom_logo = $row15[bottom_logo];
	$bottom_logo_width = $row15[bottom_logo_width];
	$bottom_logo_height = $row15[bottom_logo_height];
} **/
?>	
