<? include "simple_html_dom.php"  
?>

 <?php

 	$user=$_SESSION['user'];
   	$servername="localhost";
	$username="*********";
	$password="********";
	$dbname = "********";

	$conn=mysqli_connect($servername, $username, $password,$dbname) or die(" can't connect to server");
?>

<?php
         function len($tr) {
            $i=0;
            foreach($tr as $element) 
            $i=$i+1;
            return $i;
            }
    //echo "The time is " .date("Y/m/d");
    date_default_timezone_set('Asia/Kolkata');
    $y=date("y");
    $m=date("m");
    $d=date("d");
   // echo "<br>".$y." /".$m." /".$d;    
?>
 

<?
$del="DELETE FROM codechef";
$del1="DELETE FROM codeforce";
mysqli_query($conn,$del);
mysqli_query($conn,$del1);

$url = 'https://www.codechef.com/contests';
$opts = array(
      'http'=>array(
        // 'method'=>"GET",
        'header'=>"User-Agent:Mozilla/5.0 (iPhone; CPU iPhone OS 7_0 like Mac OS X; en-us) AppleWebKit/537.51.1 (KHTML, like Gecko) Version/7.0 Mobile/11A465 Safari/9537.53\r\n"
      )
    );

    $context = stream_context_create($opts);
    $html = file_get_html($url, false, $context);
    
       $mon = array("Jan"=>"01","Feb"=>"02","Mar"=>"03","Apr"=>"04","May"=>"05","Jun"=>"06","Jul"=>"07","Aug"=>"08","Sep"=>"09","Oct"=>"10","Nov"=>"11","Dec"=>"12");
        foreach($html->find('tr') as $element) {
            
            
            if(len($element->find('td') )>3){
             $string= $element->find('td',2)->plaintext;
           
             $a="-";
             $b=" ";
             $time=substr($string,12,20);
             $D= strtok( $string, " ");
             $M=$mon[strtok(" ")];
             $Y= strtok(" ");
            
             
             $start_com=$Y.$a.$M.$a.$D.$b.$time;
             
             $code=$element->find('td',0)->plaintext;
             $name=$element->find('td',1)->plaintext;
             $start=$element->find('td',2)->plaintext;
             $end=$element->find('td',3)->plaintext;
             
             $time=substr($end,12,20);
             $De=strtok($end," ");
             $Me=$mon[strtok(" ")];
             $Ye=strtok(" ");
             $end_com=$Ye.$a.$Me.$a.$De.$b.$time;
               
               if( ( $Y%100)> $y )
                         $sql3="INSERT INTO codechef (code,name,start,end,startcom,endcom) VALUES ('$code','$name', '$start','$end','$start_com','$end_com')";
                else 
                    if($M>$m &&($Y%100)== $y  ){
                        
                        $sql3="INSERT INTO codechef (code,name,start,end,startcom,endcom) VALUES ('$code','$name', '$start','$end','$start_com','$end_com')";
                        
                    }
                else 
                if($D>$d &&($Y%100)== $y &&  $M == $m){
                     $sql3="INSERT INTO codechef (code,name,start,end,startcom,endcom) VALUES ('$code','$name', '$start','$end','$start_com','$end_com')";
                     
                if(mysqli_query($conn,$sql3)== TRUE){
	         	echo "entered Successfully ";}
		        else echo " error !!!!";
		        
		      
                  
                    echo $code."<br>";
                    echo $name."<br>";
                    echo $start."<br>";
                    echo $end."<br>";
                    echo "<br><br>";   
                }
            }
        }
?>

<?
$html = file_get_html('http://codeforces.com/contests');

      
       $mon = array("Jan"=>"01","Feb"=>"02","Mar"=>"03","Apr"=>"04","May"=>"05","Jun"=>"06","Jul"=>"07","Aug"=>"08","Sep"=>"09","Oct"=>"10","Nov"=>"11","Dec"=>"12");
       
        foreach($html->find('tr') as $element) {
            
            $tr=$element->find('td');
            
            if(len($element->find('td') )>4){
             $string= $element->find('td',2)->plaintext;
             $date = strtok($string, " ");
             $time = strtok(" ");
        
             $a="-";
             $b=" ";
             $M= $mon[strtok($date, "/")];
             $D =  strtok( "/");
             $Y = strtok("/");
             $start_com=$Y.$a.$M.$a.$D.$b.$time;
            
               if( ( $Y%100)> $y ){
                  $name=$element->find('td',0)->plaintext;
                    $start=$element->find('td',2)->plaintext;
                    $lenght=$element->find('td',3)->plaintext;
                    
                  $sql1="INSERT INTO codeforce(name,start,startcom,length) VALUES ('$name', '$start','$start_com' ,'$lenght')";
                  mysqli_query($conn,$sql1);
               }
                      
                else 
                    if($M>$m &&($Y%100)== $y  ){
                        
                      $name=$element->find('td',0)->plaintext;
                    $start=$element->find('td',2)->plaintext;
                    $lenght=$element->find('td',3)->plaintext;
                    
                    
                  $sql1="INSERT INTO codeforce(name,start,startcom,length) VALUES ('$name', '$start','$start_com' ,'$lenght')";
                 mysqli_query($conn,$sql1);
                    }
                else 
                if($D>$d &&($Y%100)== $y &&  $M == $m){
                    $name=$element->find('td',0)->plaintext;
                    $start=$element->find('td',2)->plaintext;
                    $lenght=$element->find('td',3)->plaintext;
                    
                    $nname=$name;
                    
                  $sql1="INSERT INTO codeforce(name,start,startcom,length) VALUES ('$name', '$start','$start_com' ,'$lenght')";
                  mysqli_query($conn,$sql1);
                   if( mysqli_query($conn,$sql1))
                   echo "yes";
                   else echo "no";
                   echo $start;   
                }
            }
        }
?>
