<?
include_once("./_common.php");
$g5['title'] = '삼삼 CLASS';
$co_id = 'class';
include_once(G5_PATH.'/_head.php');

$page = $_GET["page"] ? $_GET["page"] : 1;
$search_key = $_GET["search_key"] ? $_GET["search_key"] : "";
$search_value = $_GET["search_value"] ? $_GET["search_value"] : "";
?>

    <div class="area_expert" id="app">
        <div class="area_banner">
            <h4>삼삼클래스 정규과정은 <strong>ONLY 오프라인 교육만 실행</strong>합니다.</h4>
            <p>소수정예로 수업으로 끝나는 게 아닌 바로 실행 가능한 진짜 실전 교육과 바로 실행 가능한 물건을 제공합니다.</p>
            <span>선착순으로 운영되는 삼삼클래스를 놓치지마세요.</span>
        </div>
        <div class="area_hd">
            <div class="area_title">
                <h5 class="wow fadeInDown" data-wow-delay="0.1s"><strong>EXPERT</strong> OFFLINE CLASS</h5><br>
                <span class="wow fadeInDown" data-wow-delay="0.4s">부동산 경매 전문가와 함께하는 오프라인 클래스, 삼삼경매만의 차별화를 경험하세요</span>
            </div>
            <div class="search_hd">
                <select v-model="filter.search_key">
                    <option value="">선택.</option>
                    <option value="subject">강의명</option>
                    <option value="teacher">강사명</option>
                </select>
                <input type="search" placeholder="검색어를 입력하세요" v-model="filter.search_value">
                <button type="button" @click="changePage(1)">검색</button>
            </div>
            <!--<a class="btn" href="<?php /*echo  G5_BBS_URL*/?>/class.form.php">클래스 등록하기</a>-->
        </div>
        <div class="expert_list">
            <ul>
                <li @click="location.href= base_url + '/bbs/class.view.php?id=' + item._idx" v-for="item in datas">
                    <div class="area_img">
                        <div class="img"><img :src="JSON.parse(item.file).src"></div>
                        <div class="title">
                            <span>{{item.category}}</span>
                            <p>{{item.subject}}</p>
                        </div>
                    </div>
                    <div class="area_text">
                        <p>{{item.category}} {{item.subject}}</p>
                        <span>{{item.teacher}}</span>
                    </div>
                </li>
                
            </ul>
        </div>
        <page-component :page="filter.page" :limit="filter.limit" :total="total" @change="changePage"></page-component>
        <!-- <div class="b-pagination-outer">
            <ul id="border-pagination">
                <li><a class="" href="#">«</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#" class="active">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">6</a></li>
                <li><a href="#">7</a></li>
                <li><a href="#">»</a></li>
            </ul>
        </div> -->
    </div>

<script src="https://cdn.jsdelivr.net/npm/vue@2.7.16"></script>
<script>
// Vue 인스턴스 생성
document.addEventListener('DOMContentLoaded', function(){
    new Vue({
        el: '#app',
        data: {
            base_url : "<?=G5_URL?>",
            datas : [],
            filter : {
                page : <?=$page?>,
                limit : 10,
                search_key : "<?=$search_key?>",
                search_value : "<?=$search_value?>"
            },
            total : 0,
            
        },
        created : function() {
            this.getData();
        },
        methods: {
            changePage : function(page) {
                window.location.href = `${this.base_url}/bbs/class.list.php?page=${page}&search_key=${this.filter.search_key}&search_value=${this.filter.search_value}`;
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
                    
                }
            },
            getData : function() {
                var method = "gets";

                var objs = {
                    _method : method,
                    filter : JSON.stringify(this.filter)
                };

                var res = this.ajax(this.base_url + "/api/g5_class.php",objs);
                if(res) {
                    console.log(res)
                    this.datas = res.datas.datas
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
        }
    });
}, false);
</script>

<?
include_once(G5_PATH.'/_tail.php');

include_once(G5_PATH."/component/page-component.php");
?>