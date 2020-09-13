@extends('layouts.front')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('front/css/inner.css')}}">





<section class="team-page">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="title-wrapper">
                    <h2>Our Members</h2>
                </div>
            </div>
        </div>
        <div class="row">
        	@foreach($teams as $team)
            <div class="col-lg-4 col-md-6 col-12 equal-height">
                <div class="team-wrapper">
                    <div class="team-image-wrapper">
                        <img src="{{asset('images/thumbnail/'.$team->image)}}">
                    </div>
                    <h4>{{$team->name}}</h4>
                    <span>{{$team->position}}</span>
                    <p>{{$team->description}}</p>
                    <ul>
                        <li><a href="{{$team->facebook}}"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="{{$team->twitter}}"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a href="{{$team->instagram}}"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                        
                    </ul>
                </div>
            </div>
            @endforeach
            
        </div>
    </div>
</section>

@endsection