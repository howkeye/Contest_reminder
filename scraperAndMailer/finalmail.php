 <?php

 	$user=$_SESSION['user'];
   	$servername="localhost";
	$username="*********";
	$password="********";
	$dbname = "********";

	$conn=mysqli_connect($servername, $username, $password,$dbname) or die(" can't connect to server");
?>

<?php
date_default_timezone_set('Asia/Kolkata');
//start codeforces
$url='http://codeforces.com/contests';
$sqlforce="SELECT name,start,startcom,length FROM codeforce";
$resultforce = $conn->query($sqlforce);
//echo $resultforce->num_rows."<br>";
if ($resultforce->num_rows > 0){
  while($rowf = $resultforce->fetch_assoc()){
$currdate=date("Y-m-d H:i:s");
$contestdate=$rowf['startcom'];

 $istcontest=  strtotime($contestdate)+9000;
      
        $contestdate= date( 'Y-m-d H:i:s',$istcontest);
        //echo $contestdate."<br>";
//echo $currdate."<br>";
$seconds = strtotime($contestdate) - strtotime($currdate);
$days    = floor($seconds / 86400);
$hours   = floor(($seconds - ($days * 86400)) / 3600);
$minutes = floor(($seconds - ($days * 86400) - ($hours * 3600))/60);
$checker = ($hours*60)+$minutes;
//echo $checker."<br>";
//echo $hours."<br>";
$contestdate=trim($contestdate);
if($days==0 && $checker<1440 && $checker>=1380){//add more conditions
$sql = "SELECT name,email FROM conuser";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
       
$to =$row['email'];

$headers = "From: contestreminder195@gmail.com" . "\r\n" ;


$subject = "Contest Reminder (codeforce) ".trim($rowf['name']);
echo $rowf['name']."<br>";
$name=trim($rowf['name']);
$start=trim($rowf['start']);
$t=$start;
$date=substr($t,0,11);
$contestdate=trim($contestdate);
$time=substr($contestdate,strlen($contestdate)-8,strlen($contestdate));
$t=strtok($time,":");
if($t>=0 && $t<=12)
  $t=" AM";
  else
  $t=" PM";
$time=$time.$t;  
$length=trim($rowf['length']);
$text ="Hi,".$row['name']."
Participate in ".$name." on Codeforces tomorrow
Date :  ".$date."
Time :  ".$time."
Duration: : ".$length."
Link:".$url."
Happy coding!!!!!
Regards
Rajat and Yash ";
$headers = "From: contestreminder195@gmail.com" . "\r\n" ;
//mail($to,$subject,$text,$headers);
echo $text."<br><br>";
 if(mail($to,$subject,$text,$headers))
 echo " mailed successfully";
 else echo "error in mailing ";
        
    }
} 
else   {echo "0 results";}

      }

if($days==0 && $checker<=120 && $checker>60){//add more conditions
$sql = "SELECT name,email FROM conuser";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
$to =$row['email'];

$headers = "From: contestreminder195@gmail.com" . "\r\n" ;

$name=trim($rowf['name']);
$subject = "Contest Reminder (codeforces) ".$name;

echo $subject;

echo $rowf['name']."<br>";

$start=trim($rowf['start']);
$t=$start;
$date=substr($t,0,11);
$contestdate=trim($contestdate);
$time=substr($contestdate,strlen($contestdate)-8,strlen($contestdate));
$t=strtok($time,":");
if($t>=0 && $t<=12)
  $t=" AM";
  else
  $t=" PM";
$time=$time.$t;  

$length=trim($rowf['length']);
$text ="Hi,".$row['name']."
Participate in ".$name." on Codeforces 
Date :  ".$date."
Time :  ".$time."
Duration: : ".$length."
Link:".$url."
Happy coding!!!!!
Regards
Rajat and Yash ";
$headers = "From: contestreminder195@gmail.com" . "\r\n" ;
echo $text."<br><br>";
 if(mail($to,$subject,$text,$headers))
 echo " mailed successfully";
 else echo "error in mailing ";
     
        
    }
} 
else   {echo "0 results";}

      }

   }
}
//end codeforces
















//start codechef
$url = 'https://www.codechef.com/';
$sqlchef="SELECT code,name,start,end,startcom,endcom FROM codechef";
$resultchef = $conn->query($sqlchef);
if ($resultchef->num_rows > 0){
  while($rowc = $resultchef->fetch_assoc()){
$link=$url.$rowc['code'];    
$currdate=date("Y-m-d H:i:s");
$c=$rowc['startcom'];
$x=substr($c,0,10);
$y=substr($c,strlen($c)-8,strlen($c));
$z=" ";
$contestdate=$x.$z.$y;

//echo $contestdate."   ".$currdate."<br>";
$seconds = strtotime($contestdate) - strtotime($currdate);
$days    = floor($seconds / 86400);
$hours   = floor(($seconds - ($days * 86400)) / 3600);
$minutes = floor(($seconds - ($days * 86400) - ($hours * 3600))/60);
$checker = ($hours*60)+$minutes;
//echo $checker."<br>";
//echo $hours."<br>";
if($days==0 && $checker<1440 && $checker>1380){//add more conditions
$sql = "SELECT name,email FROM conuser";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
       
$to =$row['email'];

$headers = "From: contestreminder195@gmail.com" . "\r\n" ;


$subject = "Contest Reminder (codechef) ".$rowc['name'];
echo $rowc['name']."<br>";
$t=trim($rowc['start']);
$sdate=substr($t,0,11);
$stime=substr($t,strlen($t)-8,strlen($t));
$t=strtok($stime,":");
if($t>=0 && $t<=12)
  $t=" AM";
  else
  $t=" PM";
$stime=$stime.$t;  
$start=$sdate." ".$stime;

$t=trim($rowc['end']);
$edate=substr($t,0,11);
$etime=substr($t,strlen($t)-8,strlen($t));
$t=strtok($etime,":");
if($t>=0 && $t<=12)
  $t=" AM";
  else
  $t=" PM";
$etime=$etime.$t;  

$end=$edate." ".$etime;

$text ="Hi,".$row['name']."
Participate in ".$rowc['name']." on Codechef tomorrow
Starts at :  ".$start."
Ends at :  ".$end."
Link:".$link."
Happy coding!!!!!
Regards
Rajat and Yash ";
$headers = "From: contestreminder195@gmail.com" . "\r\n" ;
echo $text."<br><br>";
 if(mail($to,$subject,$text,$headers))
 echo " mailed successfully";
 else echo "error in mailing ";
     
        
    }
} 
else   {echo "0 results";}

      }

if($days==0 && $checker<120 && $checker>60){//add more conditions
$sql = "SELECT name,email FROM conuser";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
$to =$row['email'];

$headers = "From: contestreminder195@gmail.com" . "\r\n" ;


$subject = "Contest Reminder (codechef) ".$rowc['name'];
echo $rowc['name']."<br>";

$t=trim($rowc['start']);
$sdate=substr($t,0,11);
$stime=substr($t,strlen($t)-8,strlen($t));
$t=strtok($stime,":");
if($t>=0 && $t<=12)
  $t=" AM";
  else
  $t=" PM";
$stime=$stime.$t;  

$start=$sdate." ".$stime;

$t=trim($rowc['end']);
$edate=substr($t,0,11);
$etime=substr($t,strlen($t)-8,strlen($t));
$t=strtok($etime,":");
if($t>=0 && $t<=12)
  $t=" AM";
  else
  $t=" PM";
$etime=$etime.$t;  

$end=$edate." ".$etime;
$text ="Hi,".$row['name']."
Participate in ".$rowc['name']." on Codechef
Starts at :  ".$start."
Ends at :  ".$end."
Link:".$link."
Happy coding!!!!!
Regards
Rajat and Yash ";
$headers = "From: contestreminder195@gmail.com" . "\r\n" ;
echo $text."<br><br>";
 if(mail($to,$subject,$text,$headers))
 echo " mailed successfully";
 else echo "error in mailing ";
     
        
    }
} 
else   {echo "0 results";}

      }




   }
}

//end codechef

?>
