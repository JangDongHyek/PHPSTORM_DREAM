<?php include_once APPPATH."Views/component/summer_note_resource.php"; // summernote ?>
<!--이사업체등록-->
<section class="from">
    <form name="conform" autocomplete="off">
        <input name="mbidx" type="hidden" value="<?= $idx?>">
        <input type="hidden" id="area_gu" value="<?=$companyInfo['area_gu'] ?? '' ?>">
        <input type="hidden" id="idx" name="idx" value="<?=$companyInfo['idx'] ?? '' ?>">
        <div>
            <button type="button" class="btn btn_small btn_line" onclick="location.href='<?=base_url()?>adm/company'">목록</button>
            <button type="submit" class="btn btn_small btn_color">등록 완료</button>
        </div>
        <hr>
        <h4>업체 정보</h4>
        <div class="box_gray">
            <div class="grid grid2">
                <dl class="form_wrap">
                    <dt><label for="companyName">노출위치</label></dt>
                    <dd>
                        <select name="cpType">
                            <option value="1" <?=($companyInfo['cp_type'] ?? '') === '1' ? 'selected' : ''  ?>>일반</option>
                            <option value="2" <?=($companyInfo['cp_type'] ?? '') === '2' ? 'selected' : ''  ?>>프리미엄</option>
                            <option value="3" <?=($companyInfo['cp_type'] ?? '') === '3' ? 'selected' : ''  ?>>메인상단</option>
                            <option value="4" <?=($companyInfo['cp_type'] ?? '') === '4' ? 'selected' : ''  ?>>메인하단</option>
                        </select>
                    </dd>
                    <dt><label for="companyName">업체명</label></dt>
                    <dd><input type="text" name="companyName" id="companyName" value="<?=$companyInfo['company_name'] ?? ''?>" placeholder="업체명"/></dd>
                    <!--<dt><label for="addr">주소</label></dt>
                    <dd>
                        <input type="text" name="addr" id="addr" value="<?/*=$companyInfo['addr'] ?? ''*/?>" onkeyup="openDaumAddress()" onclick="openDaumAddress()" readonly placeholder="주소"/>
                        <input type="hidden" name="zcode" id="zcode" value="<?/*=$companyInfo['zip_code'] ?? ''*/?>">
                    </dd>
                    <dt><label for="addr">상세 주소</label></dt>
                    <dd><input type="text" name="addrDetail" id="addrDetail" value="<?/*=$companyInfo['addr_detail'] ?? ''*/?>" placeholder="상세 주소"/></dd>-->
                    <dt><label for="cpTel">연락처</label></dt>
                    <dd><input type="tel" name="cpTel" id="cpTel" value="<?=$companyInfo['cp_tel'] ?? ''?>" placeholder="연락처" data-format="tel050"/></dd>
                </dl>
                <dl class="form_wrap">
                    <dt><label for="">지역 선택</label></dt>
                    <dd class="flex">
                        <select name="areaSi" id="areaSi" >
                            <option value="부산" <?= $companyInfo['area_si'] == '부산' ? 'selected' : '' ?>>부산</option>
                            <option value="울산" <?= $companyInfo['area_si'] == '울산' ? 'selected' : '' ?>>울산</option>
                            <option value="경남" <?= $companyInfo['area_si'] == '경남' ? 'selected' : '' ?>>경남</option>
                        </select>
                        <select name="areaGu" id="areaGu">
                            <option value="">구/군</option>
                        </select>
                    </dd>
                    <dt><label for="grant">관허</label></dt>
                    <dd><input type="text" name="grant" id="grant" value="<?=$companyInfo['grant']?>" placeholder="관허"/></dd>
                    <dt><label for="">서비스 선택</label></dt>
                    <dd class="select">

                        <?php
                        $serviceTypes = explode(',', $companyInfo['service_type']);
                        foreach (SERVICE_TYPE as $key => $value) :
                            if ($key !== '') : ?>
                                <input type="checkbox" id="serviceType<?=$key?>" name="serviceType" value="<?=$key?>" <?= in_array($key, $serviceTypes) ? 'checked' : '' ?>/><label for="serviceType<?=$key?>"><?=$value?></label>
                            <?php endif;
                        endforeach; ?>
                    </dd>
                </dl>
            </div>
            <br>
            <dl class="form_wrap">
                <dt><label for="cpDesc">간단 설명</label></dt>
                <dd><textarea name="cpDesc" placeholder=""><?=$companyInfo['cp_desc']?></textarea></dd>
                <dt>
                    <label for="">메인 이미지 등록</label>
                    <p class="txt_color txt_down">※메인 이미지는 900X900사이즈를 권장합니다</p>
                </dt>
                <dd class="flex">
                    <!-- 메인 이미지 업로드 섹션 -->
                    <div class="col-lg-6">
                        <div class="flex ai-c gap5">
                            <label for="upload" class="btn btn_black">이미지 등록</label>
                            <!--<input type="file" name="mainImg" id="upload" style="display: none;" accept="image/*" onchange="handleFileSelect(event)">-->
                            <input type="file" name="mainImg" id="upload" style="display: none;" accept="image/*" onchange="handleFileSelect(event, 'main')">
                            <input type="hidden" name="nomainImg" value="<?= $companyInfo['main_img'] ?>">
                            <span id="file-name">메인 이미지를 선택하세요..</span>

                            <?php if ($companyInfo['main_img']) : ?>
                                <a class="btn btn_mini btn_line" id="delete-btn" onclick="deleteFile('main')">삭제</a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <!-- 숏츠 비디오 업로드 섹션 -->
                    <div class="col-lg-6">
                        <div class="flex ai-c gap5">
                            <label for="shortsUpload" class="btn btn_black">숏츠 등록</label>
                            <input type="file" name="shortsVideo" id="shortsUpload" style="display: none;" accept="image/*,video/mp4" onchange="handleFileSelect(event, 'shorts')">
                            <input type="hidden" name="noshortsVideo" value="<?= $companyInfo['shorts_video'] ?? '' ?>">
                            <span id="shorts-file-name">숏츠 이미지를 선택하거나 비디오를 선택하세요..</span>

                            <?php if (!empty($companyInfo['shorts_video'])) : ?>
                                <a class="btn btn_mini btn_line" id="shorts-delete-btn" onclick="deleteFile('shorts')">삭제</a>
                            <?php endif; ?>
                        </div>
                    </div>

                </dd>
                <dd class="flex">
                    <!-- 메인 이미지 미리보기 -->
                    <div class="col-lg-6">
                        <div id="preview-container" style="margin-top: 10px;">
                            <?php if (!empty($companyInfo['main_img'])) : ?>
                                <img src="<?= base_url('uploads/company/' . $companyInfo['main_img']) ?>" id="uploaded-image" alt="메인 이미지">
                            <?php endif; ?>
                        </div>
                    </div>
                    <!-- 숏츠 비디오 미리보기 -->
                    <div class="col-lg-6">
                        <div id="shorts-preview-container" style="margin-top: 10px;"></div>
                        <?php
                        $shortsVideoPath = FCPATH . 'uploads/company/' . $companyInfo['shorts_video']; // 실제 파일 경로
                        $shortsMime = mime_content_type($shortsVideoPath); // 파일의 MIME 타입 가져오기

                        if (strpos($shortsMime, 'image/') === 0): ?>
                            <img src="<?= base_url('uploads/company/' . $companyInfo['shorts_video']) ?>" id="shorts-uploaded-image" alt="숏츠 이미지">
                        <?php elseif ($shortsMime === 'video/mp4'): ?>
                            <video src="<?= base_url('uploads/company/' . $companyInfo['shorts_video']) ?>" id="shorts-uploaded-video" style="width: 500px; height: 500px;" controls></video>
                        <?php else: ?>
                            <p>지원되지 않는 파일 형식입니다.</p>
                        <?php endif; ?>
                    </div>
                </dd>
            </dl>
        </div>
        <hr>
        <h4>연결 주소</h4>
        <div class="box_gray">
            <div class="grid grid2">
                <dl class="form_wrap">
                    <dt><label for="hompageLink">홈페이지</label></dt>
                    <dd><input type="text" name="hompageLink" id="hompageLink" value="<?=$companyInfo['hompage_link']?>" placeholder="홈페이지 주소"/></dd>
                    <dt><label for="blogLink">블로그</label></dt>
                    <dd><input type="text" name="blogLink" id="blogLink" value="<?=$companyInfo['blog_link']?>" placeholder="블로그 주소"/></dd>
                    <dt><label for="instarLink">인스타그램</label></dt>
                    <dd><input type="text" name="instarLink" id="instarLink" value="<?=$companyInfo['instar_link']?>" placeholder="인스타그램 주소"/></dd>
                </dl>
                <dl class="form_wrap">
                    <dt><label for="youtubeLink">유튜브</label></dt>
                    <dd><input type="text" name="youtubeLink" id="youtubeLink" value="<?=$companyInfo['youtube_link']?>" placeholder="유튜브 주소"/></dd>
                    <dt><label for="tiktokLink">틱톡</label></dt>
                    <dd><input type="text" name="tiktokLink" id="tiktokLink" value="<?=$companyInfo['tiktok_link']?>" placeholder="틱톡 주소"/></dd>
                </dl>
            </div>
            <!--등록된 해당 링크만 상세 페이지에 아이콘이 추가됩니다.-->
        </div>
        <hr>
        <h4>서비스 설명</h4>
        <div class="box_gray">
            <div class="editor">
                <!--<textarea name="serviceDesc" placeholder="에디터 추가"></textarea>-->
                <div id="editor"></div>
                <textarea name="serviceDesc" class="hidden"><?=$companyInfo['service_desc']??''?></textarea>
            </div>
        </div>
    </form>
</section>
<?php /*include_once APPPATH."Views/component/daum_addr_popup.php" */?>
<script src="<?= base_url()?>js/adm/company_form.js?<?=JS_VER?>"></script>

<script>
    function handleFileSelect(event, type) {
        const file = event.target.files[0];
        let fileName, previewContainer;

        if (type === 'main') {
            fileName = document.getElementById('file-name');
            previewContainer = document.getElementById('preview-container');
        } else if (type === 'shorts') {
            fileName = document.getElementById('shorts-file-name');
            previewContainer = document.getElementById('shorts-preview-container');
        }

        // 미리보기 컨테이너 초기화
        previewContainer.innerHTML = '';

        if (file) {
            fileName.textContent = file.name;  // 선택된 파일명을 표시

            const fileURL = URL.createObjectURL(file);
            if (file.type.startsWith('video/')) {
                // 비디오인 경우
                const video = document.createElement('video');
                video.src = fileURL;
                video.controls = true; // 비디오 컨트롤 표시
                video.style.width = '500px'; // 비디오 너비 설정
                video.style.height = '500px'; // 비디오 높이 설정
                previewContainer.appendChild(video);
            } else if (file.type.startsWith('image/')) {
                // 이미지인 경우
                const img = document.createElement('img');
                img.src = fileURL;
                img.style.width = '!00%'; // 이미지 너비 설정

                previewContainer.appendChild(img);
            }
        }
    }

    function deleteFile(type) {
        let uploadInput, fileName, previewContainer;

        if (type === 'main') {
            uploadInput = document.getElementById('upload');
            fileName = document.getElementById('file-name');
            previewContainer = document.getElementById('preview-container');
        } else if (type === 'shorts') {
            uploadInput = document.getElementById('shortsUpload');
            fileName = document.getElementById('shorts-file-name');
            previewContainer = document.getElementById('shorts-preview-container');
        }

        // 선택된 파일 리셋
        uploadInput.value = '';
        fileName.textContent = type === 'main' ? '메인 이미지를 선택하세요..' : '숏츠 이미지를 선택하거나 비디오를 선택하세요..';  // 기본 메시지로 되돌림
        previewContainer.innerHTML = ''; // 미리보기 삭제
    }

    let fileNameSpan = document.querySelector("#file-name");

    if (<?= json_encode($companyInfo['main_img']) ?>) {
        fileNameSpan.textContent = "Existing image";
    } else {
        fileNameSpan.textContent = "메인 이미지를 선택하세요..";
    }

    // 수정시 바인딩]
    document.addEventListener('DOMContentLoaded', () => {
        $('#editor').summernote('code', document.querySelector('[name="serviceDesc"]').value);
    })

    // submit
    //document.querySelector('[name="serviceDesc"]').value = $('#editor').summernote('code');

    $('#editor').summernote(getSummerNoteSettings('editor', true, false, true));

</script>