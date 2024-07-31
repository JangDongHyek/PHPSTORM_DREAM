<div id="Declare_Modal" class="modal" >
    <!-- Modal content -->
    <div class="modal-content">
        <h1 align="center" class="modal-title">게시판 신고하기<span class="close" onclick="modal_action('Declare');">×</span></h1>

        <table id="modal-tb">
            <tbody>
                <tr>
                    <td>
                        <span >신고내용</span>
                    </td>
                    <td>
                        <ul >
                            <? foreach($declare_list AS $key => $val){ ?>
                            <li>
                                <input type="radio" name="declare_chk" id="de_<?=$key?>" value="<?=$key?>">
                                <label for="de_<?=$key?>"><?=$val?></label>
                            </li>
                            <? } ?>
                        </ul>
                        <div>
                            <input type="hidden" id="declare_mb_id" value="<?=$member['mb_id']?>"/>
                            <textarea rows="4" class="dec_tb_content" name="declare_content"></textarea>
                        </div>
                    </td>
                </tr>

            </tbody>
        </table>

        <div class="fact_frm-chk">
            <button type="button" class="btn btn-outline-secondary" style="background:white;border:1px solid #eee; " onclick="modal_action('Declare');">취소</button>
            <button type="button" class="btn btn-primary" id="modal_btn" onclick="declare_action()" data-wr_id="" >신고하기</button>
        </div>
    </div>
</div>