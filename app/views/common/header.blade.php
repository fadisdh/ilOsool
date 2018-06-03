<div class="header">
	<div class="header-topbar dark-bg">
       
        @if(can('admin.view'))
            <!-- <div class="admin-link">
                Welcome, <a href="{{ URL::route('admin') }}">{{ Auth::user()->firstname . ' ' .Auth::user()->lastname }}</a>
            </div> -->
        @endif
        
        <div class="top-menu">
            <ul class="list-unstyled">
                <li class="searchbox">
                    {{ Form::open(array('route' => 'pages',
                                'method' => 'get')) }}
                        {{ Form::text('search', Input::get('search'), array('class' => 'search animation', 'placeholder' => trans('general.search'))) }}
                    {{ Form::submit('', array('class' => 'search-btn')) }}
                    {{ Form::close() }}
                </li>
                
                @if(Config::get('app.locale') == 'en')
                    <li class="top-menu-item"><a href="{{ Request::url() . '?lang=ar' }}">عربي</a></li>
                @else
                    <li class="top-menu-item"><a href="{{ Request::url() . '?lang=en' }}">English</a></li>
                @endif
                <li class="top-menu-item"><a href="{{ URL::route('page', array('slug' => 'about')) }}">{{trans('menu.topmenu.about')}}</a></li>
                <li class="top-menu-item"><a href="{{ URL::route('page', array('slug' => 'asset_classes')) }}">{{trans('menu.topmenu.asset_class')}}</a></li>
                <li class="top-menu-item"><a href="{{ URL::route('posts', array('type' => 'news')) }}">{{trans('menu.topmenu.news_center')}}</a></li>
                <li class="top-menu-item"><a href="{{ URL::route('page.partners') }}">{{trans('menu.topmenu.partners')}}</a></li>
                <li class="top-menu-item"><a href="{{ URL::route('page', array('slug' => 'admin_policy')) }}">{{trans('menu.topmenu.admin_policy')}}</a></li>
                <li class="top-menu-item"><a href="{{ URL::route('page.contact') }}">{{trans('menu.topmenu.contact')}}</a></li>
            </ul>
        </div>
    </div>
	<div class="logo"><a href="{{ URL::route('home') }}">{{ HTML::image('images/logo.png') }}</a></div>
    <div id="mainmenu" class="mainmenu">
    	<ul class="mainmenu-wrapper list-unstyled">
        	<li class="mainmenu-item yellow-bg clickable">
        		<div class="bar yellow-bg dark"></div>
        		<a href="#box-help" class="mainmenu-link">{{trans('menu.topmenu.help')}}</a>
        	</li>
            @if(Auth::check())
                <li class="mainmenu-item green-bg clickable">
                    <div class="bar green-bg dark"></div>
                    <a href="#box-profile" class="mainmenu-link">{{trans('menu.topmenu.profile')}}</a>
                </li>
                <li class="mainmenu-item blue-bg clickable">
                    <div class="bar blue-bg dark"></div>
                    <a href="{{ URL::route('logout') }}" class="mainmenu-link">{{trans('menu.topmenu.logout')}}</a>
                </li>
            @else
                <li class="mainmenu-item green-bg clickable">
                    <div class="bar green-bg dark"></div>
                    <a href="#box-signup" class="mainmenu-link">{{trans('menu.topmenu.signup')}}</a>
                </li>
                <li class="mainmenu-item blue-bg clickable">
                    <div class="bar blue-bg dark"></div>
                    <a href="#box-login" href="{{ URL::route('login') }}" class="mainmenu-link">{{trans('menu.topmenu.login')}}</a>
                </li>
            @endif
        </ul>
        <div id="mainmenu-boxes" class="mainmenu-boxes">
            <div id="box-help" class="mainmenu-box yellow-bg">
                <ul class="link-list">
                    <li><a href="{{ URL::route('page', 'how-it-works') }}"><span class="glyphicon glyphicon-facetime-video"></span> &nbsp; {{trans('menu.topmenu.how')}}</a></li>
                    <li><a href="{{ URL::route('page', 'faq')}}"><span class="glyphicon glyphicon-question-sign"></span> &nbsp; {{trans('menu.topmenu.faq')}}</a></li>
                    <li><a href="{{ URL::route('page.contact') }}"><span class="glyphicon glyphicon-envelope"></span> &nbsp; {{trans('menu.topmenu.contact')}}</a></li>
                    <li><a href="{{ URL::route('page', 'terms') }}"><span class="glyphicon glyphicon-list-alt"></span> &nbsp; {{trans('menu.topmenu.terms')}}</a></li>
                </ul>
            </div>
            <div id="box-signup" class="mainmenu-box green-bg">
                <ul class="link-list">
                    <li><a class="popup" href="javascript:void(0);" data-href="{{ URL::route('register.popup')}}?type=individual" data-title="{{trans('menu.topmenu.register_as_individual')}}"><span class="glyphicon glyphicon-user"></span> &nbsp; {{trans('menu.topmenu.register_as_individual')}}</a></li>
                    <li><a class="popup" href="javascript:void(0);" data-href="{{ URL::route('register.popup')}}?type=company" data-title="{{trans('menu.topmenu.register_as_company')}}"><span class="glyphicon glyphicon-user"></span> &nbsp; {{trans('menu.topmenu.register_as_company')}}</a></li>
                    <li><a class="popup" href="javascript:void(0);" data-href="{{ URL::route('register.popup')}}?type=agent" data-title="{{trans('menu.topmenu.register_as_agent')}}"><span class="glyphicon glyphicon-user"></span> &nbsp; {{trans('menu.topmenu.register_as_agent')}}</a></li>
                </ul>
            </div>
            @if(Auth::check())
                <div id="box-profile" class="mainmenu-box green-bg">
                    <ul class="link-list">
                        <li><a href="{{ URL::route('profile') }}"><span class="glyphicon glyphicon-user"></span> &nbsp; {{trans('menu.topmenu.profile_info')}}</a></li>
                        <li><a href="{{ URL::route('profile.investment') }}"><span class="glyphicon glyphicon-usd"></span> &nbsp; {{trans('menu.topmenu.investment_info')}}</a></li>
                        <!--  <li><a href="{{ URL::route('profile.files') }}"><span class="glyphicon glyphicon-folder-open"></span> &nbsp; Files</a></li>
                        <li><a href="{{ URL::route('profile.orders') }}"><span class="glyphicon glyphicon-hand-up"></span> &nbsp; My Investments</a></li> -->
                        @if(Auth::user()->rule->hasPermission('company.add'))
                            <li><a href="{{ URL::route('profile.companies') }}"><span class="glyphicon glyphicon-th-list"></span> &nbsp; {{trans('menu.topmenu.my_listings')}}</a></li>
                        @endif
                        <li><a  href="{{ URL::route('profile.bookmarks') }}"><span class="glyphicon glyphicon-book"></span>&nbsp; {{trans('menu.topmenu.my_bookmarks')}}</a>
                        <li><a href="{{ URL::route('profile.notifications') }}"><span class="glyphicon glyphicon-bullhorn"></span>&nbsp; {{trans('menu.topmenu.notifications')}}</a></li>
                        <li><a href="{{ URL::route('messages') }}"><span class="glyphicon glyphicon-envelope"></span>&nbsp; {{trans('menu.topmenu.messages')}}</a>
                        </li>
                    </ul>
                </div>
            @endif

            <div id="box-login" class="mainmenu-box blue-bg">
                {{ Form::open(array('route' => 'login.post', 'class' => 'form login-popup')) }}
                    <input type="email" name="email" placeholder="Email">

                    <input type="password" name="password" placeholder="password">

                    <div class="checkbox">
                        <label><input type="checkbox" name="remember" />&nbsp; {{trans('menu.topmenu.remember')}}</label>
                    </div>

                    <div class="forgot-pass">
                        <a class="popup" href="javascript:void(0);" data-href="{{ URL::route('passreminder')}}" data-title="Password Reset">{{trans('menu.topmenu.forget_password')}}</a>
                    </div>
                    
                    <div class="login-btn">
                        {{ Form::submit(trans('menu.topmenu.login'), array('class' => 'btn btn-default')) }}
                    </div>
                    
                    <div class="login-separator">
                        <div class="separator"><h3>{{trans('menu.topmenu.or')}}</h3></div>
                    </div>
                    <a href="javascript:loginWithLinkidin('');" class="linkedin-login-btn">{{trans('menu.topmenu.login_linkedin')}}</a>
                    
                    {{ Form::token(); }}
                {{ Form::close() }}


            </div>
        </div>
    </div>
</div>
   