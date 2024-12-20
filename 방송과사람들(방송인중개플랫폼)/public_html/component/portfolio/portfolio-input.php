<?php $componentName = str_replace(".php", "", basename(__FILE__)); ?>
<script type="text/x-template" id="<?= $componentName ?>-template">
    <div>
        <span id="tab1" style="display: block">
        <div id="item_write">
                <div class="inr v2" id="inr">
                <h3>포트폴리오등록</h3>

                <div class="box_list">
                    <div class="box_write">
                        <h4>제목</h4>
                        <div class="cont">
                            <input name="i_title" id="i_title" type="text" placeholder="제목을 입력해 주세요." v-model="data.name">
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
                           <select v-if="parent_category" v-model="data.category_idx">
                                <option value="">선택해주세요</option>
                                <option v-for="item in parent_category.childs" :value="item.idx">{{item.name}}</option>
                           </select>
                       </div>
                    </div>
                <div class="box_content">
					<div class="box_write02">
						<h4 class="b_tit">메인이미지등록
                            <em>
                                <i class="point" name="point">{{ data.main_image_array.length }}</i>/1
                            </em>
                            <span v-if="data.main_image_array.length > 1" style="color : red;">메인 이미지는 최대 1장입니다.</span>
                        </h4>
						<div class="cont">
							<div class="area_box">

								<!-- 처음화면에서는 안보였다가 이미지 등록하면 나타나게 해주세요 ~~ -->
								<ul class="photo_list" id="file_list">
                                    <li class="file_1" v-for="item,index in data.main_image_array">
                                        <div class="area_img">
                                            <img :src="item.preview ? item.preview : jl.root+item.src">
                                            <div class="area_delete" @click="data.main_image_array.splice(index,1)"><span class="sound_only">삭제</span></div>
                                        </div>
                                    </li>
								</ul>
                                <!-- //이미지 미리보기 -->

                                <input type="file" name="file" id="input_file" multiple accept="*" style="position: absolute; left: -999; opacity:0; width: 0; height: 0;"
                                       ref="main_image_array" @change="jl.changeFile($event,data,'main_image_array')">
								<div id="fileDrag" class="img_wrap" @click="$refs.main_image_array.click();"
                                     @drop.prevent="jl.dropFile($event,data,'main_image_array')" @dragover.prevent @dragleave.prevent>
									<div class="area_txt">
										<div class="area_img"><img
                                                    :src="`${jl.root}/theme/basic_app/img/app/icon_upload.svg`"></div>
										<span class="w">마우스로 드래그해서 파일을 추가하세요.</span>
										<span class="m">파일을 추가하세요.</span>
									</div>
								</div>
								<em>※이미지 권장 비율(4:3)</em>
							</div>
						</div>
					</div>
				</div>
				<div class="box_content">
					<div class="box_write02">
						<h4 class="b_tit">상세이미지등록
                            <em><i class="point" name="subpoint">{{ data.content_image_array.length }}</i>/10</em>
                            <span v-if="data.content_image_array.length > 10" style="color : red;">상세이미지는 최대 10장입니다.</span>
                        </h4>
						<div class="cont">
							<div class="area_box">

								<!-- 처음화면에서는 안보였다가 이미지 등록하면 나타나게 해주세요 ~~ -->
								<ul class="photo_list" id="file_list">
                                    <li class="file_1" v-for="item,index in data.content_image_array">
                                        <div class="area_img">
                                            <img :src="item.preview ? item.preview : jl.root+item.src">
                                            <div class="area_delete" @click="data.content_image_array.splice(index,1)"><span class="sound_only">삭제</span></div>
                                        </div>
                                    </li>
								</ul>
                                <!-- //이미지 미리보기 -->

                                <input type="file" name="file" id="input_file" multiple accept="*" style="position: absolute; left: -999; opacity:0; width: 0; height: 0;"
                                       ref="content_image_array" @change="jl.changeFile($event,data,'content_image_array')">
								<div id="fileDrag" class="img_wrap" @click="$refs.content_image_array.click();"
                                     @drop.prevent="jl.dropFile($event,data,'content_image_array')" @dragover.prevent @dragleave.prevent>
									<div class="area_txt">
										<div class="area_img"><img
                                                    :src="`${jl.root}/theme/basic_app/img/app/icon_upload.svg`"></div>
										<span class="w">마우스로 드래그해서 파일을 추가하세요.</span>
										<span class="m">파일을 추가하세요.</span>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
                <div class="box_content">
                    <div class="box_write02">
                        <h4 class="b_tit">동영상 등록
<!--                            동영상 기획 정리될때까지 주석처리-->
<!--                            <em><i class="point" name="subpoint">{{data.movie_file_array.length}}</i>/8</em>-->
                            <em><i class="point" name="subpoint">{{data.movie_link.length}}</i>/10</em>
                        <div class="cont">
                            <div class="area_box">
<!--                                <div class="video_active box_dashed">-->
<!--                                    <ul>-->
<!--                                        <li v-for="item,index in data.movie_file_array">-->
<!--                                            <p>{{ item.name }}</p>-->
<!--                                            <a class="del" href="" @click="event.preventDefault(); data.movie_file_array.splice(index,1)"><i class="fa-sharp fa-light fa-xmark"></i></a>-->
<!--                                        </li>-->
<!--                                    </ul>-->
<!--                                    <button class="btn_add" @click="$refs.movieRef.click()"><i class="fa-light fa-folder-arrow-up"></i> 동영상 업로드</button>-->
<!--                                    <input v-show="false" type="file" ref="movieRef" @change="jl.changeFile($event,data,'movie_file_array')">-->
<!--                                </div>-->
                                <div class="link_active box_dashed">
                                    <dl v-for="item,index in data.movie_link">
                                        <dt>동영상 링크 {{ (index+1).toString().padStart(2,'0') }}.</dt>
                                        <dd><input type="text" placeholder="등록하고자하는 동영상 링크를 입력해주세요" v-model="data.movie_link[index]"></dd>
                                        <a class="del" href="" @click="event.preventDefault(); data.movie_link.splice(index,1)"><i class="fa-sharp fa-light fa-xmark"></i></a>
                                    </dl>
                                    <button class="btn_add" @click="addMovie()"><i class="fa-light fa-plus"></i> 링크 추가</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="box_write02">
						<h4>포트폴리오 설명</h4>
						<div class="cont">
							<!-- 에디터 넣어주세요~! -->
							<textarea name="i_content" v-model="data.description"
                                      placeholder="프로젝트 목적, 주요기능과 메뉴 등을 상세히 입력해주세요">
                            </textarea>
						</div>
					</div>
                    <div class="box_write02">
						<h4>약관 동의</h4>
						<div class="cont">
							<div class="box_gray">
								<p class="chkBox"><input type="checkbox" id="agree" name="agree" v-model="agree"><label
                                            for="agree">아래 내용에 모두 동의 합니다.</label></p>
							</div>

                            도용하지 않은 순수 본인의 창작물 임을 확인합니다.
                            신고 접수 시 해당 포트폴리오가 방송과사람들에 의해 임의 삭제 처리될 수 있음에 동의합니다.
						</div>
					</div>
                </div>
                <div id="area_btn"><a class="btn_next" href="" @click="event.preventDefault(); postData();">등록완료</a></div>
            </div>
        </div>
    </span>
    </div>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            mb_no: {type: String, default: ""},
            primary: {type: String, default: ""}
        },
        data: function () {
            return {
                jl: null,
                filter: {},
                data: {
                    member_idx : this.mb_no,
                    name : "",
                    category_idx : "",
                    main_image_array : [],
                    content_image_array : [],
                    movie_file_array : [],
                    movie_link : [],
                    description : "",
                },
                agree : false,

                categories : [],
                bool : true,
                parent_category_idx : "",
            };
        },
        created: function () {
            this.jl = new Jl('<?=$componentName?>');
            this.getCategory();
            console.log(this.primary)
            console.log(this.mb_no)
            if(this.primary) this.getData();
        },
        mounted: function () {
            this.$nextTick(() => {

            });
        },
        methods: {
            addMovie() {
                if(this.data.movie_link.length >= 10) {
                    alert("동영상 등록은 최대 10개입니다.");
                    return false;
                }
                this.data.movie_link.push('');
            },
            async postData() {
                if(!this.data.name) {
                    alert("제목을 입력해주세요.");
                    return false;
                }

                if(!(this.data.name.length >= 5 && this.data.name.length <= 35)) {
                    alert("제목은 5자이상 35자 이하입니다.");
                    return false;
                }

                if(!this.data.category_idx) {
                    alert("카테고리를 2차까지 선택해주세요.");
                    return false;
                }
                if(!this.data.main_image_array.length) {
                    alert("메인 이미지 1장은 필수입니다.");
                    return false;
                }
                if(this.data.main_image_array.length > 1) {
                    alert("메인 이미지는 1장까지 가능합니다");
                    return false;
                }

                if(this.data.main_image_array[0].size > 2097152) {
                    alert("메인 이미지의 크기 제한은 2MB 입니다.");
                    return false;
                }

                if(this.data.content_image_array.length > 10) {
                    alert("상세 이미지는 10장까지 가능합니다");
                    return false;
                }

                for (let i = 0; i < this.data.content_image_array.length; i++) {
                    if(this.data.content_image_array[i].size > 5242880) {
                        alert("상세 이미지의 크기 제한은 5MB입니다.");
                        return false;
                    }
                }

                if(this.data.movie_file_array.length > 8) {
                    alert("동영상 등록은 8개까지 가능합니다");
                    return false;
                }
                if(this.data.movie_link.length > 10) {
                    alert("동영상 링크 등록은 10개까지 가능합니다");
                    return false;
                }
                if(!this.agree) {
                    alert("약관에 동의해주세요.");
                    return false;
                }

                var method = this.primary ? "update" : "insert";
                var res = await this.jl.ajax(method, this.data, "/api/member_portfolio.php");

                if (res) {
                    alert("완료 되었습니다.");
                    window.location.href = `${this.jl.root}/bbs/mypage_portfolio.php`;
                }
            },
            async getData() {
                var filter = {primary : this.primary}
                var res = await this.jl.ajax("get", filter, "/api/member_portfolio.php");

                if (res) {
                    this.bool = false;
                    this.data = res.response.data[0]
                    this.parent_category_idx = this.data.CATEGORY.data[0].parent_idx;
                }
            },
            async getCategory() {
                var filter = { parent_idx : "" };

                var res = await this.jl.ajax("get",filter,"/api/category.php");
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