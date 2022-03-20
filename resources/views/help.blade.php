@extends('layout')
@section('title', 'help')
@auth
<header>
    <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">MIND</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-item nav-link" href="{{route('home')}}">Home</a>
            </li>
        </ul>
        <ul class="justify-content-end navbar-nav">
            <li class="nav-item me-3">
                <a class="nav-link active" href="#">HELP</a>
            </li>
        </ul>
        <form action="{{route('logout')}}" method="POST" class="d-flex mb-2 mb-lg-0">
            @csrf
            <button type="submit" class="btn btn-danger logout-btn">Logout</button>
        </form>
        </div>
  </div>
</nav>
</header>
@endauth
@guest
<header>
    <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">MIND</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-item nav-link" href="{{route('showLogin')}}">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-item nav-link" href="{{route('showSignup')}}">Create account</a>
            </li>
            <li class="nav-item">
                <a class="nav-item nav-link active" href="#">HELP</a>
            </ul> 
        </div>
  </div>
</nav>
</header>
@endguest
@section('content')    
    <div class="col-md-10 mx-auto mb-5">
        <h2 class="fs-1 text-light">MIND Information</h2>
        <p class="fs-3 mt-4 text-light">MINDについて</p>
        <p class="fs-5 text-light">このアプリは、マインド食事法をゲーム感覚で楽しく継続し、より健康な食生活を送ることを目的に作られました。このアプリでは、マインド食事法をどれだけ普段の食生活で実践できているかを数値で可視化して知ることができます。
        </p>
        <p class="fs-3 mt-5 text-light">
            MINDの使い方
        </p>
        <p class="fs-5 text-light">
            カレンダーをクリックして、その日にあなたが食べたものをチェックしていきましょう。記録した内容は後で振り返ることができますし、記録の修正や削除をすることも可能です。
        </p>
        <p class="fs-3 mt-5 text-light">
            継続のためのコツ
        </p>
        <p class="fs-5 text-light">
            このアプリのチェックリストには、推奨摂取量や1食分の目安量が記載されていますが、これらにこだわりすぎる必要はありません。最初からハードルを高く設定すると、継続が難しくなるからです。食事法に慣れるまでは、食べたか、食べてないかくらいのざっくりした基準で記入していくことをお勧めします。
            <br>また、点数についても無理をして100点を目指す必要は無く、60点~80点くらいを継続するだけでも十分に食事法の効果は期待できます。高い点数を目指す際は、それがストレスにならない程度にとどめておくことをお勧めします。
        </p>
        <p class="fs-3 mt-5 text-light">
            備考
        </p>
        <p class="fs-5 text-light">
            このアプリで設けているマインド食事法のチェックリストや各食品の点数は、「ヤバい集中力 1日ブッ通しでアタマが冴えわたる神ライフハック45」  2019/9/20 鈴木 祐(著) を参考にして作成しています。
        </p>
    </div>
@endsection
@include('footer')