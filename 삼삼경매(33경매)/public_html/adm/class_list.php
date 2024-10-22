<?php
$sub_menu = "260000";
include_once('./_common.php');
include_once('../lib/thumbnail.lib.php');
include_once(G5_PATH."/model/model.php");

auth_check($auth[$sub_menu], 'r');


$g5['title'] = '삼삼CLASS';
include_once('./admin.head.php');


?>


<div id="app">
    <form  name="fsearch" class="local_sch01 local_sch" method="get">
    
    <span class="schTit">강좌 검색 : </span>
    <input type="text" class="frm_input" placeholder="강의명,강사명" name="all_search" v-model="filter.all_search" @keyup.enter="changePage(1)">
    <input type="button" class="btn_submit" @click="changePage(1)" value="검색">
    </form>
    
    
    <div class="btn_add01 btn_add">
        <!--<a href="./member_form.php" id="member_add">회원추가</a>-->
        <?php if ($is_admin == 'super' || $_SESSION['ss_mb_level'] > 8) { ?>
        <a href="./class_form.php" id="member_add">강의 등록</a>
        <?php if ($is_admin == 'super') { ?>
        <!--<a href="./member_form_company.php" id="member_add">가맹점 추가</a>-->
        <?php } ?>
        <?php } ?>
    </div>
    
    
    <input type="hidden" name="member_list_manager" value="1">
    
    <div class="row row-horizon">
    <div class="tbl_head02">
        <table>
        <caption><?php echo $g5['title']; ?> 목록</caption>
            <colgroup>
                <col width="40px">
                <col width="100px">
                <col width="*">
                <col width="*">
                <col width="100px">
                <col width="100px">
                <col width="100px">
                <col width="50px">
                <col width="50px">
            </colgroup>
        <thead>
        <tr>
            <th width="5" align="center" id="mb_list_chk">
                <label for="chkall" class="sound_only">강의 전체</label>
                <input type="checkbox" v-model="all_check">
            </th>				
            <th id="mb_company">분류</th>
            <th id="mb_name">강의명</th>
            <th id="mb_tel">강사명</th>
            <th id="mb_hp">등록일</th>
            <th id="mb_10">신청기간</th>
            <th id="mb_email">교육기간</th>
            <th id="mb_11">신청자수</th>
            <th id="mb_list_mng">수정</th>
        </tr>
        </thead>
        <tbody>
     
        <tr v-for="item in datas">
            <td headers="mb_list_chk" class="td_chk">
                <input type="checkbox" v-model="checks" :value="item._idx">
            </td>
            <td align="center" class="td_company" headers="mb_company">{{item.category}}</td>
            <td align="center" class="td_name" headers="mb_name">{{item.subject}}</td>
            <td align="center" class="td_tel" headers="mb_tel">{{item.teacher}}</td>
            <td align="center" class="td_hp" headers="mb_hp">{{item.c_date}}</td>
            <td align="center" class="td_10" headers="mb_10">{{item.request_s_date}} ~ {{item.request_e_date}}</td>
            <td align="center" class="td_10" headers="mb_10">{{item.education_s_date}} ~ {{item.education_e_date}}</td>
            <td align="center" class="td_11" headers="mb_email"><a :href="base_url + '/adm/class_register_list.php?idx=' + item._idx"><strong class="color_red">{{item.counts}}</strong></a></td>
            <td headers="mb_list_mng" class="td_mngsmall"><?php echo $s_mod ?> <a :href="base_url + '/adm/class_form.php?_idx=' + item._idx">수정</a>
            </td>
        </tr>
        
        <tr v-if="total == 0">
            <td colspan=\"".$colspan."\" class=\"empty_table\">자료가 없습니다.</td>
        </tr>
        </tbody>
        </table>

        <pagination-component :page="filter.page" :limit="filter.limit" :total="total" @change="changePage"></pagination-component>
    </div>
    </div><!--row row-horizon-->
    <br>
    <div class="btn_list01 btn_list">
        <input type="button" @click="deleteData" name="act_button" value="선택삭제">
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.7.16"></script>

<script>
// Vue 인스턴스 생성
document.addEventListener('DOMContentLoaded', function(){
    new Vue({
        el: '#app',
        data: {
            base_url : "<?=G5_URL?>",
            data : {},
            datas : [],
            filter : {
                page : <?=$_GET["page"] ? $_GET["page"] : 1?>,
                limit : 10,
                all_search : "<?=$_GET["all_search"] ? $_GET["all_search"] : ""?>"
            },
            total : 0,
            checks : [],
            all_check : false
        },
        created : function() {
            this.getData();
        },
        methods: {
            changePage(page) {
                window.location.href = `${this.base_url}/adm/class_list.php?page=${page}&all_search=${this.filter.all_search}`;
            },
            postData : function() {
                var method = this.data._idx ? "put" : "post";
                var obj = JSON.parse(JSON.stringify(this.data));

                var objs = {
                    _method : method,
                    obj : JSON.stringify(obj),
                };

                var res = this.ajax(this.base_url + "/api/",objs);

                if(res) {
                    console.log(res)
                }
            },
            deleteData : function() {
                var method = "deletes";

                if(this.checks.length <= 0) {
                    alert("하나 이상 선택하셔야합니다.");
                    return false;
                }

                var objs = {
                    _method : method,
                    arrays : JSON.stringify(this.checks)
                };

                var res = this.ajax(this.base_url + "/api/g5_class.php",objs);
                if(res) {
                    alert("삭제되었습니다.");
                    window.location.reload();
                }
            },
            getData : function() {
                var method = "gets2";

                var objs = {
                    _method : method,
                    filter : JSON.stringify(this.filter)
                };

                var res = this.ajax(this.base_url + "/api/g5_class.php",objs);
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
include_once (G5_PATH."/component/pagination-component.php");
include_once ('./admin.tail.php');
?>
