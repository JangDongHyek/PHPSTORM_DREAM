<?php
$sub_menu = "230100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');



$g5['title'] = '카테고리 관리';
include_once('./admin.head.php');


?>

<style>
	.sortable-list {
	  list-style-type: none;
	  padding: 0;
	  width: 150px;
	  float: left;
	  margin: 10px;
	  border: 1px solid #ccc;
	  background-color: #f0f0f0;
	}
	.sortable-list li {
	  background-color: #fff;
	  margin: 5px;
	  padding: 5px;
	  cursor: pointer;
	}

    .sortable-list li input {
        width: 90px;
    }
</style>

<div id="app">
    <div class="sortable-list" v-for="(item,item_index) in datas">
        <h3>
            <input type="text" v-model="item.name">
            <button @click="datas.splice(item_index,1)">삭제</button>
        </h3>
        <ul>
            <draggable v-model="item.childs" @end="onEnd">
                <li v-for="(child,index) in item.childs">
                    <input type="text" v-model="item.childs[index]">
                </li>
                <button @click="item.childs.push('')">추가</button>
            </draggable>
        </ul>
    </div>
    <button @click="datas.push({name:'',childs:[]})">1차 추가</button>
    <button @click="postData">저장</button>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/vue/2.5.2/vue.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sortablejs@1.8.4/Sortable.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/Vue.Draggable/2.20.0/vuedraggable.umd.min.js"></script>

<script>
    // Vue 인스턴스 생성
    new Vue({
        el: '#app',
        data: {
            base_url : "<?=G5_URL?>",
            datas : []
        },
        created : function() {
            this.getData();
        },
        methods: {
            onEnd : function(event) {
                
            },
            postData : function() {
                var method = "post";
                var obj = JSON.parse(JSON.stringify(this.datas));
                
                var objs = {
                    _method : method,
                    obj : JSON.stringify(obj),
                };
                
                var res = this.ajax(this.base_url + "/api/new_category2",objs);

                if(res) {
                    alert("저장되었습니다.");
                }
            },
            getData : function() {
                var method = "get";
                
                var objs = {
                    _method : method
                };
                
                var res = this.ajax(this.base_url + "/api/new_category2",objs);
                if(res) {
                    this.datas = res.data.datas;
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
<?php
include_once ('./admin.tail.php');
?>
