<html>
<body>

<?php
error_reporting (0);

function view_stats_for_poll($the_file)
{
$the_file_path="poll_data/".$the_file.".dat";
if (!file_exists ($the_file_path))
 {
    echo "The Poll you requested does not exist .. ";
 } else
 {
     $file=fopen($the_file_path,"r");
     $thepoll_choice = str_replace("\n", "", $thepoll_choice);
     
     $count=0; $votes_passed=0;
     $max_option=0;
     $votes[0]=0;
     while (!feof($file)) // Loop til end of file.
       {
           $buffer = trim  ( fgets($file, 4096) ); // Read a line.
           if (strlen($buffer)==0) {} else 
           if ($count % 3 == 0 ) 
            { 
              $votes[(int) $buffer]++;
              if ((int) $buffer>$max_option) { $max_option=(int) $buffer; } 
              $votes_passed++;
              //echo "Line #".$count." ".$buffer."<br>";
            }  
            $count++;
       }
       
       
    echo "<table border = 0>";   
    echo "<tr><td bgcolor=\"#CCCCCC\"> &nbsp; </td><td bgcolor=\"#CCCCCC\" width=400> &nbsp; </td>";
      for($i=1; $i<=$max_option; $i=$i+1)
	 {
		echo "<tr><td bgcolor=\"#CCCCCC\">Option ".$i."</td>";
		echo "<td>";
		$numpc=$votes[$i]/$votes_passed;
		echo "<table width=".(round(1000 * $numpc))." height=40 bgcolor=\"#00CCCC\" ><tr><td></td></tr></table>";
		if ($votes[$i]==0) { echo "No votes"; } else
		                   { echo $votes[$i]." votes (".(round(100*$numpc))." % ) "; }
		echo "</td></tr>";
	 }
	 echo "<tr><td bgcolor=\"#CCCCCC\">Total</td><td bgcolor=\"#CCCCCC\">".$votes_passed." votes</td>";
     echo "<table>";   
     
 
     fclose($file);  
     // WRITE IP
     
 }
}
 

 if (isset($_GET['poll_name']))
 {
  $poll_name= $_GET['poll_name'] ; 
  
     echo "Thank you for using my poll form , you selected to view stats for Poll `".$poll_name."` <br><br>";
     echo "<a href=\"view_poll?poll_name=".$poll_name."\">Go to the actual poll</a>";
     view_stats_for_poll($poll_name);
  }
else 
  {
     echo " Please select a poll item to view it";
  }
?>
<br><br><center><small><small> Powered by Apolls written by Ammar Qammaz</small></small></center><br>
</body>
</html>