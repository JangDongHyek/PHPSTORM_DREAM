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
                        <a href="" @click="event.preventDefault();">
                            <em>1</em>
                            <span>기본정보</span>
                        </a>
                    </li>
                    <li id="">
                        <a href="" @click="event.preventDefault();">
                            <em>2</em>
                            <span>서비스 설명</span>
                        </a>
                    </li>
                    <li id="">
                        <a href="" @click="event.preventDefault();">
                            <em>3</em>
                            <span>이미지 등록</span>
                        </a>
                    </li>
                    </ul>
                </div>
                <div class="box_list">

                    <div class="box_content">
                        <div class="box_write02">
                            <h4 class="b_tit">포트폴리오 <em><i class="point" name="subpoint">{{ product.portfolios.length }}</i>/5</em></h4>
                            <div class="cont">
                                <div class="area_box">
                                    <ul class="photo_list" id="file_list">
                                        <li class="file_1" v-for="item,index in product.portfolios">
                                            <div class="area_img" v-if="jl.findObject(portfolios,'idx',item)">
                                                <img :src="jl.root + jl.findObject(portfolios,'idx',item).main_image_array[0].src">
                                                <div class="area_delete" @click="product.portfolios.splice(index,1)"><span class="sound_only">삭제</span></div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="portfolio text-right" v-if="!admin">
                        <button class="btn" @click="modal = true"><i class="fa-regular fa-arrow-down-to-line"></i> 포트폴리오 불러오기</button>
                    </div>
                    <br>
                    <p class="text-center txt_blue">나의 포트폴리오를 불러와서<br class="visible-xs"> 빠르게 상품을 등록해보세요!</p>

                    
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
                                    <button @click="product.portfolios.push(item.idx)">등록하기</button>
                                </li>
                            </ul>
                    </slot-modal>
                    
                    <br>
                    <div class="box_write">
                        <h4>제목</h4>
                        <div class="cont">
                            <input name="i_title" id="i_title" type="text" maxlength="30" placeholder="7자이상 30자 이하." v-model="product.name">
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
                                        <input type="radio" v-model="product.gender" name="gender" id="male" value="남자"><label for="male">남자</label>
                                        <input type="radio" v-model="product.gender" name="gender" id="female" value="여자"><label for="female">여자</label>
                                        <input type="radio" v-model="product.gender" name="gender" id="not-selected" value="미선택"><label for="not-selected">미선택</label>
                                    </div>
                                </div>
                                <div class="box_write" v-if="['23','24','28','29'].includes(parent_category_idx)">
                                    <h4>연령</h4>
                                    <div class="cont box">
                                        <input type="radio" v-model="product.age" value="키즈" id="kids" name="age-group"><label for="kids">키즈</label>
                                        <input type="radio" v-model="product.age" value="청소년" id="teen" name="age-group"><label for="teen">청소년</label>
                                        <input type="radio" v-model="product.age" value="20~30대" id="twenties-thirties" name="age-group"><label for="twenties-thirties">20~30대</label>
                                        <input type="radio" v-model="product.age" value="중장년" id="middle-aged" name="age-group"><label for="middle-aged">중장년</label>
                                    </div>
                                </div>
                                <div class="box_write">
                                    <h4>지역</h4>
                                    <div class="cont box">
                                        <input type="checkbox" :disabled="product.area.includes('선택안함')" v-model="product.area" value="국내" id="domestic" name="location"><label for="domestic">국내</label>
                                        <input type="checkbox" :disabled="product.area.includes('선택안함')" v-model="product.area" value="해외" id="overseas" name="location"><label for="overseas">해외</label>
                                        <input type="checkbox" :disabled="product.area.includes('선택안함')" v-model="product.area" value="협의가능" id="overseas1" name="location"><label for="overseas1">협의가능</label>
                                        <input type="checkbox" @click="product.area = [];" v-model="product.area" value="선택안함" id="overseas2" name="location"><label for="overseas2">선택안함</label>
                                    </div>
                                </div>
                                <div class="box_write" v-if="product.area.includes('국내')">
                                    <h4>상세지역</h4>
                                    <div class="cont box">
                                        <template v-for="region,rindex in regions">
                                        <input type="checkbox" :disabled="product.region.includes('전국')" v-model="product.region" :value="region" :id="'rindex'+rindex" name="location"><label :for="'rindex'+rindex">{{region}}</label>
                                        </template>
                                        <input type="checkbox" @click="product.region = [];" v-model="product.region" value="전국" id="rindex15111" name="location"><label for="rindex15111">전국</label>
                                    </div>
                                </div>
                                <div class="box_write">
                                    <h4>주말 작업<br>가능여부</h4>
                                    <div class="cont box">
                                        <input type="radio" v-model="product.weekend" value="협의가능" id="negotiable2" name="availability"><label for="negotiable2">협의가능</label>
                                        <input type="radio" v-model="product.weekend" value="가능" id="possible" name="availability"><label for="possible">가능</label>
                                        <input type="radio" v-model="product.weekend" value="불가능" id="not-possible" name="availability"><label for="not-possible">불가능</label>
                                    </div>
                                </div>
                                <div class="box_write" v-if="!['','27','31'].includes(parent_category_idx)" >
                                    <h4>작업유형</h4>
                                    <div class="cont box">
                                        <template v-for="item,index in getWorkType()">
                                            <input type="checkbox" v-if="item != '선택안함'" :disabled="product.types.includes('선택안함')" v-model="product.types" :value="item" :id="'i'+index">
                                            <input type="checkbox" v-else @click="product.types=[];" v-model="product.types" :value="item" :id="'i'+index">
                                            <label :for="'i'+index">{{item}}</label>
                                        </template>

                                    </div>
                                </div>
                                <div class="box_write" v-if="['20','21'].includes(parent_category_idx)" >
                                    <h4>스타일</h4>
                                    <div class="cont box">
                                        <input type="checkbox" :disabled="product.styles.includes('선택안함')" v-model="product.styles" value="인물" id="person" name="category"><label for="person">인물</label>
                                        <input type="checkbox" :disabled="product.styles.includes('선택안함')" v-model="product.styles" value="사물" id="object" name="category"><label for="object">사물</label>
                                        <input type="checkbox" :disabled="product.styles.includes('선택안함')" v-model="product.styles" value="제품" id="product" name="category"><label for="product">제품</label>
                                        <input type="checkbox" :disabled="product.styles.includes('선택안함')" v-model="product.styles" value="의상" id="clothing" name="category"><label for="clothing">의상</label>
                                        <input type="checkbox" :disabled="product.styles.includes('선택안함')" v-model="product.styles" value="자동차" id="car" name="category"><label for="car">자동차</label>
                                        <input type="checkbox" :disabled="product.styles.includes('선택안함')" v-model="product.styles" value="인테리어" id="interior" name="category"><label for="interior">인테리어</label>
                                        <input type="checkbox" :disabled="product.styles.includes('선택안함')" v-model="product.styles" value="2D" id="2d" name="category"><label for="2d">2D</label>
                                        <input type="checkbox" :disabled="product.styles.includes('선택안함')" v-model="product.styles" value="3D" id="3d" name="category"><label for="3d">3D</label>
                                        <input type="checkbox" :disabled="product.styles.includes('선택안함')" v-model="product.styles" value="이펙트" id="effects" name="category"><label for="effects">이펙트</label>
                                        <input type="checkbox" :disabled="product.styles.includes('선택안함')" v-model="product.styles" value="애니메이션" id="animation" name="category"><label for="animation">애니메이션</label>
                                        <input type="checkbox" @click="product.styles=[];" v-model="product.styles" value="선택안함" id="none-cate" name="category"><label for="none-cate">선택안함</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="box_write02">
                            <h4>검색 키워드</h4>
                            <div class="cont">
                                <div class="keyword">
                                        <div class="keyword_add">
                                            <p>검색 키워드</p>
                                            <input type="text" placeholder="키워드 입력" v-model="temp" @keyup.enter="addKeyword();"> <span>{{product.keywords.length}}/5</span>
                                            <button @click="addKeyword()" v-if="!admin">추가</button>
                                        </div>
                                        <div class="keyword_list">
                                            <div class="tag">
                                                <template v-for="item,index in product.keywords">
                                                    <span>{{ item }} <a class="del" href="" @click="event.preventDefault(); product.keywords.splice(index,1);"><i class="fa-light fa-xmark" v-if="!admin"></i></a></span>
                                                </template>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>

                        <div class="box_write02">
                            <h4>가격정보</h4>
                            <p class="flex chkBox" v-if="!admin"><input type="checkbox" name="package" id="package" v-model="product.package"><label for="package">패키지로 가격설정</label></p>
                            <div class="cont box">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="active"><a href="#basic" role="tab" data-toggle="tab">BASIC</a></li>
                                        <li v-show="product.package"><a href="#standard" role="tab" data-toggle="tab">STANDARD</a></li>
                                        <li v-show="product.package"><a href="#premium" role="tab" data-toggle="tab">PREMIUM</a></li>
                                    </ul>

                                <!-- Tab Content -->
                                    <div class="tab-content">
                                        <div class="tab-pane fade in active" id="basic">
                                                <dl>
                                                    <dt>제목<span class="required">*</span></dt>
                                                    <dd><input type="text" placeholder="제목을 입력해주세요" required v-model="product.basic.name">
                                                        {{product.basic.name.length}} / 20
                                                        <span v-if="product.basic.name.length > 20" style="color : red">제목은 최대 20글자입니다.</span>
                                                    </dd>
                                                </dl>
                                                <dl>
                                                    <dt>설명<span class="required">*</span></dt>
                                                    <dd>
                                                        <textarea type="text" placeholder="상세설명을 입력해주세요" required v-model="product.basic.description"></textarea>
                                                        {{ product.basic.description.length }} / 60
                                                        <span v-if="product.basic.description.length > 60" style="color : red">설명은 최대 60글자입니다.</span>
                                                    </dd>
                                                </dl>
                                                <dl>
                                                    <dt>금액(VAT 포함)<span class="required">*</span></dt>
                                                    <dd>
                                                        <p class="flex">
                                                            <input type="text" class="text-right" placeholder="0" @keyup="jl.isNumberKeyInput($event,true)" @input="jl.isNumberKeyInput($event,true)" required v-model="product.basic.price"><label>원</label>
                                                        </p>
                                                    </dd>
                                                </dl>
                                                <dl>
                                                    <dt>작업 기간<span class="required">*</span></dt>
                                                    <dd>
                                                        <select required v-model="product.basic.work">
                                                            <option value="">선택해주세요</option>
                                                            <option v-for="item in 30" :value="item">{{ item }}일</option>
                                                        </select>
                                                    </dd>
                                                </dl>
                                                <dl>
                                                    <dt>수정 횟수<span class="required">*</span></dt>
                                                    <dd>
                                                        <select required v-model="product.basic.modify">
                                                            <option value="">선택해주세요</option>
                                                            <option v-for="item in 16" :value="item-1">{{ item-1 }}회</option>
                                                            <option value="제한없음">제한없음</option>
                                                        </select>
                                                    </dd>
                                                </dl>

                                        </div>
                                        <div class="tab-pane fade" id="standard">
                                                <dl>
                                                    <dt>제목<span class="required">*</span></dt>
                                                    <dd><input type="text" placeholder="제목을 입력해주세요" required v-model="product.standard.name">
                                                        {{product.standard.name.length}} / 20
                                                        <span v-if="product.standard.name.length > 20" style="color : red">제목은 최대 20글자입니다.</span>
                                                    </dd>
                                                </dl>
                                                <dl>
                                                    <dt>설명<span class="required">*</span></dt>
                                                    <dd>
                                                        <textarea type="text" placeholder="상세설명을 입력해주세요" required v-model="product.standard.description"></textarea>
                                                        {{ product.standard.description.length }} / 60
                                                        <span v-if="product.standard.description.length > 60" style="color : red">설명은 최대 60글자입니다.</span>
                                                    </dd>
                                                </dl>
                                                <dl>
                                                    <dt>금액(VAT 포함)<span class="required">*</span></dt>
                                                    <dd>
                                                        <p class="flex">
                                                            <input type="text" class="text-right" @keyup="jl.isNumberKeyInput($event,true)" @input="jl.isNumberKeyInput($event,true)" placeholder="0" required v-model="product.standard.price"><label>원</label>
                                                        </p>
                                                    </dd>
                                                </dl>
                                                <dl>
                                                    <dt>작업 기간<span class="required">*</span></dt>
                                                    <dd>
                                                        <select required v-model="product.standard.work">
                                                            <option value="">선택해주세요</option>
                                                            <option v-for="item in 30" :value="item">{{ item }}일</option>
                                                        </select>
                                                    </dd>
                                                </dl>
                                                <dl>
                                                    <dt>수정 횟수<span class="required">*</span></dt>
                                                    <dd>
                                                        <select required v-model="product.standard.modify">
                                                            <option value="">선택해주세요</option>
                                                            <option v-for="item in 16" :value="item-1">{{ item-1 }}회</option>
                                                            <option value="제한없음">제한없음</option>
                                                        </select>
                                                    </dd>
                                                </dl>

                                        </div>
                                        <div class="tab-pane fade" id="premium">
                                                <dl>
                                                    <dt>제목<span class="required">*</span></dt>
                                                    <dd><input type="text" placeholder="제목을 입력해주세요" required v-model="product.premium.name">
                                                        {{product.premium.name.length}} / 20
                                                        <span v-if="product.premium.name.length > 20" style="color : red">제목은 최대 20글자입니다.</span>
                                                    </dd>
                                                </dl>
                                                <dl>
                                                    <dt>설명<span class="required">*</span></dt>
                                                    <dd>
                                                        <textarea type="text" placeholder="상세설명을 입력해주세요" required v-model="product.premium.description"></textarea>
                                                        {{ product.premium.description.length }} / 60
                                                        <span v-if="product.premium.description.length > 60" style="color : red">설명은 최대 60글자입니다.</span>
                                                    </dd>
                                                </dl>
                                                <dl>
                                                    <dt>금액(VAT 포함)<span class="required">*</span></dt>
                                                    <dd>
                                                        <p class="flex">
                                                            <input type="text" class="text-right" placeholder="0" @keyup="jl.isNumberKeyInput($event,true)" @input="jl.isNumberKeyInput($event,true)" required v-model="product.premium.price"><label>원</label>
                                                        </p>
                                                    </dd>
                                                </dl>
                                                <dl>
                                                    <dt>작업 기간<span class="required">*</span></dt>
                                                    <dd>
                                                        <select required v-model="product.premium.work">
                                                            <option value="">선택해주세요</option>
                                                            <option v-for="item in 30" :value="item">{{ item }}일</option>
                                                        </select>
                                                    </dd>
                                                </dl>
                                                <dl>
                                                    <dt>수정 횟수<span class="required">*</span></dt>
                                                    <dd>
                                                        <select required v-model="product.premium.modify">
                                                            <option value="">선택해주세요</option>
                                                            <option v-for="item in 16" :value="item-1">{{ item-1 }}회</option>
                                                            <option value="제한없음">제한없음</option>
                                                        </select>
                                                    </dd>
                                                </dl>

                                        </div>
                                    </div>
                            </div>

                            <div class="box_write">
                                <h4>세금 계산서 <br>가능여부</h4>
                                <div class="cont box">
                                    <input type="radio" id="tax-available" v-model="product.tax_invoice" name="tax-invoice" value="true"><label for="tax-available">가능</label>
                                    <input type="radio" id="tax-not-available" v-model="product.tax_invoice" name="tax-invoice" value="false"><label for="tax-not-available">불가능</label>
                                </div>
                            </div>
                        </div>
                        <div class="box_write02">
                            <h4>맞춤옵션</h4>
                            <div class="cont">
                                <div class="box_ck">
                                    <ul class="area_filter" id="area_filter">
                                        <li v-for="item,index in product.options">

                                            <div class="filter_active" v-if="item.detail == 'custom'">
                                                <div>
                                                    <dl class="grid">
                                                        <dt><label>제목</label></dt>
                                                        <dd><input type="text" placeholder="제목을 입력해주세요" v-model="item.name"></dd>
                                                        <dt><label>설명</label></dt>
                                                        <dd><input type="text" placeholder="설명을 입력해주세요" v-model="item.description"></dd>
                                                    </dl>
                                                </div>
                                            </div>
                                        </li>

                                        <li v-if="parent_category && !admin">
                                            <div>
                                                <span @click="$emit('addOption')">맞춤옵션 추가</span>
                                            <div>
                                        </li>
                                    </ul>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
                <div id="area_btn"><a class="btn_next" href="" @click="event.preventDefault(); changeTap()">다음</a></div>
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
            admin : {type : Boolean, default : false},
        },
        data: function(){
            return {
                jl : null,
                filter : {

                },
                data : {

                },
                temp : "",
                modal : false,

                portfolios : [],

                categories : [],
                bool : false,
                parent_category_idx : "",

                regions : ["서울", "경기", "인천", "강원", "대전", "세종", "충남", "충북", "부산", "울산", "경남", "경북", "대구", "광주", "전남", "전북", "제주"],
            };
        },
        created: function(){
            this.jl = new Jl('<?=$componentName?>');
            this.getCategory();
            this.getPortfolio();
        },
        mounted: function(){
            this.$nextTick(() => {

            });
        },
        methods: {
            changeTap() {
                if(this.product.portfolios.length > 5) {
                    alert("포트폴리오는 5개까지만 가능합니다.");
                    return false;
                }

                if(this.product.name.length < 7) {
                    alert("제목은 7자이상이여야 합니다.");
                    return false;
                }
                if(this.product.category_idx == "") {
                    alert("카테고리를 선택해주세요.");
                    return false;
                }

                if(this.product.package) {
                    if(!this.product.standard.name || !this.product.basic.name || !this.product.premium.name) {
                        alert("가격정보의 제목은 필수값입니다.");
                        return false;
                    }

                    if(this.product.standard.name.length > 20 || this.product.basic.name.length > 20 || this.product.premium.name.length > 20) {
                        alert("가격정보의 제목은 20글자까지 가능합니다.");
                        return false;
                    }

                    if(!this.product.standard.description || !this.product.basic.description || !this.product.premium.description) {
                        alert("가격정보의 설명은 필수값입니다.");
                        return false;
                    }

                    if(this.product.standard.name.description > 60 || this.product.basic.name.description > 60 || this.product.premium.name.description > 60) {
                        alert("가격정보의 내용은 60글자까지 가능합니다.");
                        return false;
                    }

                    if(!this.product.standard.price || !this.product.basic.price || !this.product.premium.price) {
                        alert("가격정보의 가격은 필수값입니다.");
                        return false;
                    }

                    if(!this.product.standard.work || !this.product.basic.work || !this.product.premium.work) {
                        alert("가격정보의 작업 기간은 필수값입니다.");
                        return false;
                    }

                    if(this.product.standard.modify === "" || this.product.basic.modify === "" || this.product.premium.modify === "") {
                        alert("가격정보의 수정 횟수는 필수값입니다.");
                        return false;
                    }
                }else {
                    if(!this.product.basic.name) {
                        alert("가격정보의 제목은 필수값입니다.");
                        return false;
                    }

                    if(this.product.basic.name.length > 20) {
                        alert("가격정보의 제목은 20글자까지 가능합니다.");
                        return false;
                    }

                    if(!this.product.basic.description) {
                        alert("가격정보의 설명은 필수값입니다.");
                        return false;
                    }

                    if(this.product.basic.name.description > 60) {
                        alert("가격정보의 내용은 60글자까지 가능합니다.");
                        return false;
                    }

                    if(!this.product.basic.price) {
                        alert("가격정보의 가격은 필수값입니다.");
                        return false;
                    }

                    if(!this.product.basic.work) {
                        alert("가격정보의 작업 기간은 필수값입니다.");
                        return false;
                    }

                    if(this.product.basic.modify === "") {
                        alert("가격정보의 수정 횟수는 필수값입니다.");
                        return false;
                    }
                }

                this.$emit('changeTab',2)
            },
            addKeyword() {
                if(this.temp.trim() == "") {
                    alert("키워드를 입력해주세요.");
                    return false;
                }

                if(this.product.keywords.length >= 5) {
                    alert("검색 키워드는 최대 5개입니다.");
                    return false;
                }
                this.product.keywords.push(this.temp);
                this.temp = '';
            },
            getWorkType() {
                switch (this.parent_category_idx) {
                    case "20" :
                        return ['사진','영상','음향','선택안함']
                    case "21" :
                        return ['사진','영상','음향','선택안함']
                    case "22" :
                        return ['블로그', '카페', '밴드', '인스타그램', '페이스북', '유튜브', '포스트', '틱톡', '지식인', '트위터', '디스코드', '트위치', '기타', '선택안함'];
                    case "23" :
                        return ['드라마', '영화', '연극', '뮤지컬', '재연', '유튜브', '선택안함'];
                    case "24" :
                        return ['피팅', '패션', '주얼리', '뷰티', '의전·전시', '광고', '선택안함'];
                    case "25" :
                        return ['촬영', '무대', '스튜디오', '장비', '장소', '설치', '섭외', '통제', '취재', '선택안함'];
                    case "26" :
                        return ['한국어', '영어', '중국어', '일본어', '불어', '러시아어'];
                    case "27" :
                        return []
                    case "28" :
                        return ['노래', 'DJ', '댄스', '연주', '사회', '선택안함'];
                    case "29" :
                        return ['개인레슨', '그룹', '기업강의', '취미', '자격증', '프로젝트', '취업', '선택안함'];
                    case "30" :
                        return ['내방', '출장', '화상', '전화', '메시지', '문서', '선택안함'];
                    case "31" :
                        return [];
                    default :
                        return [];
                }
            },
            async getPortfolio() {
                var filter = {member_idx: this.mb_no}
                var res = await this.jl.ajax("get",filter,"/api/member_portfolio.php");

                if(res) {
                    this.portfolios = res.response.data
                }
            },
            async getCategory() {
                var method = "get";
                var filter = { parent_idx : 0 };

                var res = await this.jl.ajax(method,filter,"/api/category.php");
                if (res) {
                    console.log(res)
                    this.categories = res.response.data;
                }
            }
        },
        computed: {
            product_package : function() {
                return this.product.package;
            },
            parent_category : function() {
                if(!this.parent_category_idx) return null;
                return this.categories.find(obj => obj['idx'] == this.parent_category_idx);
            }
        },
        watch: {
            product_package() {
                $('a[href="#basic"]').tab('show'); // 탭 전환
            },
            parent_category_idx : function() {
                if(this.bool) {
                    this.product.category_idx = '';
                }else {
                    this.bool = true;
                }
                this.product.types = [];
            },
            parent_category : function(){
                this.$emit('change',this.parent_category)
            }
        }
    });
</script>

<style>

</style>