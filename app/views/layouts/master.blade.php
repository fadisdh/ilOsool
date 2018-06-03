<!doctype html>
<html lang="en" {{ isset($page_html) ? $page_html : '' }}>
<head>
    <meta charset="UTF-8">

    <title>
        @section('title')
            ilOsool Market Place
        @show | ilOsool
    </title>

    @section('meta')
        <meta name="description" content="{{ isset($page_description) ? $page_description : '' }}" />
        <meta name="keywords" content="{{ isset($page_keywords) ? $page_keywords : '' }}" />
    @show

    @section('links')
        <link rel="shortcode icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    @show

    @section('styles')
        {{ HTML::style('css/bootstrap/bootstrap.min.css') }}
        
        {{ HTML::style('css/common.css') }}
        @if(getLocale() == 'ar')
            {{ HTML::style('http://cdnjs.cloudflare.com/ajax/libs/bootstrap-rtl/3.2.0-rc2/css/bootstrap-rtl.min.css') }}
            {{ HTML::style('css/rtl.css') }}
        @endif
        <!-- DatePicker -->
        {{ HTML::style('js/vitalets-bootstrap-datepicker/datepicker.css') }}
        
        <!-- Toggle -->
        {{ HTML::style('js/jquery-toggles/toggles.css') }}
        {{ HTML::style('js/jquery-toggles/themes/toggles-modern.css') }}
    @show

    @section('scripts')
        {{ HTML::script('js/jquery/jquery-1.10.2.min.js') }}
        {{ HTML::script('js/jquery.easing.1.3.js') }}
        
        <!--{{ HTML::script('js/jquery/jquery-migrate-1.2.1.min.js') }}-->
        {{ HTML::script('//tinymce.cachefly.net/4.0/tinymce.min.js') }}
        {{ HTML::script('js/jquery.tmpl.min.js') }}
        {{ HTML::script('js/bootstrap/bootstrap.min.js') }}
        {{ HTML::script('js/bootstrap/respond.min.js') }}
        {{ HTML::script('js/main.js') }}

        <!-- DatePicker -->
        {{ HTML::script('js/vitalets-bootstrap-datepicker/bootstrap-datepicker.js') }}
        
        <!-- Toggle -->
        {{ HTML::script('js/jquery-toggles/toggles.min.js') }}
        <!-- Include the LinkedIn JavaScript API and define a onLoad callback function -->
        @if (!Auth::check())
            @include('script.linkedin')
            <script type="text/javascript">
              var registerType = null;

              function loginWithLinkidin(type){
                registerType = type;
                IN.User.authorize();
              }

              function onLinkedInLoad() {
                IN.Event.on(IN, "auth", function(){
                     IN.API.Profile("me").fields('emailAddress','firstName','lastName','mainAddress','location','phoneNumbers', 'dateOfBirth').result(function(data){
                        user = data.values[0];
                        if(user.phoneNumbers){
                            phone = (user.phoneNumbers.values) ? user.phoneNumbers.values[0].phoneNumber : '';
                        }else{
                            phone = '';
                        }
                        if(user.dateOfBirth){
                            dateOfBirth = user.dateOfBirth.year + '-' + (user.dateOfBirth.month < 10 ? '0' + user.dateOfBirth.month : user.dateOfBirth.month) + '-' + (user.dateOfBirth.day < 10 ? '0' + user.dateOfBirth.day : user.dateOfBirth.day);
                        }else{
                            dateOfBirth = '';
                        }

                        location.href = "{{ URL::route('linkedin_login') }}?" + "email=" + user.emailAddress + "&firstName=" + user.firstName + "&lastName=" + user.lastName + "&mainAddress=" + user.mainAddress + "&location=" + user.location.name + "&phoneNumber=" + phone + "&birth=" + dateOfBirth + '&type=' + registerType;
                     });
                });
              }
            </script>
        @endif

         <script language="javascript" type="text/javascript">
         
            $(function(){
                $(document).on('change', '#folder-select', function(){
                    var $this = $(this);
                    var $folderNew = $('#folder-new');

                    if($this.val() == 'new'){
                        $folderNew.slideDown();
                    }else{
                        $folderNew.slideUp();
                    }
                });
            });
        
        </script>
    @show

    @section('inline_style')
        
    @show

    @section('inline_script')
        
    @show

    @section('analytics')
        <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-52340003-1', 'auto');
          ga('send', 'pageview');

        </script>

<!-- Start of Woopra Code -->
<script>
(function(){
        var t,i,e,n=window,o=document,a=arguments,s="script",r=["config","track","identify","visit","push","call","trackForm","trackClick"],c=function(){var t,i=this;for(i._e=[],t=0;r.length>t;t++)(function(t){i[t]=function(){return i._e.push([t].concat(Array.prototype.slice.call(arguments,0))),i}})(r[t])};for(n._w=n._w||{},t=0;a.length>t;t++)n._w[a[t]]=n[a[t]]=n[a[t]]||new c;i=o.createElement(s),i.async=1,i.src="//static.woopra.com/js/w.js",e=o.getElementsByTagName(s)[0],e.parentNode.insertBefore(i,e)
})("woopra");

woopra.config({
    domain: 'ilosool.com'
});
woopra.track();
</script>
<!-- End of Woopra Code -->
    @show

</head>
<body {{ isset($page_body) ? $page_body : '' }} >
    <!--[if lt IE 8]>
    <div class="old-browsers">
        <div class="center-box">
            <p>You are using a very old browser that ilOsool no longer supports for security and performance reasons. In order to use ilOsool please install one of the following free modern browsers</p>
            <div>
                <a href="http://chrome.com" target="_blank" title="Chrome">
                    <img src="{{ asset('images/chrome.png')}}" />
                </a>
                <a href="http://firefox.com" target="_blank" title="Firefox">
                    <img src="{{ asset('images/firefox.png')}}" />
                </a>
                <a href="http://opera.com" target="_blank" title="Opera">
                    <img src="{{ asset('images/opera.png')}}" />
                </a>
                <a href="http://www.apple.com/safari/download/" target="_blank" title="Safari">
                    <img src="{{ asset('images/safari.png')}}" />
                </a>
                <a href="http://windows.microsoft.com/en-US/internet-explorer/downloads/ie/" target="_blank" title="IE">
                    <img src="{{ asset('images/ie.png')}}" />
                </a>
            </div>
        </div>
    </div>
    <![endif]-->
    @section('header')
        
    @show
        
    @section('content')
        
    @show

    @section('footer')
        <div id="modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="hline"></div>
                    <div class="modal-header popup-profile-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-loading">Loading ...</div>
                    <div class="modal-container" style="display:none;"></div>
                </div>
            </div><!-- /.modal-dialog -->
        </div>

        <div id="register-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="hline"></div>
                    <div class="modal-header popup-profile-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-loading">Loading ...</div>
                    <div class="modal-container" style="display:none;"></div>
                </div>
            </div><!-- /.modal-dialog -->
        </div>
    @show

    @section('styles_footer')

    @show

    @section('scripts_footer')

    @show
</body>
</html>