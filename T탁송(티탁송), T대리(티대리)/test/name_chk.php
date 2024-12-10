<?
// 이노페이 계좌실명조회
include_once('../common.php');

$g5['title'] = '계좌실명조회 ajax 테스트';
include_once(G5_THEME_PATH.'/head.php');

?>

<script>
$(function() {
	//pgNameChk();
});


function pgNameChk() {
	/*
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
	*/

	$.ajax({  
		type : "get",  
		url : "./ajax.name_chk.php",
		//data : {"s_date" : s_date, "e_date" : e_date},  
		dataType : "text",  
		async : false,
		success : function(result) {  
			console.log(result);
		},  
		error : function(xhr,status,error) {
			console.log(error);
		}
	});
}

</script>


<?
include_once(G5_THEME_PATH.'/tail.php');
?>