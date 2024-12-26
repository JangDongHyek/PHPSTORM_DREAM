<!--회원 관리-->
<section class="list_table">
    <div id="search_form">
        <div class="panel flex ai-c jc-sb">
            <div class="flex ai-c">
                <p class="total">총 <strong class="txt_color"><?=$paging['totalCount'] ?? 0?></strong> 건</p>
                <form name="searchFrm" class="flex" autocomplete="off">
                    <div class="panel_box">
                        <div class="select">
                            <input type="radio" name="type" value="all" id="allMember" <?= $param['type'] === 'all' ? 'checked' : '' ?>  />
                            <label for="allMember">전체</label>
                            <input type="radio" name="type" value="2" id="generalMember" <?= $param['type'] ==='2'? 'checked': '' ?>/>
                            <label for="generalMember">일반회원</label>
                            <input type="radio" name="type" value="5" id="businessMember" <?= $param['type'] ==='5'? 'checked': '' ?>/>
                            <label for="businessMember">사업자회원</label>
                            <?php if($_SERVER['REMOTE_ADDR'] == "59.19.201.109" || $_SERVER['REMOTE_ADDR'] == "121.140.204.65"){ ?>
                                <input type="radio" name="type" value="8" id="realtorMember" <?= $param['type'] ==='8'? 'checked': '' ?>/>
                                <label for="realtorMember">부동산회원</label>
                            <?php }?>
                        </div>
                        <select name="state">
                            <option value="">상태 전체</option>
                            <option value="N" <?= $param['state'] === 'N'? 'selected' : ''?>>정상</option>
                            <option value="W" <?= $param['state'] === 'W'? 'selected' : ''?>>승인대기</option>
                            <option value="H" <?= $param['state'] === 'H'? 'selected' : ''?>>보류</option>
                            <option value="S" <?= $param['state'] === 'S'? 'selected' : ''?>>탈퇴</option>
                        </select>
                    </div>
                    <div class="search_wrap">
                        <select name="sfl">
                            <option value="mbId" <?= $param['sfl'] === 'mbId'? 'selected' : ''?>>아이디</option>
                            <option value="mbName" <?= $param['sfl'] === 'mbName'? 'selected' : ''?>>이름</option>
                            <option value="companyName" <?= $param['sfl'] === 'companyName'? 'selected' : ''?>>회사명</option>
                        </select>
                        <div class="search">
                            <input type="search" name="stx" id="search_value2" placeholder="검색어 입력" value="<?=$param['stx'] ?? ''?>" keyEvent.enter="onSearch">
                            <button type="submit" class="btn_search"><i class="fa-regular fa-magnifying-glass"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="btn_wrap">
                <!--<button type="button" id="changeState" class="btn btn_line" >사업자 문자 발송</button>-->
                <button type="button" id="changeState" class="btn btn_colorline" >선택 승인</button>
                <!--<button type="button" class="btn btn_gray" >선택 승인 취소</button>-->
                <button type="button" class="btn btn_color" onclick="location.href='./memberForm?lv=2'">일반회원 등록</button>
                <button type="button" class="btn btn_color" onclick="location.href='./memberForm?lv=5'">사업자 등록</button>
                <?php if($_SERVER['REMOTE_ADDR'] == "59.19.201.109" || $_SERVER['REMOTE_ADDR'] == "121.140.204.65"){ ?>
                    <button type="button" class="btn btn_color" onclick="location.href='./memberForm?lv=8'">부동산 등록</button>
                <?php }?>

            </div>
        </div>
    </div>
    <div class="table">
        <table>
            <colgroup>
                <col width="20px">
                <col width="auto">
                <col width="auto">
                <col width="auto">
                <? if ($param['type'] !== '2'):?>
                <col width="auto">
                <col width="auto">
                <? endif;?>
                <col width="auto">
                <col width="auto">
                <col width="auto">
                <col width="auto">
                <col width="auto">
            </colgroup>
            <thead>
            <tr>
                <th><input type="checkbox" id="checkAll"/></th>
                <th class="text-center">구분</th>
                <th class="text-center">가입경로</th>
                <th>아이디</th>
                <th class="text-center">이름(대표자명)</th>
                <? if ($param['type'] !== '2'):?>
                <th class="text-center">회사명</th>
                <th class="text-center">사업자번호</th>
                <? endif;?>
                <th class="text-center">연락처(담당자)</th>
                <!--<th class="text-center">이메일</th>-->
                <th class="text-center">승인상태</th>
                <th class="text-center">가입일</th>
                <th class="text-center">관리</th>
            </tr>
            </thead>
            <tbody>
                <?php if (empty($listData)):?>
                <tr><td colspan="12" class="text-center empty">내역이 없습니다.</td></tr>
                <?php else:
                foreach ($listData as $list):
                    ?>
                    <tr>
                        <td><input type="checkbox" name="check" value="<?=$list['idx']?>"/></td>
                        <td><?=MB_LEVEL[$list['mb_level']] ?></td>
                        <td><?=SNS_TYPE[$list['sns_type']]?></td>
                        <td><?=getIdView($list['mb_id'], $list['sns_type'])?></td>
                        <td><?=$list['mb_name']?></td>
                        <? if ($param['type'] !== '2'):?>
                            <td><?=$list['company_name']?></td>
                            <td><?=$list['biz_no']?></td>
                        <? endif;?>
                        <td><?=addHyphenContact($list['mb_hp'])?></td>
                        <!--<td><?/*=$list['mb_email']*/?></td>-->

                        <td><?=STATE[$list['state']]?></td>
                        <td><?=replaceDateFormat($list['created_at'],0,10)?></td>
                        <td>
                            <button class="btn btn_line" onclick="location.href='./memberForm/<?=$list['idx']?>?lv=<?=$list['mb_level']?>'">
                                관리
                            </button>
                        </td>
                    </tr>
                <?php endforeach;
                endif; ?>
            </tbody>
        </table>
    </div>
    <?php include_once APPPATH."Views/component/pagination.php" // 페이징 ?>

</section>

<script src="<?= base_url()?>js/adm/member_list.js?<?=JS_VER?>"></script>
