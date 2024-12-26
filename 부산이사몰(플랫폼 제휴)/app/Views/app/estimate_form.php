<section class="estimate">
    <form>
        <div class="box_gray">
            <div class="select">
                <input type="radio" name="moving_type" id="packaged_move" checked/>
                <label for="packaged_move">포장이사</label>

                <input type="radio" name="moving_type" id="semi_packaged_move"/>
                <label for="semi_packaged_move">반포장이사</label>

                <input type="radio" name="moving_type" id="general_move"/>
                <label for="general_move">일반이사</label>

                <input type="radio" name="moving_type" id="one_room_move"/>
                <label for="one_room_move">원룸이사</label>

                <input type="radio" name="moving_type" id="one_truck_move"/>
                <label for="one_truck_move">사다리차</label>
            </div>
            <br>
            <div>
                <dl class="form_wrap">
                    <dt><label for="">이사 예정일</label></dt>
                    <dd><input type="date" name="" id="" placeholder="이사 예정일" required /></dd>
                    <dt><label for="">출발지</label></dt>
                    <dd><input type="text" name="" id="" placeholder="출발지" required /></dd>
                    <dt><label for="">도착지</label></dt>
                    <dd><input type="text" name="" id="" placeholder="도착지" required /></dd>
                </dl>
                <hr>
                <dl class="form_wrap">
                    <dt><label for="">이사 고객님</label></dt>
                    <dd><input type="text" name="" id="" placeholder="이사 고객님" required /></dd>
                    <dt><label for="">연락처</label></dt>
                    <dd><input type="text" name="" id="" placeholder="연락처" required /></dd>
                </dl>
                <hr>
                <div class="box_line form_wrap">
                    <dl>
                        <dt>
                            <input type="checkbox" id="agree02" name="agree2" value="1">
                            <label for="agree02">개인정보처리방침 동의 <span class="txt_color">[필수]</span></label>
                        </dt>
                        <dd>
                            <div class="box_scroll">
                                <?php include APPPATH."Views/app/privacy.php"; ?>
                            </div>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
        <br>
        <button type="button" class="btn btn_large btn_color" onclick="location.href='./'">이사견적 신청</button>
    </form>
</section>