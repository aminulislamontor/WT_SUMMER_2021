<?php include "control/validation.php"; ?>

<?php
if($_SERVER["REQUEST_METHOD"]=="POST")
{

    $target_dir = "files/";
    $target_file = $target_dir . $_FILES["filetoupload"]["name"];
    
    if (move_uploaded_file($_FILES["filetoupload"]["tmp_name"], $target_file)) {
        echo "You have uploaded" .$_FILES["filetoupload"]["type"];
        //echo "<br>".$_FILES["filetoupload"]["type"];
        //echo "<img sec ='".$target_file."'>";
    }else {
        echo"Error No file Uploaded";
    }

$formdata = array(
    'Name'=> $_POST["fname"],
    'Email'=> $_POST["email"],
    'Password'=>$_POST["password"],
    'Comment'=> $_POST["comment"],
    'Gender'=>"$validateradio",
    'Hobby'=>"$h1 $h2 $h3",
    "File_Path"=>"$target_dir"
   

 );


 $existingdata = file_get_contents('data.json');
 $tempJSONdata = json_decode($existingdata);
 $tempJSONdata[] =$formdata;
 $jsondata = json_encode($tempJSONdata, JSON_PRETTY_PRINT);
 
 if(file_put_contents("data.json", $jsondata)) {
      echo "<br> Data successfully saved <br>";
  }
 else 
      echo "no data saved";

$data = file_get_contents("data.json");
$mydata = json_decode($data);


foreach($mydata as $myobject)
{
foreach($myobject as $key=>$value)
{
  echo "your ".$key." is ".$value."<br>";
} 
echo "<br>";
}

}
?>