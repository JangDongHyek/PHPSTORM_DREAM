<?
	if (!get_magic_quotes_gpc()) {
		$ss[kw] = addslashes($ss[kw]);
	}

	if(!empty($ss[kw]) && count($ss) > 0 ){
		$find=array();
		reset($ss);
		while (list ($ss_key, $ss_val) = each ($ss)) {
			if($ss_val=='1') {
				switch($ss_key) {
					case 'sn' : 
						$find[]=" (rg_name Like '%{$ss[kw]}%') ";
						break;
					case 'st' : 
						$find[]=" (rg_title Like '%{$ss[kw]}%') ";
						break;
					case 'sc' :
						$find[]=" (rg_content Like '%{$ss[kw]}%') ";
						break;
					case 'sname' :
						$find[]=" (rg_ext4 Like '%{$ss[kw]}%') ";
						break;
					case 'stel' :
						$find[]=" (rg_ext5 Like '%{$ss[kw]}%') ";
						break;
				}
			}
		}		
		if(count($find) > 0) {
			if($ss[sf] == 'and') {
				$where_str.=" AND (".implode("AND",$find).")";
			} else {
				$where_str.=" AND (".implode("OR",$find).")";
			}
		}
		unset($find);
		unset($key);
		unset($val);
	}
	
	if($ss[fc]) $where_str.=" AND (rg_cat_num = '{$ss[fc]}') ";

	if($ext32_change){
		$where_str.=" AND (rg_ext11 = '$ext32_change') ";
	}


	if($yeyak_date_start && $yeyak_date_end){
		$where_str.=" AND (rg_ext1 >= '$yeyak_date_start' and rg_ext1 <= '$yeyak_date_end') ";
	}

?>	