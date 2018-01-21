require('./bootstrap');

$(function () {
  // Fade the card bodies in on page load
  $('.card-body').fadeIn('fast');

  // Find autofocus element in the input of modal and focus input
  $('.modal').on('shown.bs.modal', () => {
    $(this).find('[autofocus]').focus();
  });


  $('#addEmailForm').submit(evt => {
    addForms(evt, 'email', 'Email');
  });

  $('#addPhoneForm').submit(evt => {
    addForms(evt, 'phone', 'Phone',);
  });
});

addForms = (evt, x, y) => {
  evt.preventDefault();
  const form = $(evt.target);


  $.ajax({
    type: "POST",
    url: form.attr("action"),
    dataType: 'json',
    data: form.serialize(), // serializes the form's elements.

  }).done(() => {
    //
  }).fail(err => {
    if (err.responseJSON) {
      const errMessage = err.responseJSON.errors.newemail[0];

      // Throw error message for form validation
      $(`#${x}-error`).html(errMessage);
      $(`#new${x}`).addClass('is-invalid');
      // Autofocus back on input after error is thrown
      $('.modal').find('[autofocus]').focus();

    } else {
      $('.modal').modal('hide');
      location.reload();
    }
  });
}


