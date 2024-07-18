
<!-- 회원가입약관 동의 시작 { -->
<div class="mbskin" style="">

<!--    <p>회원가입약관 및 개인정보처리방침안내의 내용에 동의하셔야 회원가입 하실 수 있습니다.</p>-->

    <section id="fregister_term" style="margin-bottom: 20px">
        <div style="float: left;padding: 10px 0;font-weight: bold;text-align: left;font-size: 1.2em;color: #777;">회원가입약관</div>
        <textarea style="height: 160px; width: 100%; resize:none; font-size:13px; border:1px solid #d1dee2; background-color:#fbfbfb; padding:10px" readonly><?php echo get_text($config['cf_stipulation']) ?></textarea>
        <fieldset class="fregister_agree">
            <label for="agree11">회원가입약관의 내용에 동의합니다.</label>
            <input type="checkbox" name="agree" value="1" id="agree11">
        </fieldset>
    </section>

    <section id="fregister_private" style="margin-bottom: 20px">
        <div style="float: left;padding: 10px 0;font-weight: bold;text-align: left;font-size: 1.2em;color: #777;">개인정보처리방침안내</div>
        <div class="tbl_head01 tbl_wrap">
            <table>
                <caption>개인정보처리방침안내</caption>
                <thead>
                <tr>
                    <th>목적</th>
                    <th>항목</th>
                    <th>보유기간</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td align="center">이용자 식별 및 본인여부 확인</td>
                    <td align="center">아이디, 이름, 비밀번호</td>
                    <td align="center">회원 탈퇴 시까지</td>
                </tr>
                <tr>
                    <td align="center">고객서비스 이용에 관한 통지,<br>
                  CS대응을 위한 이용자 식별</td>
                    <td align="center">연락처 (이메일, 휴대전화번호)</td>
                    <td align="center">회원 탈퇴 시까지</td>
                </tr>
                </tbody>
          </table>
        </div>

        <fieldset class="fregister_agree">
            <label for="agree21">개인정보처리방침안내의 내용에 동의합니다.</label>
            <input type="checkbox" name="agree2" value="1" id="agree21">
        </fieldset>
    </section>

<!--    <div class="btn_confirm">-->
<!--        <input type="submit" class="btn_submit" value="회원가입">-->
<!--    </div>-->


    <script>
    function fregister_submit(f)
    {
        if (!f.agree.checked) {
            alert("회원가입약관의 내용에 동의하셔야 회원가입 하실 수 있습니다.");
            f.agree.focus();
            return false;
        }

        if (!f.agree2.checked) {
            alert("개인정보처리방침안내의 내용에 동의하셔야 회원가입 하실 수 있습니다.");
            f.agree2.focus();
            return false;
        }

        return true;
    }
    </script>
</div>
<!-- } 회원가입 약관 동의 끝 -->