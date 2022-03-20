@extends('layout')
@section('title', 'detail')
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
<div class="col-md-6 mx-auto mb-5">
    <p class="text-light fs-2">{{$disp_date}}の記録</p>
    @php
    $good_foods_count = count($good_food_array);
    @endphp

    @php
    $bad_foods_count = count($bad_food_array);
    @endphp

    <div>
        <div>
            <table class="table table-bordered table-secondary" >
                <thead>
                    <tr>
                    <th>頭に良いフードカテゴリー</th>
                    </tr>
                </thead>
                <tbody>
                @if ($good_food_array[0])
                    @for( $i = 0; $i < $good_foods_count; ++$i )
                    <tr>
                    <td>{{$good_food_array[$i]}}</td>
                    </tr> 
                    @endfor 
                @else
                    <tr>
                        <td>無し</td>
                    </tr> 
                @endif 
                </tbody>
            </table>
        </div>
        <div>
            <table class="table table-bordered table-secondary">
                <thead>
                    <tr>
                    <th>頭に悪いフードカテゴリー</th>
                    </tr>
                </thead>
                <tbody>
                @if ($bad_food_array[0])
                    @for( $i = 0; $i < $bad_foods_count; ++$i ) 
                        <tr>
                        <td>{{$bad_food_array[$i]}}</td>
                        </tr> 
                    @endfor
                @else
                    <tr>
                        <td>無し</td>
                    </tr> 
                @endif 
                </tbody>
            </table>
        </div>
    </div>
   
    <div>
    <p class="text-light fs-5 border-bottom text-center"><span>メモ : </span>{{$meal_log['memo']}}</p>
    <p class="text-light fs-3 border-bottom text-center"><span>スコア : </span>{{$meal_log['score']}}</p>
    </div>

    <div class="d-flex justify-content-center mt-5">
        <div class="me-4">
            <button type="button" class="btn btn-lg btn-outline-light btn-block" onclick="location.href='edit/{{$meal_log['id']}}'">修正</button> 
        </div>
        <div>
            <form method="POST" action="{{ route('delete',$meal_log['id']) }}" onSubmit="return checkDelete()">
            @csrf
            <button type="submit" class="btn btn-lg btn-outline-light btn-block">削除</button>
            </form>  
        </div> 
    </div> 
</div>
    

    
                
    

<script>
function checkDelete(){
if(window.confirm('削除してよろしいですか？')){
    return true;
} else {
    return false;
}
}
</script>
@endsection
@include('footer')