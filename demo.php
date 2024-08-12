      <?php
      // barcode( $filepath, $text, $size, $orientation, $code_type, $print, $sizefactor );
    if(false)
    {
    require('barcode.php');
      $text='this is the wolrd that we are living in';
      barcode("barcodeimages/thebarcodeimage.png",$text,'50','horizontal','code39','false');
    }

require("fdf/fpdf.php");
class PDF extends FPDF
{
function Header()
{
    global $title;

    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Calculate width of title and position
    $w = $this->GetStringWidth($title)+6;
    $this->SetX((210-$w)/2);
    // Colors of frame, background and text
    $this->SetDrawColor(0,80,180);
    $this->SetFillColor(230,230,0);
    $this->SetTextColor(220,50,50);
    // Thickness of frame (1 mm)
    $this->SetLineWidth(1);
    // Title
    $this->Cell($w,9,$title,1,1,'C',true);
    // Line break
    $this->Ln(10);
}

function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Text color in gray
    $this->SetTextColor(128);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
}

function ChapterTitle($num, $label)
{
    // Arial 12
    $this->SetFont('Arial','',12);
    // Background color
    $this->SetFillColor(200,220,255);
    // Title
    $this->Cell(0,6,"Chapter $num : $label",0,1,'L',true);
    // Line break
    $this->Ln(4);
}

function ChapterBody($file)
{
    // Read text file
   // $txt = file_get_contents($file);
    // Times 12
    $this->SetFont('Times','',12);
    // Output justified text
    $this->MultiCell(0,5,$file);
    // Line break
    $this->Ln();
    // Mention in italics
    $this->SetFont('','I');
    $this->Cell(0,5,'(end of the lovely chapter)');
}

function PrintChapter($num, $title, $file)
{
    $this->AddPage();
    $this->ChapterTitle($num,$title);
    $this->ChapterBody($file);
}
}

$pdf = new PDF();
$title = 'afghanistan is my country ';
$pdf->SetTitle($title);
$pdf->SetAuthor('Asadullah Jalali');
$file='Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente, accusamus earum, tempora sint veritatis magni modi error odio fugiat ratione, blanditiis autem itaque nam corporis laudantium numquam est id dolor!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odio vel nesciunt eligendi nam, molestiae eveniet, accusamus, minus repellendus facere deleniti eum aliquid nobis corporis, suscipit eos ullam laudantium. Praesentium, possimus.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ullam libero, eius dolor, aperiam tempora dignissimos voluptatibus asperiores omnis molestiae distinctio atque facilis mollitia, sit maxime eum beatae? Et, blanditiis sit.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus dignissimos nihil, sit fugit minima est accusantium magnam qui debitis laborum consequuntur, dolore nam error culpa nulla quibusdam beatae fugiat exercitationem!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure temporibus eum, nostrum ut quae vitae accusamus in consequatur laboriosam, a impedit similique numquam animi aliquid nam. Cumque mollitia minima aliquid?Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatum dignissimos nihil velit architecto necessitatibus veritatis aspernatur. Cum quod impedit debitis doloribus, aspernatur quae porro nihil consequatur quisquam mollitia aliquam voluptates!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus maxime pariatur iure enim et! Recusandae ad maxime, et pariatur! Placeat rem vitae illo pariatur iste expedita sed, doloribus at assumenda?Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque iusto, tempora praesentium commodi quas quod rem autem? Amet, quisquam impedit ullam quasi consectetur recusandae possimus earum porro voluptate, eaque corporis.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Porro illo, nam quidem tempora. Atque esse explicabo praesentium, fugiat sequi, provident nulla dignissimos animi reprehenderit, quasi, iure ipsa sapiente officia magni.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ea repellendus, distinctio voluptates debitis ab doloremque. Nisi vero cum eius incidunt excepturi fuga, sapiente dolores inventore nemo voluptas, distinctio veniam quo!';
$pdf->PrintChapter(1,'this is a simple chapter',$file);
$pdf->PrintChapter(2,'this is a simple chapter',$file);
$pdf->PrintChapter(3,'this is a simple chapter',$file);
$pdf->PrintChapter(4,'this is a simple chapter',$file);
$pdf->PrintChapter(5,'this is a simple chapter',$file);
$pdf->Output();




















$curl = curl_init();

$headers = [];

$params = [];

$api_key=
curl_setopt_array($curl, array(
CURLOPT_URL => "",
CURLOPT_RETURNTRANSFER => true,
CURLOPT_ENCODING => "",
CURLOPT_MAXREDIRS => 10,
CURLOPT_TIMEOUT => 0,
CURLOPT_FOLLOWLOCATION => true,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => "",
CURLOPT_POSTFIELDS => json_encode($params),
CURLOPT_HTTPHEADER => $headers,
));
















      ?>