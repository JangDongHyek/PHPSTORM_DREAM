<?php
    include_once("./_common.php");

    $mb_id = $_REQUEST['mb_id'];
    $w = $_REQUEST['w'];
    if(!$mb_id){
        exit('회원 아이디가 없습니다.');
    }

    $mb = get_member($mb_id);
    $sql = "select count(*) as cnt from g5_member_contract where mb_id = '{$mb_id}' and use_yn <> 'N'";
    $contract_row_cnt = sql_fetch($sql)['cnt'];

    if($w == 'u'){
        if($contract_row_cnt){
            //alert('작성중인 계약서가 있습니다.',G5_ADMIN_URL.'/contract_pop.php?w=u&mb_id='.$mb_id);
        }else{
            alert('선 계약서 작성하기.',G5_ADMIN_URL.'/contract_pop.php?mb_id='.$mb['mb_id'].'&pop=true');
        }
    }else{
        if($contract_row_cnt){
            alert('작성중인 계약서가 있습니다.',G5_ADMIN_URL.'/contract_pop.php?w=u&mb_id='.$mb['mb_id'].'&pop=true');
        }else{
            //alert('선 계약서 작성하기.',G5_ADMIN_URL.'/contract_pop.php?mb_id='.$mb_id);
        }
    }

?>
<style>
    body{margin: 0;background-color: #fff}
    html{background-color: #fff}
    .btn_confirm{float: right; margin: 20px 20px 0 20px; border: 1px solid #000000; background-color: #1a1a1a; color: #fff; border-radius: 4px; padding: 4px 10px; cursor: pointer;}
</style>
<script src="<?php echo G5_JS_URL ?>/jquery-1.8.3.min.js"></script>
<?php if($is_admin){ ?>
    <input type="button" value="계약서 초기화" class="btn_confirm" onclick="contractDel('<?=$mb['mb_id']?>','N')">
<?php } ?>
    <iframe id="event_frame" src="<?=G5_BBS_URL?>/contract_form.php?w=<?=$w?>&mb_id=<?=$mb['mb_id']?>&pop=true" width="100%" height="2750px"frameborder='0' scrolling="no" src='hompage' style="overflow-y:hidden"></iframe>




<script>
    // 계약삭제
    function contractDel(mb_id, approvalYN) {

        if(confirm('계약서를 삭제 하시겠습니까?')){
            $.ajax({
                url: './ajax.del_mb_contract.php',
                type: 'post',
                data: {
                    mb_id: mb_id,
                    approvalYN: approvalYN
                },
                success: function(data) {
                    console.log(data);
                    if (data) {
                        alert('계약서가 삭제되었습니다.');
                        opener.location.reload();
                        window.close();
                    }
                },
                error: function(request, error) {
                    alert("code:" + request.status + "\n" + "message:" + request.responseText + "\n" + "error:" + error);
                }
            });

        }else{
            return false;
        }


    }
</script>