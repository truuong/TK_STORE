
<?php
try {
  $conn = new PDO('mysql:host=localhost;dbname=tk_store','root','');
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  function insertData($db_name,$name,$username,$pwd,$email,$phone,$is_vip) {
    global $conn;
    $conn->exec("INSERT INTO ". $db_name ."(" . getField($db_name)  .") VALUES ('". $name ."','". $username  ."','". $pwd ."','". $email ."','". $phone ."', ".  $is_vip .")");   
  }
  function deleteData($db_name,$name,$value) {
    global $conn;
    $conn->exec("DELETE FROM ". $db_name ." WHERE ". $name . " = '". $value ."'");   
  }
  function customData($sql) {
    global $conn;
    $conn->exec($sql);   
  }
  function getCustomData($sql) {
    global $conn;
    $stmt = $conn->prepare($sql);
  $stmt->execute();
  return $stmt->fetchAll();
  }
  function editData($db_name,$field,$value,$condition,$condition_value) {
    global $conn;
    $conn->exec('UPDATE ' .$db_name . ' SET '. $field . '=' . ($aa = is_numeric($value) ? $value : '"'. $value .'"') . ' WHERE '. $condition . '=' . ($aa = is_numeric($condition_value) ? $condition_value : '"' . $condition_value .'"') );   
  }
  function getData($db_name,$all_field = '',$condition='',$value='') {
    global $conn;
    $stmt = $conn->prepare("SELECT ". getField($db_name)  ."  FROM " . $db_name);
  $stmt->execute();
  return $stmt->fetchAll();
  }
  function getField($db_name) {
    switch($db_name) {
      case 'customers' : {
        return 'ctm_name,ctm_username,ctm_password,ctm_email,ctm_phone,ctm_isvip';
        break;
      }
    }
  }
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}

?>  