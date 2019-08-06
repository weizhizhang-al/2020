



<?php

$vote = $_GET["vote"];

$userGUID = $_GET["userGUID"];
$voteid=$_GET["voteid"];
$servername = "localhost";
$username = "service";
$password = "83422zwZ";
$dbname = "vote";

$voteCount1 =(double)0;
$voteCount2 =(double)0;
$voteCount3 =(double) 0;
$voteCount4=(double)0;
$voteCount5=(double)0; 
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql1 ="update vote set active=0 where user='$userGUID' ";
if ($conn->query($sql1) === TRUE ){
    print("update vote successfully");
}else{
    print  ("update error");

}

$sql = "INSERT INTO vote (user, vote,active,id ) VALUES ( '$userGUID','$vote',1,'$voteid' )";


if ($conn->query($sql) === TRUE) {
    print ( "New record created successfully");
} else {
//print ("error");   
 echo "Error: " . $sql . "<br>" . $conn->error;
}




$sql2 = "SELECT vote, count( *) as total  FROM vote where  active=1 and (TIMESTAMPDIFF(DAY, date, NOW()) <7 
         OR date IS NULL) group by vote ";
 
// Check if there are results
if ($result = mysqli_query($conn, $sql2))
{
 // If so, then create a results array and a temporary one
 // to hold the data
print("read vote information"); 
 // Loop through each row in the result set
 while($row = $result->fetch_assoc())  
 {

print("while loop");
if ($row["vote"]==1){
   $voteCount1=$row["total"];
  }
if ($row["vote"]==2){

   $voteCount2=$row["total"];
  }   
if ($row["vote"]==3){
   $voteCount3=$row["total"];
  }  
if ($row["vote"]==4){
   $voteCount4=$row["total"];
  }    

if ($row["vote"]==5){
   $voteCount5=$row["total"];
  }  
print(""+$row["total"]);
}


print(""+$voteCount1);

$voteTotal = (double)( $voteCount1 + $voteCount2 +$voteCount3+$voteCount4+$voteCount5);

$pencentage1 = $voteCount1/$voteTotal;

$pencentage2 = $voteCount2/$voteTotal;



$pencentage3 = $voteCount3/$voteTotal;


$pencentage4 = $voteCount4/$voteTotal;

$pencentage5 = $voteCount5/$voteTotal;

print (""+$percentage1);
print ((string)$percentage2);
print ((string)$percentage3);
print ((string)$percentage4);


$sql3 ="update candidate set vote ='$pencentage1',count='$voteCount1'   where id =1 ";
if ($conn->query($sql3) === TRUE ){
    print("update candidate 1 vote information successfully");
}else{
    print  ("update 1 error");

}


$sql4 ="update candidate set vote ='$pencentage2',count='$voteCount2'   where id =2 ";
if ($conn->query($sql4) === TRUE ){
    print("update cnadidate 2 vote  successfully");
}else{
    print  ("update error");

}




$sql5 ="update candidate set vote ='$pencentage3',count='$voteCount3'   where id =3 ";
if ($conn->query($sql5) === TRUE ){
    print("update candidate 3 vote  successfully");
}else{
    print  ("update error");

}



$sql6 ="update candidate set vote ='$pencentage4',count='$voteCount4'   where id =4 ";
if ($conn->query($sql6) === TRUE ){
    print("update vote successfully");
}else{
    print  ("update error");

} 
// Add each row into our results array
 }



$sql7 ="update candidate set vote ='$pencentage5',count='$voteCount5'   where id =5 ";
if ($conn->query($sql7) === TRUE ){
    print("update vote successfully");
}else{
    print  ("update error");

}


$conn->close();


?>
