
<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Welcome to nova!</title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/signin.css" rel="stylesheet">

<style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
    text-align: center;
    color: black;
}
th, td {
    padding: 5px;
}
table{
    width: 70%;
}
p{
  font-size: 16px;
}
#AuthorDetail{
    font-size: 17px;
    width: 70%;
    
}

</style>
</head>

<body>
<center>


<?php
require_once "../../headfiles/backend_classes_h.php";
require_once "../../headfiles/test.php";

$language =$_GET["lcode"];
//$language ='eng';
if(isset($_POST['submit'])){
$language = $_POST['lang'];
}

$q = new Query;
$AID=$_GET["aid"];
//$BID='Re_Zero_Novels';
$obj = $q->getAuthor($AID,$language);
$comments = $q->getAuthorComments($AID);
?>

<div id="AuthorDetail">

<?php
    echo $obj->toHTMLDivision();
?>

</div>





<div id="rightb">
<font color="orange" size="5">
Choose your reading language:
</font>
<form action="#" method="post">
<select name="lang">
<option value="eng">English</option>
<option value="zho">Chinese</option>
<option value="jpn">Japanese</option>
</select>
<input type="submit" name="submit" value="submit" />
</form>
</div>

<br>

<!-- Bookmark Links Here  -->
<div id="AddAuthorMark">
<?php
if(isset($_POST['favor'])){
$favorstate1=$q->isFavAuthor($_COOKIE['user'],$AID);
$q->changeFavAuthor($_COOKIE['user'],$AID);
$favorstate2=$q->isFavAuthor($_COOKIE['user'],$AID);
if($favorstate1==$favorstate2){
  echo "add or delete failed";
}else{if ($favorstate1==false) {
  echo "add successsful!";
}else {echo "delete successsful!";}}
}
?>
<form action="#" method="post">
<input type="submit" name="favor" value="add or delete favoriate" />
</form>
</div>





<br>


<div id="AuthorComments">
<table id="AuthorCommentTable">
  <p>Comments:</p>
    <?php
        foreach ($comments as $r) {
            echo $r->toHTMLTableRow();
        }
    ?>
</table>
</div>


<!-- Add new comments here  -->
<div id="AddComments">
   <font color="orange" size="5">add your comment:</font>
   <form action="" method="post">
   <textarea name="comment" style="width:400px;height:60px;">Enter your comment</textarea>
   <input type="submit" value="Submit" />
   </form>

<font color="orange">
<?php
if(isset($_POST['comment'])){
$status=$q->addAuthorComment($AID,$_POST["comment"]);
if(!$status){
  echo "upload comments error";
}else{
  echo "upload comments sccuessfull!";
}
}

?>
</font>

</div>

</center>

</body>








