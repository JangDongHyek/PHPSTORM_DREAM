<script type="text/javascript" src="<?=G5_SHOP_URL?>/js/Innopay.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
    	$("#PayMethod").change(function(){
            if("VBANK"==$("#payMethod").val()){
            	$("#VbankExpDate").removeAttr("disabled");
            	$("#VbankExpDate").val(ediDate.substring(0, 8));
            }else{
            	$("#VbankExpDate").attr("disabled",true);
            }
        });
				var isMobile=checkMobileDevice();
				if(isMobile){
					$("#forward").val("N");
				}else{
					$("#forward").val("N");
				}
    });
		function checkMobileDevice() {
        var mobileKeyWords = new Array('Android', 'iPhone', 'iPod', 'BlackBerry', 'Windows CE', 'SAMSUNG', 'LG', 'MOT', 'SonyEricsson');
        for (var info in mobileKeyWords) {
            if (navigator.userAgent.match(mobileKeyWords[info]) != null) {
                return true;
            }
        }
        return false;
    }
</script>
<form name="sm_form" method="POST" action="" accept-charset="euc-kr">
<input type="hidden" name="ordr_idxx"   value="<?php echo $od_id; ?>">
<input type="hidden" name="good_name"   value="<?php echo $goods; ?>">
<input type="hidden" name="good_mny"    value="<?php echo $tot_price; ?>">
<input type="hidden" name="od_settle_case" value=""><!-- 은행계좌번호 -->
</form>