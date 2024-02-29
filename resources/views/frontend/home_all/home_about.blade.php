
@php
     $aboutdata=App\Models\About::find(1);
     $images=App\Models\MultiImage::all();
@endphp
<section id="aboutSection" class="about">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <ul class="about__icons__wrap">
                    @foreach ($images as $image)


                    <li>
                        <img class="light" src="{{asset($image->multi_image)}}" alt="Image">

                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-lg-6">
                <div class="about__content">
                    <div class="section__title">
                        <span class="sub-title">01 - About me</span>
                        <h2 class="title">{{$aboutdata->title}}</h2>
                    </div>
                    <div class="about__exp">
                        <div class="about__exp__icon">
                            <img src="{{asset('frontend/assets/img/icons/about_icon.png')}}" alt="">
                        </div>
                        <div class="about__exp__content">
                            <p>{{$aboutdata->short_title}}</p>
                        </div>
                    </div>
                    <p class="desc">{{$aboutdata->short_description}}</p>
                    <a href="about.html" class="btn">Download my resume</a>
                </div>
            </div>
        </div>
    </div>
</section>
