<?php
    $count_3 = 1;
?>
<?php foreach ($this->data['result'] as $row) : ?>
<div class="grid_print" style="<?=$count_3 % 3 == 0 ? "page-break-before:always" : ''?>">
    <div>결제완료일자 : <strong><?=$row['PayDate']?></strong></div>
    <table>
        <colgroup>
            <col width="164">
            <col width="">
            <col width="100">
            <col width="">
        </colgroup>
        <tbody>
        <tr>
            <th>사이트</th>
            <td>
                <?php if ($row['SiteType'] == 1): ?>
                    <div class="box__flag box__flag--auction"><span class="for-a11y">옥션</span></div>
                <?php else: ?>
                    <div class="box__flag box__flag--gmarket"><span class="for-a11y">G마켓</span></div>
                <?php endif ?>
            </td>
            <th>주문자</th>
            <td><?= $row['BuyerName'] ?></td>
        </tr>
        <tr>

            <th>주문번호 | 장바구니번호</th>
            <td><?= $row['OrderNo'] ?> | <?=$row['PayNo']?></td>
            <th>연락처1</th>
            <td><?=$row['BuyerMobileTel']?></td>
        </tr>
        <tr>
            <th>상품명</th>
            <td><?=$row['GoodsName']?></td>
            <th>연락처2</th>
            <td><?=$row['BuyerTel']?></td>
        </tr>
        <tr>
            <th>사은품</th>
            <td><?=$row['FreeGift']?></td>
            <th>수취인</th>
            <td><?=$row['ReceiverName']?></td>
        </tr>
        <tr>
            <th>주문수량</th>
            <td><?=$row['ContrAmount']?></td>
            <th>연락처1</th>
            <td><?=$row['BuyerMobileTel']?></td>
        </tr>
        <tr>
            <th>배송형태 | 배송구분</th>
            <td>선불 | 일반택배</td>
            <th>연락처2</th>
            <td><?=$row['BuyerTel']?></td>
        </tr>
        <tr>
            <th>주문옵션정보</th>
            <td colspan="3">
                <?php if($row['ItemOptionSelectList']): ?>
                    <?php $data2 = json_decode($row['ItemOptionSelectList']); ?>
                    <?php $data2_count = 1; ?>
                    <?php foreach ($data2 as $ItemOptionSelectList ): ?>
                        <?=$ItemOptionSelectList->ItemOptionValue ? ' '.$data2_count.'.'.$ItemOptionSelectList->ItemOptionValue.'/' : ''?>
                        <?=$ItemOptionSelectList->ItemOptionOrderCnt ? $ItemOptionSelectList->ItemOptionOrderCnt.'/' : ''?>
                        <?=$ItemOptionSelectList->ItemOptionCode ? $ItemOptionSelectList->ItemOptionCode : ''?>
                        <?='</br>'?>
                        <?php $data2_count++ ?>
                    <?php endforeach ?>
                <?php endif ?>
            </td>
        </tr>
        <tr>
            <th>추가구성정보</th>
            <td colspan="3">
                <?php if($row['ItemOptionAdditionList']): ?>
                    <?php $data3 = json_decode($row['ItemOptionAdditionList']); ?>
                    <?php $data3_count = 1; ?>
                    <?php foreach ($data3 as $ItemOptionAdditionList ): ?>
                        <?=$ItemOptionAdditionList->ItemOptionValue ? ' '.$data3_count.'.'.$ItemOptionAdditionList->ItemOptionValue.'/' : ''?>
                        <?=$ItemOptionAdditionList->ItemOptionOrderCnt ? $ItemOptionAdditionList->ItemOptionOrderCnt.'/' : ''?>
                        <?=$ItemOptionAdditionList->ItemOptionCode ? $ItemOptionAdditionList->ItemOptionCode : ''?>
                        <?='</br>'?>
                        <?php $data3_count++ ?>
                    <?php endforeach ?>
                <?php endif ?>
            </td>
        </tr>
        <tr>
            <th>배송요청사항</th>
            <td colspan="3"><?=$row['DelMemo']?></td>
        </tr>
        <tr>
            <th>배송희망일</th>
            <td colspan="3">????</td>
        </tr>
        <tr>
            <th>배송지주소</th>
            <td colspan="3">(<?=$row['ZipCode']?>)<?=$row['DelFullAddress']?></td>
        </tr>
        </tbody>
    </table>
    <br>
    <hr>
</div>
<?php
    $count_3++;
?>
<?endforeach;?>
<style>
    .grid_print {overflow-y: auto; margin-bottom: 20px; margin-top: 10px;}
    .grid_print table{ border-spacing:0; border-radius: 5px 5px 0 0}
    .grid_print table{border-top: 1px solid rgba(223, 203, 231, 0.56);}
    .grid_print th,
    .grid_print td{padding: 10px 7.5px;border-bottom: 1px solid #E6E6E6; border-right:1px solid #E6E6E6; background: #fff;}
    .grid_print th:first-of-type{ border-left:1px solid #E6E6E6;;}
    .grid_print td:first-of-type{ border-left:1px solid #E6E6E6;;}
    .grid_print th{font-weight: 600;font-size: 1em; border-bottom: 1px solid rgba(225, 225, 225, 0.56); color: #ffffff;background: #464646; white-space: nowrap}
    .grid_print tbody th{background: rgba(227, 227, 227, 0.34); border-bottom: 1px solid #E6E6E6; color: #000}
</style>