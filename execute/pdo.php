
<?php
try {
  $conn = new PDO('mysql:host=localhost;dbname=tk_store','root','');
  $field = '';
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  function insertData($db_name,$name,$username,$pwd,$email,$phone,$is_vip) {
    global $conn;
    global $field;
    switch($db_name) {
      case 'customers' : {
        $field = 'ctm_name,ctm_username,ctm_password,ctm_email,ctm_phone,ctm_isvip';
        break;
      }
    }
    $conn->exec("INSERT INTO ". $db_name ."(" . $field  .") VALUES ('". $name ."','". $username  ."','". $pwd ."','". $email ."','". $phone ."', ".  $is_vip .")");   
  }
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}

?>  