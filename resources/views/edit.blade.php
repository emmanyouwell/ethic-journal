@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{asset('css/style.css')}}">
@endsection

@section('navbar')
<nav class="navbar navbar-expand-md navbar-light shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
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
                
                <form action="{{route('journal.update', $message->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                        <div class="form-group">
                            
                            <textarea class="form-control" id="exampleFormControlTextarea1" name="entry" rows="3" required>{{$message->entry}}</textarea>
                        </div>
                        <div class="mt-2 d-flex justify-content-end">
                            <button type="submit" class="btn btn-sm btn-info me-2">Save</button>
                            <a href="{{route('home')}}" class="btn btn-sm btn-warning">Cancel</a>
                        </div>
                        
                </form>
                <p class="card-footer-glass">{{$message->created_at->toDayDateTimeString()}}</p>
            </div>
        </div>
    </div>
    @endforeach

</div>
@endsection
