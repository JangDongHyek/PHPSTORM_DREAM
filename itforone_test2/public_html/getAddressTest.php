<?php
include_once('./_common.php');



?>

<html>
<button onclick="getCity('충남', '천안시 동남구')">테스트버튼</button>
<select id="dong"></select>
<select id="gu"></select>

</html>

<script src="<?=G5_JS_URL?>/jquery-1.12.4.min.js"></script>
<script>
    function getCity(si, gu){

        if(!si && !gu){
            return false;
        }

        var opt;
        var opt_select;

        $.ajax({
            type:"GET",
            url:"<?php echo G5_URL?>/api/get_map.php",
            dataType: "json",
            data: {
                "si": si,
                "gu": gu
            },
            success:function(datas){
                console.log(datas);

                for(var i=0; i<datas.length; i++){
                    if("<?php echo $si?>" == datas[i] || "<?php echo $gu?>" == datas[i] || "<?php echo $dong?>" == datas[i])
                        opt_select = "selected";
                    else
                        opt_select = "";

                    opt = "<option value='"+datas[i]+"' "+opt_select+">"+datas[i]+"</option>";

                    if(!gu){
                        if(si == '세종'){
                            $("#dong").append(opt);
                        } else {
                            $("#gu").append(opt);
                        }

                    }else{
                        $("#dong").append(opt);
                    }
                }
            },
            error:function(request,status,error){
                alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
            }
        });
    }
</script>
