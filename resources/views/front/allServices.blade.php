@extends('layouts.front')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('front/css/inner.css')}}">



<section class="service-list-page all-sec-padding">
    <div class="container">
        <div class="blog-top-title package-info-title">
             @if($services[0]->category=='packages')
            <h2>Packages</h2>
        </div>
       <div class="package-info-wrapp">
           <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus necessitatibus possimus laboriosam quisquam dolores aut accusantium ab recusandae. Error accusantium quaerat odit nostrum modi cum dolorum iste itaque. Animi temporibus corrupti inventore sint odio alias quae, blanditiis quo sapiente ad labore! Laboriosam consequuntur iusto excepturi earum quod odio, doloremque cupiditate.</p>
            @endif
             @if($services[0]->category=='dining')
              <h2>Dining</h2>
        </div>
       <div class="package-info-wrapp">
           <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus necessitatibus possimus laboriosam quisquam dolores aut accusantium ab recusandae. Error accusantium quaerat odit nostrum modi cum dolorum iste itaque. Animi temporibus corrupti inventore sint odio alias quae, blanditiis quo sapiente ad labore! Laboriosam consequuntur iusto excepturi earum quod odio, doloremque cupiditate.</p>
            @endif
              @if($services[0]->category=='meeting_and_conference')
               <h2>Meeting and Conference</h2>
        </div>
       <div class="package-info-wrapp">
           <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus necessitatibus possimus laboriosam quisquam dolores aut accusantium ab recusandae. Error accusantium quaerat odit nostrum modi cum dolorum iste itaque. Animi temporibus corrupti inventore sint odio alias quae, blanditiis quo sapiente ad labore! Laboriosam consequuntur iusto excepturi earum quod odio, doloremque cupiditate.</p>
            @endif
            </div>
       <div class="row service__row__wrapper">
            @foreach($services as $service)
            
           <div class="col-lg-4 col-md-6 col-12">
               <a href="{{route('serviceDetail',$service->slug)}}" class="package-inner-link-wrapper">
                   <div class="package-img"><img src="{{asset('images/thumbnail/'.$service->image)}}" alt=""></div>
                   <h3>{{$service->title}}</h3>
               </a>
           </div>
           @endforeach
          
           
       </div>
    </div>
</section>



@endsection