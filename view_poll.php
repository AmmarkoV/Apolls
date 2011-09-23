<html>
<body>

<?php

 
function view_poll($the_file)
{  
  $the_file_path="poll_data/".$the_file.".dat";
  $the_ipfile_path="poll_data/".$the_file."ip.dat";
  
  
  
  $handle = @fopen($the_file, "r"); // Open file form read.  
  
  $title = fgets($handle, 4096); // Read a line.  
  $description = fgets($handle, 4096); // Read a line.  
  $empty1 = fgets($handle, 4096); // Read a line.  
  $music = fgets($handle, 4096); // Read a line.  
  $empty2 = fgets($handle, 4096); // Read a line.  
  $number_of_options = fgets($handle, 4096); // Read a line.  
  
   
  echo "
  <!DOCTYPE html PUBLIC \"-//W3C//DTD HTML 4.01//EN\" \"http://www.w3.org/TR/html4/strict.dtd\">
  <html lang=\"el\"><head>
  <meta content=\"text/html; charset=UTF-8\" http-equiv=\"content-type\">
   <title>".$title."</title>
   <style type=\"text/css\">
   A:link {text-decoration: none}
   A:visited {text-decoration: none}
   A:active {text-decoration: none}
   A:hover {text-decoration: underline overline; color: red;}
   </style>
   </head>
   <body>
   <div style=\"text-align: center;\">
   
    <big><big><big><big>".$title."</big></big></big></big><br><br>";
    
   echo $description."<br>Μπορείτε να πείτε την γνώμη σας επιλέγετε ένα από όλα και αν θέλετε γράφοντας και ένα όνομα κάτω, αλλιώς κάντε click εδώ για να επιστρέψετε στο προηγούμενο site
Από κάθε υπολογιστή ( IP ) μπορείτε να κάνετε cast 1 vote<br></div><br>";
   
    
   if ($music==1) 
     {
     	 echo "
     	        <OBJECT classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\"
 codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0\"
 WIDTH=\"20\" HEIGHT=\"20\" id=\"music\" ALIGN=\"\">
 <PARAM NAME=movie VALUE=\"music_button.swf\"> <PARAM NAME=quality VALUE=high> <PARAM NAME=bgcolor VALUE=#000000> <EMBED src=\"music_button.swf\" quality=high bgcolor=#000000  WIDTH=\"20\" HEIGHT=\"20\" NAME=\"music\" ALIGN=\"\" swLiveConnect=\"true\" TYPE=\"application/x-shockwave-flash\" PLUGINSPAGE=\"http://www.macromedia.com/go/getflashplayer\"></EMBED>
 </OBJECT>  
     	            
     	      ";
     	}    
    
   echo "
     <form method=\"post\" action=\"poll.php\" name=\"choose\">
        <input name=\"poll_name\" value=".$the_file." type=\"hidden\"><br>
          <div style=\"text-align: center;\">
            <center>
               <table style=\"text-align: left; width: 80%;\" border=\"1\" cellpadding=\"2\" cellspacing=\"2\">
                 <tbody> ";
                 
                
                 for ($choice_num = 1; $choice_num <= $number_of_options ; $choice_num++) 
                   {  
                   
                                  
                     $choice_label   = fgets($handle, 4096); // Read a line.  
                     $choice_label_more_detail   = fgets($handle, 4096); // Read a line.              
                     $choice_pros   = fgets($handle, 4096); // Read a line.  
                     $choice_cons   = fgets($handle, 4096); // Read a line.  
                     $empty_line    = fgets($handle, 4096); // Read a line.  
                     
                     echo "<tr><td>&nbsp; &nbsp; &nbsp; <input name=\"poll\" value=".$choice_num." type=\"radio\">&nbsp; &nbsp; &nbsp; &nbsp;</td>";
                     
                     // IMAGE 
                     echo "<td>
                             <img style=\"width: 340px; height: 300px;\" alt=\"".$choice_label."\" title=\"".$choice_label."\" src=\"poll_images/".$the_file."/choice".$choice_num.".jpg\">
                           </td>";
                           
                     echo "<td>
                            <big> <span style=\"font-weight: bold;\">".$choice_label."</span><br><br>
                                ".$choice_label_more_detail."</big><br><br><br>                             
                             
                                <strong>Pros</strong><br>
                                 ".$choice_pros."
                                <br><br><strong>Cons</strong><br>
                                 ".$choice_cons."                            
                             
                           </td></tr>                           
                          "; 
                   }
                
 echo "
           </tbody>
          </table>
         </center>
       </div>
          <br>&nbsp;<br>
              Name : <input name=\"name\" value=\"Nickname or mail or whatever you want :) \"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <br><br>
              Other Suggestions : <br>
                     <input size=\"200\" maxlength=\"1024\" name=\"comments\" value=\"Reasons for choice , personal experiences , spam etc.\"><br><br>
                   &nbsp; <input value=\"Register Choice!\" type=\"submit\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                   
         echo" <a href=\"poll_results.php?poll_name=".$the_file."\" target=\"_new\">
               View Results ( Generated realtime :) )..! </a>
               </form><br><br><center><small><small> Powered by Apolls written by Ammar Qammaz</small></small></center><br></body></html>    
            ";
    
    
  fclose($handle); // Close the file.
}

 

 if (isset($_GET["poll_name"]))
  //if "poll" selection is filled out, send it  
  {
      view_poll($_GET["poll_name"]); 
  }
else 
  {
  echo " Please select a poll item by clicking one of the radio buttons ( the buttons look like this -> <input name=\"sample\" value=\"x\" type=\"radio\"> <- )";
  echo "<br><a href=\"javascript:history.go(-1)\">Click here to go back</a><br>";
  }
?>

</body>
</html>