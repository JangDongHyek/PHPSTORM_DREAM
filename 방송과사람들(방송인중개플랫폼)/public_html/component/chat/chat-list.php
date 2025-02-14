<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div class="tab_container">
        <div id="tab1" class="tab_content">
            <!-- bbs/ajax.chat_list.php -->
            <ul class="chat_list ul_chat_list">
                <li>
                    <a href="<?=G5_BBS_URL?>/chat.php">
                        <div class="area_img"><img class="basic" src="<?php /*echo G5_IMG_URL */?>/img_smile.svg"></div>
                        <div class="chat_txt">
                            <div class="info"><em class="name">PODOSEA</em><span clas="data">11월 5일</span></div>
                            <div class="cont">김철수 고객님 안녕하세요. 요청하신 견적 제안금액입니다.김철수 고객님 안녕하세요. 요청하신 견적 제안금액입니다.김철수 고객님 안녕하세요. 요청하신 견적 제안금액입니다.김철수 고객님 안녕하세요. 요청하신 견적 제안금액입니다.김철수 고객님 안녕하세요. 요청하신 견적 제안금액입니다.</div>
                        </div>
                        <div class="badge">2</div>
                    </a>
                </li>
            </ul>
        </div>
        <!--<div id="tab2" class="tab_content">
            <ul class="chat_list">
                <li class="nodata">
                    <p>채팅 내역이 없습니다.</p>
                </li>
            </ul>
        </div>-->
    </div>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            mb_no : {type : String, default : ""}
        },
        data: function(){
            return {
                jl : null,
                filter : {
                    page : 1,
                    limit : 1,
                    count : 0,
                    search_key1 : "",
                    search_value1_1 : "",
                    search_value1_2 : "",
                    search_like_key1 : "",
                    search_like_value1 : "",
                    not_key1 : "",
                    not_value1 : "",
                    in_key1 : "",
                    in_value : [],
                    order_by_desc : "insert_date",
                    order_by_asc : "",
                },
                required : [
                    {name : "",message : ""},
                ],
                data : {

                },
            };
        },
        created: function(){
            this.jl = new JL('<?=$componentName?>');

            if(this.primary) this.getData();
        },
        mounted: function(){
            this.$nextTick(() => {

            });
        },
        methods: {
            postData() {
                let method = this.primary ? "update" : "insert";
                try {
                    let res = this.jl.ajax(method,this.data,"/api/example.php");
                }catch (e) {
                    alert(e)
                }

            },
            getData() {
                try {
                    let res = this.jl.ajax("get",this.filter,"/api/example.php");
                    this.data = res.data[0]
                }catch (e) {
                    alert(e)
                }
            }
        },
        computed: {

        },
        watch : {
            search_key1() {
                this.search_value1_1 = "";
                this.search_value1_2 = "";
            }
        }
    });
</script>

<style>

</style>