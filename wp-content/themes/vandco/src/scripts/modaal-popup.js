// Function to get a cookie by name
function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
}

// Function to set a cookie
function setCookie(name, value, days) {
    const d = new Date();
    d.setTime(d.getTime() + (days * 24 * 60 * 60 * 1000));
    const expires = `expires=${d.toUTCString()}`;
    document.cookie = `${name}=${value}; ${expires}; path=/`;
}

jQuery(document).ready(function($) {
	if ($('.video-modal').length > 0) {
		$('.video-modal a').modaal({
			type: 'iframe',
			iframe: {
				markup: '<div class="mfp-iframe-scaler">'+
						  '<div class="mfp-close"></div>'+
						  '<iframe class="mfp-iframe" frameborder="0" allowfullscreen allow="autoplay"></iframe>'+
						'</div>',
				patterns: {
					youtube: {
						index: 'youtube.com/', // String that detects type of video (in this case YouTube). Simply via url.indexOf(index).
						id: 'v=',
						src: '//www.youtube.com/embed/%id%?autoplay=1' // URL that will be set as a source for iframe.
					},
					vimeo: {
						index: 'vimeo.com/',
						id: '/',
						src: '//player.vimeo.com/video/%id%?autoplay=1&mute=0'
					}
				},
				srcAction: 'iframe_src',
			  }
		});
	}

    if ($('.video-popup-modal').length > 0) {
        $('.video-popup-modal a').modaal({
            type: 'iframe',
            iframe: {
                markup: '<div class="mfp-iframe-scaler">'+
                            '<div class="mfp-close"></div>'+
                            '<iframe class="mfp-iframe" frameborder="0" allowfullscreen allow="autoplay"></iframe>'+
                        '</div>',
                patterns: {
                    youtube: {
                        index: 'youtube.com/', // String that detects type of video (in this case YouTube). Simply via url.indexOf(index).
                        id: 'v=',
                        src: '//www.youtube.com/embed/%id%?autoplay=1&mute=0' // URL that will be set as a source for iframe.
                    },
                    vimeo: {
                        index: 'vimeo.com/',
                        id: '/',
                        src: '//player.vimeo.com/video/%id%?autoplay=1&mute=0'
                    }
                },
                srcAction: 'iframe_src',
            }
        });
    }

    if ($('.autoload-popup-section').length > 0) {
        const lastVisit = getCookie('vandcolastVisit');
        const today = new Date().toISOString().split('T')[0];
        //$('.autoload-popup-section').modaal({ start_open: true, hide_close: true });
        if (lastVisit !== today) {
            // Open the modal after 40 seconds
            setTimeout(function() {
                $('.autoload-popup-section').modaal({ start_open: true, hide_close: true });
            }, 40000); // 40000 milliseconds = 40 seconds
            setCookie('vandcolastVisit', today, 1); // Set cookie for 1 day
        }

        $('.decline-offer-button').on('click', function() {
            $('.autoload-popup-section').modaal('close');
        });

    }

    $('.modaal-content-container').each(function() {
        if ($(this).find('.wp-banner-popup-group').length) {
            $(this).addClass('has-popup-banner');
        }
    });

});
