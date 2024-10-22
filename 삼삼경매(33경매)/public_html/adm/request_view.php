<?php
$sub_menu = "250000";
include_once('./_common.php');
include_once('../lib/thumbnail.lib.php');

auth_check($auth[$sub_menu], 'r');

$g5['title'] = '온라인상담';
include_once('./admin.head.php');

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
<form id="fsearch_c" name="fsearch" class="local_sch01 local_sch" method="get">

<input type="hidden" name="stx_c" value="detail" id="stx_d"><!-- 가맹점 검색 -->

<span class="schTit">온라인상담 검색 : </span>
<select id="stx_mb_company" name="stx_mb_company">
	<option value="">선택하세요.</option>
	<?for($i=0; $company_row=sql_fetch_array($company_name); $i++){?>
	<option value="<?=$company_row['mb_company']?>" <?php echo get_selected($_GET['stx_mb_company'], $company_row['mb_company']); ?>><?=$company_row['mb_company']?></option>	
	<?}?>
</select>
<input type="submit" class="btn_submit" value="검색">
<input type="button" class="btn_submit" value="초기화" onclick="location.href='./member_list_manager.php'">
</form>
<!-- 가맹점 검색 E -->
<?}?>

<div class="form_wrap grid" id="app">
    <div class="form">
        <dl>
            <dt><label for="wr_name">이름<strong class="sound_only">*</strong></label></dt>
            <dd><input type="text" name="wr_name" v-model="data.wr_name" value="" id="wr_name" required="" size="10" maxlength="20"></dd>
        </dl>
        <dl class="flex">
            <dt>성별<strong class="sound_only">*</strong></dt>
            <dd>
                <input type="radio" id="gender_female" v-model="data.gender" name="gender" value="여성"><label for="gender_female">여성</label>
                <input type="radio" id="gender_male"  v-model="data.gender" name="gender" value="남성"><label for="gender_male">남성</label>
            </dd>
        </dl>
        <dl>
            <dt><label for="contact">연락처<strong class="sound_only">*</strong></label></dt>
            <dd><input type="text" id="contact" v-model="data.wr_hp" name="contact" placeholder="연락처"></dd>
        </dl>
        <dl>
            <dt><label for="email">이메일<strong class="sound_only">*</strong></label></dt>
            <dd><input type="text" id="email" v-model="data.wr_email" name="email" placeholder="이메일"></dd>
        </dl>
        <dl>
            <dt><label for="birthdate">생년월일<strong class="sound_only">*</strong></label></dt>
            <dd><input type="date" id="birthdate" v-model="data.birthdate" name="birthdate" placeholder="생년월일"></dd>
        </dl>
        <dl>
            <dt><label for="address">주소<strong class="sound_only">*</strong></label></dt>
            <dd><input type="text" id="address" v-model="data.address" name="address" placeholder="시(서울시는 구까지 입력 부탁드립니다)"></dd>
        </dl>
        <dl>
            <dt><label for="occupation">직업<strong class="sound_only">*</strong></label></dt>
            <dd><input type="text" id="occupation" v-model="data.wr_1" name="occupation" placeholder="직업"></dd>
        </dl>
    </div>
    <div class="form">
        <dl class="flex">
            <dt>결혼유무<strong class="sound_only">*</strong></dt>
            <dd>
                <input type="radio" id="marital_status_single" v-model="data.wr_2" name="marital_status" value="미혼"><label for="marital_status_single">미혼</label>
                <input type="radio" id="marital_status_married" v-model="data.wr_2" name="marital_status" value="기혼"><label for="marital_status_married">기혼</label>
            </dd>
        </dl>
        <dl>
            <dt>투자경험여부<strong class="sound_only">*</strong><span>복수 선택 가능합니다.</span></dt>
            <dd>
                <p><input type="checkbox" id="investment_none"  v-model="data.wr_3" name="investment_experience[]" value="금융투자상품에 투자해 본 경험 없음">
                    <label for="investment_none">금융투자상품에 투자해 본 경험 없음</label></p>
                <p> <input type="checkbox" id="investment_bank" v-model="data.wr_3" name="investment_experience[]" value="은행, 예/적금, 국채, MMF, CMA등"><label for="investment_bank">은행, 예/적금, 국채, MMF, CMA등</label></p>
                <p>  <input type="checkbox" id="investment_fund" v-model="data.wr_3" name="investment_experience[]" value="펀드, 원금보장형 ELS, 금융채 등"><label for="investment_fund">펀드, 원금보장형 ELS, 금융채 등</label></p>
                <p>  <input type="checkbox" id="investment_gpl" v-model="data.wr_3" name="investment_experience[]" value="GPL, NPL, 경매 등"><label for="investment_gpl">GPL, NPL, 경매 등</label></p>
                <p>  <input type="checkbox" id="investment_realestate" v-model="data.wr_3" name="investment_experience[]" value="실물 부동산 투자"><label for="investment_realestate">실물 부동산 투자</label></p>
                <p>  <input type="checkbox" id="investment_bitcoin" v-model="data.wr_3" name="investment_experience[]" value="비트코인"><label for="investment_bitcoin">비트코인</label></p>
                <p>  <input type="checkbox" id="investment_venture" v-model="data.wr_3" name="investment_experience[]" value="벤처투자"><label for="investment_venture">벤처투자</label></p>
            </dd>
        </dl>
        <dl>
            <dt>희망하는 상담 서비스<strong class="sound_only">*</strong><span>복수 선택 가능합니다.</span></dt>
            <dd>
                <p>  <input type="checkbox" id="service_financial" v-model="data.wr_4" name="desired_service[]" value="재무상담"><label for="service_financial">재무상담</label></p>
                <p>   <input type="checkbox" id="service_mortgage" v-model="data.wr_4" name="desired_service[]" value="담보물채권투자"><label for="service_mortgage">담보물채권투자</label></p>
                <p>   <input type="checkbox" id="service_realestate" v-model="data.wr_4" name="desired_service[]" value="부동산 상담"><label for="service_realestate">부동산 상담</label></p>
                <p> <input type="checkbox" id="service_auction" v-model="data.wr_4" name="desired_service[]" value="경매상담"><label for="service_auction">경매상담</label></p>
                <p> <input type="checkbox" id="service_legal" v-model="data.wr_4" name="desired_service[]" value="법무상담"><label for="service_legal">법무상담</label></p>
                <p>  <input type="checkbox" id="service_loan" v-model="data.wr_4" name="desired_service[]" value="대출상담"><label for="service_loan">대출상담</label></p>
            </dd>
        </dl>
        <dl class="flex">
            <dt>희망하시는 상담 유형<strong class="sound_only">*</strong><span>항목에 대한 설명을 입력해주세요</span></dt>
            <dd>
                <input type="radio" id="consultation_type_visit" v-model="data.wr_5" name="consultation_type" value="내방"><label for="consultation_type_visit">내방</label>
                <input type="radio" id="consultation_type_phone" v-model="data.wr_5" name="consultation_type" value="전화"><label for="consultation_type_phone">전화</label>
            </dd>
        </dl>
        <dl>
            <dt>문의사항<strong class="sound_only">*</strong><span>최대한 구체적으로 적어주세요. </span></dt>
            <dd>
                <textarea id="inquiry" name="inquiry" v-model="data.wr_6" placeholder="최대한 구체적으로 적어주세요."></textarea>
            </dd>
        </dl>
        <dl class="flex">
            <dt>통화가능시간대<strong class="sound_only">*</strong><span>항목에 대한 설명을 입력해주세요</span></dt>
            <dd>
                <input type="time" id="available_time" name="available_time" v-model="data.wr_7">
            </dd>
        </dl>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/vue@2.7.16"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script>
// Vue 인스턴스 생성
new Vue({
        el: '#app',
        data: {
            base_url : "<?=G5_URL?>",
            data : {},
            wr_id : "<?=$_GET['id']?>"
        },
        created : function() {
            this.getData();
        },
        methods: {
            postData : function() {
                var method = "post";
                var obj = JSON.parse(JSON.stringify(this.data));
                
                var objs = {
                    _method : method,
                    obj : JSON.stringify(obj),
                };
                
                var res = this.ajax(this.base_url + "/api/",objs);

                if(res) {
                    
                }
            },
            getData : function() {
                var method = "get";
                
                var objs = {
                    _method : method,
                    wr_id : this.wr_id,
                };
                
                var res = this.ajax(this.base_url + "/api/g5_write_qna.php",objs);
                if(res) {
                    console.log(res.data);
                    this.data = res.data;
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

</script>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;page='); ?>

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

<?php
include_once ('./admin.tail.php');
?>
