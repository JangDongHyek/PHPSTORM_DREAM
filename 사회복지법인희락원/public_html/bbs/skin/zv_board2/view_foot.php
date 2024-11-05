</span> 
</td> 
</tr> 
</table> 
<?
if(!eregi("Zeroboard",$a_list)) $a_list = str_replace(">","><font class=z_list>",$a_list)."";
if(!eregi("Zeroboard",$a_reply)) $a_reply = str_replace(">","><font class=z_list>",$a_reply)."";
if(!eregi("Zeroboard",$a_modify)) $a_modify = str_replace(">","><font class=z_list>",$a_modify)."";
if(!eregi("Zeroboard",$a_delete)) $a_delete = str_replace(">","><font class=z_list>",$a_delete)."";
if(!eregi("Zeroboard",$a_write)) $a_write = str_replace(">","><font class=z_list>",$a_write)."";
if(!eregi("Zeroboard",$a_vote)) $a_vote = str_replace(">","><font class=z_list>",$a_vote)."";
?>
<img src=/images/t.gif border=0 height=5><br>
<table width=<?=$width?> cellspacing=0 cellpadding=0>
<tr>
 <td height=30>
    <?=$a_reply?>답글달기</a>
    <?=$a_modify?>수정하기</a>
    <?=$a_delete?>삭제하기</a>
    <?=$a_vote?>추천하기</a>
 </td>
 <td align=right>
    <?=$a_list?>목록보기</a>
    <?=$a_write?>글쓰기</a>
 </td>
</tr>
</table>

<br>
