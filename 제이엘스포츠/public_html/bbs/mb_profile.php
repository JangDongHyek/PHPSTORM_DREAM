<?
	require_once("include/lib.inc.php");
	$profile=rg_get_member_info($mb_id);
	extract($profile);

	$show = array(1=>"nick",2=>"name",3=>"email",4=>"msn",5=>"homepage",
	              6=>"tel",7=>"mobile",8=>"jumin",9=>"birth",10=>"address",
								11=>"sex",12=>"job",13=>"hobby",14=>"photo",15=>"icon",
								16=>"signature", 17=>"greet");
	foreach($show as $key => $val) {
		if($site[st_join_form_cfg][$key] == 0) { 
			$GLOBALS["show_{$val}_begin"]= '<!--';
			$GLOBALS["show_{$val}_end"]= '-->';
		} else {
			$GLOBALS["show_{$val}_begin"]= '';
			$GLOBALS["show_{$val}_end"]= '';
		}
		if($site[st_join_form_cfg][$key] == 2) { 
			$GLOBALS["need_{$val}"]= true;
		} else {
			$GLOBALS["need_{$val}"]= false;
		}
	}

	if($mb_photo) {
		$mb_photo_view = "<img src=$member_photo_url$mb_photo>";
	} else {
		if(!$show_photo_begin) {
			$show_del_photo_begin = '<!--';
			$show_del_photo_end = '-->';
		}
	}
	if($mb_icon) {
		$mb_icon_view = "<img src=$member_icon_url$mb_icon>";
	} else {
		if(!$show_icon_begin) {
			$show_del_icon_begin = '<!--';
			$show_del_icon_end = '-->';
		}
	}

	$need_password = false;

	$show_jumin_begin = '<!--';
	$show_jumin_end = '-->';
	
	$required_password = '';
	
	for($i=1;$i<11;$i++) {
		eval("\$show_ext{$i}_begin = (\$site[st_mb_ext_types][{$i}]==0)?'<!--':'';");
		eval("\$show_ext{$i}_end = (\$site[st_mb_ext_types][{$i}]==0)?'-->':'';");
		eval("\$show_ext{$i}_title = \$site[st_mb_ext_name{$i}];");
	}
	$checked_mb_open_info = ($mb_open_info)?'checked':'';
	$checked_mb_mailing = ($mb_mailing)?'checked':'';
	
	$group[gr_header_file] = '';
	$group[gr_footer_file] = '';
	$group[gr_header_tag] = '';
	$group[gr_footer_tag] = '';
	$width='100%';
	if(!$mb_signature) {
		$show_signature_begin = "<!--";
		$show_signature_end = "-->";
	} else
		$mb_signature = nl2br($mb_signature);

	if(!$mb_greet) {
		$show_greet_begin = "<!--";
		$show_greet_end = "-->";
	} else
		$mb_greet = nl2br($mb_greet);
	
	include($skin_site_path."head.php");
	include($skin_site_path."mb_profile.php");
	include($skin_site_path."foot.php");
?>