@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{asset('css/export.css')}}">
@endsection

@section('script-foot')
<script src="{{asset('js/script.js')}}"></script>
@endsection
@section('navbar')
<nav class="navbar navbar-expand-md navbar-light shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/home') }}">
            {{auth()->user()->name}}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <a href="{{route('export')}}" class="dropdown-item">Export as PDF</a>
                            <a href="{{route('pickStyle',3)}}">pink</a>
                            <a href="{{route('pickStyle',1)}}">red</a>
                            <a href="{{route('pickStyle',2)}}">blue</a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
@endsection

@section('content')
<div class="container">
    
    @foreach($data as $message)
    <div class="row justify-content-center mt-3">
        <div class="col-md-8">
            <div class="card-glass">
                @if (Session::has('style'))
                @if(Session::get('style') === 'img/red.avif')
                <div class="card-img" style="background: url({{asset('img/red.avif')}}); background-size: cover;"></div>
                @elseif(Session::get('style') === 'img/blue.avif')
                <div class="card-img" style="background: url({{asset('img/blue.avif')}}); background-size: cover;"></div>
                @elseif(Session::get('style') === 'img/pink.avif')
                <div class="card-img" style="background: url({{asset('img/pink.avif')}}); background-size: cover;"></div>
                @endif
                @endif
              
                
                <div class="card-header">
                    <h3>Entry #{{($data->total())-(($data->currentPage()-1)*$data->perPage()+($loop->index))}}</h3>
                </div>
                <hr>
                <p>{{$message->entry}}</p>
                <hr>
                <p class="card-footer-glass">{{$message->created_at->toDayDateTimeString()}}</p>
            </div>
        </div>
    </div>
  
    @endforeach
    <div class="row justify-content-center mt-3">
        <div class="col-md-8">
            <div>{{$data->links()}}</div>
        </div>
       
    </div>
</div>
@endsection
