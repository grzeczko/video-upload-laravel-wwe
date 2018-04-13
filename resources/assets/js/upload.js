'use strict';

(function() {
  $('.alert-success').delay(3000).fadeOut("fast");

  $('.skip-btn').click(function(e) {
    e.preventDefault();

    $('.metadata').fadeOut("fast");
  });

  $(".slider").slick({
      // normal options...
      infinite: true,
      slidesToShow: 4,
      slidesToScroll: 4,
      prevArrow: $('.prev'),
      nextArrow: $('.next'),
  });

  $(".video-modal").click(function(e) {
      e.preventDefault();

      let title = $(this).data('title');
      let location = $(this).data('location');
      $('.modal-title').text(title);

      $('.modal-body').html(`
        <video width="465" src="` + location + `" controls autoplay></video>
      `);
  });

  $('#videoModal').on('hidden.bs.modal', function () {
    $('.modal-body').html('');
  });
})();
