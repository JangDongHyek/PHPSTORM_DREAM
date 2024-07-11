<div id="vueapp1">
    <div class="category_wrap">
        <h3 id="toggleCategory" @click="modal = true"><i class="fa-light fa-list"></i> 제품 카테고리</h3>
        <ul class="cate_depth0">
                <li v-for="item in datas" class="active">
                    <a :href="baseUrl+'medicinal?category=' + item.idx">{{item.name}}</a>
                    <ul class="cate_depth1">
                        <li v-for="child in item.childs">
                            <a :href="baseUrl+'medicinal?category=' + child.idx">{{child.name}}</a>
                        </li>
                    </ul>
                </li>
            </ul>
    </div>

    <!--modal style 수정시 views/component/modal-component.php 보시면됩니다-->
    <modal-component v-if="modal" @close="modal = false" v-slot="slot">
        <h2>전체 카테고리</h2>

        <div>
            <ul v-for="item in datas">
                <h2><a :href="baseUrl+'medicinal?category=' + item.idx">{{item.name}}</a></h2>
                <li v-for="child in item.childs">
                    <a :href="baseUrl+'medicinal?category=' + child.idx">{{child.name}}</a>
                </li>
            </ul>
        </div>
    </modal-component>

<!--    <div class="allcategory">-->
<!--        <div class="inner">-->
<!--            <div class="cate_hd">-->
<!--                <h4>전체 카테고리</h4>-->
<!--                <a class="btn_close"><i class="fa-light fa-xmark"></i></a>-->
<!--            </div>-->
<!--            <ul class="cate_depth0">-->
<!--                <li>-->
<!--                    <a>20시리즈 프로파일</a>-->
<!--                    <ul class="cate_depth1">-->
<!--                        <li><a>프로파일</a></li>-->
<!--                        <li><a>부품</a></li>-->
<!--                        <li><a>볼트&amp;너트</a></li>-->
<!--                    </ul>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <a>30/60시리즈 프로파일</a>-->
<!--                    <ul class="cate_depth1">-->
<!--                        <li><a>프로파일</a></li>-->
<!--                        <li><a>부품</a></li>-->
<!--                        <li><a>볼트&amp;너트</a></li>-->
<!--                    </ul>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <a>35시리즈 프로파일</a>-->
<!--                    <ul class="cate_depth1">-->
<!--                        <li><a>프로파일</a></li>-->
<!--                        <li><a>부품</a></li>-->
<!--                        <li><a>볼트&amp;너트</a></li>-->
<!--                    </ul>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <a>40/80시리즈 프로파일</a>-->
<!--                    <ul class="cate_depth1">-->
<!--                        <li><a>프로파일</a></li>-->
<!--                        <li><a>부품</a></li>-->
<!--                        <li><a>볼트&amp;너트</a></li>-->
<!--                    </ul>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <a>45/90시리즈 프로파일</a>-->
<!--                    <ul class="cate_depth1">-->
<!--                        <li><a>프로파일</a></li>-->
<!--                        <li><a>부품</a></li>-->
<!--                        <li><a>볼트&amp;너트</a></li>-->
<!--                    </ul>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <a>50시리즈 프로파일</a>-->
<!--                    <ul class="cate_depth1">-->
<!--                        <li><a>프로파일</a></li>-->
<!--                        <li><a>부품</a></li>-->
<!--                        <li><a>볼트&amp;너트</a></li>-->
<!--                    </ul>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <a>도어 및 그 외 프로파일</a>-->
<!--                    <ul class="cate_depth1">-->
<!--                        <li><a>도어용 프로파일</a></li>-->
<!--                        <li><a>그 외 프로파일</a></li>-->
<!--                        <li><a>부품</a></li>-->
<!--                        <li><a>볼트&amp;너트</a></li>-->
<!--                    </ul>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <a>앵글</a>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <a>덕트</a>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <a>컨베이어 프레임</a>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <a>캐스터</a>-->
<!--                    <ul class="cate_depth1">-->
<!--                        <li><a>캐리 마스터</a></li>-->
<!--                        <li><a>캐리 마스터(Ⅱ)</a></li>-->
<!--                        <li><a>레벨링 캐스터</a></li>-->
<!--                        <li><a>플라스틱 캐스터</a></li>-->
<!--                        <li><a>경하중용</a></li>-->
<!--                        <li><a>중하중용</a></li>-->
<!--                        <li><a>고하중용</a></li>-->
<!--                        <li><a>초고하중용</a></li>-->
<!--                    </ul>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <a>우레탄 바퀴</a>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <a>조절좌</a>-->
<!--                    <ul class="cate_depth1">-->
<!--                        <li><a>방진용</a></li>-->
<!--                        <li><a>미끄럼방지용</a></li>-->
<!--                        <li><a>앙카용</a></li>-->
<!--                        <li><a>경하중용</a></li>-->
<!--                        <li><a>중·고하중용</a></li>-->
<!--                    </ul>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <a>각종 볼트</a>-->
<!--                    <ul class="cate_depth1">-->
<!--                        <li><a>둥근머리 렌치볼트</a></li>-->
<!--                        <li><a>접시머리 렌치볼트</a></li>-->
<!--                        <li><a>육각렌치볼트</a></li>-->
<!--                    </ul>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <a>고객맞춤 결제</a>-->
<!--                </li>-->
<!--            </ul>-->
<!--        </div>-->
<!--    </div>-->
</div>

<script src="https://cdn.jsdelivr.net/npm/vue@2.7.16"></script>
<?php include_once VIEWPATH."/component/modal-component.php";?>
<script>
    // Vue 인스턴스 생성
    document.addEventListener('DOMContentLoaded', function(){
        new Vue({
            el: '#vueapp1',
            data: {
                base_url : "<?=G5_URL?>",
                model : "",
                primary : "<?=$_GET['idx']?>",
                data : {},
                datas : [],
                filter : {
                    all_search : "false",
                    page : <?=$_GET["page"] ? $_GET["page"] : 1?>,
                    limit : 10,
                    search_key : "<?=$_GET["search_key"] ? $_GET["search_key"] : ""?>",
                    search_value : "<?=$_GET["search_value"] ? $_GET["search_value"] : ""?>"
                },
                total : 0,
                checks : [],
                all_check : false,
                modal : false,
            },
            created : function() {
                this.getsData();
                // if(this.primary) this.getData();
            },
            mounted : function() {
                // this.$nextTick(() => {
                //     document.getElementById('toggleCategory').addEventListener('click', function() {
                //         document.querySelector('.allcategory').classList.toggle('active');
                //     });
                //
                //     document.querySelector('.btn_close').addEventListener('click', function() {
                //         document.querySelector('.allcategory').classList.remove('active');
                //     });
                // });
            },
            methods: {
                changePage(page) {
                    var url = `${this.base_url}/example.php?`;

                    Object.keys(this.filter).forEach(function(key) {
                        if(key == "all_search") return;
                        if(key == "limit") return;
                        url += `key=${this.filter[key]}&`;
                    });

                    window.location.href = url;
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
                        primary : this.primary
                    };

                    var res = this.ajax(this.base_url + "/api/" + this.model + ".php",objs);
                    if(res) {
                        console.log(res)
                        this.data = res.data;
                    }
                },
                getsData : function() {
                    var method = "gets";
                    // var filter = JSON.parse(JSON.stringify(this.filter));
                    var objs = {
                        _method : method,
                        // filter : JSON.stringify(filter)
                    };

                    var res = this.ajax(baseUrl+"/api/category/getsData",objs);
                    if(res) {
                        console.log(res)
                        this.datas = res.datas;
                        this.total = res.datas.count;
                    }
                },
                ajax : function(url,objs) {
                    var form = new FormData();
                    //if(url.indexOf(".php") == -1) url = url + ".php";
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

    Number.prototype.format = function(n, x) {
        var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
        return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
    };
</script>

<script>

</script>

