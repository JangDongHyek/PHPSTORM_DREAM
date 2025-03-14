<?
include_once("./_common.php");
$g5['title'] = '나의 포인트';
include_once(G5_THEME_PATH.'/head.php');

include_once(G5_PATH."/model/model2.php");

?>
<div id="app">
    <div id="point" class="my_list">
        <div class="area_top">
            <p>현재 보유중인 포인트</p> <strong>{{datas[0] ? parseInt(datas[0].mb_heart).format() : 0}} P</strong>
        </div>
        <ul>
            <li v-for="item in datas">
                <div>
                    <p class="date">{{item.regdate}}</p>
                    <strong>{{item.description}}</strong>
                </div>
                <div class="point">{{(item.plus_heart - item.minus_heart).format()}}P</div>
            </li>
            <li v-if="total == 0">
                <div>내역이 없습니다.</div>
            </li>
        </ul>
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
                model : "g5_heart",
                primary : "<?=$_GET['idx']?>",
                data : {},
                datas : [],
                filter : {
                    all_search : "true",
                    page : <?=$_GET["page"] ? $_GET["page"] : 1?>,
                    limit : 10,
                    mb_no : "<?=$member['mb_no']?>",
                    search_key : "<?=$_GET["search_key"] ? $_GET["search_key"] : ""?>",
                    search_value : "<?=$_GET["search_value"] ? $_GET["search_value"] : ""?>"
                },
                total : 0,
                checks : [],
                all_check : false,
            },
            created : function() {
                console.log(1);
                this.getsData();
                // if(this.primary) this.getData();
            },
            mounted : function() {
                this.$nextTick(() => {

                });
            },
            methods: {
                changePage(page) {
                    var url = `${this.base_url}/example.php?`;

                    Object.keys(this.filter).forEach(function(key) {
                        //JS forEacg 에선 continue 말고 return을 사용
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

    Number.prototype.format = function(n, x) {
        var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
        return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
    };
</script>

<?php
include_once(G5_THEME_PATH.'/tail.php');
?>