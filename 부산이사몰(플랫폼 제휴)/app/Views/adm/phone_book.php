<!-- 연락처 관리 -->
<!--<style>
    #show-sidebar,
    .page-wrapper header,
    .page-wrapper.toggled .sidebar-wrapper,
    main footer{display: none!important;}
</style>-->
<section class="" style="padding: 25px">
    <h3>연락처 관리</h3>
    <form name="searchFrm" autocomplete="off">
        <div class="box_gray">
            <div class="flex ai-c jc-sb">
            <h4>연락처 추가</h4>
                <div class="text-right">
                    <input type="file" class="hidden" id="fileInput" onchange="commonExcelUpload(this)">
                    <button type="button" class="btn btn_colorline" id="uploadFile">
                        <i class="fa-solid fa-file-spreadsheet"></i> 엑셀업로드
                    </button>
                    <a href="/data/양식.xlsx" download="양식.xlsx" class="btn btn_black">양식다운</a>
                </div>
            </div>
            <div class="flex gap5">
                <input type="text" name="cname" value="" placeholder="이름 입력">
                <input type="text" name="number" value="" data-format="tel" placeholder="휴대폰번호 입력">
                <button type="submit" class="btn btn_small btn_color" onclick="">연락처 추가</button>
            </div>
        </div>
        <div class="panel">
            <p>총 <span class="red"><?=$paging['totalCount']?></span>개 </p>
            <div class="flex ai-c jc-sb">
                <div class="flex ai-c">
                    <select name="sfl">
                        <?php
                        $sflList = ['name' => '이름', 'mb_hp' => '휴대폰번호',];
                        foreach ($sflList as $key => $val):
                            ?>
                            <option value="<?=$key?>" <?=$_REQUEST['sfl'] == $key ? 'selected' : ''?>><?=$val?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="search">
                        <input class="search-bar" name="stx" type="search" value="<?=$_REQUEST['stx']?>" placeholder="검색어를 입력하세요"/>
                        <button type="submit" class="btn_search"><i class="fa-light fa-magnifying-glass"></i></button>
                    </div>
                    <div class="panel_box">
                        <div class="select">
                            <input type="radio" id="typeAll" name="telType" class="red" value="typeAll" checked/><!--
                                --><label for="typeAll">전체</label>
                            <input type="radio" id="type1" name="telType" class="red" value="type1"/><!--
                                --><label for="type1">이사업체</label>
                            <input type="radio" id="type2" name="telType" class="red" value="type2"/><!--
                                --><label for="type2">부동산</label>
                            <?/* 문자 서비스 팝업에서만 노출 */?>
                            <input type="radio" id="type3" name="telType" class="red" value="type3"/><!--
                                --><label for="type3">사업자회원</label>
                            <input type="radio" id="type3" name="telType" class="red" value="type3"/><!--
                                --><label for="type3">부동산회원</label>
                            <?/* 문자 서비스 팝업에서만 노출 */?>
                        </div>
                    </div>
                </div>
                <div>
                    <button type="button" class="btn btn_color" onclick="addReceivedNum()">수신번호 추가</button>
                </div>
            </div>
        </div>
    </form>
    <div class="table adm">
        <table>
            <colgroup>
                <col width="5%"/>
                <col width="5%"/>
                <col width=""/>
                <col width=""/>
            </colgroup>
            <thead>
            <tr>
                <th><input type="checkbox" onclick="utils.selectAllCheckbox(this, 'checkIdx')"/></th>
                <th>No.</th>
                <th>이름</th>
                <th>휴대폰번호</th>
            </tr>
            </thead>
            <tbody>
            <tbody>
            <?php if (empty($listData)): ?>
                <tr><td colspan="4" class="noDataAlign">등록된 연락처가 없습니다.</td></tr>
            <?php else:
                foreach($listData as $list):
                    $num = "{$list['mb_tel']}/{$list['mb_name']}";
                    ?>
                    <tr>
                        <td><input type="checkbox" name="checkIdx" value="<?=$num?>"/></td>
                        <td><?=$paging['listNo']--?></td>
                        <td><?=$list['mb_name']?></td>
                        <td><?=$list['mb_tel']?></td>
                    </tr>
                <?php endforeach;
            endif; ?>
            </tbody>
        </table>
    </div>

    <?php include_once APPPATH . "Views/component/pagination.php" // 페이징 ?>

</section>
<script src="<?= base_url()?>js/adm/phone_book.js?<?=JS_VER?>"></script>
<script>
    // 수신번호추가
    function addReceivedNum() {
        let data = [];
        const checkboxes = document.querySelectorAll('input[name="checkIdx"]:checked');
        checkboxes.forEach((checkbox) => {
            data.push(checkbox.value);
        });
        if (data.length == 0) return utils.showAlert("연락처를 선택해 주세요.");

        // opener 체크
        if (window.opener && typeof window.opener.addReceivedList === 'function') {
            window.opener.addReceivedList(data);
            self.close();
        } else {
            utils.showAlert('문자서비스 페이지가 올바르지 않습니다.', () => {
                self.close();
            });
        }
    }
</script>