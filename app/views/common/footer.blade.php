<div class="footer">
	<div class="footer-topbar"></div>
    	<div class="footer-content container">
        	<div class="row">
                <div class="footer-col col-md-4">
                	<a class="twitter-timeline" data-dnt="true" href="https://twitter.com/ilOsool" data-widget-id="487169273995857923">Tweets by @ilOsool</a>
					<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                </div>
                <div class="footer-col col-md-2">
                	<ul>
                    	<li><h5>{{trans('menu.footer.main')}}</h5></li>
                        <li><a href="{{ URL::route('page', 'about') }}">{{trans('menu.topmenu.about')}}</a></li>
                        <li><a href="{{ URL::route('page', 'asset_classes') }}">{{trans('menu.topmenu.asset_class')}}</a></li>
                        <li><a href="{{ URL::route('posts', 'news') }}">{{trans('menu.topmenu.news_center')}}</a></li>
                        <li><a href="{{ URL::route('page', array('slug' => 'admin_policy')) }}">{{trans('menu.topmenu.admin_policy')}}</a></li>
                        <li><a href="{{ URL::route('page.contact') }}">{{trans('menu.topmenu.contact')}}</a></li>
                    </ul>
                    
                    <!-- <ul>
                        <li><h5>Ilosool asset clasess</h5></li>
                        <li><a href="{{ URL::route('page', 're') }}">Real Estate</a></li>
                        <li><a href="{{ URL::route('page', 'vc') }}">Venture Capital</a></li>
                        <li><a href="{{ URL::route('page', 'pe') }}">Private Equity</a></li>
                    </ul> -->
                </div>
                <div class="footer-col col-md-3">
                    <ul>
                        <li><h5>{{trans('menu.footer.ilosool_system')}}</h5></li>
                        <li><a href="{{ URL::route('page', 'how-it-works') }}">{{trans('menu.topmenu.how')}}</a></li>

                        <li><a href="{{ URL::route('page', 'faq')}}">{{trans('menu.footer.faq')}}</a></li>

                        <li><a href="{{ URL::route('page', 'terms') }}">{{trans('menu.topmenu.terms')}}</a></li>

                        <li><a href="{{ URL::route('page', 'disclaimer')}}">{{trans('menu.footer.disclaimer')}}</a></li>

                        <li><a href="{{ URL::route('page', 'nda') }}">{{trans('menu.footer.nda')}}</a></li>

                        @if(Auth::check())
                            <li><a href="{{ URL::route('profile') }}">{{trans('menu.topmenu.profile')}}</a></li>
                            <li><a href="{{ URL::route('logout') }}">{{trans('menu.topmenu.logout')}}</a></li>
                        @else
                            <li><a href="{{ URL::route('login') }}">{{trans('menu.topmenu.login')}}</a></li>
                        @endif
                    </ul>
                </div>
                <div class="col-md-3">
                	<div class="footer-social">
                    	<ul class="clearfix">
                        	<li class="col-md-3"><a href="{{ getOption('facebook') }}" target="_blank"><img src="{{ asset('images/facebook.png')}}" /></a></li>
                            <li class="col-md-3"><a href="{{ getOption('twitter') }}" target="_blank"><img src="{{ asset('images/twitter.png')}}" /></a></li>
                            <li class="col-md-3"><a href="{{ getOption('linkedin') }}" target="_blank"><img src="{{ asset('images/linkedin.png')}}" /></a></li>
                            <li class="col-md-3"><a href="{{ getOption('googleplus') }}" target="_blank"><img src="{{ asset('images/googleplus.png')}}" /></a></li>
                        </ul>
                    </div>

                    <!-- <div class="footer-contact">
                        {{ getOption('address') }}
                    </div> -->

                    <div class="footer-copyright">
                        <h4>{{trans('menu.footer.rights_reserved')}} © <?php echo date("Y"); ?> ilOsool.com</h4>
                        <h4>Powered By <a href="http://insightgroup.me" target="_blank">INSIGHT GROUP</a></h4>
                    </div>
                </div>
        </div>
    </div>
    <div class="footer-bottombar"></div>
</div>