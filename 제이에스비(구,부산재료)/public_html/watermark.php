<?
include "./connect.php";
//================== �Լ� ������ �ҷ��� ==================================================
include "./main.class";
			
			
			$sql = "select * from item where item_no < '482'";
			$res = mysql_query($sql, $dbconn);
			
		
			$watermark_path ="$Co_img_UP$mart_id/logo.png"; //���͸�ũ���

			for($i=0;$rows = mysql_fetch_array($res);$i++){
				$arr_result = waterMarkImage("$Co_img_UP$mart_id/".$rows[img], $watermark_path, 50, 100); //���͸�ũó��
				$arr_result = waterMarkImage("$Co_img_UP$mart_id/".$rows[img_big], $watermark_path, 50, 100); //���͸�ũó��
				$arr_result = waterMarkImage("$Co_img_UP$mart_id/".$rows[img_big2], $watermark_path, 50, 100); //���͸�ũó��
				$arr_result = waterMarkImage("$Co_img_UP$mart_id/".$rows[img_big3], $watermark_path, 50, 100); //���͸�ũó��
				$arr_result = waterMarkImage("$Co_img_UP$mart_id/".$rows[img_big4], $watermark_path, 50, 100); //���͸�ũó��
				$arr_result = waterMarkImage("$Co_img_UP$mart_id/".$rows[img_big5], $watermark_path, 50, 100); //���͸�ũó��
				
				$count = $i;
			}
			echo $count."�Ϸ�";
?>