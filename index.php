<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHPMailer</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

  <h1>PHPMailer - Envio por e-mail</h1>

  <form action="javascript:void(0);" method="post" id="formSend" class="form-main outlined-basic">
    <div class="relative">
      <label class="form-group">
        <input type="text" name="inputName" id="inputName" placeholder="&nbsp;">
        <span class="txt">Nome <sup>*</sup></span>
        <span class="bar"></span>
      </label>
      <label id="inputName-error" class="error error-msg" for="inputName"></label>
    </div>

    <div class="relative">
      <label class="form-group">
        <input type="email" name="inputEmail" id="inputEmail" placeholder="&nbsp;">
        <span class="txt">E-mail <sup>*</sup></span>
        <span class="bar"></span>
      </label>
      <label id="inputEmail-error" class="error error-msg" for="inputEmail"></label>
    </div>

    <button type="submit">Enviar</button>
  </form>


  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="js/jquery.validate.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  <script src="js/script.js"></script>

</body>
</html>