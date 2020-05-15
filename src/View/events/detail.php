<div class="wrap bg-white">
    <div class="small-container padding">
        <div class="border border-pale-white px-5 py-4 hx-150">
            <div>
                <span class="fx-3 font-weight-bold text-red"><?=movieName($teaser->movie_id)?></span>
                <span class="text-black">수정본</span>
            </div>
            <div class="d-flex mt-2">
                <div class="fx-n2 text-muted border-right border-pale-white pr-3">
                    <span>제작자: </span>
                    <span class="ml-1"><?=$teaser->user_name?>(<?=$teaser->user_id?>)</span>
                </div>
                <div class="ml-2 fx-n2 text-muted">
                    <span>제작일: </span>
                    <span class="ml-1"><?=date("Y-m-d", strtotime($teaser->created_at))?></span>
                </div>
            </div>
            <div class="d-flex mt-2">
                <span class="fx-n2 text-muted">평점:</span>

                <span class="ml-2 text-red fx-1 font-weight-bold"><?=$teaser->score?></span>
            </div>
        </div>
        <div class="mt-4 w-100 hx-600 position-relative">
            <?= $teaser->html ?>
        </div>
        <form action="/events/teasers/<?=$teaser->id?>" id="score-form" class="d-flex flex-column align-items-center mt-5" method="post">
            <hr class="rotate mb-4">
            <p class="mb-4 fx-n1 text-black">시청한 영상은 어떠셨나요? 평점을 남겨주세요!</p>
            <div class="d-flex">
                <input type="number" value="5" min="1" max="10" class="form-control wx-150" name="score">
                <button id="btn-part" class="px-3 py-2 bg-red border-none text-white fx-n1 ml-2">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
        </form>
    </div>