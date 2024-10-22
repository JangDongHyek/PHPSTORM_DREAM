<?
include_once("./_common.php");
$g5['title'] = '삼삼 CLASS';
$co_id = 'class';
include_once(G5_PATH.'/_head.php');
?>
    <div class="area_expert" id="app">
        <h2 class="title">삼삼CLASS 신청리스트</h2>
        <div class="expert_list">
            <form>
                <div class="list_wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>분류</th>
                                <th>클래스명</th>
                                <th>이름</th>
                                <th>성별</th>
                                <th>연락처</th>
                                <!--
                                <th>이메일</th>
                                <th>생년월일</th>
                                -->
                                <th>주소</th>
                                <th>직업</th>
                                <th>투자가능금액</th>
                                <th>문의사항</th>
                                <th>신청일자</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr v-for="item in datas">
                            <td>{{item.g5_class.category}}</td>
                            <td>{{item.g5_class.subject}}</td>
                            <td>{{item.name}}</td>
                            <td>{{item.gender}}</td>
                            <td>{{item.phone}}</td>
                            <!--
                            <td>{{item.email}}</td>
                            <td>{{item.birth}}</td>
                            -->
                            <td>{{item.address}}</td>
                            <td>{{item.job}}</td>
                            <td>{{item.amount}}</td>
                            <td>{{item.etc}}</td>
                            <td>{{item.c_date.split(" ")[0]}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </form>
            <pagination-component :page="filter.page" :limit="filter.limit" :total="total" @change="changePage"></pagination-component>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/vue@2.7.16"></script>

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
                page : <?=$page ? $page : 1?>,
                limit : 10
            },
            total : [],
            checks : [],
            all_check : false,
        },
        created : function() {
            this.getsData();
        },
        mounted : function() {
            
        },
        methods: {
            changePage(page) {
                window.location.href = `${this.base_url}/bbs/class.register.list.php?page=${page}`;
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
                var method = "gets";

                var objs = {
                    _method : method,
                    filter : this.filter
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

<?
include_once(G5_PATH."/component/pagination-component.php");
include_once(G5_PATH.'/_tail.php');
?>