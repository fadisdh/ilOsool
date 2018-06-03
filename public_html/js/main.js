$(function(){
    // Text Editor
    tinymce.init({
    	plugins: ['autolink link image wordcount code'],
    	selector:'.editor'
    });

    // Header Boxes
    var $mainmenu = $('#mainmenu');
    var $mainmenu_lis = $mainmenu.find('li.mainmenu-item');
    var $mainmenu_links = $mainmenu_lis.find('a.mainmenu-link');
    var $mainmenu_boxes = $('#mainmenu-boxes .mainmenu-box');

    $mainmenu_links.click(function(e){
    	var $this = $(this);
    	var href = $this.attr('href');

    	if(href.indexOf('#') != 0) return;
        else e.preventDefault();

    	var $parent = $this.parent();
		var obj = $(href);
		
		if(!$parent.hasClass('clickable')){
			obj.slideUp('fast');
			$parent.addClass('clickable');
			$('body').off('click');
		}else{
			$mainmenu_lis.addClass('clickable');
			$parent.removeClass('clickable')
	
			$mainmenu_boxes.slideUp('fast');
			obj.slideDown('fast');

			$('body').click(function(e){
		    	if (!$(e.target).parents('.mainmenu-box').length){
                    $mainmenu_boxes.slideUp('fast');
                    $mainmenu_lis.addClass('clickable')
                }
		    });
		}	
    	return false;
    });

    /*$mainmenu_boxes.on('click', function(e) {
    	e.stopPropagation();
    });*/
});

//Company timer
$(function(){
    var $timer = $('#timer');
    if(!$timer) return;

    var $days = $('#timer-days'),
        $hours = $('#timer-hours'),
        $mins = $('#timer-mins'),
        $secs = $('#timer-secs'),
        $finished = $('#timer-finished');

    var days = parseInt($days.text()),
        hours = parseInt($hours.text()),
        mins = parseInt($mins.text()),
        secs = parseInt($secs.text()),
        finished = false;


    function tick(){
        secs--;
        if(secs < 0){
            secs = 59;
            mins--;
            if(mins < 0){
                mins = 59;
                hours--;
                if(hours < 0){
                    hours = 23;
                    days--;
                    if(days < 0){
                        finished = true;
                    }
                }
            }
        }

        if(finished){
            $timer.hide();
            $finished.fadiIn();
        }else{
            $days.text(days);
            $hours.text(hours);
            $mins.text(mins);
            $secs.text(secs);
        }

        setTimeout(tick, 1000);
    }

    tick();
});

// Popup-Over
$(function(){
    $('.hint').popover({ trigger: "hover" });

    $('.ilosool-name').popover({
        trigger: "hover",
        html: true,
        content: 'The word ilOsool was derived from the Arabic word (الأصول) (il-Osool) which means assets.',
        title: ''
    });
});

// Modal
$(function(){
    var $modal = $('#modal');
    var $title = $modal.find('.modal-title');
    var $container = $modal.find('.modal-container');
    var $loading = $modal.find('.modal-loading');

    $(document.body).on('click', '.popup', function(e){
        //e.preventDefault();
        var $this = $(this);
        var href = $this.attr('data-href') || $this.attr('href');
        var title = $this.attr('data-title');
        var refresh = $this.attr('data-refresh');
        
        $title.text(title);
        $modal.modal('show');

        $.ajax({
            url : href,
            beforeSend: function(){
                $loading.show();
                var toggleClass = $this.attr('data-class');
                if(toggleClass) $this.addClass(toggleClass);
            },
            complete: function(){
                $loading.hide();
            },
            error: function(){
                alert('Error in Connection');
            },
            success: function(data){
                $container.html(data);
                $container.show('fast');
                if(data.refresh || refresh) window.location.reload();
            }
        });

        return false;
    });

    $modal.on('hidden.bs.modal', function () {
        $title.text('');
        $container.html('<div class="loading"></div>');
        $container.hide();
    });
});

// Ajax
$(function(){
    $(document.body).on('click', 'a.ajax', function(e){
        e.preventDefault();
        var $this = $(this);
        var href = $this.attr('href');
        var $res = $($this.attr('data-res'));
        var dataType = $this.attr('data-type');
        var txt = $this.text();
        var refresh = $this.attr('data-refresh');

        $.ajax({
            url : href,
            dataType: dataType || 'json',
            beforeSend: function(){
                $this.addClass('loading disabled').text('Loading');
            },
            complete: function(){
                $this.removeClass('loading disabled').text(txt);
            },
            error: function(){
                $res.text('Error in Connection');
            },
            success: function(data){
               $res.html(data.message);
               if(data.refresh || refresh) window.location.reload();
            }
        });

        return false;
    });  
});

// Ajax Form
$(function(){
    $(document.body).on('submit', 'form.ajax', function(e){
        e.preventDefault();
        var $this = $(this);
        var href = $this.attr('action');
        var method = $this.attr('method') || 'GET';
        var $res = $($this.attr('data-res'));
        var dataType = $this.attr('data-type');
        var refresh = $this.attr('data-refresh');

        var $submit = $this.find('[type="submit"]');
        var txt = $submit.text();

        $.ajax({
            url : href,
            type: method,
            data: $this.serialize(),
            dataType: dataType || 'json',
            beforeSend: function(){
                $submit.addClass('loading disabled').text('Loading');
            },
            complete: function(){
                $submit.removeClass('loading disabled').text(txt);
            },
            error: function(){
                $res.text('Error in Connection');
            },
            success: function(data){
               $res.html(data.message);
               if(data.refresh || refresh) window.location.reload();
            }
        });

        return false;
    });  
});

// Stepper
$(function(){
    var $top = $('#topmenu');
    if($top.length == 0) $top = $('.page-container');

    var $stepper = $('#stepper');
    if(!$stepper) return;

    var $wrapper = $stepper.find('.stepper-wrapper');
    var $items = $stepper.find('.stepper-item');
    var $controls = $stepper.find('.stepper-control');
    var $errorInputs = $stepper.find('.form-group.has-error');
    var stepper_width = $stepper.width();
    var top_offset = $top.offset();

    var $bar = $('#stepper-bar');
    var $bar_fill = $bar.find('.bar-fill');
    var $points = $bar.find('.point');

    var init_bar_fill = Math.floor(100/ ($points.length - 1));

    $wrapper.width(stepper_width * $items.length);
    $items.css('width', stepper_width);

    $controls.click(function(e){
        e.preventDefault();
        var $this = $(this);
        var loc = $this.attr('data-goto');
        $points.eq(loc - 1).click();
        return false;
    });

    $points.click(function(e){
        e.preventDefault();

        var $this = $(this);
        var index = $this.attr('id');
        var width = (init_bar_fill * index - init_bar_fill/2);
        if(width > 100) width = 100;

        $points.removeClass('selected');
        $points.slice(0, index).addClass('selected');

        $wrapper.stop(true, true).animate({
                'left': -1 * (index - 1) * stepper_width
        }, 'fast', 'linear', function(){
            $bar_fill.width(width + '%');
            $("html, body").animate({
                scrollTop: top_offset.top
            }, 400);
        });
        return false;
    });

    $errorInputs.each(function(){
        var $this = $(this);
        var $parent = $this.parents('.stepper-item');
        var index = $items.index($parent);
        $points.eq(index).addClass('error');
    });
    $points.filter('.error').first().click();
});

// Confirm
$(function(){
    $('body').on('click', '.confirm-action', function(){
        var $this = $(this);
        var action = $this.attr('data-action');
        if(!action) action = 'delete';
        if(!confirm('Are you sure you want to ' + action + ' ' + $this.attr('data-name'))){
            return false;
        }
    });
});

// Bootstrap Datepicker
$(function(){
    $('.datepicker').datepicker({
        format : 'yyyy-mm-dd',
        weekStart : 6,
        autoclose: true,
        todayBtn: 'linked'
    });
});

// Show/Hide Toggle
$(function(){
    $('.toggle').each(function(){
        var $this = $(this),
            $target = $($this.attr('data-target')),
            value = $this.attr('data-value');

        if(value == 1) $target.attr('checked', 'checked');
        $this.toggles({
            text:{on:'Public',off:'Private'},
            on: value == "1" ? true : false,
            checkbox: $target,
            width: 100,
            height: 32,
        });
    });
});

//Notifications
$(function(){
    $notifications_links = $('.notifications-opener');
    $notifications_boxes = $('.notifications-box');

    $notifications_links.click(function(){
        var $this = $(this),
            $wrapper = $($this.data('ref')),
            url = $this.data('url');
        
        if(url){
            $.ajax({
                url: url,
                dataType: 'JSON',
                type: 'post'
            });
        }

        if($wrapper.hasClass('selected')){
            $wrapper.slideUp('fast');
            $wrapper.removeClass('selected');
        }else{
            $notifications_boxes.slideUp('fast');
            $notifications_boxes.removeClass('selected');

            $wrapper.slideDown('fast');
            $wrapper.addClass('selected');
        }
    });
});

// Home carousel
$(function(){
    var $carousel = $('#carousel');
    var $wrapper = $carousel.find('.wrapper');
    var $items = $wrapper.find('.item');

    var $next = $carousel.find('.next');
    var $prev = $carousel.find('.prev');

    var current = 0;

    $next.click(function(e){
        e.preventDefault();
        current = go(current + 1);
        return false;
    });

    $prev.click(function(e){
        e.preventDefault();
        current = go(current - 1);
        return false;
    });

    function go(i){
        if(i >= $items.length){
            $wrapper.animate({
                left : '-=20'
            }, 600, 'easeInExpo', function(){
                $wrapper.stop(true).animate({
                    left: '+=20'
                })
            });
            return i = $items.length - 1;
        }else if(i <  0){
            $wrapper.animate({
                left : '+=20'
            }, 600, 'easeInExpo', function(){
                $wrapper.stop(true).animate({
                    left: '-=20'
                })
            });
            return 0;
        }else{
            $wrapper.animate({
                left : -i * $items.outerWidth()
            }, 600, 'easeInExpo');
            return i;
        }
    }
});

// Sub Menu
$(function(){
    var $topmenu = $('#topmenu');
    var $menu = $topmenu.find(".parent");

    $menu.mouseenter(function() {
        $(this).find(".submenu").slideDown('fast');
    });

    $menu.mouseleave(function() {
         $(this).find(".submenu").slideUp('fast');
    });
});