
<?php 

    require("fdf/fpdf.php");
require('Database.php');

// php class

class PDF_JavaScript extends FPDF {

    protected $javascript;
    protected $n_js;

    function IncludeJS($script, $isUTF8=false) {
        if(!$isUTF8)
            $script=utf8_encode($script);
        $this->javascript=$script;
    }

    function _putjavascript() {
        $this->_newobj();
        $this->n_js=$this->n;
        $this->_put('<<');
        $this->_put('/Names [(EmbeddedJS) '.($this->n+1).' 0 R]');
        $this->_put('>>');
        $this->_put('endobj');
        $this->_newobj();
        $this->_put('<<');
        $this->_put('/S /JavaScript');
        $this->_put('/JS '.$this->_textstring($this->javascript));
        $this->_put('>>');
        $this->_put('endobj');
    }

    function _putresources() {
        parent::_putresources();
        if (!empty($this->javascript)) {
            $this->_putjavascript();
        }
    }

    function _putcatalog() {
        parent::_putcatalog();
        if (!empty($this->javascript)) {
            $this->_put('/Names <</JavaScript '.($this->n_js).' 0 R>>');
        }
    }
}

class PDF_AutoPrint extends PDF_JavaScript
{
    function AutoPrint($printer='')
    {
        // Open the print dialog
        if($printer)
        {
            $printer = str_replace('\\', '\\\\', $printer);
            $script = "var pp = getPrintParams();";
            $script .= "pp.interactive = pp.constants.interactionLevel.full;";
            $script .= "pp.printerName = '$printer'";
            $script .= "print(pp);";
        }
        else
            $script = 'print(true);';
        $this->IncludeJS($script);
    }
}




  if(isset($_GET['filename']) && isset($_GET['no']))
  {
  $filename=$_GET['filename'];
      $no=$_GET['no'];
  $query='SELECT applicant.applicant_passportno,applicant_firstname,applicant_lastname, application.application_visaType, application.application_enterby, application.application_invoice_no, application.application_referenceno, point_of_contact.poc_firstname
  FROM point_of_contact
      inner JOIN application ON application.application_poc_id = point_of_contact.poc_id
      inner JOIN applicant ON application.application_applicant_id = applicant.applicant_id
  where application.application_referenceno="'.$no.'"';
  
    $result=mysqli_query($connection,$query);
    //  $count=mysqli_num_rows($result);
      
  $pdf = new PDF_AutoPrint('L','in',array(4,6));
  //$pdf = new FPDF('L');
  //$pdf->AddPage();
  $pdf->SetFont('helvetica','',14);
  //for($i=1;$i<=3;$i++)  
    //$pdf->Image($filepath,10,(15*$i),30);
  //$pdf->Image($filepath,10,50,280,150,'png');
  //$pdf->Image($filepath,15,102,180,80,'png');
  //$pdf->Image($filepath,15,202,180,80,'png');
  //$pdf->Image($filepath,15,302,180,80,'png');
  //$pdf->Image($filepath,1,44,395,40,'png');
  //$pdf->Image($filepath,1,86,395,40,'png');
    //  $row=mysqli_fetch_assoc($result);
  //for($i=0;$i<=$count;$i++)
  $count=0;
  while($row=mysqli_fetch_assoc($result))
  {
      $count++;
      $fullname=$row['applicant_firstname'].' '.$row['applicant_lastname'];
      $righttext=$row['application_visaType']." ".$row['application_invoice_no'];
      $pdf->AddPage();
      $pdf->ln(0.1);
      $pdf->Cell(0,0,"REIRED Tourism Services",0,0,'C');
      $pdf->ln(0.4);
      $pdf->multiCell(0,0,$row['application_enterby']);
      $pdf->Cell(4.5);
      $lefttext=$row['application_enterby'];
      $pdf->multiCell(0.8,0.2,$righttext);
   //  $pdf->MultiCell(3, 0, $lefttext, 1, 'L', 0, 0, '', '', true, 0, false, true, 0);
   //   $pdf->MultiCell(, 0, $righttext, 1, 'R', 0, 1, '', '', true, 0, false, true, 0);
      if(strlen($righttext)>15)
      $pdf->ln(0.3);
      else
      $pdf->ln(0.8);
      $pdf->Cell(0,0,$no,0,0,'C');
      $pdf->ln(0.2);
     // if($i==$count)
     // $index=" X1";
     // else
      //$index=$row['application_passportno'];
      $pdf->cell(0,0,$fullname.$index,0,0,'C');
      $pdf->Image('barcodeimages/'.$filename,1.3,0.6,3.6,1.3,'png');
  }
  // last slip
  $result=mysqli_query($connection,$query);
      $row=mysqli_fetch_assoc($result);
      {
     // $count++;
      $fullname=$row['applicant_firstname'].' '.$row['applicant_lastname'];
      $righttext=$row['application_visaType']." ".$row['application_invoice_no'];
      $pdf->AddPage();
      $pdf->ln(0.1);
      $pdf->Cell(0,0,"REIRED Tourism Services",0,0,'C');
      $pdf->ln(0.4);
      $pdf->multiCell(0,0,$row['application_enterby']);
      $pdf->Cell(4.5);
      $pdf->multiCell(0.8,0.2,$righttext);
      if(strlen($righttext)>15)
      $pdf->ln(0.3);
      else
      $pdf->ln(0.8);
      $pdf->Cell(0,0,$no,0,0,'C');
      $pdf->ln(0.2);
     // if($i==$count)
     // $index=" X1";
     // else
      //$index=$row['application_passportno'];
      $pdf->cell(0,0,$fullname.' X '.$count,0,0,'C');
      $pdf->Image('barcodeimages/'.$filename,1.3,0.6,3.6,1.3,'png');    
      }
      /* lead pax
      $fullname=$row['poc_firstname'].' '.$row['poc_lastname'];
      $righttext=$row['application_visaType']." ".$row['application_invoice_no'];
      $pdf->AddPage();
      $pdf->ln(0.1);
      $pdf->Cell(0,0,"REIRED Tourism Services",0,0,'C');
      $pdf->ln(0.4);
      $pdf->multiCell(0,0,$row['application_enterby']);
      $pdf->Cell(4.5);
      $pdf->multiCell(0.8,0.2,$righttext);
      if(strlen($righttext)>15)
      $pdf->ln(0.3);
      else
      $pdf->ln(0.8);
      $pdf->Cell(0,0,$no,0,0,'C');
      $pdf->ln(0.2);
     // if($i==$count)
      $index=" X1";
     // else
     // $index=$row['application_passportno'];
      $pdf->cell(0,0,$row['poc_firstname'].' | '.$index,0,0,'C');*/
   //   $pdf->Image('barcodeimages/'.$filename,1.1,0.6,3.8,1.3,'png');
  //$pdf->Image($filepath,0.3,1.9,2.5,1.6,'png');
  //$pdf->Image($filepath,0.3,3.4,2.5,1.6,'png');
  //$pdf->Image($filepath,1,1.4,1.5,1.2,'png');
  //$pdf->Image($filepath,1,2.6,1.5,1.2,'png');
        ob_end_clean();
        $pdf->AutoPrint();
        $pdf->Output($filename.'.pdf', 'I');
  
  unlink('barcodeimages/'.$filename);   
  }
  
  /*
      require("fdf/fpdf.php");
  require('Database.php');
  if(isset($_GET['filename']) && isset($_GET['no']))
  {
  $filename=$_GET['filename'];
      $no=$_GET['no'];
  $query='SELECT applicant.applicant_passportno, application.application_visaType, application.application_enterby, application.application_invoice_no, application.application_referenceno, point_of_contact.poc_firstname
  FROM point_of_contact
      inner JOIN application ON application.application_poc_id = point_of_contact.poc_id
      inner JOIN applicant ON application.application_applicant_id = applicant.applicant_id
  where application.application_referenceno="'.$no.'"';
  
     $result=mysqli_query($connection,$query);
      $count=mysqli_num_rows($result);
      
  $pdf = new FPDF('L','in',array(4,6));
  //$pdf = new FPDF('L');
  //$pdf->AddPage();
  $pdf->SetFont('Times','',14);
  //for($i=1;$i<=3;$i++)  
    //$pdf->Image($filepath,10,(15*$i),30);
  //$pdf->Image($filepath,10,50,280,150,'png');
  //$pdf->Image($filepath,15,102,180,80,'png');
  //$pdf->Image($filepath,15,202,180,80,'png');
  //$pdf->Image($filepath,15,302,180,80,'png');
  //$pdf->Image($filepath,1,44,395,40,'png');
  //$pdf->Image($filepath,1,86,395,40,'png');
      $row=mysqli_fetch_assoc($result);
  for($i=0;$i<=$count;$i++)
  {
      $righttext=$row['application_visaType']." ".$row['application_invoice_no'];
      $pdf->AddPage();
      $pdf->ln(0.1);
      $pdf->Cell(0,0,"REIRED Tourism Services",0,0,'C');
      $pdf->ln(0.4);
      $pdf->multiCell(0,0,$row['application_enterby']);
      $pdf->Cell(4.5);
      $pdf->multiCell(0.8,0.2,$righttext);
      if(strlen($righttext)>15)
      $pdf->ln(0.3);
      else
      $pdf->ln(0.8);
      $pdf->Cell(0,0,$no,0,0,'C');
      $pdf->ln(0.2);
      if($i==$count)
      $index=" X1";
      else
      $index=$row['application_passportno'];
      $pdf->cell(0,0,$row['poc_firstname'].' | '.$index,0,0,'C');
      $pdf->Image('barcodeimages/'.$filename,1.1,0.6,3.8,1.3,'png');
  }
  //$pdf->Image($filepath,0.3,1.9,2.5,1.6,'png');
  //$pdf->Image($filepath,0.3,3.4,2.5,1.6,'png');
  //$pdf->Image($filepath,1,1.4,1.5,1.2,'png');
  //$pdf->Image($filepath,1,2.6,1.5,1.2,'png');
        ob_end_clean();
  $pdf->Output($filename.'.pdf', 'I');
  
  unlink('barcodeimages/'.$filename);   
  }*/
  ?>
