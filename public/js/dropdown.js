$('.dropdown').on('show.bs.dropdown', function() {
  $('body').append($('.dropdown').css({
    position: 'absolute',
    left: $('.dropdown').offset().left,
    top: $('.dropdown').offset().top
  }).detach());
});