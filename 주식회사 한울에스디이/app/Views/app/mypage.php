<!-- 내 정보 관리-->
</div>
<?php if($user) {?>
<section class="">
    <button type="button" class="btn btn-blue">수정 완료</button>
    <div class="box-gray">
        <div class="form_wrap grid grid2">
            <div>
                <label for="">아이디</label>
                <input type="text" value="<?=$user['user_id']?>" placeholder="아이디" readonly/>
                <label for="">비밀번호</label>
                <input type="password" name="" id="" placeholder="비밀번호"/>
                <label for="">비밀번호 확인</label>
                <input type="password" name="" id="" placeholder="비밀번호 확인"/>
                <p class="flex ai-c">
                    <select>
                        <option>소속부서</option>
                    </select>
                    <select>
                        <option>직급</option>
                    </select>
                </p>
            </div>
            <div>
                <label for="">이름</label>
                <input type="text" name="" id="" placeholder="이름"/>
                <label for="">연락처</label>
                <input type="tel" name="" id="" placeholder="연락처"/>
            </div>
        </div>
    </div>
</section>
<?}else {?>
  <h1>잘못된 접근입니다 로그인을 진행해주세요.</h1>
<?}?>
