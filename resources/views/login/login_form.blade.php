@extends('layout')
@section('title', 'ログインフォーム')
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
                <a class="nav-item nav-link active" href="#">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-item nav-link" href="{{route('showSignup')}}">Create account</a>
            </li>
            <li class="nav-item">
                <a class="nav-item nav-link" href="{{route('showHelp')}}">HELP</a>
            </ul> 
        </div>
  </div>
</nav>
</header>
@section('content')
<div class="col-md-6 mx-auto mt-5 border border-light rounded p-5 ">
    <form class="form-signin" method="POST" action="/login">
    @csrf
    @if ($errors->any())
    <div class="alert alert-danger err-info">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <x-alert type="light" :session="session('msg')"/>
    <input type="text" id="inputUsername" name="name" class="form-control text-dark mt-3" placeholder="ユーザー名" autofocus>
    <input type="password" id="inputPassword" name="password" class="form-control text-dark mt-3" placeholder="パスワード">
    <br>
    <button class="btn btn-lg btn-outline-light btn-block" type="submit">Login</button>
    </form>
</div>

@endsection
@include('footer')