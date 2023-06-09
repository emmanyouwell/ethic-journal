@extends('layouts.app')

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
                            
                            <textarea class="form-control" id="exampleFormControlTextarea1" name="entry" rows="3"></textarea>
                        </div>
                        <div class="mt-2 d-flex justify-content-end">
                            <button type="submit" class="btn btn-success ">Submit</button>
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
                <p>{{$message->entry}}</p>
                <p class="card-footer-glass">{{$message->created_at->toDayDateTimeString()}}</p>
            </div>
        </div>
    </div>
    @endforeach

</div>
@endsection
