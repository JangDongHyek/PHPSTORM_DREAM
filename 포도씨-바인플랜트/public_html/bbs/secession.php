<?
include_once('./_common.php');
$g5['title'] = '회원탈퇴';
include_once('./_head.php');

if($member['secession'] == 'Y') {
    alert('이미 회원탈퇴 신청이 접수되었습니다.');
}
?>

<link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">
	
<div class="area_secession">
	<div class="inr v3">
		<h2>회원탈퇴</h2>
		<div class="area_box">
			<div class="box">
				<h3>탈퇴 전 아래의 유의사항을 꼭 확인하여 주세요.</h3>
				<ul class="box_list">
					<li>1. 사용하고 계신 아이디는 탈퇴할 경우 재사용 및 복구가 불가능합니다.</li>
					<li>2. 탈퇴 후 회원정보 이용기록은 모두 삭제되며, 삭제된 데이터는 복구되지 않습니다. <br>다만, 법령에 의하여 보관해야 하는 정보는 회원탈퇴 후에도 일정기간 보관됩니다. 자세한 사항은 포도씨 개인정보 처리방침에서 확인할 수 있습니다.</li>
					<li>3. 탈퇴 후에도 게시판에 등록한 게시글 및 댓글은 탈퇴 시 자동 삭제되지 않습니다.</li>
					<li>4. 삭제를 원하는 게시글이 있다면 반드시 직접 탈퇴 전 비공개 처리하거나 삭제하시기 바랍니다.</li>
					<li>5. 탈퇴 후에는 회원정보가 삭제되어 본인 여부를 확인할 수 있는 방법이 없기에, 게시글을 임의로 삭제해드릴 수 없습니다.</li>
					<li>6. 탈퇴 시 회원이 보유하고 있는 벙커는 모두 소멸되며, 복구가 불가능합니다. 환불규정에 해당하지 않는 벙커는 환불이 불가능하므로 모두 소진하시기 바랍니다.</li>
					<li>7. 경우에 따라 탈퇴처리까지는 7일 가량 소요될 수 있습니다.</li>
				</ul>
			</div>
			<div class="ck_box">
				<input type="checkbox" id="agree" name="agree">
				<label for="agree">
					<span></span>
					<em>상기 포도씨 회원탈퇴시 처리사항 안내를 확인하였음에 동의합니다.</em>
				</label>
			</div>
		</div>
		<div class="area_confirm">
			<input type="button" class="btn_submit" value="회원탈퇴 신청" onclick="secession();">
		</div>
	</div>
</div>
</div>

<script>
    function secession() {
        if($('input:checkbox[id="agree"]:checked').length == 0) {
            swal('회원탈퇴 시 처리사항 안내에 동의해 주세요.');
            return false;
        }

        $.ajax({
            url: './ajax.secession.php',
            type: 'post',
            success: function(data) {
                if(data) {
                    swal('회원탈퇴 신청이 완료되었습니다.')
                    .then(()=>{
                        location.href = g5_url;
                    })
                }
            }
        })
    }
</script>

<?
include_once('./_tail.php');
?>
