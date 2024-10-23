<!--관리자 팝업관리-->
<section class="popup">
    <form name="searchFrm" autocomplete="off">
        <div class="panel">
            <p>총 <span class="green"><?=$paging['totalCount']?></span>개 </p>
            <div>
                <select name="sfl">
                    <option value="title" <?=$_GET['sfl']=='title'?'selected':''?>>제목</option>
                </select>
                <input class="search-bar" name="stx" type="search" value="<?=$_GET['stx']?>" placeholder="검색어를 입력하세요" />
                <button type="submit" class="btn_search"><i class="fa-light fa-magnifying-glass"></i></button>
            </div>
            <span>
                <button type="button" class="btn btn_black" onclick="commonActionDelete('/apiAdmin/deletePopup');">선택 삭제</button>
                <button type="button" class="btn btn_blue" onclick="location.href='<?=PROJECT_URL?>/adm/popupForm'">팝업 등록</button>
            </span>
        </div>
    </form>

    <div class="box3">
        <div class="table adm">
            <table>
                <colgroup>
                    <col width="20px">
                    <col width="30px">
                    <col width="100px">
                    <col width="*">
                    <col width="*">
                    <col width="*">
                    <col width="*">
                    <col width="*">
                    <col width="*">
                    <col width="*">
                    <col width="150px">
                </colgroup>
                <thead>
                <tr>
                    <th><input type="checkbox" onclick="selectAllCheckbox(this, 'checkIdx')"></th>
                    <th>No.</th>
                    <th>이미지</th>
                    <th>제목</th>
                    <th>시작일시</th>
                    <th>종료일시</th>
                    <th>팝업위치</th>
                    <th>시간</th>
                    <th>왼쪽 여백</th>
                    <th>상단 여백</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach($listData as $list) {
                    $imgPath = UPLOAD_FOLDERS['POPUP'] . $list['file_nm'];
                    $imgSrc = ASSETS_URL.'/'.uploadFileRemoveServerPath($imgPath);
                ?>
                <tr>
                    <td><input type="checkbox" name="checkIdx" value="<?=$list['idx']?>"/></td>
                    <td><?=$paging['listNo']?></td>
                    <td><div class="thumb_img"><img src="<?=$imgSrc?>"></div></td>
                    <td><?=$list['title']?></td>
                    <td><?=replaceDateFormat($list['start_date'], 14)?></td>
                    <td><?=replaceDateFormat($list['end_date'], 14)?></td>
                    <td><?=$list['display_position']=='0'?'<span class="txt_red">로그인 전</span>':'<span class="txt_blue">로그인 후</span>'?></td>
                    <td><?=$list['hide_duration_hour']?>시간</td>
                    <td><?=$list['layer_left']?>px</td>
                    <td><?=$list['layer_top']?>px</td>
                    <td>
                        <button type="button" class="btn btn_whiteline" onclick="location.href='<?=PROJECT_URL?>/adm/popupForm/<?=$list['idx']?>'">수정</button>
                        <button type="button" class="btn btn_redline" onclick="commonActionDelete('/apiAdmin/deletePopup', '<?=$list['idx']?>')">삭제</button>
                    </td>
                </tr>
                <?php
                    $paging['listNo']--;
                }
                if ($paging['totalCount'] == 0) { ?>
                <tr><td colspan="20" class="noDataAlign">등록된 팝업이 없습니다.</td></tr>
                <? } ?>
                </tbody>
            </table>
        </div>

        <? include_once VIEWPATH. 'component/pagination.php'; // 페이징?>
    </div>
</section>
