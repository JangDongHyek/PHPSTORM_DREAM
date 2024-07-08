<?
include_once('./_common.php');

?>
<script type="text/javascript" src="../../js/jquery-1.8.3.min.js"></script>
<script>
$(window).ready(function(){ 
	$.ajax({
		type:"POST",
		url:"<?=G5_PLUGIN_URL?>/gcm/send_msg.php",
		dataType:"html",
		data: {
			"post_no": "<?=$post_no?>",
			"post_title": "<?=$post_title?>",
			"post_content": "<?=$post_content?>",
			"post_url": "<?=$post_url?>",
			"post_user": "<?=$post_user?>",
			"post_save": "<?=$post_save?>"
		},
		success:function(data){
			//alert(data);
			
		},
		error:function(request,status,error){
			//alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		},
		beforeSend:function(){
			
		},
		complete:function(){
			
		}
	});
});
</script>