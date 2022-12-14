$(document).ready(function () {


    // * * * * * * * * * * * * * * * * * * * * * * * * *
    // * teleport links
    // *
    // * @set outer parent element class: js-href-teleport-wrapper
    // * @set link (<a> tag) element class: js-href-teleport-link
    // * @set element to add the link to class: js-href-teleport
    // *
    // * This adds a link tag (<a>) to other elements within a wrapper
    // * links comes from a link. Example: add a link to h2, image etc. inside a teaser
    // *
    $(".js-href-teleport").each(function () {
        var $link = $(this).parents(".js-href-teleport-wrapper").find(".js-href-teleport-link"),
            href = $link.attr("href"),
            target = $link.attr("target") ? $link.attr("target") : '_self';

        if (href) {
            $(this).wrapInner('<a href="' + href + '" target="' + target + '"></a>');
        }
    });



    // * * * * * * * * * * * * * * * * * * * * * * * * *
    // * parent clickable elements (excludes links inside)
    // *
    // * @set outer parent element class: js-click-item-parent
    // * @set link (<a> tag) element class: js-click-item-link
    // *
    // * This makes the whole element clickable and still
    // * makes other links inside clickable with their target
    // *
    $(".js-click-item-parent").delegate('a', 'click', function (e) {
        var target = $(this).attr("target"),
            url = $(this).attr("href");

        if (target == "_blank") {
            window.open(url);
        } else {
            window.location = url;
        }
        return false;
    }).click(function () {
        var target = $(this).find("a.js-click-item-link").attr("target"),
            url = $(this).find("a.js-click-item-link").attr("href");

        if (target == "_blank") {
            window.open(url);
        } else {
            window.location = url;
        }
        return false;
    });



    // * * * * * * * * * * * * * * * * * * * * * * * * *
    // * Scroll-To
    // *
    // * Smooth-Scroll to targets on page
    // *
    $('a[href*="#"]:not([href="#"])').click(function () {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                scrollTo(target);
                return false;
            }
        }
    });

    function scrollTo(element) {
        $('html, body').animate({
            scrollTop: element.offset().top - 100
        }, 1000);
    }



    // * * * * * * * * * * * * * * * * * * * * * * * * *
    // * animateIn
    // *
    // *
    var offset = 80; // Distance from Browserbottom & -top where the animation should start

    function fadeInElements() {
        var viewPortStart = $(window).scrollTop(),
            viewPortEnd = viewPortStart + $(window).height();


        $(".animateIn:visible").each(function () {
            var elementTop = $(this).offset().top,
                elementBottom = $(this).offset().top + $(this).outerHeight();

            if ((elementTop + offset) <= viewPortEnd && (elementBottom - offset) >= viewPortStart) {
                var delay = $(this).data("animation-delay");
                $(this).css("transition-delay", delay + "s").addClass("animateIn--active");
            } else {
                $(this).removeClass("animateIn--active");
            }
        });
    }

    $(window).scroll(function () {
        fadeInElements();
    });

    fadeInElements();


    // * * * * * * * * * * * * * * * * * * * * * * * * *
    // * add target blank to external links
    // *
    // *
    $('a:not([data-targetblank=ignore])').each(function () {
        if (location.hostname === this.hostname || !this.hostname.length) {
            // ... do nothing?
        } else {
            $(this).attr('target', '_blank');
        }
    });


    // * * * * * * * * * * * * * * * * * * * * * * * * *
    // * navButton
    // *
    // *
    $(".js-navbutton").click(function () {
        $(this).toggleClass("active");
        $(".js-nav").toggleClass("active");
        $("body").toggleClass("freeze");

    });



    // * * * * * * * * * * * * * * * * * * * * * * * * *
    // * tabs
    // *
    // *
    $(".js-tab").click(function () {
        var tabIndex = $(this).index(),
            $wrapper = $(this).parents(".js-tab-wrapper");

        $wrapper.find(".js-tab").removeClass("active");
        $(this).addClass("active");

        $wrapper.find(".js-tab-content").hide();
        $wrapper.find('.js-tab-content:eq(' + tabIndex + ')').show();

        var currentTabText = $(this).text();
        $(".js-service-breadcrump").text(currentTabText)
        console.log(currentTabText);
    });
    $(".js-tab:first-child").trigger("click");



    // * * * * * * * * * * * * * * * * * * * * * * * * *
    // * sliderImage
    // *
    // *
    var $heroImage = $(".js-slider");

    if ($heroImage.length) {
        $heroImage.slick({
            slidesToShow: 1,
            dots: true,
            arrows: false,
            speed: 1000,
            infinite: true,
        });
    }

    $(".js-slider-nav-item").click(function () {
        var index = $(this).index();
        $heroImage.slick('slickGoTo', index);
    });

    $heroImage.on('beforeChange', function (event, slick, currentSlide, nextSlide) {
        $(".js-slider-nav-item").removeClass("active");
        $('.js-slider-nav-item:eq(' + nextSlide + ')').addClass("active");
    });

    $(".js-slider-nav-item:first-child").addClass("active");

    // * * * * * * * * * * * * * * * * * * * * * * * * *
    // * accordion
    // *
    // *
    $(".js-accordion-button").click(function () {

        $(this).toggleClass("active").siblings().slideToggle().parents(".js-accordion").siblings().find(".js-accordion-panel").slideUp();


    });

    // * * * * * * * * * * * * * * * * * * * * * * * * *
    // * headerDropdown
    // *
    // *
    $(document).click(function (event) {
        var $wrapper = $(".js-header-language-wrapper");
        if ($wrapper.is(event.target) || $wrapper.has(event.target).length) {
            $wrapper.addClass("active");
        }
        else {
            $wrapper.removeClass("active");
        }
    });

    jQuery.expr[':'].Contains = function (a, i, m) {
        return (a.textContent || a.innerText || "").toLowerCase().indexOf(m[3].toLowerCase()) >= 0;
    };

    $(".js-header-language-input").on("input", function () {
        var input = $(this).val(),
            $languageList = $(".js-header-language-list");

        $languageList.find(".js-header-language-listitem").hide();
        $languageList.find(".js-header-language-listitem:Contains(" + input + ")").show();
    });

    // * * * * * * * * * * * * * * * * * * * * * * * * *
    // * countrySelect
    // *
    // *

    $(".js-country-select").change(function () {
        $(".js-country-result-wrapper").children().hide();
        var slectedCountryIndex = $(".js-country-select").find(":selected").index();
        $(".js-country-result-wrapper").find('.js-country-result:eq(' + slectedCountryIndex + ')').show();
        // var selectedCountry = $(".js-country-select").find(":selected").val();
        // $(".js-country-result-wrapper").find(`#${selectedCountry}`).show();
    });

    // * * * * * * * * * * * * * * * * * * * * * * * * *
    // * newsSelect
    // *
    // *
    // Add all existing years to <select>
    $newsBoxes = $(".js-news-result-wrapper").children();
    var existingYears = $newsBoxes.map(function (index) {
        var newsYear = $newsBoxes.eq(index).find(".js-news-date").text().slice(-4);
        return newsYear
    })
    var uniqueYears = [...new Set(existingYears)].sort();

    uniqueYears.forEach(function (year) {
        $(".js-news-select").append(`<option>${year}</option>`)
    })

    // Filter newsBoxes on change
    $(".js-news-select").change(function () {
        $newsBoxes.hide();

        var showAll = $(".js-news-default-option").text();
        var selectedYear = $(".js-news-select").find(":selected").text();

        if (selectedYear === showAll) {
            $newsBoxes.show();
        }
        else {
            // Show only selected years
            $newsBoxes.filter(function (index) {
                // Get last 4 chars from js-news-date div
                var newsYear = $newsBoxes.eq(index).find(".js-news-date").text().slice(-4);
                return newsYear === selectedYear;
            }).show();
        }
    });

});



// * * * * * * * * * * * * * * * * * * * * * * * * *
// * sticky Header
// *
// *
$(window).on("load scroll", function () {
    if ($(window).scrollTop() >= 40) {
        $(".js-header").addClass("sticky");
    } else {
        $(".js-header").removeClass("sticky");
    }
});
