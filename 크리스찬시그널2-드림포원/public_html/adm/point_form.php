<?php
$sub_menu = "210100";
include_once('./_common.php');

if ($is_admin != 'super')
    alert_close('최고관리자만 접근 가능합니다.');

$g5['title'] = '만나 지급/차감';
include_once(G5_PATH.'/head.sub.php');

?>

<style>
    .btn_submit {
        display: inline-block;
        padding: 0 7px;
        height: 24px;
        border: 0;
        background: #ff3061;
        color: #fff !important;
        letter-spacing: -0.1em;
        text-decoration: none;
        vertical-align: middle;
        line-height: 2em;
    }

</style>
<div id="menu_frm" class="new_win">
    <h1><?php echo $g5['title']; ?></h1>
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="all: unset;">
            <div class="modal-body">
                <p>대상아이디</p>
                <div>
                    <form name="sfrm" autocomplete="off" onsubmit="return search_id(this);">
                        <input type="text" name="input_id" id="input_id" class="frm_input" size="20" required minlength="2">
                        <button type="submit" class="btn_submit">검색</button>
                    </form>
                </div><br/>
                <div id="srch_result" class="tbl_head02 mb_tbl"></div><br/>
                <form name="fpoint" id="fpoint">
                    <input type="hidden" name="reg_mb_id" id="reg_mb_id">
                    <p>
                        만나
                        <span style="margin-left: 10px; margin-right: 10px;"><input type="radio" name="input_category" value="지급" checked>&nbsp;지급</span>
                        <span><input type="radio" name="input_category" id="input_category" value="차감">&nbsp;차감</span>
                    </p>
                    <div>
                        <input type="text" name="input_point" id="input_point" class="frm_input" size="20" required minlength="2" onkeyup="only_number(this);">
                    </div><br/>
                    <!--<p>업무담당자</p>
                    <div>
                        <input type="text" name="input_manager" id="input_manager" class="frm_input" size="20" required minlength="2">
                    </div><br/>-->
                    <p>지급/차감 사유</p>
                    <div>
                        <textarea name="input_content" id="input_content" style="resize: unset;" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn_submit" onclick="fpoint_submit();">적용</button>
                <button type="button" class="btn_frmline" data-dismiss="modal">닫기</button>
            </div>
        </div>
    </div>
</div>

<script>
    // 대상아이디 검색
    function search_id(f) {
        if (f.input_id.value.length < 2) {
            alert('대상아이디를 2자 이상 입력하세요.');
            f.input_id.focus();
            return false;
        }

        $.ajax({
            type : "get",
            url : "./ajax.point_id_search.php",
            data : {"id" : f.input_id.value },
            dataType : "html",
            async : false,
            success : function(data) {
                $("#srch_result").html(data);
            },
            error : function(xhr,status,error) {
                console.log(error);
            },
            complete : function() {
                return false;
            }
        });

        return false;
    }

    // 대상아이디 검색 선택
    function select_id(mb_id) {
        $('#reg_mb_id').val(mb_id);
        $('input[name="input_id"]').val(mb_id);
        $('#srch_result').html('');
    }

    // 만나 지급/차감 적용
    function fpoint_submit() {
        if($.trim($('#input_id').val()).length == 0) {
            alert('대상 아이디를 입력하세요.');
            return false;
        }
        if($('#reg_mb_id').val() != $('#input_id').val()) { // 대상 아이디 선택 후 input 내용 변경했을 시
            alert('대상 아이디를 확인하세요.');
            return false;
        }
        if($('#input_point').val().replace(',','').length == 0) {
            alert('지급/차감할 만나를 입력하세요.');
            return false;
        }

        var form = $('#fpoint')[0];
        var formData = new FormData(form);

        $.ajax({
            url:  g5_admin_url + "/ajax.point_action.php",
            processData: false,
            contentType: false,
            data: formData,
            type: 'POST',
            async: false,
            success: function (data) {
                if(data == 'success') {
                    alert('만나가 적용되었습니다.');
                    window.close();
                    opener.location.reload();
                }
                else if(data == 'fail') {
                    alert('차감할 만나가 부족합니다.');
                }
            },
        });
    }
</script>

<?php
include_once(G5_PATH.'/tail.sub.php');
?>