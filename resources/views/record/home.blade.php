@extends('layout')
@section('title', 'home')
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
                <a class="nav-item nav-link active" href="#">Home</a>
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
    <div class="col-md-10 mx-auto mb-5">
    <x-alert type="light" :session="session('msg')"/>

<form method="POST" action="{{route('showSelect')}}">
@csrf
@php
echo "<select name='y'>";
@endphp
    @for ($i = $y - 2; $i <= $y + 2; $i++) 
        @php
            echo "<option";
        @endphp
        @if ($i == $y) 
            @php
                echo " selected ";
            @endphp
        @endif
            @php
                echo ">$i</option>";
            @endphp
    @endfor
@php
    echo "</select>年";
@endphp

@php
    echo "<select name='m'>";
@endphp
    @for ($i = 1; $i <= 12; $i++) 
        @php
        echo "<option";
        @endphp
        @if ($i == $m) 
            @php
                echo " selected ";
            @endphp
        @endif
        @php
            echo ">$i</option>";
        @endphp
    @endfor
@php
echo "</select>月";
echo "<input type='submit' value='表示'>";
echo "</form>";
@endphp

<!-- カレンダーの表示 -->
<table class="table table-striped table-bordered table-light" style="height: 700px;">
<tr>
    <th style="width: 14%; height: 50px;">日</th>
    <th style="width: 14%">月</th>
    <th style="width: 14%">火</th>
    <th style="width: 14%">水</th>
    <th style="width: 14%">木</th>
    <th style="width: 14%">金</th>
    <th style="width: 14%">土</th>
    </tr>
    <tr>
    
    @for ($i = 1; $i <= $wd1; $i++) 
         <td> </td>
    @endfor

    @php
        function isExsistLog($date,$mind_array){
            if(array_key_exists($date,$mind_array)){
                $mind_score = $mind_array[$date]."point";   
                return $mind_score;       
            } 
        }
    @endphp


    @while (checkdate($m, $d, $y)) 
        @php
        $param = "%04d%02d%02d";
        $date_param = sprintf($param, $y, $m, $d)
        @endphp


        <!-- 変更箇所 -->
        @php
        $y = substr($date_param, 0, 4);
        $m = substr($date_param, 4, 2);
        $d = substr($date_param, 6, 2);
        $disp_date = "$y-$m-$d";
        $score = isExsistLog($disp_date,$mind_array);
        @endphp

        
        <!-- 生成するリンクを分岐 -->
        <!-- もしその日の記録があれば閲覧画面のリンクを生成してスコアを表示 -->
        @if($score)
        <td class="position-relative">
            <a class="text-decoration-none link-success d-block h-100 w-100" href="{{ route('detail', $date_param) }}">{{$d}}</a>
            <a class="text-decoration-none link-success position-absolute top-50 start-50 translate-middle fs-3" href="{{ route('detail', $date_param) }}">{{$score}}</a>
        </td>
        @else
        <td><a class="text-decoration-none link-success d-block h-100 w-100" href="{{ route('log', $date_param) }}">{{$d}}</a></td>
        @endif

        <!-- その日が土曜日の場合の処理 -->
        @if (date("w", mktime(0, 0, 0, $m, $d, $y)) == 6) 
            <!-- // 週を終了 -->
            </tr>

            <!-- // 次の週がある場合は新たな行を追加 -->
            @if (checkdate($m, $d + 1, $y)) 
                <tr>
            @endif
        @endif

        <!-- // 日付を1つ進める -->
        @php
        $d++;
        @endphp
    @endwhile

    <!-- // 最後の週の土曜日まで空白を追加 -->
    @for ($i = 1; $i < 7 - $wdx; $i++)
        <td> </td>
    @endfor
</tr>
</table>
    </div>
@endsection
@include('footer')