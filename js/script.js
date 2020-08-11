$(document).ready(function () { //Quando documento estiver pronto
  $("#formSend").validate({
    rules: {
      inputName: {
        required: true
      },
      inputEmail: {
        required: true,
        email: true,
      }
    },
    messages: {
      inputName: {
        required: 'O campo nome é obrigatório',
      },
      inputEmail: {
        required: 'O campo e-mail é obrigatório',
        email: 'Informe um e-mail válido'
      }
    },
    submitHandler: function (form) {
      var urlData = $(form).serialize();

      $.ajax({
        type: "POST",
        url: "send.php",
        async: true,
        data: urlData,
        success: function (data) {
          let result = JSON.parse(data);

          if (result['success']) {
            Swal.fire({
              icon: 'success',
              title: 'Enviado!',
              text: result['message'],
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Erro ao enviar!',
              text: result['message'],
            });
          }
        },
        beforeSend: function () {
          buttonSubmit('Enviando...', form);
        },
        complete: function () {
          clear_form_elements(form);
          buttonSubmit('Enviar novamente', form);
        }
      });

      return false;
    }
  });
});

function clear_form_elements(parentClass) {
  $(parentClass).find(':input').each(function () {
    switch (this.type) {
      case 'password':
      case 'text':
      case 'textarea':
      case 'file':
      case 'select-one':
      case 'select-multiple':
      case 'date':
      case 'number':
      case 'tel':
      case 'email':
        $(this).val('');
        break;
      case 'checkbox':
      case 'radio':
        this.checked = false;
        break;
    }
  });
}

function buttonSubmit(textHTML, selector) {
  let buttonSubmit = 'button[type=submit]',
    inputSubmit = 'input[type=submit]';

  if ($(buttonSubmit, selector).length) {
    $(buttonSubmit, selector).html(textHTML);
  } else {
    $(inputSubmit, selector).val(textHTML);
  }
}