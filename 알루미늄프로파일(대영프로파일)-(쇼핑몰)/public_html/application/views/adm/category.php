<!--관리자-상품관리 목록-->
<section class="product" id="app">
    <form name="searchFrm" autocomplete="off">
		<input type="hidden" name="order" value=""/><!--정렬-->
        <div class="panel">
<!--			<p>총 <span class="green">--><?//=$paging['totalCount']?><!--</span>개 </p>-->
            <div>
                <select name="sfl">
					<option value="name">카테고리명</option>
                </select>
				<input class="search-bar" name="name" type="search" value="" v-model="filter.name" placeholder="검색어를 입력하세요" />
                <button type="submit" class="btn_search"><i class="fa-light fa-magnifying-glass"></i></button>
            </div>
            <span>
                <!--<button type="button" class="btn btn_orange" onclick="setDefaultDelivery()">기본 배송비 설정</button>-->
                <button type="button" class="btn btn_green" onclick="location.href='<?=PROJECT_URL?>/adm/categoryForm'">등록하기</button>
            </span>
        </div>
    </form>

    <div class="boxline">
        <div class="flex">

			<select class="list_order" onchange="searchFilter('order', this.value)">
				<option value="" <?=$_GET['order']==''? 'selected':''?>>우선순위</option>
			</select>
        </div>
        <div class="table adm">
            <table>
                <colgroup>
                    <col width="*">
                    <col width="10%">
<!--                    <col width="10%">-->
                    <col width="10%">
                    <col width="10%">
                    <!--<col width="10%">
                    <col width="13%">
                    <col width="7%">
					<col width="*">-->
                </colgroup>
                <thead>
                <tr>
                    <th>카테고리명</th>
<!--                    <th>상품 등록수</th>-->
                    <!--
                    <th>배송</th>
                    -->
                    <th>노출</th>
                    <th>우선순위</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>

                <template v-for="item in datas">
                    <tr>
                        <td>
                            <a @click="select_category = item.idx == select_category ? '' : item.idx">{{item.name}}</a>
                            <span v-if="item.childs.length>0">[{{item.childs.length}}]</span>
                        </td>
                        <td>
                            <select v-model="item.visible"  @change="putData(item)">
                                <option value="true">노출</option>
                                <option value="false">노출안함</option>
                            </select>
                        </td>
                        <td>
                            {{item.priority}}
                        </td>
                        <td>
                            <button type="button" class="btn btn_black" @click="window.location.href=baseUrl+'adm/categoryForm?parent_idx='+item.idx">추가</button>
                            <button type="button" class="btn btn_black" @click="window.location.href=baseUrl+'adm/categoryForm?idx='+item.idx">수정</button>
                            <button type="button" class="btn btn_greenline" @click="deleteData(item.idx)">삭제</button>
                        </td>
                    </tr>

                    <template v-for="item2 in item.childs" v-if="select_category == item.idx">
                        <tr style="background-color : lightblue">
                            <td>
                                ({{item.name}}) -> {{item2.name}}
                            </td>
                            <td>
                                <select v-model="item2.visible">
                                    <option value="true">노출</option>
                                    <option value="false">노출안함</option>
                                </select>
                            </td>
                            <td>
                                {{item2.priority}}
                            </td>
                            <td>
                                <button type="button" class="btn btn_black" @click="window.location.href=baseUrl+'adm/categoryForm?idx='+item2.idx">수정</button>
                                <button type="button" class="btn btn_greenline" @click="deleteData(item2.idx)">삭제</button>
                            </td>
                        </tr>
                    </template>
                </template>

				<tr v-if="datas.length <= 0"><td colspan="20" class="noDataAlign">등록된 상품이 없습니다.</td></tr>
                </tbody>
            </table>
        </div>

        <? include_once VIEWPATH. 'component/pagination.php'; // 페이징?>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/vue@2.7.16"></script>

<script>
    // Vue 인스턴스 생성
    document.addEventListener('DOMContentLoaded', function(){
        new Vue({
            el: '#app',
            data: {
                base_url : "",
                model : "",
                primary : "<?=$_GET['idx']?>",
                data : {},
                datas : [],
                filter : {
                    name : "<?=$_GET['name']?>",
                },
                total : 0,
                checks : [],
                all_check : false,
                select_category : ""
            },
            created : function() {
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
                putData : function(item) {
                    var obj = JSON.parse(JSON.stringify(item));
                    delete obj.childs;
                    var objs = {
                        obj : JSON.stringify(obj),
                    };

                    var res = this.ajax(`${baseUrl}api/category/putData`,objs);

                    if(res) {

                    }
                },
                deleteData : function(idx) {
                    if(!confirm("정말 삭제하시겠습니까?")) {
                        return false;
                    }
                    var method = "get";

                    var objs = {
                        _method : method,
                        idx : idx
                    };

                    var res = this.ajax(baseUrl+"api/category/deleteData",objs);
                    if(res) {
                        console.log(res)
                        alert("삭제되었습니다.")
                        window.location.reload();
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

                    var res = this.ajax(baseUrl+"api/category/getsData",objs);
                    if(res) {
                        console.log(res)
                        this.data = res.data;
                    }
                },
                getsData : function() {
                    var method = "gets";
                    var filter = JSON.parse(JSON.stringify(this.filter));
                    var objs = {
                        _method : method,
                        filter : JSON.stringify(filter)
                    };

                    var res = this.ajax(baseUrl+"api/category/getsData",objs);
                    if(res) {
                        console.log(res)
                        this.datas = res.datas;
                        // this.datas = res.datas.datas;
                        // this.total = res.datas.count;
                    }
                },
                ajax : function(url,objs) {
                    var form = new FormData();

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
<?php include_once MODAL_PATH. "product_modal.php" // 배송비 모달 ?>

<!--상품관리 JS-->
<script src="<?=ASSETS_URL?>/js/adm/product.js?v=<?=JS_VER?>"></script>
