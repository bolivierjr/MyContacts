require('./bootstrap');

$(document).ready(function() {
  // Fade the card bodies in on page load
  $('.card-body').fadeIn('fast');

  // Find autofocus element in the input of modal and focus input
  $('.modal').on('shown.bs.modal', function() {
    $(this).find('[autofocus]').focus();
  });
});

$(document).submit(function(e){
  var form = $(e.target);

  if(form.is("#addForm")) { // check if this is the form that you want
    e.preventDefault();
    $.ajax({
      type: "POST",
      url: form.attr("action"),
      dataType: 'json',
      data: form.serialize(), // serializes the form's elements.
      success: function(res) {
        console.log(res.responseJSON);
      },
      error: function(res) {
        console.log(res);
        $('#email-error').html(res.responseJSON.errors.newemail[0]);
        $('#newemail').addClass('is-invalid');
      }
    });
  }
});

// if(data.success) {
//   setInterval(function(){
//     $('#addModal').modal({show: true});
//   }, 3000);