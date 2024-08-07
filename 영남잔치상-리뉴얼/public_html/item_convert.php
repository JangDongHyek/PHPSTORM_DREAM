<?php
	include_once("./_common.php");
	$catArr=array("35"=>"80","37"=>"10","36"=>"20","43"=>"60","49"=>"70","46"=>"80","44"=>"90","47"=>"a0","45"=>"b0","50"=>"40","51"=>"d0","52"=>"50","53"=>"c0","42"=>"e0");
	$sql="select * from item where firstno='42'";
	$result=sql_query($sql);
	while($row=sql_fetch_array($result)){
		/*$it_id=time().rand(1000,9999);
		$ca_id=$catArr[$row[firstno]];
		$ca_id2=$catArr[$row['prevno']];
		$sql="insert g5_shop_item set
				ca_id='$ca_id',
				ca_id2='$ca_id2',
				it_id='$it_id',
				it_name='$row[item_name]',
				it_explan='$row[item_explain]',
				it_explan2='$row[short_explain]',
				it_cust_price ='$row[price]',
				it_price='$row[z_price]',
				it_img1='yensan/".$row[img_sml]."',
				it_time='".date("Y-m-d H:i:s")."',
				it_update_time='".date("Y-m-d H:i:s")."',
				it_10='$row[item_no]'";
		$result2=sql_query($sql);
		if(!$result2){
			echo $sql."===";
			echo "error : ".$row[item_no]."<br/>";
		}*/
					$it_use=$row[if_hide]=="0"?"1":"0";
		$sql="select * from g5_shop_item where it_10='$row[item_no]'";
		$result2=sql_query($sql);
		$cnt=sql_num_rows($result2);
		$ca_id=$catArr[$row[firstno]];
		//$ca_id2=$catArr[$row['prevno']];
		if($cnt==0){
			$it_id=time().rand(1000,9999);
			
			$item_explan=addslashes($row[item_explain]);
			$item_explan2=addslashes($row[short_explain]);
			
			/*$sql="insert g5_shop_item set
					ca_id='$ca_id',
					ca_id2='$ca_id2',
					it_id='$it_id',
					it_name='$row[item_name]',
					it_explan='$item_explan',
					it_explan2='$item_explan2',
					it_cust_price ='$row[price]',
					it_price='$row[z_price]',
					it_img1='janchisang/".$row[img_big]."',
					it_img2='janchisang/".$row[img_big2]."',
					it_time='".date("Y-m-d H:i:s")."',
					it_update_time='".date("Y-m-d H:i:s")."',
					it_use='$it_use',
					it_10='$row[item_no]'";*/
			/*$result2=sql_query($sql);
			if(!$result2){
				echo $sql."===";
				echo "error : ".$row[item_no]."<br/>";
			}*/
		}else{
			$sql="update g5_shop_item set it_use='$it_use',ca_id='$ca_id' where it_10='$row[item_no]'";
			echo $sql."<br/>";
			sql_query($sql);
		}

	}
?>