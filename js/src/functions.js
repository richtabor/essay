/**
 * Theme javascript functions file.
 *
 */
( function( a ) {
	"use strict";

	var  body = a("body"),
		b 	= a("#nav-btn"),
		c 	= a("#fullscreen-nav"),
		d 	= a(".site-hero"),
		e 	= body.find(".entry-content"),
		f 	= e.find(".alignnone"),
		q 	= e.find("blockquote"),
		s 	= a(".video-background.embedded iframe"),
		sn 	= a("#social-navigation"),
		cb   = a('.comments-btn'),
		cl   = a('.comment-list'),
		rb   = a('.respond-btn'),
		cf   = a('.comment-respond'),
		pm   = a('.primary-menu'),

		dur = 200;


	/* Fullwidth '.alignnone' Images */ 
	function g() {
		f.each(function() {
			var n = a(this);
			n.hasClass("wp-caption") ? (n.css({
				"margin-left": e.width() / 2 - a(window).width() / 2,
				"max-width": "none"
			}), n.add(n.find("img")).css("width",  a(window).width() )) : n.css({
				"margin-left": e.width() / 2 - a(window).width() / 2,
				"max-width": "none",
				width: a(window).width()
			})
		})
	}

	/* Fullscreen .site-hero */ 
	function h() {
		if( d.hasClass('fullscreen') ) {
			if( body.hasClass('admin-bar') ) {
				d.css({ "height": a(window).height() - 32 + 'px' });
			} else {
				d.css({ "height": a(window).height() + 'px' });
			}
		}
	}

	/* Fullwidth blockquote */ 
	function i() {
		q.each(function() {
			var n = a(this);
			n.css({
				"margin-left": e.width() / 4 - a(window).width() / 4,
				"margin-right": e.width() / 4 - a(window).width() / 4
			})
		})
	}

	/* Navigation dropdowns */
	function j() {
	     a("li.menu-parent-item a").addClass('sub-menu-link');
		a(".sub-menu a").removeClass('sub-menu-link');
		a('#fullscreen-nav .sub-menu').hide();
		a('#fullscreen-nav li a').click(function(event){
			if (a(this).next('ul.sub-menu').children().length !== 0) {     
		     	event.preventDefault();
			}
			a(this).siblings('.sub-menu').slideToggle(150);
			a(this).toggleClass( "open" );
		});
	}

	/* Parallax hero area */
	function k() {
		if( a('body').hasClass('single') && a('.site-hero .image-background').hasClass('parallax') ) { 
			if (a(".site-hero .entry-header").length) {
				var  hb = body.outerHeight(),
					he = a(".site-hero .entry-header .inner"),
					hi = a(".site-hero .image-background"),
					hv = a(".site-hero .video-background");

				a(window).on("scroll", function() {
		               var vb = 1 - a(window).scrollTop() / hb * 2;
		               0 >= vb && (vb = 0), 
		               he.css({ opacity: vb });
		               hi.css({ transform: "translate(0, " + .35 * a(window).scrollTop() + "px)" });
		               hv.css({ transform: "translate(0, " + .35 * a(window).scrollTop() + "px)" });
		          });
			}
		}
	}

	/* Smooth scrolling links */
	function l() {
		a('.back-to-top, .scroll-more').on("click", function() {
			event.preventDefault();
			if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
				var target = a(this.hash); target = target.length ? target : a('[name=' + this.hash.slice(1) +']');
				if (target.length) {
					if( a(this).hasClass('scroll-more') ) {
						body.animate({ scrollTop: target.offset().top - 90}, 1300);
					} else {
						if( body.hasClass('admin-bar') ) {
							body.animate({ scrollTop: target.offset().top - 32 }, 1300);
						} else {
							body.animate({ scrollTop: target.offset().top }, 1300);
						}
					}
					return false;
				}
			}
		});
	}

	/* Fade in .back-to-top after scrolling 500px */
	function m() {
		var topLink = a('.back-to-top');
		if(jQuery(window).scrollTop() > 500) {
			topLink.fadeIn(500);
		} else {
			topLink.fadeOut(500);
		}
	}

	/*  Retina logo function */
	function n() {
		// a('.site-logo').load(function(){
		    a('img.site-logo:not([src^="@2x"])').each(function() {
		        var imgW = a(this).width() / 2;
		        var imgH = a(this).height() / 2;
		        a(this).attr('width', imgW);
		        a(this).attr('height', imgH);
		    });
		//});
	}

	/* fitVids */
	a("body").fitVids();

	/* Loading Progress Bar */ 
	NProgress.configure({
	     minimum: .2,
	     showSpinner: !1
	}),
		       
	document.onreadystatechange = function () {
		if (document.readyState == "interactive") {
	    		NProgress.start();
		}
	}

	var everythingLoaded = setInterval(function() {
		if (/loaded|complete/.test(document.readyState)) {
			clearInterval(everythingLoaded);
			setTimeout(function(){NProgress.done()},2000);
		}
	}, 10);

	/* Add loading class */ 	
	setTimeout(function() {
	     body.addClass("loaded")
	}, 20);

	/* Navigation Button */ 
	b.on("click", function(a) {
		a.preventDefault(), body.toggleClass("open-nav"),

		/* Add animation classes to the list items */ 
		!body.hasClass("open-nav") ? pm.find("li").removeClass("animate") : pm.find("li").each(function(a) {
			setTimeout(function() {
				pm.find("li").eq(a).addClass("animate")
			}, 55 * a)
		}),
		/* Add animation classes to the social icons */ 
		!body.hasClass("open-nav") ? sn.find("li").removeClass("animate") : sn.find("li").each(function(a) {
			setTimeout(function() {
				setTimeout(function() {
					sn.find("li").eq(a).addClass("animate")
				}, 100 * a)
			}, 250);
		})
	});

	/* Document Ready */
	a(document).ready(function() {
	     g(), h(), i(), j(), k(), l(), n();

	     if (jQuery().validate) { jQuery("#commentform").validate();  jQuery(".bean-contact-form").validate(); }

		/* Add focus to no-results input on page load */ 
		if( a('body').hasClass('search-no-results') ) {
			setTimeout(function() {
			    a('.search-field').focus();
			}, 20);
		}

		/* Fade out links */ 
		function b() {  window.location = d } var d;

		a("a:not(.sub-menu-link)").on("click", function(a) {
			return "" == this.href || null == this.href ? void a.preventDefault() : void(-1 == this.href.indexOf("#") && -1 == this.href.indexOf("mailto:") && -1 == this.href.indexOf("javascript:") && "_blank" != this.target && (a.preventDefault(), d = this.href, 
			body.removeClass("loaded"), setTimeout(b, 200)))
		});

		/* Comments Reveal */ 	
		cb.on('click', function(a) { 
			a.preventDefault();
			if( cb.hasClass('active') ) {
				cl.slideUp( dur , function() {
					cb.removeClass('active');
					cl.removeClass('active');
					cl.fadeOut(dur);
				});	
			} else {
				cl.slideDown( dur , function() {
	   				cb.addClass('active');
					cl.addClass('active');
					cl.fadeIn(dur);
	 			});
			}
		});

		/* Respond Reveal */ 	
		rb.on('click', function(a) { 
			a.preventDefault();
			if( rb.hasClass('active') ) {
				cf.slideUp( dur , function() {
					rb.removeClass('active');
					cf.removeClass('active');
					cf.fadeOut(dur);
				});	
			} else {
				cf.slideDown( dur , function() {
	   				rb.addClass('active');
					cf.addClass('active');
					cf.fadeIn(dur);
	 			});
			}
		});

		/* Blur effects*/ 
		if( a('.site-hero .image-background').hasClass('blur') ) {
			var heroVague = a('.site-hero .image-background').Vague({
			    intensity: 7,// Blur Intensity
			}); heroVague.blur();	
		}	

		if( a('.site-hero .video-background').hasClass('blur') ) {
			var heroVague = a('.site-hero .video-background').Vague({
			    intensity: 7,// Blur Intensity
			}); heroVague.blur();	
		}	

		if( a('body').hasClass('single') ) {
			if (a('.next-preview').length > 0) {
				var nextVague = a('.next-preview .image-background').Vague({
				    intensity: 7,// Blur Intensity
				}); nextVague.blur();
			}
		}	
	}),

	/* Resize functions */ 
	a(window).resize(function(){
	     g(), h(), i();
	});

	/* Scroll functions */ 
	a(window).scroll(function() {
		m();
	});

} )( jQuery );