
<?php 
  
  $name = $_GET['name'];
  // The location of the PDF file 
  // on the server 
  $filename = "instructor/testupload/$name"; 
    
  echo $filename;
  //Header content type 
  header("Content-type: application/pdf"); 
    
  header("Content-Length: " . filesize($filename)); 
    
  // Send the file to the browser. 
  readfile($filename); 
  ?>  
  