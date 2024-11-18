<table border="1">
        <caption><?php echo $board['bo_subject'] ?> 목록</caption>
        <colgroup>
            <?php if ($is_checkbox) { ?>
            <col class="td_chk" width="5%">
            <?php } ?>
            <col class="td_subject" width="15%">
            <col class="td_location">
            <col class="td_tel" width="15%">
            <col class="td_view" width="10%">
        </colgroup>
        <thead class="hidden-xs">
        <tr>
            <th>매장명</th>
			<th>주소</th>
			<th>전화번호</th>
			<th>주차여부</th>
			<th>지점소개</th>
            
        </tr>
        </thead>
        <tbody>
        <?php
        for ($i=0; $i<count($list); $i++) {
         ?>
        <tr class="<?php if ($list[$i]['is_notice']) echo "bo_notice"; ?>">
           
            <td class="td_subject">
				<!-- 매장명 -->
                
                    <?php echo $list[$i]['subject'] ?>
                
                
                
            </td>
			<td class="td_location">
				<!-- 주소 -->
				<?php echo $list[$i]['wr_1'] ?> <?php echo $list[$i]['wr_2'] ?>
			</td>
			<td><span class="call_btn"><i class="fa fa-phone"></i> <?php echo $list[$i]['wr_3'] ?></span></td>
			<td><span class="call_btn"><i class="fa fa-phone"></i> <?php echo $list[$i]['wr_4'] ?></span></td>
			<td><?=strip_tags($list[$i]['wr_content'])?></td>
		</tr>			
            
        <?php } ?>
        <?php if (count($list) == 0) { echo '<tr><td colspan="5" class="empty_table">가맹점이 없습니다.</td></tr>'; } ?>
        </tbody>
        </table>