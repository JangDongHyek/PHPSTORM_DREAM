<?
include_once('./_common.php');
include_once(G5_PATH."/jl/JlConfig.php");

$name = "cmypage";
$pid = "mypage_form";
$g5['title'] = '전문가 프로필관리';
include_once('./_head.php');

$mb = get_member($member[mb_id]);

if($mb == null) alert("로그인 해주세요", G5_URL);

?>

<? if($name=="cmypage") { ?>
	<body<?php echo isset($g5['body_script']) ? $g5['body_script'] : ''; ?> class="cmypage">
<?}?>

<link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">

<link href="https://cdn.jsdelivr.net/npm/smartwizard@6/dist/css/smart_wizard_all.min.css" rel="stylesheet" type="text/css" />
<style>
    @media screen and (max-width:1024px) {
        #area_my{display: none;}
        #ft{display: none;}
    }



</style>

    <div id="area_mypage" class="profile">
		<div class="inr" id="app">
            <?php include('./mypage_banner.php'); ?>
			<div id="mypage_wrap">
				<?php include_once('./mypage_info.php'); ?>

                <?if ($member['mb_level'] == 2) {?>
                    <profile-client mb_no="<?=$member['mb_no']?>"></profile-client>
                <?} else if ($member['mb_level'] == 3) {?>
                    <profile-main mb_no="<?=$member['mb_no']?>"></profile-main>
                <?}?>



                <!-- 마이페이지에만 나오는 메뉴 -->
				<?php include_once('./mypage_menu.php'); ?>
			</div>
		</div>

    </div>

<?
$jl->vueLoad();
//foreach ($jl->getDir("/component/profile") as $data) {
//    echo $data."<br>";
//}

//$jl->includeDir("/component/profile");
include_once($jl->ROOT."/component/profile/profile-client.php");
include_once($jl->ROOT."/component/profile/profile-main.php");
include_once($jl->ROOT."/component/profile/profile-section1.php");
include_once($jl->ROOT."/component/profile/profile-section2.php");
include_once($jl->ROOT."/component/profile/profile-section3.php");
include_once($jl->ROOT."/component/profile/profile-section4.php");
include_once($jl->ROOT."/component/profile/profile-section5.php");
include_once($jl->ROOT."/component/profile/profile-section6.php");
include_once($jl->ROOT."/component/profile/profile-section7.php");
include_once($jl->ROOT."/component/profile/profile-section8.php");
?>
<script src="https://cdn.jsdelivr.net/npm/smartwizard@6/dist/js/jquery.smartWizard.min.js" type="text/javascript"></script>

<script>
    $(function() {
        // Smart Wizard 초기화
        $('#smartwizard').smartWizard({
            transition: {
                animation: 'slideHorizontal' // Step content 애니메이션: none|fade|slideHorizontal|slideVertical|slideSwing|css
            },
            toolbar: {
                showNextButton: false, // 다음 버튼 표시
                showPreviousButton: false, // 이전 버튼 표시
            },
            onLeaveStep: function (obj, context) {
                // 마지막 단계에 도달한 경우 버튼 텍스트 변경
                if (context.toStep === 7) { // Step 7 is the last step
                    $('#next-btn').text('프로필 저장하기');
                } else {
                    $('#next-btn').text('저장하고 다음');
                }
            }
        });
    });
</script>



<?
include_once('./_tail.php');
?>

