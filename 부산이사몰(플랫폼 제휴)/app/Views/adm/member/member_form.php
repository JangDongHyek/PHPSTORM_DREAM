<!--회원 상세/등록-->
<section class="from">
    <form name="signup" autocomplete="off">
        <div>
            <button type="button" class="btn btn_small btn_line" onclick="history.back()">목록</button>
            <button type="submit" class="btn btn_small btn_color">등록 완료</button>
        </div>
        <div id="user_form">
            <input type="hidden" id="mb_level" name="mb_level" value="<?=$lv ?? ''?>">
            <input type="hidden" id="idxNumber" name="idx" value="<?=$member['idx'] ?? ''?>">

            <?php if (($lv ?? '')=== '2'):?>
                <!--일반회원-->
                <div class="box_gray" id="generalMemberForm">
                    <div class="grid grid2">
                        <dl class="form_wrap">
                            <dt><label for="mb_id">아이디</label></dt>
                            <dd><input type="text" name="mb_id" id="mb_id" value="<?=$member['mb_id'] ?? ''?>" placeholder="아이디" <?=!empty($member)? 'readonly' : '' ?> /></dd>
                            <dt><label for="mb_password">비밀번호</label></dt>
                            <dd><input type="password" name="mb_password" id="mb_password" placeholder="비밀번호"/></dd>
                        </dl>
                        <dl class="form_wrap">
                            <dt><label for="mb_name">이름</label></dt>
                            <dd><input type="text" name="mb_name" id="mb_name" value="<?=$member['mb_name'] ?? ''?>" placeholder="이름"/></dd>
                            <dt><label for="mb_hp">연락처</label></dt>
                            <dd><input type="text" name="mb_hp" id="mb_hp" value="<?=addHyphenContact($member['mb_hp'] ?? '')?>" placeholder="연락처" data-format="tel"/></dd>
                            <!--<dt><label for="">이메일</label></dt>
                            <dd><input type="text" name="mb_email" id="mb_email" value="<?/*=$member['mb_email'] ?? ''*/?>" placeholder="이메일"/></dd>-->
                        </dl>
                    </div>
                </div>
                <!--//일반회원-->
                <br>

            <?php elseif (($lv ?? '') === '5' || ($lv ?? '') === '8'):?>
                <!--사업자회원-->
                <div class="box_gray" id="businessMemberForm">
                    <div class="grid grid2">
                        <dl class="form_wrap">
                            <dt><label for="company_name"><?= $lv === '5' ? '회사명' : '부동산명' ?></label></dt>
                            <dd><input type="text" name="company_name" id="company_name" value="<?=$member['company_name'] ?? ''?>" placeholder="<?= $lv === '5' ? '회사명' : '부동산명' ?>"/></dd>
                            <dt><label for="mb_id">아이디</label></dt>
                            <dd><input type="text" name="mb_id" id="mb_id" value="<?=$member['mb_id'] ?? ''?>" placeholder="아이디" <?= isset($member['mb_id']) && $member['mb_id'] !== '' ? 'readonly' : '' ?> /></dd>
                            <dt><label for="mb_password">비밀번호</label></dt>
                            <dd><input type="password" name="mb_password" id="mb_password" placeholder="비밀번호"/></dd>
                        </dl>
                        <dl class="form_wrap">
                            <dt><label for="mb_name">대표자명</label></dt>
                            <dd><input type="text" name="mb_name" id="mb_name" value="<?=$member['mb_name'] ?? ''?>" placeholder="대표자명"/></dd>
                            <dt><label for="biz_no">사업자등록번호</label></dt>
                            <dd><input type="text" name="biz_no" id="biz_no" value="<?=$member['biz_no'] ?? ''?>" placeholder="사업자등록번호" data-format="business"/></dd>
                            <dt><label for="mb_hp">담당자 연락처</label></dt>
                            <dd><input type="text" name="mb_hp" id="mb_hp" value="<?=addHyphenContact($member['mb_hp'] ?? '')?>" placeholder="담당자 연락처" data-format="tel"/></dd>
                          <!--  <dt><label for="mb_email">이메일</label></dt>
                            <dd><input type="text" name="mb_email" id="mb_email" value="<?/*=$member['mb_email'] ?? ''*/?>" placeholder="이메일"/></dd>-->

                        </dl>
                    </div>
                </div>
                <!--사업자회원 보유 업체리스트-->
                <?php if (($lv ?? '') === '5' ):?>
                    <hr>
                    <div class="flex ai-c jc-sb">

                        <h4>광고 현황</h4>
                        <div>
                            <button type="button" class="btn btn_gray" id="delCompany" onclick="">삭제</button>
                            <button type="button" class="btn btn_color" id="btnRegCompany">업체 등록</button>
                        </div>
                    </div>
                    <div class="table">
                        <table>
                            <colgroup>
                                <col width="5%">
                                <col width="*">
                                <col width="*">
                                <col width="10%">
                                <!--<col width="*">-->
                                <col width="*">
                                <col width="10%">
                                <col width="*">
                                <col width="10%">
                                <!--<col width="10%">-->
                                <col width="5%">
                                <col width="5%">
                            </colgroup>
                            <thead>
                            <tr>
                                <th><input type="checkbox" id="checkAll"/></th>
                                <th>노출위치</th>
                                <th>업체명</th>
                                <th>지역</th>
                                <!--<th>주소</th>-->
                                <th>연락처</th>
                                <th>관허</th>
                                <th>서비스</th>
                                <th>등록일</th>
                                <!--<th>광고여부</th>-->
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php if (empty($company_list)) :?>
                                <tr>
                                    <td colspan="10">등록된 업체가 없습니다.</td>
                                </tr>
                            <?php else:
                                foreach ($company_list as $list):
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
                                        <td><?=$list['company_name']?></td>
                                        <td><?=$list['area_si']?> > <?=$list['area_gu']?></td>
                                        <!--<td>[<?/*=$list['zip_code']*/?>] <?/*=$list['addr']*/?> <?/*=$list['addr_detail']*/?></td>-->
                                        <td><?=$list['cp_tel']?></td>
                                        <td><?=$list['grant']?></td>
                                        <td> <?=implode(', ', $services)?></td>
                                        <td><?=replaceDateFormat($list['created_at'])?></td>
                                        <!--<td>-</td>-->
                                        <td><button class="btn btn_line" id="updateCompany" data-idx="<?=$list['idx']?>">수정</button></td>
                                        <td><button type="button" class="btn btn_line" id="addition" data-idx="<?=$list['idx']?>" data-mbid="<?=$member['idx'] ?? 0?>">복사</button></td>
                                    </tr>
                                <?php endforeach;
                            endif;
                            ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif;?>
                <!--//사업자회원-->
            <?php endif;?>
        </div>
    </form>

</section>
<script src="<?= base_url()?>js/adm/member.js?<?=JS_VER?>"></script>
<script src="<?= base_url()?>js/common/user_validator.js?<?=JS_VER?>"></script>
