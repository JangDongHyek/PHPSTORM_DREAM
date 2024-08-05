<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <!--포트폴리오에서 가져오기-->
    <div class="portfolio text-right">
        <button data-toggle="modal" data-target="#portfolioModal" class="btn"><i class="fa-regular fa-arrow-down-to-line"></i> 포트폴리오 불러오기</button>
        <!-- 취소 및 환불규정 모달팝업/카테고리별로 환불 규정 내용이 달라집니다. 현재는 1차카테고리(디자인) > 2차카테고리(웹툰.캐릭터)를 임의로 선택하고 등록가정임-->
        <div id="basic_modal">
            <div class="modal fade" id="portfolioModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa-light fa-xmark"></i></button>
                            <h4 class="modal-title" id="myModalLabel">포트폴리오 불러오기</h4>
                        </div>
                        <div class="modal-body">
                            <ul id="product_list">
                                <li class="nodata">
                                    <div class="nodata_wrap">
                                        <div class="area_img"><img src="<?php echo G5_THEME_IMG_URL ?>/app/img_nodata.svg"></div>
                                        <p>등록한 포트폴리오가 없습니다.</p>
                                    </div>
                                </li>
                                <li>
                                    <a href="https://itforone.com:443/~broadcast/bbs/portfolio_view.php">
                                        <div class="area_img">
                                            <img src="https://itforone.com:443/~broadcast/data/file/main_img/0_2039270465__d3e9d3a90aff883a7a587b48a12d57dd7db70d9c.jpg" title="">
                                        </div>
                                        <div class="area_txt">
                                            <span></span><!-- 업체명 -->
                                            <h3>영상제작</h3> <!-- 제목 -->
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://itforone.com:443/~broadcast/bbs/portfolio_view.php">
                                        <div class="area_img">
                                            <img src="https://itforone.com:443/~broadcast/data/file/main_img/0_2039270465__d3e9d3a90aff883a7a587b48a12d57dd7db70d9c.jpg" title="">
                                        </div>
                                        <div class="area_txt">
                                            <span></span><!-- 업체명 -->
                                            <h3>영상제작</h3> <!-- 제목 -->
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://itforone.com:443/~broadcast/bbs/portfolio_view.php">
                                        <div class="area_img">
                                            <img src="https://itforone.com:443/~broadcast/data/file/main_img/0_2039270465__d3e9d3a90aff883a7a587b48a12d57dd7db70d9c.jpg" title="">
                                        </div>
                                        <div class="area_txt">
                                            <span></span><!-- 업체명 -->
                                            <h3>영상제작</h3> <!-- 제목 -->
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://itforone.com:443/~broadcast/bbs/portfolio_view.php">
                                        <div class="area_img">
                                            <img src="https://itforone.com:443/~broadcast/data/file/main_img/0_2039270465__d3e9d3a90aff883a7a587b48a12d57dd7db70d9c.jpg" title="">
                                        </div>
                                        <div class="area_txt">
                                            <span></span><!-- 업체명 -->
                                            <h3>영상제작</h3> <!-- 제목 -->
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">불러오기</button>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--basic_modal-->
        <!-- 취소 및 환불규정 모달팝업 -->
    </div>
    <!--포트폴리오에서 가져오기-->
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            primary : {type : String, default : ""}
        },
        data: function(){
            return {
                jl : null,
                filter : {

                },
                data : {

                },
            };
        },
        created: function(){
            this.jl = new JL('<?=$componentName?>');
        },
        mounted: function(){
            this.$nextTick(() => {

            });
        },
        methods: {
            postData : function() {
                var method = this.primary ? "update" : "insert";
                var res = this.jl.ajax(method,this.data,"/api/example.php");

                if(res) {

                }
            },
            getData: function () {
                var filter = {primary: this.primary}
                var res = this.jl.ajax("get",filter,"/api/example.php");

                if(res) {
                    this.data = res.response.data

                }
            }
        },
        computed: {

        },
        watch : {

        }
    });
</script>

<style>

</style>