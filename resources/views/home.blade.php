@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{asset('css/style.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('script-head')
<script defer src="{{asset('js/script.js')}}"></script>
@endsection

@section('navbar')
<nav class="navbar navbar-expand-md navbar-dark shadow-lg">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/home') }}">
            {{ config('app.name', 'Laravel') }}
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
    <div class="row justify-content-center">
        
        <div class="col-md-8">
            <div class="card-glass">
                <div class="card-header text-white mb-3"><h3>Entry for today</h3></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{route('journal.saveEntry')}}" method="POST">
                        @csrf
                        
                        <div class="form-group">
                            
                            <textarea class="form-control" id="exampleFormControlTextarea1" name="entry" rows="3" required></textarea>
                        </div>
                        <div class="mt-2 d-flex justify-content-end">
                            <button type="submit" class="btn btn-info ">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @foreach($mes as $message)
    <div class="row justify-content-center mt-3">
        <div class="col-md-8">
            <div class="card-glass">
                <div class="card-header">
                    <h3 class="text-white">Entry #{{$counter--}}</h3>
                </div>
                <hr>
                <p>{{$message->entry}}</p>
                <hr>
                <div class="card-footer-glass d-flex justify-content-between">
                    <p>{{$message->created_at->toDayDateTimeString()}}
                    </p>
                    <div>
                        <a href="{{route('journal.edit',$message->id)}}" class="text-info"><i class="me-2 fa-solid fa-pen-to-square"></i></a>
                        <a href="{{route('journal.delete',$message->id)}}" class="text-warning"><i class="fa-solid fa-trash"></i></a>
                        
                    </div>
                   
                </div>
                
                
            </div>
        </div>
    </div>
    @endforeach

</div>


@endsection
