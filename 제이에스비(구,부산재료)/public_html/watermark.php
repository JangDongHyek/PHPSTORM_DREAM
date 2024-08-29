<?
include "./connect.php";
//================== 窃荐 颇老阑 阂矾咳 ==================================================
include "./main.class";
			
			
			$sql = "select * from item where item_no < '482'";
			$res = mysql_query($sql, $dbconn);
			
		
			$watermark_path ="$Co_img_UP$mart_id/logo.png"; //况磐付农版肺

			for($i=0;$rows = mysql_fetch_array($res);$i++){
				$arr_result = waterMarkImage("$Co_img_UP$mart_id/".$rows[img], $watermark_path, 50, 100); //况磐付农贸府
				$arr_result = waterMarkImage("$Co_img_UP$mart_id/".$rows[img_big], $watermark_path, 50, 100); //况磐付农贸府
				$arr_result = waterMarkImage("$Co_img_UP$mart_id/".$rows[img_big2], $watermark_path, 50, 100); //况磐付农贸府
				$arr_result = waterMarkImage("$Co_img_UP$mart_id/".$rows[img_big3], $watermark_path, 50, 100); //况磐付农贸府
				$arr_result = waterMarkImage("$Co_img_UP$mart_id/".$rows[img_big4], $watermark_path, 50, 100); //况磐付农贸府
				$arr_result = waterMarkImage("$Co_img_UP$mart_id/".$rows[img_big5], $watermark_path, 50, 100); //况磐付农贸府
				
				$count = $i;
			}
			echo $count."肯丰";
?>