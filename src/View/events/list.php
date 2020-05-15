<div class="wrap bg-white">
    <!-- VISUAL -->
    <div class="visual sub">
        <div class="images">
            <img src="/images/slide_3.png" alt="슬라이드 이미지">
        </div>
        <div class="position-center text-center text-white">
            <div class="fx-n1 text-pale-white">HOME > 이벤트 > 영화티저 콘테스트</div>
            <div class="fx-8 mt-2" lang="en">
                <span class="font-weight-lighter">Movie Teaser</span>
                <b>Contest</b>
            </div>
        </div>
    </div>
    <!-- /VISUAL -->
    <div class="container padding">
        <div class="d-flex flex-wrap px-sm-2">
            <?php foreach($list as $item): ?>
                <div class="split-3 split-sm-6">
                    <div class="hx-300 border border-pale-white pointer" onclick="location.href='/events/teaser-contest/<?=$item->id?>'">
                        <div class="w-100 hx-200 position-relative">
                            <img src="/images/movies/movie<?=$item->movie_id?>-cover.jpg" alt="커버 이미지" class="position-absolute fit-cover">
                        </div>
                        <div class="hx-100 px-3 py-3">
                            <div class="fx-1 font-weight-bold text-black"><?=movieName($item->movie_id)?> 수정영상</div>
                            <div class="fx-n1 text-pale-black mt-2">
                                <span><?=$item->user_name?></span>
                                <span class="ml-1"><?=date("Y-m-d", strtotime($item->created_at))?></span>
                                <span class="ml-1">평점: <?=$item->score?></span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach;?>
        </div>
    </div>