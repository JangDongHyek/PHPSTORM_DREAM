<?
// 이노페이 계좌실명조회
include_once('../common.php');

$g5['title'] = '계좌실명조회';
include_once(G5_THEME_PATH.'/head.php');

$url = "Https://www.arspay.co.kr/AcctNmReq.acct";

$post_data = array();
$post_data["mid"] = "butdrivinm"; //INNOPAY_MID;
$post_data["merkey"] = get_text("BJQTPtoda47ieFmZgux2SCUGgk9LXDBcWRMqa3Wd/D5vVtfpW4KbBfq61n0H3cZdOD9V/XC6eNsE06HOGuiBg=="); //INNOPAY_KEY;
$post_data["moid"] = "TEST00001";
$post_data["bankCode"] = "032";
$post_data["acntNo"] = "092120588417";
$post_data["idNo"] = "890220";
$post_data["acntNm"] = "윤지영";

echo "<pre>";
print_r($post_data);
echo "</pre>";

$headers = array("content-type: application/json"); 

//배열을 JSON데이터로 생성 
$json = json_encode($post_data); 

//CURL함수 사용 
$ch=curl_init(); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($ch, CURLOPT_URL, $url); 
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
curl_setopt($ch, CURLOPT_POST, true); 
curl_setopt($ch, CURLOPT_POSTFIELDS, $json); 
curl_setopt($ch, CURLOPT_TIMEOUT, 999);		// sec

$response = curl_exec($ch); 

if(curl_error($ch)){ 
	$curl_data = null; 
} else {
	$curl_data = $response; 
} 

curl_close($ch);

// print_r($curl_data);

$decode = json_decode($response, true);
echo "<pre>";
print_r($decode);
echo "</pre>";

?>

<script>
$(function() {
	//getAccName();
});

/*
function getAccName() {
	var obj = {};
	obj.mid = "<?=INNOPAY_MID?>";
	obj.merkey = "<?=INNOPAY_KEY?>";
	obj.moid = "TEST00001";
	obj.bankCode = "032";
	obj.acntNo = "092120588417";
	obj.idNo = "890220";
	obj.acntNm = "윤지영";

	var json = JSON.stringify(obj);



	console.log(json);
	return false;

	$.ajax({  
		type : "post",  
		url : "https://www.arspay.co.kr/AcctNmReq.acct",
		data : JSON.stringify(obj),
		dataType : "json",
		contentType: "application/json",
		// header:{'Accept': 'application/json', 'Content-Type': 'application/json'},
		success : function(result) {  
			console.log(result);
		},  
		error : function(xhr,status,error) {
			console.log(error);
		}
	});
}
*/
</script>


<?
include_once(G5_THEME_PATH.'/tail.php');
?>