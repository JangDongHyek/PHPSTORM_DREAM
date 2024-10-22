<?
include_once("./_common.php");
$g5['title'] = '삼삼 CLASS';
$co_id = 'class';
include_once(G5_PATH.'/_head.php');
?>
    <div class="area_expert">
        <h2 class="title">삼삼CLASS 등록하기</h2>
        <div class="expert_form">
            <form>
                <div class="form_wrap">
                    <div class="form">
                        <dl>
                            <dt>타이틀 이미지 등록<strong class="sound_only">*</strong></dt>
                            <dd>
                                <div id="preview">
                                    <!--이미지 등록 전-->
                                    <label for="imageInput" id="uploadLabel"><i class="fa-light fa-camera"></i> 이미지 등록</label>
                                    <input type="file" id="imageInput" accept="image/*" multiple style="display: none;">
                                    <!--이미지 등록 후-->
                                    <div id="imageContainer"></div>
                                </div>
                            </dd>
                        </dl>
                        <dl>
                            <dt><label for="">분류<strong class="sound_only">*</strong></label></dt>
                            <dd><select>
                                    <option>경매기초학습</option>
                                </select>
                            </dd>
                        </dl>
                        <dl>
                            <dt><label for="">클래스명<strong class="sound_only">*</strong></label></dt>
                            <dd><input type="text" name="" value="" id="" maxlength="20"></dd>
                        </dl>
                        <dl>
                            <dt><label for="">신청기간<strong class="sound_only">*</strong></label></dt>
                            <dd class="flex"><input type="date" name="" value="" id="">&nbsp;~&nbsp;<input type="date" name="" value="" id=""></dd>
                        </dl>
                        <dl>
                            <dt><label for="">교육기간<strong class="sound_only">*</strong></label></dt>
                            <dd class="flex"><input type="date" name="" value="" id="">&nbsp;~&nbsp;<input type="date" name="" value="" id=""></dd>
                        </dl>
                        <dl>
                            <dt><label for="">클래스 소개<strong class="sound_only">*</strong></label></dt>
                            <dd><!--에디터--><textarea></textarea></dd>
                        </dl>
                        <dl>
                            <dt><label for="">커리큘럼<strong class="sound_only">*</strong></label></dt>
                            <dd><!--에디터--><textarea></textarea></dd>
                        </dl>

                    </div>
                </div>
                <div class="btn_confirm">
                    <input type="submit" value="클래스 등록" id="btn_submit" accesskey="s" class="btn_submit">
                    <a href="<?php echo  G5_BBS_URL?>/class.list.php" class="btn_cancel">취소</a>
                </div>
            </form>
        </div>
    </div>
<script>
    //메인 이미지 등록
    document.getElementById('imageInput').addEventListener('change', function(event) {
        const imageContainer = document.getElementById('imageContainer');
        const uploadLabel = document.getElementById('uploadLabel');
        imageContainer.innerHTML = ''; // Clear previous images
        const files = event.target.files;

        if (files.length > 0) {
            uploadLabel.style.display = 'none'; // Hide the upload label
        }

        Array.from(files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;

                // Add click event to change the image
                img.addEventListener('click', function() {
                    document.getElementById('imageInput').click();
                    document.getElementById('imageInput').onchange = function(event) {
                        const newFile = event.target.files[0];
                        if (newFile) {
                            const newReader = new FileReader();
                            newReader.onload = function(e) {
                                img.src = e.target.result;
                            }
                            newReader.readAsDataURL(newFile);
                        }
                    }
                });

                imageContainer.appendChild(img);
            }
            reader.readAsDataURL(file);
        });
    });


</script>


<?
include_once(G5_PATH.'/_tail.php');
?>