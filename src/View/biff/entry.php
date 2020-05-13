<!-- VISUAL -->
<div class="wrap bg-white">
    <!-- VISUAL -->
    <div class="visual sub">
        <div class="images">
            <img src="/images/slide_2.png" alt="슬라이드 이미지">
        </div>
        <div class="position-center text-center text-white">
            <div class="fx-n1 text-pale-white">HOME > 출품 신청</div>
            <div class="fx-8 mt-2" lang="en">
                <span class="font-weight-lighter">Application</span>
                <b>for Entry</b>
            </div>
        </div>
    </div>
    <!-- /VISUAL -->

    <form method="post" autocomplete="off">
        <div class="small-container padding">
                <div class="d-flex flex-wrap">
                    <div class="split-6 px-3">
                        <span class="font-weight-bold text-black fx-n1">1. 출품자 정보</span>
                        <hr class="mt-2 mb-3">
                        <div class="py-2">
                            <input type="text" name="user_id" class="form-control" placeholder="출품자 아이디" value="<?= user() ? user()->user_id : "" ?>" <?= user() ? "readonly" : "" ?>>
                        </div>
                        <div class="py-2">
                            <input type="text" name="user_name" class="form-control" placeholder="출품자 명" value="<?= user() ? user()->user_name : "" ?>" <?= user() ? "readonly" : "" ?>>
                        </div>
                    </div>
                    <div class="split-6 px-3">
                        <span class="font-weight-bold text-black fx-n1">2. 출품 정보</span>
                        <hr class="mt-2 mb-3">
                        <div class="py-2">
                            <input type="text" name="title" class="form-control" placeholder="영화 제목">
                        </div>
                        <div class="py-2">
                            <input type="text" name="running_time" class="form-control" placeholder="상영 시간(분)">
                        </div>
                        <div class="py-2">
                            <input type="text" name="created_at" class="form-control" placeholder="제작년도">
                        </div>
                        <div class="py-2">
                            <select name="type" class="form-control">
                                <option value="">분류</option>
                                <option value="극영화">극영화</option>
                                <option value="다큐멘터리">다큐멘터리</option>
                                <option value="애니메이션">애니메이션</option>
                                <option value="기타">기타</option>
                            </select>
                        </div>
                    </div>
                </div>
            <div class="text-center mt-5">
                <button type="submit" class="bg-black text-white fx-n1 border-none px-4 py-2 mr-1">신청하기</button>
                <button id="btn-view-image" class="bg-gray text-black fx-n1 border-none px-4 py-2">출품 비율</button>
            </div>
            <div class="text-center mt-4">
                <img id="entry-graph" src="/biff-2019/entry-graph" alt="entry-graph" hidden>
            </div>
        </div>
    </form>
    <script>
        window.addEventListener("load", () => {
            let viewing = false;
            let $graph = document.querySelector("#entry-graph");
            document.querySelector("#btn-view-image").addEventListener("click", e => {
                e.preventDefault();
                if($graph.getAttribute("hidden") === null){
                    $graph.setAttribute("hidden", "hidden");
                } else {
                    $graph.removeAttribute("hidden");
                }
            });
        });
    </script>