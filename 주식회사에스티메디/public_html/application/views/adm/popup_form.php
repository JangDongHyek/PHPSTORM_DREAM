<!--관리자 팝업관리 등록/수정-->
<section class="popupupd">
    <form name="popup" autocomplete="off">
        <input type="hidden" name="idx" value="<?=$viewData['idx']?>"/>

        <div class="panel">
            <label class="title">팝업제목</label>
            <input type="text" name="title" placeholder="팝업제목을 입력하세요" class="title" required maxlength="30" value="<?=$viewData['title']?>"/>
            <span>
                <button type="button" class="btn btn_gray" onclick="history.back()">목록</button>
                <button type="submit" class="btn btn_blue"><?=empty($viewData['idx'])?'등록':'수정'?></button>
            </span>
        </div>
        <div class="box">
            <input type="hidden" name="target" value="C">

            <p class="name">시간</p>
            <p class="line">
                <label>다시 보지 않음 시간 설정</label><input type="number" name="hideHour" value="<?=$viewData['hide_duration_hour']??24?>" required />시간
            </p>
            <p class="name">팝업위치</p>
            <p class="line">
                <label>선택</label>
                <select name="position">
                    <option value="0" <?=$viewData['display_position']=="0"?"selected":"";?>>로그인 전</option>
                    <option value="1" <?=$viewData['display_position']=="1"?"selected":"";?>>로그인 후</option>
                    <option value="2" <?=$viewData['display_position']=="1"?"selected":"";?>>로그인 전/후</option>
                </select>
            </p><p class="name">시작/종료 일시</p>
            <p class="line date">
                <label>시작일</label>
                <?
                $expDate = $viewData['start_date']!=''? explode(" ", $viewData['start_date']) : [];
                $expTime = $expDate[1]!=''? explode(":", $expDate[1]) : [];
                ?>
                <input type="date" name="startDate" value="<?=$expDate[0]?>" required/>
                <select name="startHour">
                <?
                    for($i=0; $i<24; $i++){
                        $pad = str_pad($i, 2, '0', STR_PAD_LEFT);
                        $selected = $pad=='00' || $pad==$expTime[0]? 'selected':'';
                    ?>
                    <option value="<?=$pad?>" <?=$selected?>><?=$pad?></option>
                    <?}?>
                </select>
                <span>:</span>
                <select name="startMin">
                    <?
                    for($i=0; $i<60; $i++){
                        $pad = str_pad($i, 2, '0', STR_PAD_LEFT);
                        $selected = $pad=='00' || $pad==$expTime[1]? 'selected':'';
                        ?>
                        <option value="<?=$pad?>" <?=$selected?>><?=$pad?></option>
                    <?}?>
                </select>
            </p>
            <p class="line date">
                <label>종료일</label>
                <?
                $expDate = $viewData['end_date']!=''? explode(" ", $viewData['end_date']) : [];
                $expTime = $expDate[1]!=''? explode(":", $expDate[1]) : [];
                ?>
                <input type="date" name="endDate" value="<?=$expDate[0]?>" required/>
                <select name="endHour">
                    <?
                    for($i=0; $i<24; $i++){
                        $pad = str_pad($i, 2, '0', STR_PAD_LEFT);
                        $selected = $pad=='23' || $pad==$expTime[0]? 'selected':'';
                    ?>
                        <option value="<?=$pad?>" <?=$selected?>><?=$pad?></option>
                    <?}?>
                </select>
                <span>:</span>
                <select name="endMin">
                    <?
                    for($i=0; $i<60; $i++){
                        $pad = str_pad($i, 2, '0', STR_PAD_LEFT);
                        $selected = $pad=='59' || $pad==$expTime[1]? 'selected':'';
                    ?>
                        <option value="<?=$pad?>" <?=$selected?>><?=$pad?></option>
                    <?}?>
                </select>
            </p>
            <p class="name">팝업 위치</p>
            <p class="line"><label>왼쪽 여백</label><input type="text" name="layerLeft" value="<?=$viewData['layer_left']??10?>" />px</p>
            <p class="line"><label>상단 여백</label><input type="text" name="layerTop" value="<?=$viewData['layer_top']??10?>" />px</p>
            <p class="name">팝업 이미지</p>
            <dl class="file_wrap">
                <dd>
                    <button type="button" class="btn btn_black" onclick="addImage()">이미지 첨부</button>
                    <div class="img_prev">
                        <?
                        // 이미지 미리보기
                        if ($viewData['file_nm'] != '') {
                            $imgPath = UPLOAD_FOLDERS['POPUP'] . $viewData['file_nm'];
                            $imgSrc = ASSETS_URL.'/'.uploadFileRemoveServerPath($imgPath);
                        ?>
                            <img src="<?=$imgSrc?>">
                            <button type="button" class="btn btn_whiteline" onclick="deleteFile()">삭제</button>
                        <? } else { ?>
                            <img src="">
                        <? } ?>
                    </div>
                </dd>
            </dl>
            <!-- file upload hidden -->
            <div class="hide">
                <input type="file" name="file1" onchange="fileUpload(this)" accept="image/*">
                <input type="hidden" name="fileName" value="<?=$viewData['file_nm']??''?>" />
            </div>
        </div>
    </form>
</section>

<script>
    const form = document.popup;
    const gubun = form.idx.value ? '수정' : '등록';

    // 공지 등록/수정
    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        if (form.fileName.value == '') {
            return showAlert('팝업 이미지를 첨부해 주세요.');
        }

        const confirmResult = await showConfirm(`팝업을 ${gubun}하시겠습니까?`);
        if (confirmResult.isConfirmed !== true) return false;

        const formData = new FormData(form);
        const response = await fetchData('/apiAdmin/registerPopup', formData);
        if (response.result) {
            let message = `${gubun}이 완료되었습니다.`;
            showAlert(`${message}`, () => { location.replace(`${baseUrl}adm/popup`); });
        } else {
            let message = response.message ? response.message : `${gubun}에 실패했습니다.`;
            showAlert(message);
        }

    });


    // 첨부파일업로드
    const addImage = () => {
        document.querySelector('input[name=file1]').click();
    }
    // 업로드 처리
    const fileUpload = async (input) => {
        const file = input.files[0];
        if (file == undefined || !file) return;
        // const originFileName = file.name;

        // 최대용량체크
        const maxSizeMB = 8; // 8mb
        const maxByte = maxSizeMB * 1024 * 1024;
        const fileByte = file.size;

        if (fileByte > maxByte) {
            showAlert(`${maxSizeMB}MB 이하 파일만 등록이 가능합니다.`);
            initFileHandler(input);
            return false;
        }

        // 확장자체크
        const fileType = file.name.split('.').pop().toLowerCase();
        const allowedTypes = ['jpg', 'jpeg', 'png'];

        if (!allowedTypes.includes(fileType)) {
            showAlert(`이미지 파일(jpg, jpeg, png)만 등록이 가능합니다.`);
            initFileHandler(input);
            return false;
        }

        const formData = new FormData();
        formData.append('uploaded_file', file);
        formData.append('target', 'POPUP');

        const prevWrap = document.querySelector('.img_prev');
        const response = await fetchData('/file/upload', formData);
        if (response.result) {
            // prevImg.src = response.source;
            form.fileName.value = response.filename;
            prevWrap.innerHTML = `<img src="<?=ASSETS_URL?>/uploads/popup/${response.filename}">
            <button type="button" class="btn btn_whiteline" onclick="deleteFile()">삭제</button>`;
        } else {
            let msg = `이미지 업로드에 실패했습니다.<br>다시 시도해 주세요.`;
            showAlert(msg);
            prevWrap.innerHTML = '';
            form.fileName.value = '';
        }

        input.value = ``;
    }

    // 삭제
    const deleteFile = async () => {
        const confirmResult = await showConfirm('이미지를 삭제하시겠습니까?');
        if (confirmResult.isConfirmed !== true) return false;

        document.querySelector('.img_prev').innerHTML = '';
        form.fileName.value = '';
    }
</script>
