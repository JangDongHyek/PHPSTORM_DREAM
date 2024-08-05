<?php $componentName = str_replace(".php","",basename(__FILE__)); ?>
<script type="text/x-template" id="<?=$componentName?>-template">
    <div>
        <span id="tab1" style="display: block">
        <div id="item_write">
                <input type="hidden" name="click_tab" id="click_tab" value="">
                <input type="hidden" name="now_tab" id="now_tab" value="1">

                <div class="inr v2" id="inr">
                <h3>서비스등록</h3>
                <div class="snb">
                    <ul class="list_step">
                    <li id="" class="active">
                        <a href="" @click="event.preventDefault(); $emit('changeTab',1);">
                            <em>1</em>
                            <span>기본정보</span>
                        </a>
                    </li>
                    <li id="">
                        <a href="" @click="event.preventDefault(); $emit('changeTab',2);">
                            <em>2</em>
                            <span>서비스 설명</span>
                        </a>
                    </li>
                    <li id="">
                        <a href="" @click="event.preventDefault(); $emit('changeTab',3);">
                            <em>3</em>
                            <span>이미지 등록</span>
                        </a>
                    </li>
                    </ul>
                </div>
                <div class="box_list">
                    <div class="portfolio text-right">
                        <button class="btn" @click="modal = true"><i class="fa-regular fa-arrow-down-to-line"></i> 포트폴리오 불러오기</button>
                    </div>
                    
                    <slot-modal :modal="modal" title="포트폴리오 불러오기" @close="modal = false">
                        <ul id="product_list">
                                <li class="nodata" v-if="portfolios.length == 0">
                                    <div class="nodata_wrap">
                                        <div class="area_img"><img :src="`${jl.root}/theme/basic_app/img/app/img_nodata.svg`"></div>
                                        <p>등록한 포트폴리오가 없습니다.</p>
                                    </div>
                                </li>
                                <li v-else v-for="item in portfolios">
                                    <a :href="`${jl.root}/bbs/portfolio_view.php?idx=${item.idx}`" target="_blank">
                                        <div class="area_img">
                                            <img :src="jl.root+item.main_image_array[0].src" title="">
                                        </div>
                                        <div class="area_txt">
                                            <span></span><!-- 업체명 -->
                                            <h3>{{item.name}}</h3> <!-- 제목 -->
                                        </div>
                                    </a>
                                </li>
                            </ul>
                    </slot-modal>
                    
                    <br>
                    <div class="box_write">
                        <h4>제목</h4>
                        <div class="cont">
                            <input name="i_title" id="i_title" type="text" placeholder="제목을 입력해 주세요." v-model="product.name">
                        </div>
                    </div>
                    <div class="box_write">
                        <h4>1차 카테고리</h4>
                        <div class="cont">
                            <select v-model="parent_category_idx">
                                <option value="">선택해주세요</option>
                                <option v-for="item in categories" :value="item.idx">{{item.name}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="box_write">
                        <h4>2차 카테고리</h4>
                       <div class="cont" id="ctg_ul2">
                           <select v-if="parent_category" v-model="product.category_idx">
                                <option value="">선택해주세요</option>
                                <option v-for="item in parent_category.childs" :value="item.idx">{{item.name}}</option>
                           </select>
                       </div>
                    </div>
                    <div class="box_content">
                        <div class="box_write02">
                            <h4>서비스 타입</h4>
                            <div class="cont">
                                <div class="box_write">
                                    <h4>성별</h4>
                                    <div class="cont box">
                                        <input type="radio" name="gender" id="male" value="남자"><label for="male">남자</label>
                                        <input type="radio" name="gender" id="female" value="여자"><label for="female">여자</label>
                                        <input type="radio" name="gender" id="not-selected" value="미선택"><label for="not-selected">미선택</label>
                                    </div>
                                </div>
                                <div class="box_write">
                                    <h4>연령</h4>
                                    <div class="cont box">
                                        <input type="radio" id="kids" name="age-group"><label for="kids">키즈</label>
                                        <input type="radio" id="teen" name="age-group"><label for="teen">청소년</label>
                                        <input type="radio" id="twenties-thirties" name="age-group"><label for="twenties-thirties">20~30대</label>
                                        <input type="radio" id="middle-aged" name="age-group"><label for="middle-aged">중장년</label>
                                    </div>
                                </div>
                                <div class="box_write">
                                    <h4>지역</h4>
                                    <div class="cont box">
                                        <input type="checkbox" id="domestic" name="location"><label for="domestic">국내</label>
                                        <input type="checkbox" id="overseas" name="location"><label for="overseas">해외</label>
                                        <input type="checkbox" id="negotiable" name="location"><label for="negotiable">협의 또는 선택안함</label>
                                    </div>
                                </div>
                                <div class="box_write">
                                    <h4>주말 작업 가능여부</h4>
                                    <div class="cont box">
                                        <input type="checkbox" id="negotiable" name="availability"><label for="negotiable">협의가능</label>
                                        <input type="checkbox" id="possible" name="availability"><label for="possible">가능</label>
                                        <input type="checkbox" id="not-possible" name="availability"><label for="not-possible">불가능</label>
                                    </div>
                                </div>
                                <div class="box_write">
                                    <h4>작업유형</h4>
                                    <div class="cont box">
                                        <input type="checkbox" id="photo" name="media"><label for="photo">사진</label>
                                        <input type="checkbox" id="video" name="media"><label for="video">영상</label>
                                        <input type="checkbox" id="audio" name="media"><label for="audio">음향</label>
                                        <input type="checkbox" id="none-media" name="media"><label for="none-media">선택안함</label>
                                    </div>
                                </div>
                                <div class="box_write">
                                    <h4>스타일</h4>
                                    <div class="cont box">
                                        <input type="checkbox" id="person" name="category"><label for="person">인물</label>
                                        <input type="checkbox" id="object" name="category"><label for="object">사물</label>
                                        <input type="checkbox" id="product" name="category"><label for="product">제품</label>
                                        <input type="checkbox" id="clothing" name="category"><label for="clothing">의상</label>
                                        <input type="checkbox" id="car" name="category"><label for="car">자동차</label>
                                        <input type="checkbox" id="interior" name="category"><label for="interior">인테리어</label>
                                        <input type="checkbox" id="2d" name="category"><label for="2d">2D</label>
                                        <input type="checkbox" id="3d" name="category"><label for="3d">3D</label>
                                        <input type="checkbox" id="effects" name="category"><label for="effects">이펙트</label>
                                        <input type="checkbox" id="animation" name="category"><label for="animation">애니메이션</label>
                                        <input type="checkbox" id="none-cate" name="category"><label for="none-cate">선택안함</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="box_write02">
                            <h4>검색 키워드</h4>
                            <div class="cont">
                                <div class="box_write">
                                    <div class="keyword">
                                        <div class="keyword_add">
                                            <p>검색 키워드</p>
                                            <input type="text" placeholder="키워드 입력"> <span>5/5</span> <button>추가</button>
                                        </div>
                                        <div class="keyword_list">
                                            <div class="tag">
                                                <span>배우 <a class="del"><i class="fa-light fa-xmark"></i></a></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="box_write02">
                            <h4>가격정보</h4>
                            <div class="cont">
                                <p class="flex"><input type="checkbox" name="package" id="package" v-model="product.package"><label for="package">패키지로 가격설정</label></p>
                                <div class="box_write package">
                                    <div class="table">
                                        <table v-if="!product.package">
                                            <thead>
                                                <tr>
                                                    <td></td>
                                                    <th>BASIC</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <!--기본항목-->
                                                <tr>
                                                    <th>제목<span class="required">*</span></th>
                                                    <td><input type="text" placeholder="제목을 입력해주세요" required v-model="product.basic.name">
                                                        {{product.basic.name.length}} / 20
                                                        <span v-if="product.basic.name.length > 20" style="color : red">제목은 최대 20글자입니다.</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>설명<span class="required">*</span></th>
                                                    <td>
                                                        <textarea type="text" placeholder="상세설명을 입력해주세요" required v-model="product.basic.description"></textarea>
                                                        {{ product.basic.description.length }} / 60
                                                        <span v-if="product.basic.description.length > 60" style="color : red">설명은 최대 60글자입니다.</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>금액(VAT 포함)<span class="required">*</span></th>
                                                    <td>
                                                        <p class="flex">
                                                            <input type="text" class="text-right" placeholder="0" required v-model="product.basic.price"><label>원</label>
                                                        </p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>작업 기간<span class="required">*</span></th>
                                                    <td>
                                                        <select required v-model="product.basic.work">
                                                            <option>선택해주세요</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>수정 횟수<span class="required">*</span></th>
                                                    <td>
                                                        <select required v-model="product.basic.modify">
                                                            <option>선택해주세요</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <table v-else>
                                            <thead>
                                                <tr>
                                                    <td></td>
                                                    <th>STANDARD</th>
                                                    <th>DELUXE</th>
                                                    <th>PREMIUM</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <!--기본항목-->
                                                <tr>
                                                    <th>제목<span class="required">*</span></th>
                                                    <td><input type="text" placeholder="제목을 입력해주세요" required v-model="product.standard.name">
                                                        {{ product.standard.name.length }} / 20 <span v-if="product.standard.name.length > 20" style="color : red">제목은 최대 20글자입니다.</span>
                                                    </td>

                                                          <td><input type="text" placeholder="제목을 입력해주세요" required v-model="product.deluxe.name">
                                                        {{product.deluxe.name.length}} / 20 <span v-if="product.deluxe.name.length > 20" style="color : red">제목은 최대 20글자입니다.</span>
                                                    </td>

                                                          <td><input type="text" placeholder="제목을 입력해주세요" required v-model="product.premium.name">
                                                        {{ product.premium.name.length }} / 20 <span v-if="product.premium.name.length > 20" style="color : red">제목은 최대 20글자입니다.</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>설명<span class="required">*</span></th>
                                                    <td>
                                                        <textarea type="text" placeholder="상세설명을 입력해주세요" required v-model="product.standard.description"></textarea>
                                                        {{ product.standard.description.length }} / 60
                                                        <span v-if="product.standard.description.length > 60" style="color : red">설명은 최대 60글자입니다.</span>
                                                    </td>

                                                    <td>
                                                        <textarea type="text" placeholder="상세설명을 입력해주세요" required v-model="product.deluxe.description"></textarea>
                                                        {{ product.deluxe.description.length }} / 60
                                                        <span v-if="product.deluxe.description.length > 60" style="color : red">설명은 최대 60글자입니다.</span>
                                                    </td>

                                                    <td>
                                                        <textarea type="text" placeholder="상세설명을 입력해주세요" required v-model="product.premium.description"></textarea>
                                                        {{ product.premium.description.length }} / 60
                                                        <span v-if="product.premium.description.length > 60" style="color : red">설명은 최대 60글자입니다.</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>금액(VAT 포함)<span class="required">*</span></th>
                                                    <td><p class="flex"><input type="text" class="text-right" placeholder="0" required v-model="product.standard.price"><label>원</label></p></td>
                                                    <td><p class="flex"><input type="text" class="text-right" placeholder="0" required v-model="product.deluxe.price"><label>원</label></p></td>
                                                    <td><p class="flex"><input type="text" class="text-right" placeholder="0" required v-model="product.premium.price"><label>원</label></p></td>
                                                </tr>
                                                <tr>
                                                    <th>작업 기간<span class="required">*</span></th>
                                                    <td>
                                                        <select required v-model="product.standard.work">
                                                            <option>선택해주세요</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select required v-model="product.deluxe.work">
                                                            <option>선택해주세요</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select required v-model="product.premium.work">
                                                            <option>선택해주세요</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>수정 횟수<span class="required">*</span></th>
                                                    <td>
                                                        <select required v-model="product.standard.work">
                                                            <option>선택해주세요</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select required v-model="product.deluxe.work">
                                                            <option>선택해주세요</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select required v-model="product.premium.work">
                                                            <option>선택해주세요</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box_write02">
                            <h4>추가옵션</h4>
                            <div class="cont">
                                <div class="box_ck">
                                    <ul class="area_filter" id="area_filter">
                                        <li>
                                            <div>
                                                <input type="checkbox" id="filter0<?=$i?>" name="option_arr[]" value="<?=$i?>">
                                                <label for="filter0<?=($i)?>">촬영 시간(분) 추가</label>
                                            <div>
                                            <div class="filter_active">
                                                <div class="grid4">
                                                    <input type="text" placeholder="최소 1,000"><span>원 추가시</span>
                                                    <select><option>선택해주세요</option></select><span>분 추가</span>
                                                </div>
                                                <!--패키지 일때-->
                                                <div class="grid5">
                                                    <strong>STANDARD</strong>
                                                    <input type="text" placeholder="최소 1,000"><span>원 추가시</span>
                                                    <select><option>선택해주세요</option></select><span>분 추가</span>
                                                </div>
                                                <div class="grid5">
                                                    <strong>DELUXE</strong>
                                                    <input type="text" placeholder="최소 1,000"><span>원 추가시</span>
                                                    <select><option>선택해주세요</option></select><span>분 추가</span>
                                                </div>
                                                <div class="grid5">
                                                    <strong>PREMIUM</strong>
                                                    <input type="text" placeholder="최소 1,000"><span>원 추가시</span>
                                                    <select><option>선택해주세요</option></select><span>분 추가</span>
                                                </div>
                                                <!--패키지 일때-->
                                            </div>
                                        </li>
                                        <li>
                                            <div>
                                                <input type="checkbox" id="filter1" >
                                                <label for="filter1">상업적 이용 가능</label>
                                            <div>
                                        </li>
                                        <li>
                                            <div>
                                                <input type="checkbox" id="filter2" >
                                                <label for="filter2">원본 파일 제공</label>
                                            <div>
                                        </li>
                                        <li>
                                            <div>
                                                <input type="checkbox" id="filter3" >
                                                <label for="filter3">자막 삽입</label>
                                            <div>
                                        </li>
                                        <li>
                                            <div>
                                                <input type="checkbox" id="filter4" >
                                                <label for="filter4">맞춤 옵션 추가</label>
                                            <div>
                                            <div class="filter_active">
                                                <div>
                                                    <dl class="grid">
                                                        <dt><label>제목</label></dt>
                                                        <dd><input type="text" placeholder="제목을 입력해주세요"></dd>
                                                        <dt><label>설명</label></dt>
                                                        <dd><input type="text" placeholder="설명을 입력해주세요"></dd>
                                                        <dt><label>추가금액</label></dt>
                                                        <dd class="flex"><input type="text" placeholder="최소1,000"><span>원 추가시</span></dd>
                                                        <dt><label>추가작업일</label></dt>
                                                        <dd class="flex"><select><option>선택해주세요</option></select><span>분 추가</span></dd>
                                                    </dl>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
                <div id="area_btn"><a class="btn_next" href="" @click="event.preventDefault(); $emit('changeTab',2)">다음</a></div>
            </div>
        </div>
    </span>
    </div>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            primary : {type : String, default : ""},
            mb_no : {type : String, default : ""},
            product : {type : Object ,default : null},
        },
        data: function(){
            return {
                jl : null,
                filter : {

                },
                data : {

                },

                modal : false,

                portfolios : [],

                categories : [],
                bool : true,
                parent_category_idx : "",
            };
        },
        created: function(){
            this.jl = new JL('<?=$componentName?>');
            this.getCategory();
            this.getPortfolio();
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
            getPortfolio: function () {
                var filter = {member_idx: this.mb_no}
                var res = this.jl.ajax("get",filter,"/api/member_portfolio.php");

                if(res) {
                    this.portfolios = res.response.data
                }
            },
            getCategory: function () {
                var method = "get";
                var filter = { parent_idx : "" };
                var objs = {
                    _method: method,
                    filter: JSON.stringify(filter)
                };

                var res = ajax("/api/category.php", objs);
                if (res) {
                    console.log(res)
                    this.categories = res.response.data;
                }
            }
        },
        computed: {
            parent_category : function() {
                if(!this.parent_category_idx) return null;
                return this.categories.find(obj => obj['idx'] == this.parent_category_idx);
            }
        },
        watch: {
            parent_category_idx : function() {
                if(this.bool) {
                    this.data.category_idx = '';
                }else {
                    this.bool = true;
                }

            }
        }
    });
</script>

<style>

</style>