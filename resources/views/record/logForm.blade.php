@extends('layout')
@section('title', 'logForm')
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
                <a class="nav-item nav-link active" href="{{route('home')}}">Home</a>
            </li>
        </ul>
        <ul class="justify-content-end navbar-nav">
            <li class="nav-item me-3">
                <a class="nav-link" href="{{route('showHelp')}}">HELP</a>
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
@section('content')    
    <div class="col-md-10 mx-auto mb-5 rounded">
    <p class="text-light fs-2">{{$disp_date}}の記録</p>
    <form action="{{route('store')}}" method="post" name="mindLog">
    <table class="table table-bordered table-secondary">
        <thead>
            <tr>
            <th scope="col">頭に良いフードカテゴリー</th>
            <th scope="col">例</th>
            <th scope="col">推奨摂取量</th>
            <th scope="col">1食分の目安</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <td scope="row">
                <label role="button">
                    <input role="button" class="form-check-input me-1" type="checkbox" name="good_food[]" value="全粒穀物" onclick="cal()">
                    全粒穀物
                </label>
            </td>
            <td>オートミール、玄米、キヌアなど</td>
            <td>週21食</td>
            <td>握りこぶし一個分</td>
            </tr>
            <tr>
            <td scope="row">
                <label role="button">
                    <input  class="form-check-input me-1" type="checkbox" name="good_food[]" value="葉物野菜" onclick="cal()">
                    葉物野菜
                </label>
            </td>
            <td>ほうれん草、ケール、レタスなど</td>
            <td>1日1食</td>
            <td>両手に乗るくらい</td>
            </tr>
            <tr>
            <td scope="row">
                <label role="button">
                    <input role="button" class="form-check-input me-1" type="checkbox" name="good_food[]" value="葉物以外の野菜" onclick="cal()">
                    葉物以外の野菜
                </label>
            </td>
            <td>玉ねぎ、にんじん、ブロッコリーなど</td>
            <td>1日1食</td>
            <td>両手に乗るくらい</td>
            </tr>
            <tr>
            <td scope="row">
                <label role="button">
                    <input role="button" class="form-check-input me-1" type="checkbox" name="good_food[]" value="ナッツ類" onclick="cal()">
                    ナッツ類
                </label>
            </td>
            <td>クルミ、マカデミア、アーモンドなど</td>
            <td>1日1食</td>
            <td>親指くらい</td>
            </tr>
            <tr>
            <td scope="row">
                <label role="button">
                    <input role="button" class="form-check-input me-1" type="checkbox" name="good_food[]" value="豆類" onclick="cal()">
                    豆類
                </label>
            </td>
            <td>レンズ豆、大豆、ヒヨコ豆など</td>
            <td>1日1食</td>
            <td>片手に乗るくらい</td>
            </tr>
            <tr>
            <td scope="row">
                <label role="button">
                    <input role="button" class="form-check-input me-1" type="checkbox" name="good_food[]" value="鶏肉" onclick="cal()">
                    鶏肉
                </label>
            </td>
            <td>ニワトリ、鴨、ダックなど</td>
            <td>週2食</td>
            <td>片手に乗るくらい</td>
            </tr>
            <tr>
            <td scope="row">
                <label role="button">
                    <input role="button" class="form-check-input me-1" type="checkbox" name="good_food[]" value="魚介類" onclick="cal()">
                    魚介類
                </label>
            </td>
            <td>サーモン、サバ、イワシなど</td>
            <td>週1食</td>
            <td>片手に乗るくらい</td>
            </tr>
            <tr>
            <td scope="row">
                <label role="button">
                    <input role="button" class="form-check-input me-1" type="checkbox" name="good_food[]" value="ベリー類" onclick="cal()">
                    ベリー類
                </label>
            </td>
            <td>ブルーベリー、イチゴ、ラズベリーなど</td>
            <td>週2食</td>
            <td>握りこぶし一個分</td>
            </tr>
            <tr>
            <td scope="row">
                <label role="button">
                    <input role="button" class="form-check-input me-1" type="checkbox" name="good_food[]" value="エキストラバージンオリーブオイル" onclick="cal()">
                    エキストラバージンオリーブオイル
                </label>
            </td>
            <td>-</td>
            <td>調理、ドレッシングに使用</td>
            <td>親指くらい</td>
            </tr>     
        </tbody>
    </table>

    <table class="table table-bordered table-secondary">
        <thead>
            <tr>
            <th scope="col">頭に悪いフードカテゴリー</th>
            <th scope="col">上限摂取量</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <td scope="row">
                <label role="button">
                    <input role="button" class="form-check-input me-1" type="checkbox" name="bad_food[]" value="バター・マーガリン" onclick="cal()">
                    バター・マーガリン
                </label>
            </td>
            <td>1日小さじ一杯</td>
            </tr>
            <tr>
            <td scope="row">
                <label role="button">
                    <input role="button" class="form-check-input me-1" type="checkbox" name="bad_food[]" value="お菓子・スナック類" onclick="cal()">
                    お菓子・スナック類
                </label>
            </td>
            <td>週5食まで</td>
            </tr>
            <tr>
            <td scope="row">
                <label role="button">
                    <input role="button" class="form-check-input me-1" type="checkbox" name="bad_food[]" value="赤肉・加工肉" onclick="cal()">
                    赤肉・加工肉
                </label>
            </td>
            <td>週に400gまで</td>
            </tr>
            <tr>
            <td scope="row">
                <label role="button">
                    <input role="button" class="form-check-input me-1" type="checkbox" name="bad_food[]" value="チーズ" onclick="cal()">
                    チーズ
                </label>
            </td>
            <td>週に80gまで</td>
            </tr>
            <tr>
            <td scope="row">
                <label role="button">
                    <input role="button" class="form-check-input me-1" type="checkbox" name="bad_food[]" value="揚げ物" onclick="cal()">
                    揚げ物
                </label>
            </td>
            <td>週に1食まで</td>
            </tr>
            <tr>
            <td scope="row">
                <label role="button">
                    <input role="button" class="form-check-input me-1" type="checkbox" name="bad_food[]" value="ファストフード" onclick="cal()">
                    ファストフード
                </label>
            </td>
            <td>週に1食まで</td>
            </tr>
            <tr>
            <td scope="row">
                <label role="button">
                    <input role="button" class="form-check-input me-1" type="checkbox" name="bad_food[]" value="外食" onclick="cal()">
                    外食
                </label>
            </td>
            <td>週に1食まで</td>
            </tr>
            
        </tbody>
    </table>
    <div class="input-group">
    <span class="input-group-text">メモ</span>
    <textarea class="form-control" aria-label="With textarea" name="memo">{{ old('memo') }}</textarea>
    </div>
    

    <input type="hidden" id="post_score" name="post_score" value="50">
    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
    <input type="hidden" name="date" value="{{$ymd}}">
    @csrf
    <div class="row justify-content-md-center">
    <p class="mt-3 text-light fs-2 col-3">合計スコア <span id="total_score">50</span>pt</p>
    </div>
    <div class="mx-auto" style="width: 200px;">
        <button class="btn btn-lg btn-outline-light btn-block" type="submit">記録する</button>
    </div>
    </form>
    </div>
<script>
point = new Array();
point[0] = 2;
point[1] = 10;
point[2] = 10;
point[3] = 4;
point[4] = 6;
point[5] = 4;
point[6] = 8;
point[7] = 4;
point[8] = 2;
point[9] = -6;
point[10] = -10;
point[11] = -6;
point[12] = -2;
point[13] = -10;
point[14] = -10;
point[15] = -6;

function cal(){
score = 50;
for(i = 0 ;i <= 15 ;i++){
if(document.mindLog.elements[i].checked == true){
score = score + point[i];
}
}
document.getElementById('total_score').innerHTML = score;
document.getElementById('post_score').value = score;
}
</script>
@endsection
@include('footer')