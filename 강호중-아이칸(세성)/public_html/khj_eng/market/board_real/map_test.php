<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
 
<html xmlns="http://www.w3.org/1999/xhtml">
 
<head>
 
<meta http-equiv="content-type" content="text/html; charset=utf-8">
 
<meta name="generator" content="kimsQ">
 
<meta name="author" content="<?=$browse['name']?>">
 
<meta name="keywords" content="<?=$browse['title']?> <?=$R['tag']?>">
 
<title>���̹� ��</title>
 
</head>
 
<body  leftmargin=0 topmargin=0 marginwidth=0 >
 
<?
 
function getUTF_8($str)
 
{
 
	return iconv('EUC-KR','UTF-8',$str);
 
}
 



function getEUC_KR($str)
 
{
 
	return iconv('UTF-8','EUC-KR',$str);
 
}
 



function getnavermapXml2($navermapxml_url,&$ygeopoint_x,&$ygeopoint_y){
 
	$pquery = $navermapxml_url;
 
	$fp = fsockopen ("maps.naver.com", 80, $errno, $errstr, 30);
 
	if (!$fp) {
 
		echo "$errstr ($errno)";
 
	} else {
 
		fputs($fp, "GET /api/geocode.php?");
 
		fputs($fp, $pquery);
 
		fputs($fp, " HTTP/1.1\r\n");
 
		fputs($fp, "Host: maps.naver.com\r\n");
 
		fputs($fp, "Connection: Close\r\n\r\n");
 



		$header = "";
 
		while (!feof($fp)) {
 
			$out = fgets ($fp,512);
 
			if (trim($out) == "") {
 
				break;
 
			}
 
			$header .= $out;
 
		}
 



		$mapbody = "";
 
		while (!feof($fp)) {
 
			$out = fgets ($fp,512);
 
			$mapbody .= getUTF_8($out);
 
		}
 



		$idx = strpos(strtolower($header), "transfer-encoding: chunked");
 



		if ($idx > -1) { // chunk data
 
			$temp = "";
 
			$offset = 0;
 
			do {
 
				$idx1 = strpos($mapbody, "\r\n", $offset);
 
				$chunkLength = hexdec(substr($mapbody, $offset, $idx1 - $offset));
 



				if ($chunkLength == 0) {
 
					break;
 
				} else {
 
					$temp .= substr($mapbody, $idx1+2, $chunkLength);
 
					$offset = $idx1 + $chunkLength + 4;
 
				}
 
			} while(true);
 
			$mapbody = $temp;
 
		}
 
		fclose ($fp);
 
	 }
 
	// ������� �ּ� �˻� xml �Ľ�
 



	$map_x_point_1=explode("<x>", ($mapbody));
 
	$map_x_point_2=explode("</x>", $map_x_point_1[1]);
 
	$ygeopoint_x=$map_x_point_2[0];
 
	$map_y_point_1=explode("<y>", ($mapbody));
 
	$map_y_point_2=explode("</y>", $map_y_point_1[1]);
 
	$ygeopoint_y=$map_y_point_2[0];
 
#
 
}//end function
 
#
 
$naver_mapkey	 = "/*���ڸ��� �߱޹��� �ڵ带 �Է��ϼ���*/";//http://dev.naver.com/openapi/register ����Ű �߱��ڵ�
 
//$addr <== ���⿡ �ּҸ� �Է��ϰų� ���� �Ѱ��ָ� �ǰ�����
 
$navermapxml_url='key='.$naver_mapkey.'&query='.getUTF_8($addr);
 
#
 
getnavermapXml2($navermapxml_url,$ygeopoint_x,$ygeopoint_y);
 
?>
 
<!-- ���̹� ���� Ű �� -->
 
<script type="text/javascript" src="http://map.naver.com/js/naverMap.naver?key=<?php echo $naver_mapkey?>"></script>
 
<!-- ���̹� ���� Ű �� �� -->
 
<style>
 
#mapcontainer{
 
	width: <?php echo $map_width?>px;
 
	height: <?php echo $map_height?>px;http://naver.com/
 
	margin:0;
 
}
 
</style>
 
<div id="mapbody"></div>
 
<div id="display"></div>
 
<script type="text/javascript">
 



 var x_point = '<? echo ($ygeopoint_x)?$ygeopoint_x:0; ?>';
 
 var y_point = '<? echo ($ygeopoint_y)?$ygeopoint_y:0; ?>';
 
 /*
 
 * ����API 2.0�� ������ ī�� ��ǥ �ܿ��� ���浵 ��ǥ�� �����մϴ�.
 
 * ���浵 ��ǥ�� ����ϱ� ���ؼ��� ������ NPoint Ŭ���� ��� NLatLng Ŭ������ ����ؾ� �մϴ�.
 
 *
 
 * http://maps.naver.com/api/geocode.php ���� "��⵵����������1��25-1"�� �˻��� �����
 
 * x : 321033, y : 529749
 
 * �� ���� ��� ������ ���ڽ��ϴ�.
 
 *
 
 * ���Ǹ� ���� ���������� mapObj, tm128, latlng�� ������ �ξ����ϴ�.
 
 */
 
var mapObj = new NMap(document.getElementById('mapbody'),<?php echo $map_width?>,<?php echo $map_height?>);
 
var tm128 = new NPoint(x_point,y_point);
 
var latlng;
 
/*
 
 * ��⵵����������1��25-1�� ��ġ�� �̵��մϴ�. ������ 1�� �����Ͽ����ϴ�.
 
 * �ε����ʰ� Ȯ��/��� ��Ʈ�ѷ��� ����ϰ� ���콺 ����/�ƿ��� Ȱ��ȭ �Ͽ����ϴ�.
 
 */
 
mapObj.setCenterAndZoom(tm128, <?php echo $yzoom?>);
 
mapObj.addControl(new NZoomControl());
 
mapObj.enableWheelZoom();
 
latlng = mapObj.fromTM128ToLatLng(tm128);
 
/*
 
 * NMark�� ���������� tm128 ��� ���浵�� ����Ͽ� �������� ǥ���Ͽ����ϴ�.
 
 */
 
var mark = new NMark(latlng, new NIcon('../image/ic_spot.png',new NSize(52,41),new NSize(14,40)));
 
mapObj.addOverlay(mark);
 
</script>
 
</body>
 
</html>