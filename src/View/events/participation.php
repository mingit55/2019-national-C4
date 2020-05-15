<!-- VISUAL -->
    <div class="wrap bg-white">
        <div class="visual sub">
            <div class="images">
                <img src="/images/slide_3.png" alt="슬라이드 이미지">
            </div>
            <div class="position-center text-center text-white">
                <div class="fx-n1 text-pale-white">HOME > 이벤트 > 콘테스트 참여하기</div>
                <div class="fx-8 mt-2" lang="en">
                    <b>Participation</b>
                    <span class="font-weight-lighter">in the Contest</span>
                </div>
            </div>
        </div>
        <!-- /VISUAL -->

        <!-- PARTICIPATION -->
        <div class="parti">
            <div class="container padding">
                <div class="mb-5">
                    <div class="text-center">
                        <div class="fx-7 text-red" lang="en">
                            <b>Participation</b>
                            <br>in the Contest
                        </div>
                        <div class="mt-3 fx-n2 text-pale-black">콘테스트 참여하기</div>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="d-flex flex-column wx-150">
                        <button class="btn-tool btn my-1 bg-pale-white border border-pale-white text-black" data-tool="line">자유곡선</button>
                        <button class="btn-tool btn my-1 bg-pale-white border border-pale-white text-black" data-tool="rect">사각형</button>
                        <button class="btn-tool btn my-1 bg-pale-white border border-pale-white text-black" data-tool="text">텍스트</button>
                        <button class="btn-tool btn my-1 bg-pale-white border border-pale-white text-black" data-tool="pick">선택</button>
                        <button id="btn-play" class="btn my-1 bg-pale-white border border-pale-white text-black">재생</button>
                        <button id="btn-pause" class="btn my-1 bg-pale-white border border-pale-white text-black">정지</button>
                        <button id="btn-alldel" class="btn my-1 bg-pale-white border border-pale-white text-black">전체 삭제</button>
                        <button id="btn-pickdel" class="btn my-1 bg-pale-white border border-pale-white text-black">선택 삭제</button>
                        <button id="btn-reset" class="btn my-1 bg-pale-white border border-pale-white text-black">초기화</button>
                        <button id="btn-download" class="btn my-1 bg-pale-white border border-pale-white text-black">다운로드</button>
                        <button id="btn-merge" class="btn my-1 bg-pale-white border border-pale-white text-black">병합하기</button>
                    </div>
                    <div class="px-4">
                        <div id="video-area">
                            <div class="clip-box"></div>
                        </div>
                        <div id="time-area">
                            <div class="d-flex justify-content-between hx-30 align-items-center">
                                <div class="text-gray fx-n2">
                                    <span class="mr-2">영상 시간: </span>
                                    <span id="video-current">00:00:00</span>
                                    <span>/</span>
                                    <span id="video-duration">00:00:00</span>
                                </div>
                                <div class="text-gray fx-n2">
                                    <span class="mr-1">클립 시작 시간: </span>
                                    <span id="clip-start">00:00:00</span>
                                    <span class="mr-1 ml-2">유지 시간</span>
                                    <span id="clip-duration">00:00:00</span>
                                </div>
                            </div>
                        </div>
                        <div id="clip-area"></div>
                        <div id="movie-area">
                            <div class="d-flex w-100 justify-content-around pt-4">
                                <img class="movie-card" src="/images/movies/movie1-cover.jpg" alt="movie-cover" height="250">
                                <img class="movie-card" src="/images/movies/movie2-cover.jpg" alt="movie-cover" height="250">
                                <img class="movie-card" src="/images/movies/movie3-cover.jpg" alt="movie-cover" height="250">
                                <img class="movie-card" src="/images/movies/movie4-cover.jpg" alt="movie-cover" height="250">
                                <img class="movie-card" src="/images/movies/movie5-cover.jpg" alt="movie-cover" height="250">
                            </div>
                        </div>
                    </div>
                    <div>
                        <div>
                            <label class="fx-n2" for="s_color">색상</label>
                            <select id="s_color" class="select">
                                <option value="gray">gray</option>
                                <option value="blue">blue</option>
                                <option value="green">green</option>
                                <option value="red">red</option>
                                <option value="yellow">yellow</option>
                            </select>
                        </div>
                        <div class="mt-2">
                            <label class="fx-n2" for="s_lineWidth">선 두께</label>
                            <select id="s_lineWidth" class="select">
                                <option value="3">3px</option>
                                <option value="5">5px</option>
                                <option value="10">10px</option>
                            </select>
                        </div>
                        <div class="mt-2">
                            <label class="fx-n2" for="s_fontSize">글자 크기</label>
                            <select id="s_fontSize" class="select">
                                <option value="16">16px</option>
                                <option value="18">18px</option>
                                <option value="24">24px</option>
                                <option value="32">32px</option>
                            </select>
                        </div>
                    </div>
                </div>
                <form id="part-form" class="text-center mt-5" method="post">
                    <input type="hidden" id="movie_id" name="movie_id">
                    <input type="hidden" id="video_html" name="video_html">
                    <hr class="rotate mb-4">
                    <p class="mb-4 fx-n1 text-black">편집한 영상으로 콘테스트에 참여해 보세요!</p>
                    <button id="btn-part" class="px-4 py-3 bg-red border-none text-white fx-n1">콘테스트 참여하기</button>
                </form>
            </div>
        </div>
        <!-- /PARTICIPATION -->

        <script>
            window.addEventListener("load", () => {
                const editor = new App();
                
                document.querySelector("#part-form").addEventListener("submit", function(e){
                    e.preventDefault();
                    let videoHTML = editor.parseHTML();
                    if(videoHTML) {
                        document.querySelector("#movie_id").value = editor.viewer.currentTrack.movie_id;
                        document.querySelector("#video_html").value = videoHTML;
                        this.submit();
                    }
                });
            });
        </script>