
@extends('master')
@section('main')
    <div class="movie-facility padding-bottom padding-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="checkout-widget checkout-card payment-container">
                        {{-- <h1 class="title mb-1">Successul<span></span></h1> --}}
                       @foreach ($data as $key => $value)
                            <h5 class="mb-3" style="max-width: 350px; overflow: hidden;">{{$key}} : <b>{{$value}}</b></h5>
                        @endforeach
                        <a href="{{route('index')}}" class="proceed-btn custom-button back-button" type="submit" >Go to Home page</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
