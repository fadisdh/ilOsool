@extends('layouts.site')

@section('title')
  News
@stop

@section('content')
    @parent
    <div class="page-img">{{ HTML::image('images/news-cover.jpg') }}</div>
    <div class="container">
        <div class="page-container">
            <div class="hline"></div>
            <div class="page-content">
                <h2 class="page-title">{{ getLocale() == 'en' ? 'Partners' : 'الشركاء' }}</h2>
                <ul class="posts-list list-unstyled">
                    <li class="row">
                        <a href="http://ultrafrontier.com/" target="_blank">
                            <div class="posts-image col-md-2">
                                <img src="{{ asset('images/partners/ultrafrontier.png') }}"/>
                            </div>
                            <div class="col-md-10">
                                @if(getLocale() == 'en')
                                    <h3>Ultra Frontier</h3>
                                    <p>Ultra Frontier is an innovative investment advisory boutique which prides itself on its ability to provide its clients with a unique and tailored service. With strong foundations in the Middle East and vast industry experience amongst its team of specialists, Ultra Frontier has both the tools and vision to offer an unparalleled suite of services to meet the needs of its diverse clients. With its finger consistently on the pulse of changing economic climates and market fluctuations.</p>
                                @else
                                    <h3>الترا فورنتير</h3>
                                    <p>الترا فورنتير هي بوتيك الاستشارات الاستثمارية المبتكرة والتي تفخربقدرتها على توفيرخدمة فريدة من نوعها ومصممة لعملائها. ويعود ذالك إلى  أسسها القوية في الشرق الأوسط والخبرة في مجال القطاعات الواسعة من خلال فريق من المتخصصين، تمتلك الترا فورنتير كلا من الأدوات والرؤية لتقديم خدمة لا مثيل لها لتلبية احتياجات عملائها المتنوعة. حيث تبقى باستمرار على نبض تغيير المناخات الاقتصادية وتقلبات السوق.</p>
                                @endif
                                
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>      
@stop