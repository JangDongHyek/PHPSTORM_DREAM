<?php
$sub_menu = "260000";
include_once('./_common.php');
include_once('../lib/thumbnail.lib.php');

auth_check($auth[$sub_menu], 'r');


$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';

$g5['title'] = '신청자현황';
include_once('./admin.head.php');

?>
<!-- Meta Pixel Code -->
<script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', 1051471960040783);
    fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
               src="https://www.facebook.com/tr?id=1051471960040783&ev=PageView&noscript=1"
    /></noscript>
<!-- End Meta Pixel Code -->

<div id="app">
    <div class="local_ov01 local_ov">
        총신청자수 명
    </div>
    
    <form class="local_sch01 local_sch">
    <span class="schTit">강좌 검색 : </span>
    <input type="search" class="frm_input" name="all_search" v-model="filter.all_search" placeholder="강의명,강사명">
    <input type="button" class="btn_submit" value="검색">
    </form>
    
    
    <form name="fmemberlist" id="fmemberlist" action="./member_list_update.php" onsubmit="return fmemberlist_submit(this);" method="post">
    
    <div class="row row-horizon">
    <div class="tbl_head02">
        <table>
        <caption><?php echo $g5['title']; ?> 목록</caption>
        <thead>
        <tr>
            <th width="5" align="center" id="mb_list_chk">
                <label for="chkall" class="sound_only">강의 전체</label>
                <input type="checkbox" name="chkall" v-model="all_check">
            </th>
            <th id="mb_class">강의명</th>
            <th id="mb_name">이름</th>
            <th id="mb_gender">성별</th>
            <th id="mb_tel">연락처</th>
            <!--
            <th id="mb_email">이메일</th>
            <th id="mb_birth">생년월일</th>
            -->
            <th id="mb_address">주소</th>
            <th id="mb_occupation">직업</th>
            <th id="mb_amount">투자가능금액</th>
            <th id="mb_etc">요청사항</th>
            <th id="mb_date">신청일자</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="item in datas">
            <td headers="mb_list_chk" class="td_chk">
                <input type="checkbox" name="chk[]" v-model="checks" :value="item._idx">
            </td>
            <td align="center" class="mb_class" headers="mb_class">{{item.g5_class.subject}}</td>
            <td align="center" class="td_name" headers="mb_name">{{item.name}}</td>
            <td align="center" class="mb_gender" headers="mb_gender">{{item.gender}}</td>
            <td align="center" class="mb_tel" headers="mb_tel">{{item.phone}}</td>
            <!--
            <td align="center" class="mb_email" headers="mb_email">{{item.email}}</td>
            <td align="center" class="mb_birth" headers="mb_birth">{{item.birth}}</td>
            -->
            <td align="center" class="mb_address" headers="mb_address">{{item.address}}</td>
            <td align="center" class="mb_occupation" headers="mb_occupation">{{item.job}}</td>
            <td align="center" class="mb_occupation" headers="mb_occupation">{{item.amount}}</td>
            <td align="center" class="mb_occupation" headers="mb_occupation">{{item.etc}}</td>
            <td align="center" class="mb_date" headers="mb_date">{{item.c_date.split(" ")[0]}}</td>
        </tr>
       
        <tr v-if="total == 0"><td colspan=\"".$colspan."\" class=\"empty_table\">자료가 없습니다.</td></tr>
        </tbody>
        </table>
    </div>
    </div><!--row row-horizon-->
    <!-- <test-component></test-component> -->
    <pagination-component :page="filter.page" :limit="filter.limit" :total="total" @change="changePage"></pagination-component>
    
    <div class="btn_list01 btn_list">
        <!--<input type="submit" name="act_button" value="선택수정" onclick="document.pressed=this.value">-->
        <input type="button" name="act_button" value="선택삭제" @click="deletesData">
    </div>
    
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.7.16"></script>

<?
include(G5_PATH."/component/pagination-component.php");
// include(G5_PATH."/component/test-component.php");
?>

<script>
// Vue 인스턴스 생성
document.addEventListener('DOMContentLoaded', function(){
    new Vue({
        el: '#app',
        data: {
            base_url : "<?=G5_URL?>",
            model : "g5_class_request",
            idx : "<?=$_GET['idx']?>",
            data : {},
            datas : [],
            filter : {
                page : <?=$_GET['page'] ? $_GET['page'] : 1?>,
                limit : 10,
                all_search : "<?=$_GET['all_search'] ? $_GET['all_search'] : ""?>"
            },
            total : 0,
            checks : [],
            all_check : false,
        },
        created : function() {
            if(this.idx) {
                this.filter.class_idx = this.idx;
            }
            this.getsData();
            // if(this.data._idx) this.getData();
        },
        mounted : function() {
            
        },
        methods: {
            changePage : function(page) {
                window.location.href = `${this.base_url}/adm/class_register_list.php?page=${page}&all_search=${this.filter.all_search}`;
            },
            postData : function() {
                var method = this.data._idx ? "put" : "post";
                var obj = JSON.parse(JSON.stringify(this.data));

                var objs = {
                    _method : method,
                    obj : JSON.stringify(obj),
                };

                var res = this.ajax(this.base_url + "/api/" + this.model + ".php",objs);

                if(res) {
                    console.log(res)
                }
            },
            deletesData : function() {
                var method = "deletes";

                if(this.checks.length <= 0) {
                    alert("하나 이상 선택하셔야합니다.");
                    return false;
                }

                var objs = {
                    _method : method,
                    arrays : JSON.stringify(this.checks)
                };

                var res = this.ajax(this.base_url + "/api/" + this.model + ".php",objs);
                if(res) {
                    alert("삭제되었습니다.");
                    window.location.reload();
                }
            },
            getData : function() {
                var method = "get";

                var objs = {
                    _method : method,
                    _idx : this.idx
                };

                var res = this.ajax(this.base_url + "/api/" + this.model + ".php",objs);
                if(res) {
                    console.log(res)
                    this.data = res.data;
                }
            },
            getsData : function() {
                var method = "gets2";

                var objs = {
                    _method : method,
                    filter : JSON.stringify(this.filter)
                };

                var res = this.ajax(this.base_url + "/api/" + this.model + ".php",objs);
                if(res) {
                    console.log(res)
                    this.datas = res.datas.datas;
                    this.total = res.datas.count;
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
        },
        computed : {
        },
        watch : {
            all_check : function() {
                this.checks = [];

                if(this.all_check) {
                    this.datas.forEach((item) => {
                        this.checks.push(item._idx);
                    });
                }
            }
        }

    });
}, false);
</script>


<?php
include_once ('./admin.tail.php');

?>
