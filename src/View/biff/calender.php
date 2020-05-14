<div class="wrap bg-white">
    <div class="container py-5">
        <div id="calender">
            <div class="d-flex justify-content-between align-items-center">
                <button id="btn-prev" class="fx-5 border-none bg-none">&lt;</button>
                <span id="now-date" class="fx-6" lang="ko">
                    <span class="year text-red font-weight-bold">2020</span>년 
                    <span class="month text-red font-weight-bold">5</span>월
                </span>
                <button id="btn-next" class="fx-5 border-none bg-none">&gt;</button>
            </div>
            <div class="d-flex flex-wrap mt-5">
                <div class="split-1-7 p-1">
                    <div class="text-red text-center py-1 fx-n1">일</div>
                </div>
                <div class="split-1-7 p-1">
                    <div class="text-black text-center py-1 fx-n1">월</div>
                </div>
                <div class="split-1-7 p-1">
                    <div class="text-black text-center py-1 fx-n1">화</div>
                </div>
                <div class="split-1-7 p-1">
                    <div class="text-black text-center py-1 fx-n1">수</div>
                </div>
                <div class="split-1-7 p-1">
                    <div class="text-black text-center py-1 fx-n1">목</div>
                </div>
                <div class="split-1-7 p-1">
                    <div class="text-black text-center py-1 fx-n1">금</div>
                </div>
                <div class="split-1-7 p-1">
                    <div class="text-red text-center py-1 fx-n1">토</div>
                </div>
            </div>
            <div class="body d-flex flex-wrap"></div>
        </div>
        <?php if(admin()): ?>
            <div class="mt-4 text-center">
                <a href="/schedules/application" class="bg-black text-white fx-n1 border-none px-4 py-2 mr-1">상영 일정 등록</a>
            </div>
        <?php endif; ?>
    </div>
    <script>
        Date.prototype.parseDate = function(){
            let year = this.getFullYear();
            let month = this.getMonth() + 1;
            let date = this.getDate();

            return `${year}-${month}-${date}`;
        }

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

            getSchedules(year, month){
                return fetch(`/biff-2019/schedules?year=${year}&month=${month}`)
                    .then(res => res.json())
                    .then(res => {
                        if(!res.status){
                            alert(res.data);
                            return [];
                        } else {
                            return res.data.reduce((prev, curr) => {
                                let date = new Date(curr.start_time);
                                let find = prev.find(item => (item.date.parseDate()) == (date.parseDate()));
                                if(find) find.list.push(curr);
                                else prev.push({list: [curr], date});
                                return prev;
                            }, []);
                        }
                    });
            }

            async render(){
                const lastD = new Date(this.now.getFullYear(), this.now.getMonth() + 1, 0);
                const firstD = new Date(this.now.getFullYear(), this.now.getMonth(), 1);
                const firstDNextM = new Date(this.now.getFullYear(), this.now.getMonth() + 1, 1);
                const lastDLastM = new Date(this.now.getFullYear(), this.now.getMonth(), 0);

                let list = await Promise.all([
                    this.getSchedules(lastDLastM.getFullYear(), lastDLastM.getMonth() + 1),
                    this.getSchedules(firstD.getFullYear(), firstD.getMonth() + 1),
                    this.getSchedules(firstDNextM.getFullYear(), firstDNextM.getMonth() + 1)
                ]);

                this.$body.innerHTML = "";

                for(let i = firstD.getDay(); i > 0; i--){
                    let day = lastDLastM.getDate() - i - 1;
                    let schedules = list[0].find(item => item.date.parseDate() == new Date(lastDLastM.getFullYear(), lastDLastM.getMonth(), day).parseDate());
                    let $schedules = schedules ? schedules.list.slice(0, 3).map(data => `<p class="w-100 px-3 overflow-ellipsis">${data.title}</p>`) : "";

                    let elem = document.createElement("div");
                    elem.classList.add("split-1-7", "p-1");
                    elem.innerHTML = `<div class="text-muted text-center hx-150 position-relative d-flex flex-column pt-5">
                                        <span class="position-date font-weight-bold fx-2 text-muted">${day}</span>
                                        ${$schedules}
                                    </div>`;
                    this.$body.append(elem);
                }

                for(let i = 1; i <= lastD.getDate(); i++){
                    let date = new Date(this.now.getFullYear(), this.now.getMonth(), i).parseDate();
                    let schedules = list[1].find(item => item.date.parseDate() == date);
                    let $schedules = schedules ? schedules.list.slice(0, 3).map(data => `<p class="w-100 px-3 overflow-ellipsis">${data.title}</p>`) : [];

                    let elem = document.createElement("div");
                    elem.addEventListener("click", e => {
                        location.assign("/schedules/" + date); 
                    });
                    elem.classList.add("split-1-7", "p-1");
                    elem.innerHTML = `<div class="text-black text-center hx-150 position-relative d-flex flex-column pt-5">
                                        <span class="position-date font-weight-bold fx-2 text-black">${i}</span>
                                        ${$schedules.join("")}
                                    </div>`;
                    this.$body.append(elem);
                }

                for(let i = lastD.getDay(); i < 6; i++){
                    let day = i - lastD.getDay() + 1;
                    let schedules = list[0].find(item => item.date.parseDate() == new Date(firstDNextM.getFullYear(), firstDNextM.getMonth(), day).parseDate());
                    let $schedules = schedules ? schedules.list.slice(0, 3).map(data => `<p class="w-100 px-3 overflow-ellipsis">${data.title}</p>`) : "";

                    let elem = document.createElement("div");
                    elem.classList.add("split-1-7", "p-1");
                    elem.innerHTML = `<div class="text-muted text-center hx-150 position-relative d-flex flex-column pt-5">
                                        <span class="position-date font-weight-bold fx-2 text-muted">${day}</span>
                                        ${$schedules}
                                    </div>`;
                    this.$body.append(elem);
                }
            }
        }


        window.addEventListener("load", () => {
            let calender = new Calender();
            calender.render();

            let $year = document.querySelector("#now-date .year");
            let $month = document.querySelector("#now-date .month");

            document.querySelector("#btn-prev").addEventListener("click", () => {
                calender.prev();
                $year.innerText = calender.now.getFullYear();
                $month.innerText = calender.now.getMonth() + 1;
            });

            document.querySelector("#btn-next").addEventListener("click", () => {
                calender.next();
                $year.innerText = calender.now.getFullYear();
                $month.innerText = calender.now.getMonth() + 1;
            });
        });
    </script>