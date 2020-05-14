<!-- VISUAL -->
<div class="wrap bg-white">
    <!-- VISUAL -->
    <div class="visual sub">
        <div class="images">
            <img src="/images/slide_3.png" alt="슬라이드 이미지">
        </div>
        <div class="position-center text-center text-white">
            <div class="fx-n1 text-pale-white">HOME > 상영 일정 > 상영 일정 추가</div>
            <div class="fx-8 mt-2" lang="en">
                <span class="font-weight-lighter">Screening</span>
                <b>Schedule Addition</b>
            </div>
        </div>
    </div>
    <!-- /VISUAL -->

    <form method="post" autocomplete="off">
        <div class="small-container padding">
                <div class="d-flex flex-wrap">
                    <div class="split-6 px-3">
                        <span class="font-weight-bold text-black fx-n1">1. 출품 정보</span>
                        <hr class="mt-2 mb-3">
                        <div class="py-2">
                            <select name="movie_id" class="form-control">
                                <option value="">영화를 선택하세요</option>
                                <?php foreach($entries as $entry): ?>
                                    <option value="<?=$entry->id?>"><?= $entry->title ?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="split-6 px-3">
                        <span class="font-weight-bold text-black fx-n1">2. 예약 정보</span>
                        <hr class="mt-2 mb-3">
                        <div class="py-2">
                            <input type="text" name="screening_date" class="form-control" placeholder="상영 예약일시(년/월/일/시/분)">
                        </div>
                    </div>
                </div>
            <div class="text-center mt-5">
                <button type="submit" class="bg-black text-white fx-n1 border-none px-4 py-2 mr-1">추가하기</button>
            </div>
        </div>
    </form>