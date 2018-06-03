(function($){

    $.fn.shareMe = function(options){
        var settings = $.extend({
                data: {
                    title: '',
                    description: '',
                    url: '',
                    media: '',
                    via: ''
                }
            }, options);

        var sites = {
            pinterest: {
                url: 'http://pinterest.com/pin/create/button/?url={{url}}&media={{media}}&description={{description}}',
                popup: {
                    width: 685,
                    height: 500
                },
                link : false
            },
            facebook: {
                url: 'https://www.facebook.com/sharer/sharer.php?s=100&p[title]={{title}}&p[summary]={{description}}&p[url]={{url}}&p[images][0]={{media}}',
                popup: {
                    width: 626,
                    height: 436
                },
                link : false
            },
            twitter: {
                url: 'https://twitter.com/share?url={{url}}&via={{via}}&text={{description}}',
                popup: {
                    width: 685,
                    height: 500
                },
                link : false
            },
            googleplus: {
                url: 'https://plus.google.com/share?url={{url}}',
                popup: {
                    width: 600,
                    height: 600
                },
                link : false
            },
            linkedin: {
                url: 'https://www.linkedin.com/shareArticle?summary={{description}}&ro=false&title={{title}}&mini=true&url={{url}}&source=',
                popup: {
                    width: 600,
                    height: 600
                },
                link : false
            },
            email: {
                url: 'mailto:?subject={{title}}&body=%0A{{url}}%0A{{description}}',
                link : true
            }
        };

        var popup = function(site, url){
            var left = (window.innerWidth/2) - (site.popup.width/2),
                top = (window.innerHeight/2) - (site.popup.height/2);

            return window.open(url, '', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' + site.popup.width + ', height=' + site.popup.height + ', top=' + top + ', left=' + left);
        };

        var share = function(site, data){
            if(!site) return;

            data = data || {};
            data.title = data.title || settings.data.title;
            data.description = data.description || settings.data.description;
            data.url = data.url || settings.data.url;
            data.media = data.media || settings.data.media;
            data.via = data.via || settings.data.via;

            var url = site.url.replace(/{{url}}/g, encodeURIComponent(data.url))
              .replace(/{{title}}/g, encodeURIComponent(data.title))
              .replace(/{{description}}/g, encodeURIComponent(data.description))
              .replace(/{{media}}/g, encodeURIComponent(data.media))
              .replace(/{{via}}/g, encodeURIComponent(data.via));

            if(site.link) window.location.href = url;
            else popup(site, url);
        };

        return this.each(function(){
            var $this = $(this),
                type = $this.data('type');

            $this.bind('click', function(event){
                event.preventDefault();

                share(sites[type], {
                    title: $this.data('title'),
                    description: $this.data('description'),
                    url: $this.data('url'),
                    media: $this.data('media'),
                    via: $this.data('via')
                });

                return false;
            });
        });
    };

})(jQuery);