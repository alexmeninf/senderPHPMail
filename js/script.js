$(document).ready(function () { //Quando documento estiver pronto
  const form = '#formSend';
  $(form).validate({
    rules: {
      name: {
        required: true
      },
      email: {
        required: true,
        email: true,
      }
    },
    messages: {
      name: {
        required: 'O campo nome é obrigatório',
      },
      email: {
        required: 'O campo e-mail é obrigatório',
        email: 'Informe um e-mail válido'
      }
    },
    submitHandler: function () {
      // Send informations
      const btnForm = form + ' button[type=submit]';
      const formData = $(form).serialize();

      $.ajax({
        url: window.location.href + 'sendAPI.php',
        method: 'POST',
        data: {formData},
        beforeSend: () => {
          $(btnForm).html('Enviando...');
        }
      }).done(function(data) {
        const obj = JSON.parse(data);

        if (obj.success) {
          Swal.fire({
            title: 'Enviado!',
            text: `${obj.message}`,
            type: 'success',
            confirmButtonText: 'Fechar'
          });
          clear_form_elements(form);     
             
        } else {
          Swal.fire({
            title: 'Algo deu errado!',
            text: `${obj.message}`,
            type: 'error',
            confirmButtonText: 'Ok'
          });
        }
      }).fail(function(data) {
        const obj = JSON.parse(data);

        Swal.fire({
          title: 'Algo deu errado!',
          text: `${obj.message}`,
          type: 'error',
          confirmButtonText: 'Ok'
        });
      }).always(function() {
        $(btnForm).html('Enviar novamente');
      });
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