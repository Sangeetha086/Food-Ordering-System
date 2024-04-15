<?php
$name=$_POST['name'];
$number=$_POST['number'];
$email=$_POST['email'];
$message=$_POST['message'];


$conn=new mysqli('localhost','root','','canteen');

if($conn->connect_error)
{
   die('Connection failed :'.$conn->connect_error);
}
else
{
$st=$conn->prepare("insert into contact (name,number,email,message) values(?,?,?,?)");
$st->bind_param("ssss",$name,$number,$email,$message);
$st->execute();
echo"Thank you for contacting Us";
$st->close();
$conn->close();

}



?>