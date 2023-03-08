<?php
  if(isset($_FILES['file'])) {
    $file_name = $_FILES['file']['name'];
    $file_temp = $_FILES['file']['tmp_name'];
    
    if(move_uploaded_file($file_temp, $file_name)) {
      $pdf_name = substr($file_name, 0, -4).".pdf";
      exec("convert $file_name $pdf_name");
      
      if(file_exists($pdf_name)) {
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="'.$pdf_name.'"');
        readfile($pdf_name);
        unlink($pdf_name);
        exit;
      }
    }
  }
?>
