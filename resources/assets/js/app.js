require('./bootstrap');

$(function () {
  // Fade the card bodies in on page load
  $('.card-body').fadeIn(0);

  // Find autofocus element in the input of modal and focus input
  $('.modal').on('shown.bs.modal', () => {
    $(this).find('[autofocus]').focus();
  });

  $('#createForm').submit(() => {
    disableSubmitButtons();
  });

  $('#editForm').submit(() => {
    disableSubmitButtons();
  });

  $('#addEmailForm').submit(evt => {
    addForms(evt, 'email');
  });

  $('#addPhoneForm').submit(evt => {
    addForms(evt, 'phone');
  })

  for (let i = 1; i < 6; i++) {
    $(`#deleteEmail${i}`).on('click', () => {
      let indexToDel = $(`#deleteEmail${i}`).data('index');
      $('#deleteEmailForm').data('index',indexToDel);
    });
  }


  $('#deleteEmailForm').submit(evt => {
    deleteForms(evt);
  });

});

disableSubmitButtons = () => {
  $('#submitEdit,#submitCreate').prop('disabled', 'disabled');
}

addForms = (evt, x) => {
  evt.preventDefault();
  const form = $(evt.target);

  // Disable submit button after first click
  $('#submitEmail,#submitPhone').prop('disabled', 'disabled');

  $.ajax({
    type: "POST",
    url: form.attr("action"),
    dataType: 'json',
    data: form.serialize(), // serializes the form's elements.

  }).done(res => {
    if (res.success) {
      $('.modal').modal('hide');
      location.reload();
    }
  }).fail(err => {
    if (err.responseJSON) {
      let errMessage;

      if (x === 'email') {
        errMessage = err.responseJSON.errors.newemail[0];
      } else {
        errMessage = err.responseJSON.errors.newphone[0]
      }

      // Throw error message for form validation
      $(`#${x}-error`).html(errMessage);
      $(`#new${x}`).addClass('is-invalid');
      // Autofocus back on input after error is thrown
      $('.modal').find('[autofocus]').focus();

      // enable button again
      $('#submitEmail,#submitPhone').prop('disabled', false);
    }
  });
}

deleteForms = (evt) => {
  evt.preventDefault();
  const form = $(evt.target);
  const url = form.attr("action").slice(0, -1) + form.data('index');
  $('#deleteButton,#deletePhone').prop('disabled', 'disabled');

  $.ajax({
    type: "POST",
    url: url,
    dataType: 'json',
    data: form.serialize(), // serializes the form's elements.

  }).done(res => {
    console.log(res);
    if (res.success) {
      $('.modal').modal('hide');
      location.reload();
    }

  }).fail(err => {
    console.log(err);
  });
}