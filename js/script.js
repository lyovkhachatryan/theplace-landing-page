

$(function () {
	

    $('.nav-link').on('click', function (e) {
      $('.nav-link').removeClass('active');
      $(this).addClass('active');
      var id = $(this).attr('data-content');
      $('.content').addClass('inactive');
      $('#' + id).removeClass('inactive');
    });

    $(document).on('submit','#contactForm',function(e) {
      e.preventDefault();
      var data = $(this).serialize();
      $.post('/contact.php', data, function(res) {
        var data = JSON.parse(res);
        console.log(data);
        var $alert = $('#contactFormAlert');
        if (data.success) {
          $alert.addClass('alert-success');
        } else {
          $alert.addClass('alert-danger');
        }
        $alert.text(data.message).fadeIn();
      });
        
        
        
        
    })
    


})


