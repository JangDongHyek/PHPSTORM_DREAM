<!--문자서비스-->
<style>
    .sendsms .thumb_img {
        margin-bottom: 5px;
        width: 50px;
        height: 50px;
        background-size: cover !important;
        background-position: center center !important;
        border: 1px solid #D9D9D9;
        border-radius: 5px;
    }
</style>
<section class="sms">
    <div class="panel">
        <span>
            <button type="button" class="btn btn_black" onclick="createPopup('/apiAdmin/baro/smsHistory', '문자전송내역', 1000, 900)">전송내역</button>
        </span>
    </div>
    <br>
    <div class="sendsms grid grid2">
        <div class="box who">
            <h3>수신번호 입력</h3>
            <div>한번에 최대 500건 까지 발송이 가능합니다.</div>
            <div class="flex jc-sb gap5">
                <input type="text" name="hp" placeholder="휴대폰 번호를 입력하세요" data-format="tel" autocomplete="off"/>
                <button class="btn btn_gray btn_h40 male-auto" type="button" onclick="addHp()">추가</button>
                <button class="btn btn_black btn_h40" type="button" onclick="openPhoneBook()">연락처 목록</button>
            </div>
            <div class="table">
                <table>
                    <thead>
                    <tr>
                        <th>휴대폰 번호</th>
                        <th>이름</th>
                        <th>삭제</th>
                    </tr>
                    </thead>
                    <tbody id="receiveList">
                    <!--수신번호 목록-->

                   <!-- <tr>
                        <td><input type="text" name="number[]" value="010-1234-1234" readonly=""></td>
                        <td><input type="text" name="cname[]" value="" readonly=""></td>
                        <td><button class="btn btn_colorline" type="button" onclick="deleteHp(this)">삭제</button></td>
                    </tr>-->
                    </tbody>
                </table>
            </div>
        </div>
        <div class="box_gray write">
            <h3>문자메시지 작성</h3>
            <div class="smscont">
                <div class="circle">
                    <input type="radio" id="sms" name="msgType" value="s" checked><label for="sms">단문(90byte)</label>
                    <input type="radio" id="mms" name="msgType" value="m"><label for="mms">장문/포토(2,000byte)</label>
                </div>
                <br>
                <textarea name="message" placeholder="메시지를 입력하세요" style="height: 260px;"></textarea>
                <p><span data-id="byte">0</span> bytes</p>

                <div id="photoWrap" class="hide">
                    <h6>사진 첨부</h6>
                    <p class="text-left">
                        ※ 사진용량 1MB 이하, 1280x1024 픽셀 이하의 JPG 파일로 제한됩니다.<br>
                        ※ <strong class="txt_red">MMS 발송시</strong> 많은 수신번호는 서버 속도 저하를 일으킬 수 있으니, <strong>수신번호를 최소화</strong>해 주세요.
                    </p>
                    <div class="thumb_img" id="mmsImgPrev" style="background-image: url(../img/common/noimg2.png)" onclick="removeMMS()"></div>
                    <dl class="file_wrap">
                        <label for="mmsImg" class="btn btn_line">MMS 사진 추가</label>
                        <input type="file" id="mmsImg" class="hide" accept="image/jpeg" onchange="handleMMSImage(this)"/>
                    </dl>
                </div>

                <div class="btn_wrap">
                    <button class="btn btn_color male-auto" type="button" onclick="handleMessage()" style="margin-right: 5px;">문자 보내기</button>
                    <button class="btn btn_black" type="button" onclick="location.reload()">전체 초기화</button>
                    <input type="hidden" name="amt" value="<?=$remainPrice??0?>"/>
                </div>

            </div>
        </div>
    </div>

    <br>
    <div>
        <h3>내역</h3>
        <div class="table">
            <table>
                <thead>
                <tr>
                    <th>No.</th>

                    <th>일자</th>
                    <th>내용</th>
                    <th>수신자</th>
                    <th>수신자 이름</th>
                </tr>
                </thead>
                <tbody>
                <?php if (empty($listData)): ?>
                    <tr><td colspan="6" class="noDataAlign">등록된 내역이 없습니다.</td></tr>
                <?php else:
                    foreach($listData as $list):
                        ?>
                        <tr>
                            <td><?=$paging['listNo']--?></td>
                            <td><?=replaceDateFormat($list['created_at'], 2,14)?></td>
                            <td><?=$list['content']?></td>
                            <td class="text_right txt_bold txt_blue">

                                <a href="#" data-code="<?=$list['fee_code']?>"><?=format_to_num($list['to_num'])?></a>
                            </td>
                            <td class="text_right txt_bold"><?=format_to_name($list['to_name'])?></td>
                        </tr>
                    <?php endforeach;
                endif; ?>
                </tbody>
            </table>
        </div>

        <?php include_once APPPATH."Views/component/pagination.php" // 페이징 ?>
    </div>

</section>

<script src="<?= base_url()?>js/adm/sms_service.js?<?=JS_VER?>"></script>
<?php include_once APPPATH."Views/modal/app/sms_recipient.php" ?>

<script>
    function openPhoneBook() {
        const width = 1000; // 창 너비
        const height = 600; // 창 높이
        const left = (window.screen.width / 2) - (width / 2); // 화면 중앙 정렬
        const top = (window.screen.height / 2) - (height / 2); // 화면 중앙 정렬

        window.open(
            '/adm/phoneBook',
            'phoneBookWindow',
            `width=${width},height=${height},top=${top},left=${left},resizable=yes,scrollbars=yes`
        );
    }
    /*
    function openPhoneBook() {
        createPopup(`/adm/phoneBook`, '연락처 목록', 800, 580);
    }
   */
</script>