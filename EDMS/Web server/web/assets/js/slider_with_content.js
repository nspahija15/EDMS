
function onselectButton(value) {
    document.getElementById('dropdown-work-Opt').value = value;
}

document.getElementById('carousel-text').innerHTML = document.getElementById('slide-content-0').innerHTML;

$(document).ready(function ($) {

      $('#myCarousel').carousel({
          interval: 5000
      });


    //Handles the carousel thumbnails
    $('[id^=carousel-selector-]').click(function () {
        var id = this.id.substr(this.id.lastIndexOf("-") + 1);
        var id = parseInt(id);
        $('#myCarousel').carousel(id);
    });


    // When the carousel slides, auto update the text
    $('#myCarousel').on('slid.bs.carousel', function (e) {
        var id = $('.item.active').data('slide-number');
        $('#carousel-text').html($('#slide-content-' + id).html());
    });

});
