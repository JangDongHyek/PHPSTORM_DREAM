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
                            <input name="i_title" id="i_title" type="text"
                                   placeholder="제목을 입력해 주세요.">
                        </div>
                    </div>
                    <div class="box_write">
                        <h4>1차 카테고리</h4>
                        <div class="cont">
                            <div class="select_box v1">
                                <div class="box">

                                    <div class="select">
                                        카테고리를 선택해주세요
                                    </div>
                                    <ul class="list date" id="ctg_ul">
                                        <li class="">방송·배우·연기</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box_write">
                        <h4>2차 카테고리</h4>
                       <div class="cont" id="ctg_ul2">
                           <select>
                               <option>aaa</option>
                           </select>
                       </div>
                    </div>
                <div class="box_content">
					<div class="box_write02">
						<h4 class="b_tit">메인이미지등록 <em><i class="point" name="point">0</i>/4</em></h4>
						<div class="cont">
							<div class="area_box">

								<!-- 처음화면에서는 안보였다가 이미지 등록하면 나타나게 해주세요 ~~ -->
								<ul class="photo_list" id="file_list">
                                    <li class="file_1">
                                        <div class="area_img">
                                            <img src="">
                                            <div class="area_delete" onclick=''><span class="sound_only">삭제</span></div>
                                        </div>
                                    </li>
								</ul>
                                <!-- //이미지 미리보기 -->

                                <input type="file" name="file" id="input_file" multiple accept="*" style="position: absolute; left: -999; opacity:0; width: 0; height: 0;">
								<div id="fileDrag" class="img_wrap" onclick="file_add('')">
									<div class="area_txt">
										<div class="area_img"><img
                                                    src="<?php echo G5_THEME_IMG_URL ?>/app/icon_upload.svg"></div>
										<span class="w">마우스로 드래그해서 파일을 추가하세요.</span>
										<span class="m">파일을 추가하세요.</span>
									</div>
								</div>
								<em>※이미지 권장 사이즈: 652 x 488px (4:3 비율)</em>
							</div>
						</div>
					</div>
				</div>
				<div class="box_content">
					<div class="box_write02">
						<h4 class="b_tit">상세이미지등록 <em><i class="point"
                                                         name="subpoint"><?= $subfilecount ?></i>/8</em></h4>
						<div class="cont">
							<div class="area_box">
								<!-- 처음화면에서는 안보였다가 이미지 등록하면 나타나게 해주세요 ~~ -->
								<ul class="photo_list" id="subfile_list">
                                    <?php for ($i = 0; $row = sql_fetch_array($sub_file_result); $i++) { ?>
                                        <li class="subfile_<?= ($i + 1) ?>">
                                            <div class="area_img">
                                                <img src="<?= G5_DATA_URL . "/file/sub_img/" . $row['bf_file'] ?>">
                                                <div class="area_delete"
                                                     onclick='file_delete(<?= ($i + 1) ?>,"sub","<?= $row['bf_idx'] ?>")'><span
                                                            class="sound_only">삭제</span></div>
                                            </div>
                                        </li>
                                    <?php } ?>
								</ul>
                                <!-- //이미지 미리보기 -->
                                <input type="file" name="file" id="subinput_file" onchange="file_select(this,'sub');"
                                       multiple accept="image/*"
                                       style="position: absolute; left: -999; opacity:0; width: 0; height: 0;">
								<div id="fileDrag" class="sub_img_wrap" onclick="file_add('sub')">

									<div class="area_txt">
										<div class="area_img"><img
                                                    src="<?php echo G5_THEME_IMG_URL ?>/app/icon_upload.svg"></div>
										<span class="w">마우스로 드래그해서 파일을 추가하세요.</span>
										<span class="m">파일을 추가하세요.</span>
									</div>
								</div>
								<em>※이미지 권장 사이즈: 652 x 488px (4:3 비율)</em>
							</div>
						</div>
					</div>
				</div>
                <div class="box_content">
                    <div class="box_write02">
                        <h4 class="b_tit">동영상 등록 <em><i class="point" name="subpoint"><?= $subfilecount ?></i>/8</em>
                            <!--<p><input type="checkbox"><label>링크 등록</label></p>--></h4>
                        <div class="cont">
                            <div class="area_box">
                                <div class="video_active box_dashed">
                                    <ul>
                                        <li>
                                            <p>동영상 제목.mp4</p>
                                            <a class="del"><i class="fa-sharp fa-light fa-xmark"></i></a>
                                        </li>
                                        <li>
                                            <p>동영상 제목.mp4</p>
                                            <a class="del"><i class="fa-sharp fa-light fa-xmark"></i></a>
                                        </li>
                                    </ul>
                                    <button class="btn_add"><i class="fa-light fa-folder-arrow-up"></i> 동영상 업로드</button>
                                </div>
                                <div class="link_active box_dashed">
                                    <dl>
                                        <dt>동영상 링크 01.</dt>
                                        <dd><input type="text" placeholder="등록하고자하는 동영상 링크를 입력해주세요"></dd>
                                        <a class="del"><i class="fa-sharp fa-light fa-xmark"></i></a>
                                    </dl>
                                    <dl>
                                        <dt>동영상 링크 02.</dt>
                                        <dd><input type="text" placeholder="등록하고자하는 동영상 링크를 입력해주세요"></dd>
                                        <a class="del"><i class="fa-sharp fa-light fa-xmark"></i></a>
                                    </dl>
                                    <button class="btn_add"><i class="fa-light fa-plus"></i> 링크 추가</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="box_write02">
						<h4>포트폴리오 설명</h4>
						<div class="cont">
							<!-- 에디터 넣어주세요~! -->
							<textarea name="i_content"
                                      placeholder="프로젝트 목적, 주요기능과 메뉴 등을 상세히 입력해주세요"><?= $view['i_content'] ?></textarea>
						</div>
					</div>
                    <div class="box_write02">
						<h4>약관 동의</h4>
						<div class="cont">
							<div class="box_gray">
								<p><input type="checkbox" id="agree" name="agree"><label
                                            for="agree">아래 내용에 모두 동의 합니다.</label></p>
							</div>
                            도용하지 않은 순수 본인의 창작물 임을 확인합니다.
                            신고 접수 시 해당 포트폴리오가 방송과사람들에 의해 임의 삭제 처리될 수 있음에 동의합니다.
						</div>
					</div>
                </div>
                <div id="area_btn"><a class="btn_next" href="javascript:tab_click('2')">등록완료</a></div>
            </div>
        </div>
    </span>
        <span id="tab2" style="display: none">
        <?php include_once('./item_write02.php'); ?>
    </span>
        <span id="tab3" style="display: none">
    <?php include_once('./item_write03.php'); ?>
    </span>
    </div>
</script>

<script>
    Vue.component('<?=$componentName?>', {
        template: "#<?=$componentName?>-template",
        props: {
            primary: {type: String, default: ""}
        },
        data: function () {
            return {
                jl: null,
                filter: {},
                data: {},
            };
        },
        created: function () {
            this.jl = new JL('<?=$componentName?>');
        },
        mounted: function () {
            this.$nextTick(() => {

            });
        },
        methods: {
            postData: function () {
                var method = this.primary ? "update" : "insert";
                var res = this.jl.ajax(method, this.data, "/api/example.php");

                if (res) {

                }
            },
            getData: function () {
                var res = this.jl.ajax("get", this.data, "/api/example.php");

                if (res) {
                    this.data = res.response.data

                }
            }
        },
        computed: {},
        watch: {}
    });
</script>

<style>

</style>