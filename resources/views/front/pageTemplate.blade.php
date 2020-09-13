@extends('layouts.front')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('front/css/inner.css')}}">



<section class="terms-page">
    <div class="container">
        <div class="term-wrapper">
            <h3>{{$page->title}}</h3>
            <p>{{$page->description}}</p>
            <ul>
                <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda, ad.</li>
                <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda, ad.</li>
                <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda, ad.</li>
                <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda, ad.</li>
                <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda, ad.</li>
                <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda, ad.</li>
                <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda, ad.</li>
                <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda, ad.</li>
            </ul>
        </div>
    </div>
</section>

@endsection