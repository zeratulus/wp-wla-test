function getTestimonials(alpha) {
    jQuery('#testimonials .alphabet .item').removeClass('active');
    jQuery('#t-a-' + alpha.toUpperCase()).addClass('active');
    jQuery('.slider-active-alpha').html(alpha.toUpperCase());
    let rootEl = jQuery('#testimonials');
    let content = rootEl.find('.content');
    if (content.hasClass('slick-initialized')) {
        content.slick('unslick');
    }
    content.html('');
    showTestimonialPreloader();
    let url = rootEl.data('ajax-url');
    jQuery.get(url + alpha, {}, function (data) {
        console.log(data);
        if (data.success) {
            hideTestimonialPreloader();
            let counter = 0;
            let html = '<div class="slide-content">';
            let perPage = 10;
            let pages = data.items.length / perPage;
            for (let page = 0; page <= pages; page++) {
                counter = 0;
                for (let x = page * perPage; x < pages * perPage; x++) {
                    let el = data.items[x];
                    if (el.image != null) {
                        html += `<div class="testimonial" style="background-image: url('${el.image}');">${el.post_title}</div>`;
                    } else {
                        html += `<div class="testimonial">${el.post_title}</div>`;
                    }
                    counter++;
                    if (counter === 10) {
                        html += '</div>';
                        html += '<div class="slide-content">';
                    }
                }
            }
            html += '</div>';
            html += '<div class="slide-content">Just for slider...</div>'; //add slide for a test...
            content.append(html);
            content.slick({});
            jQuery('#testimonials .btn-slider-next').on('click', function () {
                content.slick('slickNext');
            });
            jQuery('#testimonials .btn-slider-prev').on('click', function () {
                content.slick('slickPrev');
            });
        } else {
            console.error(data);
        }
    });
}

function getTestimonialsAlphabet() {
    return new Promise((resolve, reject) => {
        let rootEl = jQuery('#testimonials .alphabet');
        let url = rootEl.data('ajax-url');
        jQuery.get(url, {}, function (data) {
            console.log(data);
            if (data.success) {
                data.items.forEach(function (el) {
                    rootEl.append(`<div class="item" id="t-a-${el.alpha}" onclick="getTestimonials('${el.alpha}')">${el.alpha}</div>`);
                });
                resolve(data);
            } else {
                console.error(data);
                reject(data);
            }
        });
    });
}

function showTestimonialPreloader() {
    jQuery('#testimonials .content').append('<div class="testimonial-preloader d-flex flex-center flex-align-center"><i class="fas fa-spinner"></i></div>');
}

function hideTestimonialPreloader() {
    jQuery('#testimonials .content .testimonial-preloader').remove();
}

jQuery(document).ready(function () {
    getTestimonialsAlphabet().then(() => {
        getTestimonials('A');
    });
});