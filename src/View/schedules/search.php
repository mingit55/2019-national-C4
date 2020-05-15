<div class="container bg-white">
<div class="wrap bg-white"> 
    <div class="container padding">
        <div class="border-pale-white border-bottom pb-4">
            <div class="text-center mb-4">
                <span class="font-weight-bold text-red fx-5">상영작 검색</span>
            </div>
            <div class="d-flex flex-row-reverse">
                <div class="d-flex ml-2">
                    <input type="text" id="i_keyword" name="keyword" class="form-control wx-250" placeholder="검색어를 입력해 주세요">
                    <button id="btn-search" class="px-2 py-2 text-white border-none bg-red">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
                <div>
                    <select id="i_type" class="form-control">
                        <option value="">전체</option>
                        <option value="극영화">극영화</option>
                        <option value="다큐멘터리">다큐멘터리</option>
                        <option value="애니메이션">애니메이션</option>
                        <option value="기타">기타</option>
                    </select>
                </div>
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

            </div>
        </div>
        <div id="counter">
            <div class="fx-n2 text-muted text-center mt-5">
                <span class="view">0</span>
                /
                <span class="total">0</span>
            </div>
        </div>
    </div>
    <script>
        class Search {
            constructor(){
                this.init();
            }

            async init(){
                this.schedules = await this.loadSchedules();

                this.render();
            }

            get keyword(){
                let $i_keyword = document.querySelector("#i_keyword");
                return $i_keyword.value;
            }

            get type(){
                let $i_type = document.querySelector("#i_type");
                return $i_type.value;
            }

            render(){
                let $body = document.querySelector(".table .body");
                $body.innerHTML = "";

                let viewList = JSON.parse(JSON.stringify(this.schedules));
                
                if(this.keyword !== "") {
                    viewList = viewList.filter(item => item.title.indexOf(this.keyword) >= 0);
                }

                if(this.type !== ""){
                    viewList = viewList.filter(item => item.type === this.type);
                }

                viewList.forEach(item => {
                    let $elem = document.createElement("div");
                    $elem.classList.add("row");
                    $elem.innerHTML = `<div class="split-1-7">${item.start_time} ~  ${item.end_time}</div>
                        <div class="split-1-7">${item.user_name}</div>
                        <div class="split-1-7">${item.user_id}</div>
                        <div class="split-1-7">${item.title}</div>
                        <div class="split-1-7">${item.running_time}</div>
                        <div class="split-1-7">${item.created_at}</div>
                        <div class="split-1-7">${item.type}</div>`;
                    $body.append($elem);
                });

                let $c_total = document.querySelector("#counter .total");
                let $c_view = document.querySelector("#counter .view");

                $c_total.innerText = this.schedules.length;
                $c_view.innerText = viewList.length;
            }
            
            loadSchedules(){
                return fetch("/biff-2019/schedules")
                    .then(res => res.json())
                    .then(res => res.data);
            }
            
        }

        window.addEventListener("load", () => {
            let app = new Search();


            document.querySelector("#i_keyword").addEventListener("input", e => {
                app.render();
            });

            document.querySelector("#i_type").addEventListener("change", e => {
                app.render();
            });

            document.querySelector("#btn-search").addEventListener("click", e => {
                app.render();
            });
        });
    </script>