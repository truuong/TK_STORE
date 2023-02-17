
<?php
try {
  $conn = new PDO('mysql:host=localhost;dbname=tk_store','root','');
  $temp = '';
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  function insertData(...$arr) {
    global $conn;
    global $temp;
    for ($i=1; $i < count($arr); $i++) { 
      $temp.= ",'". $arr[$i] ."'";
  }
  $temp = substr($temp,1);
    $conn->exec("INSERT INTO ". $arr[0] ."(" . getColumn($arr[0])  .") VALUES (". $temp .")");   
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
  function getData($db_name) {
    global $conn;
    $stmt = $conn->prepare("SELECT *  FROM " . $db_name);
  $stmt->execute();
  return $stmt->fetchAll();
  }
  function getColumn($db_name) {
    global $conn;
    $stmt = $conn->prepare("SHOW COLUMNS FROM " . $db_name);
  $stmt->execute();
  $stmt = $stmt->fetchAll();
  $txt = '';
  for ($i=0; $i < count($stmt); $i++) { 
      $txt.= ',' . $stmt[$i][0];
  }
  return ltrim(',',$txt);
  }
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}

?>  