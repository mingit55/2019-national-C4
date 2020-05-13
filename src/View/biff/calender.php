<div class="wrap bg-white">
    <div class="container padding">
        <div id="calender">
            <div class="d-flex justify-content-between align-items-center">
                <button id="btn-prev" class="fx-5 border-none bg-none">&lt;</button>
                <span id="now-date" class="fx-6 text-black" lang="ko">2020년 5월</span>
                <button id="btn-next" class="fx-5 border-none bg-none">&gt;</button>
            </div>
            <div class="d-flex flex-wrap mt-5">
                <div class="split-1-7 p-1">
                    <div class="border border-black text-black text-center py-1">일</div>
                </div>
                <div class="split-1-7 p-1">
                    <div class="border border-black text-black text-center py-1">월</div>
                </div>
                <div class="split-1-7 p-1">
                    <div class="border border-black text-black text-center py-1">화</div>
                </div>
                <div class="split-1-7 p-1">
                    <div class="border border-black text-black text-center py-1">수</div>
                </div>
                <div class="split-1-7 p-1">
                    <div class="border border-black text-black text-center py-1">목</div>
                </div>
                <div class="split-1-7 p-1">
                    <div class="border border-black text-black text-center py-1">금</div>
                </div>
                <div class="split-1-7 p-1">
                    <div class="border border-black text-black text-center py-1">토</div>
                </div>
            </div>
            <div class="body d-flex flex-wrap"></div>
        </div>
    </div>
    <script>
        class Calender {
            constructor(){
                this.$body = document.querySelector("#calender .body");
                this.now = new Date();
            }

            change(year, month){
                this.now = new Date(year, month);
            }

            next(){
                this.change(this.now.getFullYear(), this.now.getMonth() + 1);
                this.render();
            }

            prev(){
                this.change(this.now.getFullYear(), this.now.getMonth() - 1);
                this.render();
            }

            getDate(){
                let year = this.now.getFullYear();
                let month = this.now.getMonth() + 1;
                return `${year}년 ${month}월`;
            }

            render(){
                const lastD = new Date(this.now.getFullYear(), this.now.getMonth() + 1, 0);
                const firstD = new Date(this.now.getFullYear(), this.now.getMonth(), 1);
                const lastDLastM = new Date(this.now.getFullYear(), this.now.getMonth(), 0);

                this.$body.innerHTML = "";

                for(let i = firstD.getDay(); i > 0; i--){
                    let day = lastDLastM.getDate() - i - 1;
                    let elem = document.createElement("div");
                    elem.classList.add("split-1-7", "p-1");
                    elem.innerHTML = `<div class="border border-muted text-muted text-center hx-150 position-relative d-flex flex-column pt-5">
                                        <span class="position-date text-muted">${day}</span>
                                        <p class="w-100 px-3 overflow-ellipsis"></p>
                                    </div>`;
                    this.$body.append(elem);
                }

                for(let i = 1; i <= lastD.getDate(); i++){
                    let elem = document.createElement("div");
                    elem.classList.add("split-1-7", "p-1");
                    elem.innerHTML = `<div class="border border-black text-black text-center hx-150 position-relative d-flex flex-column pt-5">
                                        <span class="position-date text-black">${i}</span>
                                        <p class="w-100 px-3 overflow-ellipsis"></p>
                                    </div>`;
                    this.$body.append(elem);
                }

                for(let i = lastD.getDay(); i < 6; i++){
                    let day = i - lastD.getDay() + 1;
                    let elem = document.createElement("div");
                    elem.classList.add("split-1-7", "p-1");
                    elem.innerHTML = `<div class="border border-muted text-muted text-center hx-150 position-relative d-flex flex-column pt-5">
                                        <span class="position-date text-muted">${day}</span>
                                        <p class="w-100 px-3 overflow-ellipsis"></p>
                                    </div>`;
                    this.$body.append(elem);
                }
            }
        }


        window.addEventListener("load", () => {
            let calender = new Calender();
            calender.render();

            let $now = document.querySelector("#now-date");;

            document.querySelector("#btn-prev").addEventListener("click", () => {
                calender.prev();
                $now.innerText = calender.getDate();
            });

            document.querySelector("#btn-next").addEventListener("click", () => {
                calender.next();
                $now.innerText = calender.getDate();
            });
        });
    </script>