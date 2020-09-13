@extends('layouts.front')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('front/css/inner.css')}}">



<section class="contact-page">
    <div class="contact-toop-image" style="background-image:url({{asset('front/images/slider1.jpg')}})">
       <div class="container">
           <div class="row">
               <div class="col-12">
                   <div class="title-wrapper contact-title">
                        <h2>Contact</h2>
                   </div>
               </div>
           </div>
       </div>
    </div>
    
    <div class="contact-info-section">

        <div class="container">
            @if (count($errors) > 0)
            <div class="alert alert-danger message">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="row">
                <div class="col-lg-4 col-md-12 col-12">
                    <div class="contact-address-wrap">
                        <ul>
                            <li>
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                <h3>Address</h3>
                                <p>{{$dashboard_composer->address}}</p>
                            </li>
                            <li>
                                <i class="fa fa-phone" aria-hidden="true"></i>
                                <h3>Call Us</h3>
                                <p>{{$dashboard_composer->phone}}</p>
                            </li>
                            <li>
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                <h3>Email</h3>
                                <a href="#">{{$dashboard_composer->email}}</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-8 col-md-12 col-12">
                    <div class="contact-form-wrapper">
                        <h3>Leave A Mesage</h3>
                        <!-- <p>Lorem ipsum, dolor sit  dolore aut, beatae tempore ad repudiandae dolores necessitatibus delectus asperiores cumque expedita corporis nulla nesciunt perspiciatis suscipit iure magnam quas earum commodi aspernatur. Beatae veritatis vero, placeat quae quibusdam reprehenderit maxime sed esse ipsam rem labore aut alias quo.</p> -->
                        <form action="{{route('saveContact')}}" method="post" >
                        	{{csrf_field()}}
                            <label>Name</label>
                            <input type="text" plceholder="" name="name">
                            <label>Email</label>
                            <input type="email" placeholder="" name="email">
                            <label>Subject</label>
                            <input type="text" placeholder="" name="subject">
                            <label>Message</label>
                            <textarea name="message"></textarea>
                            <input type="submit" name="Send Message" class="site-btn" value="Send Message">
                            
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection