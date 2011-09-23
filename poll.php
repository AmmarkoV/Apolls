<html>
<body>

<?php
error_reporting (0);

function check_ip_votes($the_file,$theip)
{

 $the_file_path="poll_data/".$the_file.".dat";
 $the_ipfile_path="poll_data/".$the_file."ip.dat";

if (!file_exists ($the_file_path))
 {
   $file=fopen($the_file_path,"w+");
   fclose($file);   
 } 
 
if (!file_exists ($the_ipfile_path))
 {
   $file=fopen($the_ipfile_path,"w+");
   fclose($file);   
 } 

 $result=0; 
 $file = fopen($the_ipfile_path, "r");
 if ($file!=FALSE)
  {
   if (filesize($the_ipfile_path)>5)
   {
    $input = fread($file, filesize($the_ipfile_path));
    $result = strpos  ( $input , $theip  );
   } else
   { $result = FALSE; }
   
   if ($result === FALSE) { $result=0; } else
                          { $result=2; }  
   fclose($file);
  } else
  { echo "hm.. problem..";
    return 1; }
  
 return $result;
}

function register_poll_result($the_file,$theip,$thepoll_choice,$name,$comments)
{  
$the_file_path="poll_data/".$the_file.".dat";
$the_ipfile_path="poll_data/".$the_file."ip.dat";

  
     // WRITE DATA 
     $file=fopen($the_file_path,"a");
      
     if ( $file != FALSE ) 
     { 
      $thepoll_choice = str_replace("\n", "", $thepoll_choice);
      fwrite($file,$thepoll_choice."\n"); 
     
      $name = str_replace("\n", "", $name);
      fwrite($file,$name."\n"); 
     
      $comments = str_replace("\n", "", $comments);
      fwrite($file,$comments."\n"); 
     
      fclose($file);  
     } else 
     
     {
     	return 0;
     }        	     
     // WRITE IP
     
     
     $file=fopen($the_ipfile_path,"a");
     if ( $file != FALSE ) 
     { 
      fwrite($file,$theip."\n"); 
      fclose($file);    
     } 
       else  
     {
     	 // VOTING IP NOT REGISTERED :P
     }        	
     
   return 1;
    
}

function poll_exists($the_file)
{
 if (!file_exists ($the_file))
 {
   return 0;   
 } 
   return 1;
}

if (isset($_REQUEST['poll']))
//if "poll" selection is filled out, send it  
{
  $poll_name= $_REQUEST['poll_name'] ; 
  $poll_choice = $_REQUEST['poll'] ; 
  $name = $_REQUEST['name'] ;
  $comments = $_REQUEST['comments'] ;
   
  if ($_SERVER['HTTP_X_FORWARD_FOR']) 
   {
       $ip = $_SERVER['HTTP_X_FORWARD_FOR'];
   } else 
   {
       $ip = $_SERVER['REMOTE_ADDR'];
   } 
    
   if ( poll_exists($poll_name) )
   {   
    if ( check_ip_votes($poll_name,$ip)==0)
    {
     if ( register_poll_result($poll_name,$ip,$poll_choice,$name,$comments) )
      { 
        echo "Thank you for using my poll form , you selected #".$poll_choice." from IP ".$ip."<br>" ;
        echo "Remember only one vote per IP , hope you used it wisely!<br><br>";
        echo "<a href=\"poll_results.php?poll_name=".$poll_name."\" target=\"_new\" >See the results</a>";
      } else 
      {
      	echo "<strong>Sorry , but voting is not yet enabled for this poll..!</strong><br><a href=\"javascript:history.go(-1)\">Click here to go back</a><br>";
     
      	}
    } else
    {
      echo "Only one vote per IP , sorry!<br><a href=\"javascript:history.go(-1)\">Click here to go back</a><br>";
    }
   } else { echo "Sorry this poll does not exist!<br><a href=\"javascript:history.go(-1)\">Click here to go back</a><br>"; }
   	
  }
else 
  {
  echo " Please select a poll item by clicking one of the radio buttons ( the buttons look like this -> <input name=\"sample\" value=\"x\" type=\"radio\"> <- )";
  echo "<br><a href=\"javascript:history.go(-1)\">Click here to go back</a><br>";
  }
?>

</body>
</html>