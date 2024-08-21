<?
// 추가배송비

$add_delivery_price = array("3000", "4000", "4000", "4500", "7500");
$add_delivery_district = array(5);
$add_delivery_district[0] = array("제주", "제주시", "가덕도", "위도면", "옥도면", "낙월면", "난지도리", "마도동", "신수동", "산양읍", "사량면", "한산면", "욕지면", "지도리", "수도동", "상오리");
$add_delivery_district[1] = array("묘도동", "금산면", "노화읍", "소안면", "청산면", "임자면", "증도면", "지도읍", "신의면", "하의면", "장산면", "흑산면", "도초면", "비금면", "자은면", "암태면", "팔금면");
$add_delivery_district[2] = array("안좌면", "압해면", "고하동", "달동", "율도동", "삼산면", "교동면", "오천면", "추자면", "우도면", "금당면", "생일면", "금일읍", "약산면", "고금면");
$add_delivery_district[3] = array("화정면", "삼산면", "남면", "조도면", "봉선리", "동백리", "신지면", "보길면");
$add_delivery_district[4] = array("대청면", "덕적면", "백령면", "연평면", "자월면", "북도면", "울릉군");

for($i=0, $delivery_count=count($add_delivery_district); $i<$delivery_count; $i++)
{
	if(array_search("대청면", $add_delivery_district[$i])!==false)
		break;
}
	echo $add_delivery_price[$i];
?>