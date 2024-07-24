<?
include_once('./_common.php');
include_once("../class/Lib.php");
$jl = new JL();

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

<style>
    @media screen and (max-width:1024px) {
        #area_my{display: none;}
    }
</style>

    <div id="area_mypage" class="profile">
		<div class="inr" id="app">
			<div id="mypage_wrap">
				<?php include_once('./mypage_info.php'); ?>

                <profile-main mb_no="<?=$member['mb_no']?>"></profile-main>

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
    <script>
        $(document).ready(function() {
            // 모달 열기
            $('.openModalBtn').on('click', function() {
                var modalId = $(this).data('modal');
                $('#' + modalId).show();
            });

            // 모달 닫기
            $('.modal .close').on('click', function() {
                $(this).closest('.modal').hide();
            });

            // 선택하기 버튼 클릭 시 모달 닫기
            $('.modal-btn button').on('click', function() {
                $(this).closest('.modal').hide();
            });

            // 모달 외부 클릭 시 모달 닫기
            $(window).on('click', function(e) {
                if ($(e.target).hasClass('modal')) {
                    $(e.target).hide();
                }
            });
        });

        //파일첨부
        // 요소들을 선택합니다
        const addFileDiv = document.getElementById('addFile');
        const fileInput = document.createElement('input');  // 파일 입력 엘리먼트를 생성합니다
        fileInput.type = 'file';  // 파일 입력으로 설정합니다
        fileInput.style.display = 'none';  // 숨깁니다 (버튼처럼 스타일링하기 위해)

        // 생성한 파일 입력을 addFileDiv에 추가합니다
        addFileDiv.appendChild(fileInput);

        // span과 버튼을 선택합니다
        const span = addFileDiv.querySelector('span');
        const btn = addFileDiv.querySelector('.btn');

        // 버튼에 클릭 이벤트 리스너를 추가합니다
        btn.addEventListener('click', function() {
            fileInput.click();  // 파일 입력을 클릭하여 파일 선택 대화상자를 엽니다
        });

        // 파일 입력의 변경 이벤트를 처리합니다
        fileInput.addEventListener('change', function() {
            const file = this.files[0];  // 선택된 파일을 가져옵니다
            if (file) {
                span.textContent = file.name;  // span의 텍스트를 선택된 파일의 이름으로 업데이트합니다
            } else {
                span.textContent = '증빙자료 파일 첨부';  // 파일이 선택되지 않았을 때는 기본 텍스트로 설정합니다
            }
        });




    </script>
    <script>
        function save_profile() {

            let formData = new FormData();

            for(let i=1; i<7; i++){
                let fileInput = document.getElementById("file"+i);
                let file = fileInput.files[0];
                if(file){
                    formData.append("file"+i, file);
                }

                let checkbox = document.getElementById("file_d"+i);
                if (checkbox != null && checkbox.checked) {
                    formData.append("file_d"+i,"t");
                } else {
                    formData.append("file_d"+i,"f");
                }
            }
            // let re_time = $("#mb_1").val();
            // let start_time_h = $("#call_hour_1").val();
            // let end_time_h = $("#call_hour_2").val();
            // let start_time_m = $("#call_min_1").val();
            // let end_time_m = $("#call_min_2").val();
            // let mb_about = $("#pf_produce").val();

            let mb_nick = $("#mb_nick").val();
            var org_mb_nick = "<?=$member[mb_nick]?>";
            if(mb_nick.trim() == "") {
                alert("닉네임은 필수입니다.");
                return false;
            }
            if(mb_nick.trim().length < 2) {
                alert("닉네임은 2글자 이상이어야 합니다.");
                return false;
            }
            let mb_sex = $("input:radio[name='mb_sex']:checked").val() ? $("input:radio[name='mb_sex']:checked").val() : "";
            let mb_birth = $("#mb_birth").val();
            let mb_job = $("input:radio[name='mb_job']:checked").val();
            let mb_interest = [];
            $("input[name='mb_interest']:checked").each(function(e){
                mb_interest.push($(this).val());
            })
            var nick_check = false;
            var error = false;
            // 닉네임중복검사
            $.ajax({
                url : "ajax_nick_check.php",
                method : "post",
                enctype : "multipart/form-data",
                async : false,
                cache : false,
                data : {
                    "_method" : "get",
                    "mb_nick" : mb_nick
                },
                dataType : "json",
                success: function(res){
                    console.log(res);
                    if(!res.success) {
                        alert(res.message);
                        error = true;
                    }
                    else {
                        if(res.data.length > 0) nick_check = true;
                    }
                }
            });

            if(error) return false;

            if(nick_check && org_mb_nick != mb_nick) {
                alert("이미 존재하는 닉네임입니다.");
                return false;
            }

            formData.append("mode","save_profile");
            // formData.append("re_time",re_time);
            // formData.append("start_time_h",start_time_h);
            // formData.append("end_time_h",end_time_h);
            // formData.append("start_time_m",start_time_m);
            // formData.append("end_time_m",end_time_m);
            // formData.append("mb_about",mb_about);
            formData.append("mb_nick",mb_nick);
            formData.append("mb_sex",mb_sex);
            formData.append("mb_birth",mb_birth);
            formData.append("mb_job",mb_job);
            formData.append("mb_interest",JSON.stringify(mb_interest));
            formData.append("mb_profile","true");

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "<?=G5_URL?>/bbs/ajax.controller.php", true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // 파일 업로드 성공 시 동작할 코드 작성
                    swal('등록 되었습니다.');
                    console.log("파일 업로드 성공");

                    var response = xhr.responseText;
                    console.log(response);
                } else {
                    // 파일 업로드 실패 시 동작할 코드 작성
                    console.log("파일 업로드 실패");
                }
            };
            xhr.send(formData);
        }



        //이미지 미리보기
        function getImgPrev(input) {
            var regex = /(.*?)\.(jpg|jpeg|png|bmp|jfif|JPG)$/;
            var filesTempArr = [];

            if (!regex.test(input.files[0].name)) {
                swal("이미지만 등록이 가능합니다. (jpg, jpeg, png, bmp, jfif, JPG)");
                input.value = "";
                return false;
            }

            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var img = document.createElement('img'),
                        div_img = document.getElementById("img_area");
                    // btn = document.createElement('button');

                    var el = $(input);
                    // img.setAttribute("class", "p_img");
                    img.setAttribute("src", e.target.result);
                    // img.setAttribute("style", "width:110px;height:110px;");
                    $("#img_area").html(img);

                }
                reader.readAsDataURL(input.files[0]);

                var files = input.files;
                var files_arr = Array.prototype.slice.call(files);
                filesTempArr.push(files_arr);

                var form = $('#imgfrm')[0];
                var formData = new FormData(form);
                // formData.append("mb_icon", filesTempArr);
                formData.append("mode", "mb_icon_update");

                // 이미지 등록
                $.ajax({
                    url : g5_bbs_url + "/ajax.controller.php",
                    processData: false,
                    contentType: false,
                    data: formData,
                    type: 'POST',
                    success : function(data) {
                        if(data =='success'){
                            swal('사진 등록이 완료되었습니다.');
                            // $('#del_file').val(data);
                        }else{
                            alert(data);
                        }
                    },
                    err : function(err) {
                        alert(err.status);
                    }
                });
            }
        }

    </script>



<?
include_once('./_tail.php');
?>

