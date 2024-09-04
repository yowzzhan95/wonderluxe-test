jQuery(document).ready(function ($) {
    var $sliderWrapper = $('.slider-wrapper');
    var totalSlides = $('.slide').length;
    var currentIndex = 0;

    function moveSlider(index) {
        var slideWidth = $('.slide').width();
        $sliderWrapper.css('transform', 'translateX(' + (-index * slideWidth) + 'px)');
    }

    $('.right-arrow').click(function () {
        if (currentIndex < totalSlides - 1) {
            currentIndex++;
            moveSlider(currentIndex);
        }
    });

    $('.left-arrow').click(function () {
        if (currentIndex > 0) {
            currentIndex--;
            moveSlider(currentIndex);
        }
    });

    $(window).resize(function () {
        moveSlider(currentIndex);
    });
});