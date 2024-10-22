<?php
$sub_menu = "260000";
include_once('./_common.php');
include_once('../lib/thumbnail.lib.php');

auth_check($auth[$sub_menu], 'r');

$sql_common = " from {$g5['member_table']} ";

$sql_search = " where (1) ";
if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case 'mb_point' :
            $sql_search .= " ({$sfl} >= '{$stx}') ";
            break;
        case 'mb_level' :
            $sql_search .= " ({$sfl} = '{$stx}') ";
            break;
        case 'mb_tel' :
        case 'mb_hp' :
            $sql_search .= " ({$sfl} like '%{$stx}') ";
            break;
        default :
            $sql_search .= " ({$sfl} like '%{$stx}%') ";
            break;
    }
    $sql_search .= " ) ";

}else if($stx_d){
	//회원 지역 검색	
	if($stx_mb_8) {
		$sql_search .= " and ( ";
		$sql_search .= " (mb_8 = '{$stx_mb_8}') ";		
		$sql_search .= " ) ";
	}

	//결혼 유형 검색	
	if($stx_mb_3) {
		$sql_search .= " and ( ";
		$sql_search .= " (mb_3 = '{$stx_mb_3}') ";		
		$sql_search .= " ) ";
	}

	//회원 성별 검색	
	if($stx_mb_2) {
		$sql_search .= " and ( ";
		$sql_search .= " (mb_2 = '{$stx_mb_2}') ";		
		$sql_search .= " ) ";
	}

	//회원 나이 검색 
	if($stx_mb_7_1 || $stx_mb_7_2){
		$sql_search .= " and ( ";		
	}

	if($stx_mb_7_1 && $stx_mb_7_2){
		$sql_search .= " mb_mb_312 between ".$stx_mb_7_1." and ".$stx_mb_7_2." ";
		//$sql_search .= " (DATE_FORMAT( NOW( ) ,  '%Y' ) - LEFT( mb_7, 4 ) +1) between ".$stx_mb_7_1." and ".$stx_mb_7_2." ";
	}else if($stx_mb_7_1 || $stx_mb_7_2){
		if($stx_mb_7_1) {								
			$sql_search .= " mb_mb_312 >= ".$stx_mb_7_1." ";		
			//$sql_search .= " (DATE_FORMAT( NOW( ) ,  '%Y' ) - LEFT( mb_7, 4 ) +1) >= ".$stx_mb_7_1." ";		
		}
		if($stx_mb_7_2) {								
			$sql_search .= " mb_mb_312 <= ".$stx_mb_7_2." ";		
			//$sql_search .= " (DATE_FORMAT( NOW( ) ,  '%Y' ) - LEFT( mb_7, 4 ) +1) <= ".$stx_mb_7_2." ";		
		}			
	}

	if($stx_mb_7_1 || $stx_mb_7_2){
		$sql_search .= " ) ";
	}

	//회원 직업 검색
	if($stx_mb_110) {
		$sql_search .= " and ( ";
		$sql_search .= " (mb_110 = '{$stx_mb_110}') ";		
		$sql_search .= " ) ";
	}

	//회원 학력 검색
	if($stx_mb_73) {
		$sql_search .= " and ( ";
		$sql_search .= " (mb_73 = '{$stx_mb_73}') ";		
		$sql_search .= " ) ";
	}

	//담당매니저 검색
	if($stx_mb_1) {
		$sql_search .= " and ( ";
		$sql_search .= " (mb_1 like '%{$stx_mb_1}%') ";		
		$sql_search .= " ) ";
	}

	//회원 신장 검색
	if($stx_mb_48_1 || $stx_mb_48_2){
		$sql_search .= " and ( ";		
	}
	if($stx_mb_48_1 && $stx_mb_48_2){
		$sql_search .= " mb_48 between ".$stx_mb_48_1." and ".$stx_mb_48_2." ";
	}else if($stx_mb_48_1 || $stx_mb_48_2){
		if($stx_mb_48_1) {								
			$sql_search .= " mb_48 >= ".$stx_mb_48_1." ";		
		}
		if($stx_mb_48_2) {								
			$sql_search .= " mb_48 <= ".$stx_mb_48_2." ";		
		}			
	}
	if($stx_mb_48_1 || $stx_mb_48_2){
		$sql_search .= " ) ";
	}

	//회원 종교 검색
	if($stx_mb_62) {
		$sql_search .= " and ( ";
		$sql_search .= " (mb_62 = '{$stx_mb_62}') ";		
		$sql_search .= " ) ";
	}
	

	$sql_search .= " and mb_level != 10 ";
}else if($stx_mb_company){
	if($stx_mb_company) {
		$sql_search .= " and ( ";
		$sql_search .= " (mb_company = '{$stx_mb_company}') ";		
		$sql_search .= " ) ";
	}
}

if ($is_admin != 'super')
    $sql_search .= " and mb_level <= '{$member['mb_level']}' ";

if($_SESSION['ss_mb_id'] != "lets080")
	$sql_search .= " and mb_id != 'lets080'";

if (!$sst) {
    $sst = "mb_datetime";
    $sod = "desc";
}

$sql_search .= " and mb_level <= 8 and mb_level >= 7 ";//매니저 레벨이 7~8
if($_SESSION['ss_mb_level'] == 9){
	$sql_search .= " and mb_company = '{$_SESSION['ss_mb_company']}' ";
}

$sql_order = " order by {$sst} {$sod} ";

//가맹점 명
$sql = "select * from `g5_member` where mb_level != 10 group by mb_company order by mb_datetime";
$company_name = sql_query($sql);

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$mb_count = $total_count + 1; //회원 넘버링

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

// 탈퇴회원수
$sql = " select count(*) as cnt {$sql_common} {$sql_search} and mb_leave_date <> '' {$sql_order} ";
$row = sql_fetch($sql);
$leave_count = $row['cnt'];

// 차단회원수
$sql = " select count(*) as cnt {$sql_common} {$sql_search} and mb_intercept_date <> '' {$sql_order} ";
$row = sql_fetch($sql);
$intercept_count = $row['cnt'];

$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';

$g5['title'] = '삼삼CLASS';
include_once('./admin.head.php');

//$sql = " select *, DATE_FORMAT(NOW( ), '%Y') - LEFT(mb_6, 4) + 1 as age {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
$sql = " select * {$sql_common} {$sql_search} {$sql_search_group} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);
//echo $sql;
$colspan = 17;

$mb_count = $mb_count - $rows * ($page - 1);
?>

<div class="local_ov01 local_ov">
    <?php echo $listall ?>
    총회원수 <?php echo number_format($total_count) ?>명
</div>

<!-- 단일검색 S -->
<!-- <form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">
<label for="sfl" class="sound_only">검색대상</label>
<select name="sfl" id="sfl">
    <option value="mb_1"<?php echo get_selected($_GET['sfl'], "mb_1"); ?>>담당매니저</option>
    <option value="mb_name"<?php echo get_selected($_GET['sfl'], "mb_name"); ?>>이름</option>
	<option value="mb_2"<?php echo get_selected($_GET['sfl'], "mb_2"); ?>>성별</option>    
    <option value="mb_mb_312"<?php echo get_selected($_GET['sfl'], "mb_mb_312"); ?>>나이</option>
	<option value="mb_110"<?php echo get_selected($_GET['sfl'], "mb_110"); ?>>직업</option>
	<option value="mb_73"<?php echo get_selected($_GET['sfl'], "mb_73"); ?>>학력</option>
	<option value="mb_8"<?php echo get_selected($_GET['sfl'], "mb_8"); ?>>지역</option>
	<option value="mb_48"<?php echo get_selected($_GET['sfl'], "mb_48"); ?>>키</option>
	<option value="mb_62"<?php echo get_selected($_GET['sfl'], "mb_62"); ?>>종교</option>
	<option value="mb_datetime"<?php echo get_selected($_GET['sfl'], "mb_datetime"); ?>>가입일시</option>
</select>
<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
<input type="text" name="stx" value="<?php echo $stx ?>" id="stx" required class="required frm_input">
<input type="submit" class="btn_submit" value="검색">
<input type="button" class="btn_submit" value="초기화" onclick="location.href='./member_list.php'">
</form>-->
<!-- 단일검색 E -->
<?php if ($is_admin == 'super' || $_SESSION['ss_mb_level'] > 9) { ?>
<!-- 가맹점 검색 S -->
    <div class="expert_form" id="app">
        <form>
            <div class="form_wrap">
                <div class="form">
                    <dl>
                        <dt>타이틀 이미지 등록<strong class="sound_only">*</strong></dt>
                        <dd>
                            <div id="preview">
                                <!--이미지 등록 전-->
                                <label for="imageInput" id="uploadLabel"><i class="fa-light fa-camera"></i> 이미지 등록</label>
                                <input type="file" id="imageInput" @change="handleUpload" accept="image/*" multiple="" style="display: none;">
                                <!--이미지 등록 후-->
                                <div id="imageContainer"></div>
                            </div>
                        </dd>
                    </dl>
                    <dl>
                        <dt><label for="">분류<strong class="sound_only">*</strong></label></dt>
                        <dd>
                            <select v-model="data.category">
                                <option value="경매기초학습">경매기초학습</option>
                            </select>
                        </dd>
                    </dl>
                    <dl>
                        <dt><label for="">클래스명<strong class="sound_only">*</strong></label></dt>
                        <dd><input type="text" v-model="data.subject" name="" value="" id="" maxlength="40"></dd>
                    </dl>
                    <dl>
                        <dt><label for="">강사명<strong class="sound_only">*</strong></label></dt>
                        <dd><input type="text" v-model="data.teacher" name="" value="" id="" maxlength="20"></dd>
                    </dl>
                    <dl>
                        <dt><label for="">신청기간<strong class="sound_only">*</strong></label></dt>
                        <dd class="flex">
                            <input type="date" v-model="data.request_s_date" name="" value="" id="">
                            &nbsp;~&nbsp;
                            <input type="date" v-model="data.request_e_date" name="" value="" id="">
                    </dd>
                    </dl>
                    <dl>
                        <dt><label for="">교육기간<strong class="sound_only">*</strong></label></dt>
                        <dd class="flex">
                            <input type="date" v-model="data.education_s_date" name="" value="" id="">
                            &nbsp;~&nbsp;
                            <input type="date" v-model="data.education_e_date" name="" value="" id="">
                        </dd>
                    </dl>
                    <dl>
                        <dt><label for="">클래스 소개<strong class="sound_only">*</strong></label></dt>
                        <dd>
                            <naver-editor name="introduction" :content="data.introduction" :default_content="default_content"></naver-editor>
                        </dd>
                    </dl>
                    <dl>
                        <dt><label for="">커리큘럼<strong class="sound_only">*</strong></label></dt>
                        <dd>
                            <naver-editor name="curriculum" :content="data.curriculum" :default_content="default_content2"></naver-editor>
                        </dd>
                    </dl>

                </div>
            </div>
            <div class="btn_confirm">
                <input type="button" @click="postData" value="클래스 등록" class="btn_submit">
                <a href="http://www.xn--289al3wekfa.kr/bbs/class.list.php" class="btn_cancel">취소</a>
            </div>
        </form>
    </div><!-- 가맹점 검색 E -->
<?}?>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.7.16"></script>
<script>
    // Vue 인스턴스 생성
    document.addEventListener('DOMContentLoaded', function(){
        new Vue({
        el: '#app',
        data: {
            base_url : "<?=G5_URL?>",
            data : {
                _idx : "<?=$_GET["_idx"]?>",
                category : "",
                subject : "",
                teacher : "",
                request_s_date : "",
                request_e_date : "",
                education_s_date : "",
                education_e_date : "",
                introduction : "",
                curriculum : "",
            },
            default_content : [],
            default_content2 : [],
            upfile : "",
        },
        created : function() {
            if(this.data._idx) {
                this.getData();
            }
        },
        methods: {
            handleUpload : function(event) {
                this.upfile = (event.target.files[0]);
            },
            postData : function() {
                var method = this.data._idx ? "put" : "post";


                var obj = JSON.parse(JSON.stringify(this.data));
                
                obj.introduction = this.default_content.getById["introduction"].getIR().replaceAll('"',"'");
                obj.curriculum = this.default_content2.getById["curriculum"].getIR().replaceAll('"',"'");
                var objs = {
                    _method : method,
                    obj : JSON.stringify(obj).replaceAll("\\",""),
                    upfile : this.upfile
                };

                var res = this.ajax(this.base_url + "/api/g5_class.php",objs);

                if(res) {
                    alert("완료되었습니다.");
                    window.location.reload();
                }
            },
            getData : function() {
                var method = "get";

                var objs = {
                    _method : method,
                    _idx : this.data._idx
                };

                var res = this.ajax(this.base_url + "/api/g5_class.php",objs);
                if(res) {
                    console.log(res)
                    this.data = res.data;
                    const img = document.createElement('img');
                    const imageContainer = document.getElementById('imageContainer');
                    img.src = this.data.file.src;
                    imageContainer.innerHTML = ''; // Clear previous images
                    imageContainer.appendChild(img);
                }
            },
            ajax : function(url,objs) {
                var form = new FormData();
                if(url.indexOf(".php") == -1) url = url + ".php";
                for(var i in objs) {
                    form.append(i, objs[i]);
                }

                var result = null;
                $.ajax({
                    url : url,
                    method : "post",
                    enctype : "multipart/form-data",
                    processData : false,
                    contentType : false,
                    async : false,
                    cache : false,
                    data : form,
                    dataType : "json",
                    success: function(res){
                        if(!res.success) alert(res.message);
                        else {
                            result = res;

                            if(res.data) {
                                var obj = res.data;
                                for(field in obj) {
                                    if(field.indexOf("_id") !== -1) continue;
                                    try {
                                        obj[field] = JSON.parse(obj[field]);
                                    } catch (e) {

                                    }
                                }
                                res.data = obj;
                            }
                        }
                    }
                });

                return result;
            }
        }
    });

       //메인 이미지 등록
       document.getElementById('imageInput').addEventListener('change', function(event) {
        const imageContainer = document.getElementById('imageContainer');
        const uploadLabel = document.getElementById('uploadLabel');
        imageContainer.innerHTML = ''; // Clear previous images
        const files = event.target.files;

        if (files.length > 0) {
            uploadLabel.style.display = 'none'; // Hide the upload label
        }

        Array.from(files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;

                // Add click event to change the image
                img.addEventListener('click', function() {
                    document.getElementById('imageInput').click();
                    document.getElementById('imageInput').onchange = function(event) {
                        const newFile = event.target.files[0];
                        if (newFile) {
                            const newReader = new FileReader();
                            newReader.onload = function(e) {
                                img.src = e.target.result;
                            }
                            newReader.readAsDataURL(newFile);
                        }
                    }
                });

                imageContainer.appendChild(img);
            }
            reader.readAsDataURL(file);
        });
    });

}, false);

</script>

<script>
function fmemberlist_submit(f)
{
    if (!is_checked("chk[]")) {
        alert(document.pressed+" 하실 항목을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택삭제") {
        if(!confirm("선택한 자료를 정말 삭제하시겠습니까?")) {
            return false;
        }
    }

    return true;
}
</script>

<script>
 

</script>


<?php
include_once('../component/naver-editor.php');
include_once('../component/test-component.php');

include_once ('./admin.tail.php');
?>
