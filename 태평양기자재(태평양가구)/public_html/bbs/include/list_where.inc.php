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
?>	