<?php
// Import CurlPost classes into the global namespace
// These must be at the top of your script, not inside a function
use CurlPost\CurlPost\CurlPostAPI;

require("src/CurlPostAPI.php");

/**
 * Tratar os valores recebidos por serialize() do javascript
 */
$values = array();
parse_str($_POST['formData'], $values);


// put the name of your input correctly
if (empty($values['email'])) {
  echo 'O campo e-mail é obrigatório.';

} else {

  // Content values
  $content = array(
    'name' => $values['name'],
    'email' => $values['email'],
  );

  // create curl object
  $curl = new CurlPostAPI('http://api.example.com');

  try {
    // execute the request
    $info = json_encode(
      array(
        'success' => 1, 
        'message' => $curl($content)
      )
    );

    print_r($info);

  } catch (\RuntimeException $ex) {
    // catch errors
    $info = json_encode(
      array(
        'success' => 0,
        'message' => 'Http error ' . $ex->getMessage() . ' with code ' . $ex->getCode()
      )
    );

    print_r($info);
  }
}
