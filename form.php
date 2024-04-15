<html>
<body>
<?php
$servername="localhost";
$username="root";
$password="";
$db="rep";

$val =$_POST["Name"];
$val1=$_POST["Email"];
$val2=$_POST["Complaint"];
$val7=$_POST["button1"];

echo "Name   :$val";echo"<br>";
echo "Email :$val1";echo"<br>";
echo "Complaint   :$val2";echo"<br>";
echo $val7;echo"<br>";

$conn=mysqli_connect($servername,$username,$password,$db);
if(!$conn)
{
 die("Connection Failed:".mysqli_connect_error());
}
echo"<br>";
echo"Connected successfully";
if($val7=="Insert")
{
$sql="insert into student values($val,'$val1','$val2')";
if(mysqli_query($conn,$sql))
{
 echo"<br><br>";
 echo"Record Inserted";
}
else
{
 echo"Error:".$sql."<br>".mysqli_error($conn);
}
}
?>




