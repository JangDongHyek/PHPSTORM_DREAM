<?
include_once('./_common.php');
$g5['title'] = 'Delete account';
include_once('./_head.php');

if($member['secession'] == 'Y') {
    alert('Membership cancellation request has already been received.');
}
?>

<link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">
	
<div class="area_secession">
	<div class="inr v3">
		<h2>Delete account</h2>
		<div class="area_box">
			<div class="box">
				<h3>Please check the following before deleting your account.</h3>
				<ul class="box_list">
					<li>1. After deleting your account, you will be unable to reuse or recover the current ID.</li>
					<li>2. All account information and activity history will be deleted, and all deleted data cannot be recovered. <br>However, information that are archived for legal reasons is stored for a certain period. Please check the Podosea Privacy Policy for more details.</li>
					<li>3. Forum posts and comments will not be automatically deleted after the account is deleted.</li>
					<li>4. You must delete or make private any posts BEFORE deleting account</li>
					<li>5. We cannot verify user credibility after an account has been deleted, so we cannot arbitrarily delete your posts.</li>
					<li>6. All Bunkers will be deleted with your account, and cannot be recovered. Please spend all Bunkers not applicable to the refund policy as they cannot be refunded.</li>
					<li>7. It may take up to 7 days for completion of the account deletion process.</li>
				</ul>
			</div>
			<div class="ck_box">
				<input type="checkbox" id="agree" name="agree">
				<label for="agree">
					<span></span>
					<em> I have viewed and agree to the above items regarding the Podosea account deletion process.</em>
				</label>
			</div>
		</div>
		<div class="area_confirm">
			<input type="button" class="btn_submit" value="Apply to delete account" onclick="secession();">
		</div>
	</div>
</div>
</div>

<script>
    function secession() {
        if($('input:checkbox[id="agree"]:checked').length == 0) {
            swal('Please agree to the guidelines for handling when canceling membership.');
            return false;
        }

        $.ajax({
            url: './ajax.secession.php',
            type: 'post',
            success: function(data) {
                if(data) {
                    swal('Membership cancellation request has been completed.')
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
