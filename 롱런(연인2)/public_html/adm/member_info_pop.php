<table class="tbl_match">
<caption>회원정보</caption>
<thead>
<tr>
	<th colspan="4">회원정보</th>
</tr>
</thead>
<tbody>
<tr>
	<th>이름</th>
	<td><?=$mb_name?></td>
	<th>성별</th>
	<td>
        <span><?=$mb_sex?></span>
        <?if ($mb_sex == "남" && isset($coupon_cnt)) { ?>
            (쿠폰:<?=$coupon_cnt?> /하트:<?=$heart_cnt?>)
        <?}?>
    </td>
</tr>
<tr>
	<th>나이</th>
	<td><?=$mb_age?></td>
	<th>연락처</th>
	<td><?=$mb_hp?></td>
</tr>
<tr>
	<th>지역</th>
	<td><?=$mb_si?></td>
	<th>상세지역</th>
	<td><?=$mb_gu?></td>
</tr>
</tbody>
</table>