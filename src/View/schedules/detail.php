<div class="wrap bg-white"> 
    <div class="container padding">
        <div class="border-pale-white border-bottom pb-5">
            <div class="text-center fx-2 mb-2">
                <span>상영 일정</span>
            </div>
            <div class="text-center fx-6">
                <span class="text-red font-weight-bold"><?=date("Y년 m월 d일", strtotime($date))?></span>
            </div>
        </div>
        <div class="table">
            <div class="head">
                <div class="split-1-7">상영 일정</div>
                <div class="split-1-7">출품자 명</div>
                <div class="split-1-7">출품자 아이디</div>
                <div class="split-1-7">제목</div>
                <div class="split-1-7">상영 시간</div>
                <div class="split-1-7">제작년도</div>
                <div class="split-1-7">분류</div>
            </div>
            <div class="body">
                <?php foreach($list as $item):?>
                    <div class="row">
                        <div class="split-1-7"><?= date("H:i", strtotime($item->start_time)) ?> ~  <?= date("H:i", strtotime($item->end_time)) ?></div>
                        <div class="split-1-7"><?= $item->user_name ?></div>
                        <div class="split-1-7"><?= $item->user_id ?></div>
                        <div class="split-1-7"><?= $item->title ?></div>
                        <div class="split-1-7"><?= $item->running_time ?></div>
                        <div class="split-1-7"><?= $item->created_at ?></div>
                        <div class="split-1-7"><?= $item->type ?></div>
                    </div>
                <?php endforeach;?>
                <?php if(count($list) == 0): ?>
                    <div class="row">
                        <div class="split-12">
                            예약된 영화가 없습니다.
                        </div>
                    </div>
                <?php endif;?>
            </div>
        </div>
    </div>