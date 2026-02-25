// import './bootstrap';
import './jquery-3.7.1.min';
import './slick-1.8.1.min';

$(document).ready(function() {
  $('.slider').slick({
        arrows: true,
        dots: false,
        prevArrow: '<button class="slick-prev slick-arrow" aria-label="Previous" type="button" style=""><-</button>',
        nextArrow: '<button class="slick-next slick-arrow" aria-label="Next" type="button" style="">-></button>',
  });
});
