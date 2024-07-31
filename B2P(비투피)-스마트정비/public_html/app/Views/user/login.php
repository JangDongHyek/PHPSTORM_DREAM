<?php
echo view('common/header_user');
echo view('common/user_head');
?>


<div class="user_con">
    <div id="<?php echo $pid ?>">
        <dl class="input_form">
            <dt>주문번호</dt>
            <dd>
                <input type="number" class="border_gray" placeholder="ex)20221228001" id="orderNo" name="oderNo">
            </dd>
        </dl>
        <dl class="input_form">
            <dt>예약자명</dt>
            <dd>
                <input type="text" class="border_gray" placeholder="ex)김혜리" id="name" name="name">
            </dd>
        </dl>
        <dl class="input_form">
            <dt>핸드폰번호</dt>
            <dd>
                <input type="tel" class="border_gray" placeholder="ex)01012345678" id="hp" name="hp">
            </dd>
        </dl>
        
        <button class="btn btn-blue" type="button" onclick="ajax_check_order()">확인하기</button>
    </div>
</div>

<script>
    let isAjaxIng = false;

    function ajax_check_order(){
        if(isAjaxIng) {
            return false;
        }
        showLoading(true);
        isAjaxIng = true;

        let formData = new FormData();
        formData.append("orderNo",$("#orderNo").val().trim());
        formData.append("name",$("#name").val().trim());
        formData.append("hp",$("#hp").val().trim());

        $.ajax({
            url: '<?= base_url("user/ajax_check_order")?>',
            type: 'POST',
            dataType: 'json',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                if(data.code != "200") {
                    swal(data.msg);
                    return;
                }
                location.href = "<?=base_url('user/rvList')?>";
            },
            error: function(jqXHR, textStatus, errorThrown) {
            },
            complete: function(jqXHR, textStatus) {
                isAjaxIng = false;
                showLoading(false);
            }
        });
    }
</script>

<?php
echo view('common/user_tail');
echo view('common/footer');
?>
