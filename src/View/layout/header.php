<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>부산국제영화제</title>
    <link rel="stylesheet" href="/css/layout.css">
    <link rel="stylesheet" href="/css/sizing.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/fontawesome/css/all.css">
    <script src="/fontawesome/js/all.js"></script>
</head>
<body>
    <!-- HEADER -->
    <input type="checkbox" id="menu-open" hidden>
    <header class="hx-80">
        <div class="wrap d-flex justify-content-between align-items-center h-100 px-sm-4">
            <a href="/">
                <img src="/images/logo_3.png" alt="부산국제영화제" height="50">
                <img src="/images/logo-icon.png" alt="부산국제영화제" height="50" class="d-none">
            </a>
            <nav class="d-sm-none">
                <div class="nav-item">
                    <a href="/biff-2019/overview">부산국제영화제</a>
                    <div class="sub">
                        <a href="/biff-2019/overview">개최개요</a>
                        <a href="/biff-2019/event-info">행사안내</a>
                    </div>
                </div>
                <div class="nav-item">
                    <a href="/biff-2019/entry">출품신청</a>
                </div>
                <div class="nav-item">
                    <a href="#">상영일정</a>
                </div>
                <div class="nav-item">
                    <a href="#">상영작검색</a>
                </div>
                <div class="nav-item">
                    <a href="#">이벤트</a>
                    <div class="sub">
                        <a href="#">영화티저 콘테스트</a>
                        <a href="/event/participation">콘테스트 참여하기</a>
                    </div>
                </div>
            </nav>
            <div class="auth-group d-sm-none">
                <?php if(user()): ?>
                    <span class="fx-n2 text-pale-black mr-3"><?=user()->user_name?> 님</span>
                    <a href="/users/logout" class="fx-n2">로그아웃</a>
                <?php else:  ?>
                    <a href="/users/sign-in" class="fx-n2 mr-1">로그인</a>
                    <a href="/users/sign-up" class="fx-n2">회원가입</a>
                <?php endif; ?>
            </div>
            <label for="menu-open" class="menu-icon d-none d-sm-block">
                <span></span>
                <span></span>
                <span></span>
            </label>
            <div class="mobile-nav">
                <div class="nav-item has-sub">
                    <a href="/biff-2019/overview">부산국제영화제</a>
                    <div class="sub">
                        <a href="/biff-2019/overview">개최개요</a>
                        <a href="/biff-2019/event-info">행사안내</a>
                    </div>
                </div>
                <div class="nav-item">
                    <a href="/biff-2019/entry">출품신청</a>
                </div>
                <div class="nav-item">
                    <a href="#">상영일정</a>
                </div>
                <div class="nav-item">
                    <a href="#">상영작검색</a>
                </div>
                <div class="nav-item has-sub">
                    <a href="#">이벤트</a>
                    <div class="sub">
                        <a href="#">영화티저 콘테스트</a>
                        <a href="/event/participation">콘테스트 참여하기</a>
                    </div>
                </div>
                <div class="auth">
                    <?php if(user()): ?>
                        <span class="text-pale-black pl-0 pr-4 fx-n2"><?=user()->user_name?> 님</span>
                        <a href="/users/logout" class="text-pale-black">로그아웃</a>
                    <?php else:  ?>
                        <a href="/users/sign-in" class="text-pale-black pl-0 pr-4">로그인</a>
                        <a href="/users/sign-up" class="text-pale-black">회원가입</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>
    <!-- /HEADER -->