<?php
  // require_once "../headfiles/connect.php";

  $username = $_POST['username'];
  $password = $_POST['password'];
  $hashpw=sha1($password);

  require_once('../headfiles/pdo_h.php');
  try{$dbh = _db_connect();
  $stmt = $dbh->prepare("SELECT * FROM Members WHERE username=:uid AND userpass=:hashpw");
  $stmt->bindParam(':uid', $username);
  $stmt->bindParam(':hashpw', $hashpw);
  $stmt->execute();
  _db_commit($dbh);} catch(Exception $e) {_db_error($dbh,$e);}

  $r = $stmt->fetch();
  if($r){
    SetCookie("user", "$username", time()+3600, '/');
    if ($r->LangPref)
    	SetCookie("lang", "$r->LangPref", time()+3600, '/');
    else
    	SetCookie("lang", "zho", time()+3600, '/');
    header("location:search.php");
    exit;
  } else {
    echo '<script type="text/javascript">';
    echo 'alert("登录失败，请再试一次.");';
    echo 'window.location.href = "index.php";';
    echo '</script>';
  }
?>
