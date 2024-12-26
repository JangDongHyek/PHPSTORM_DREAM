<!--이사업체 관리-->
<section class="company">
    <div class="panel flex ai-c jc-sb">
        <div class="flex">
            <p class="total">총 <strong class="txt_color"><?=$paging['totalCount'] ?? 0?> </strong>개 </p>
            <div class="flex ai-c">
                <!--<div class="select">
                    <input type="radio" id="all" name="ad-status" class="ad-status" value="0" checked>
                    <label for="all">전체</label>
                    <input type="radio" id="progress" name="ad-status" class="ad-status" value="1">
                    <label for="progress">광고진행중</label>
                    <input type="radio" id="completed" name="ad-status" class="ad-status" value="2">
                    <label for="completed">광고완료</label>
                </div>-->

                <form name="searchFrm" class="flex" autocomplete="off">
                    <span class="select">
                            <?php
                            $dateRange = ['0'=>'전체', '1'=>'일반', '2'=>'프리미엄', '3'=>'메인 상단', '4'=>'메인 하단'];
                            foreach ($dateRange as $key=>$val):
                                $checked = ($_REQUEST['dtRange'] == $key) || (!$_REQUEST['dtRange'] && $key == 0)? "checked" : "";
                                $id = "dtr{$key}";
                                ?>
                                <input type="radio" id="<?=$id?>" name="dtRange" class="red" value="<?=$key?>" <?=$checked?>/><!--
                            --><label for="<?=$id?>"><?=$val?></label>
                            <?php endforeach;?>
                        </span>
                    <div class="search_wrap">
                        <select id="" name="sfl">
                            <option value="companyName" <?= $param['sfl'] === 'companyName'? 'selected' : ''?>>업체명</option>
                            <option value="addr" <?= $param['sfl'] === 'addr'? 'selected' : ''?>>주소</option>
                            <option value="cpTel" <?= $param['sfl'] === 'cpTel'? 'selected' : ''?>>전화번호</option>
                            <option value="district" <?= $param['sfl'] === 'district'? 'selected' : ''?>>지역구</option>
                        </select>
                        <div class="search">
                            <input type="search" name="stx" id="search_value2" placeholder="검색어 입력" value="<?=$param['stx'] ?? ''?>" keyEvent.enter="onSearch">
                            <button type="button" class="btn_search"><i class="fa-regular fa-magnifying-glass"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!--<div>
            <button type="button" class="btn btn_gray" onclick="">삭제</button>
            <button type="button" class="btn btn_color" onclick="location.href='./companyForm'">업체 등록</button>
        </div>-->
        <div class="btn_wrap">
            <button type="button" class="btn btn_gray" id="delCompany" >삭제</button>
        </div>
    </div>

    <div class="table">
        <table>
            <colgroup>
                <col width="5%">
                <col width="*">
                <col width="*">
                <col width="*">
                <col width="*">
                <!--<col width="10%">-->
                <col width="*">
                <col width="*">
                <col width="10%">
                <col width="*">
                <col width="10%">
                <!--<col width="10%">-->
                <col width="5%">
            </colgroup>
            <thead>
            <tr>
                <th><input type="checkbox" id="checkAll" /></th>
                <th>노출위치</th>
                <th>회사명</th>
                <th>아이디</th>
                <th>업체명</th>
                <th>지역</th>
                <!--<th>주소</th>-->
                <th>연락처</th>
                <th>관허</th>
                <th>서비스</th>
                <th>등록일</th>
                <!--<th>광고여부</th>-->
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php if(empty($listData)):?>
            <tr>
                <td colspan="10" class="text-center empty">내역이 없습니다.</td>
            </tr>
            <?php else:
                foreach ($listData as $list):
                    $serviceTypes = explode(',', $list['service_type']);
                    $services = []; // 서비스 유형을 저장할 배열
                    foreach (SERVICE_TYPE as $key => $value) {
                        if (in_array($key, $serviceTypes)) {
                            $services[] = $value; // 해당하는 서비스 이름을 추가
                        }
                    }

            ?>
            <tr>
                <td><input type="checkbox" name="check" value="<?=$list['idx']?>" /></td>
                <td><?=CP_TYPE[$list['cp_type']]?></td>
                <td><?=$list['mb_company']?></td>
                <td><?=getIdView($list['mb_id'], $list['sns_type'])?></td>
                <td><?=$list['company_name']?></td>
                <td><?=$list['area_si']?> > <?=$list['area_gu']?></td>
               <!-- <td>[<?/*=$list['zip_code']*/?>] <?/*=$list['addr']*/?></td>-->
                <td><?=addHyphenContact050($list['cp_tel'])?></td>
                <td><?=$list['grant']?></td>
                <td>
                    <?=implode(', ', $services)?>
                </td>
                <td><?=replaceDateFormat($list['created_at'],0,10)?></td>
                <!--<td>-</td>-->
                <td>
                    <p class="flex">
                    <button class="btn btn_line" onclick="location.href='./companyForm/<?=$list['mb_idx']?>?idx=<?=$list['idx']?>'">수정</button>
                    <button class="btn btn_line" data-idx="<?=$list['idx']?>">복사</button>
                    </p>
                </td>
            </tr>
            <?php endforeach;
            endif;
            ?>
            </tbody>
        </table>
    </div>
    <?php include_once APPPATH."Views/component/pagination.php" // 페이징 ?>
</section>
<script src="<?= base_url()?>js/adm/company.js?<?=JS_VER?>"></script>