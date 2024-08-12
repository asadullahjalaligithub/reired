<?php


$documentroot = $_SERVER['DOCUMENT_ROOT'] . "/";
date_default_timezone_set('Asia/Kabul');

$passportnumber = $_GET['passportnumber'];
require ($documentroot . 'Database.php');
$query = "select * from applicant inner join biometric on applicant.applicant_id = biometric.applicant_id where applicant_passportno='" . $passportnumber . "'";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($result);
$xml = new DomDocument("1.0");
$xml->formatOutput = "true";

// ppln tag
$ppln = $xml->createElement("PPLN");
$xml->appendChild($ppln);
//card tag
$card = $xml->createElement("CARD");
$card->setAttribute("VER", "1.0");
$card->setAttribute("TYPE", "TR_ID");
$ppln->appendChild($card);

//text tag
$text = $xml->createElement('TEXT');
$ppln->appendChild($text);

//105 
$txt_tag = $xml->createElement("TXT_TAG");
$txt_tag->setAttribute('TAG', '105');
$txt_tag->setAttribute('DESC', 'card number');
$text->appendChild($txt_tag);

//1402
$txt_tag = $xml->createElement("TXT_TAG");
$txt_tag->setAttribute('TAG', '1402');
$txt_tag->setAttribute('DESC', 'TC NO');
$text->appendChild($txt_tag);

//1403

$txt_tag = $xml->createElement("TXT_TAG", strtoupper($row['applicant_passportno']));
$txt_tag->setAttribute('DESC', 'foreign Identity NO');
$txt_tag->setAttribute('TAG', '1403');
$text->appendChild($txt_tag);

//111
$txt_tag = $xml->createElement("TXT_TAG", strtoupper($row['applicant_firstname']));
$txt_tag->setAttribute('TAG', '111');
$txt_tag->setAttribute('DESC', 'name');
$text->appendChild($txt_tag);

//110

$txt_tag = $xml->createElement("TXT_TAG", strtoupper($row['applicant_lastname']));
$txt_tag->setAttribute('TAG', '110');
$txt_tag->setAttribute('DESC', 'surname');
$text->appendChild($txt_tag);

//1303

$txt_tag = $xml->createElement('TXT_TAG');
$txt_tag->setAttribute('TAG', '1303');
$txt_tag->setAttribute('DESC', 'maiden name');
$text->appendChild($txt_tag);

//173
$txt_tag = $xml->createElement("TXT_TAG", strtoupper($row['fathername']));
$txt_tag->setAttribute('TAG', '173');
$txt_tag->setAttribute('DESC', 'father name');
$text->appendChild($txt_tag);

// 174

$txt_tag = $xml->createElement("TXT_TAG", strtoupper($row['mothername']));
$txt_tag->setAttribute('TAG', '174');
$txt_tag->setAttribute('DESC', 'mother name');
$text->appendChild($txt_tag);

//107
$txt_tag = $xml->createElement("TXT_TAG", strtoupper($row['applicant_dob']));
$txt_tag->setAttribute('TAG', '107');
$txt_tag->setAttribute('DESC', 'birth date');
$text->appendChild($txt_tag);

//108

if ($row['applicant_gender'] == 'male')
    $txt_tag = $xml->createElement("TXT_TAG", "1");
else
    $txt_tag = $xml->createElement("TXT_TAG", "2");
$txt_tag->setAttribute('TAG', '108');
$txt_tag->setAttribute('DESC', 'gender');
$text->appendChild($txt_tag);


//1415
$txt_tag = $xml->createElement("TXT_TAG", "AFG AFGHANISTAN");
$txt_tag->setAttribute('DESC', 'registration place - province');
$txt_tag->setAttribute('TAG', '1415');
$text->appendChild($txt_tag);

//1416
$txt_tag = $xml->createElement("TXT_TAG", "DISTRICT");
$txt_tag->setAttribute('DESC', 'registration place -  district');
$txt_tag->setAttribute('TAG', '1416');
$text->appendChild($txt_tag);

//365
$txt_tag = $xml->createElement("TXT_TAG", date('yy-m-d'));
$txt_tag->setAttribute('DESC', 'taken date');
$txt_tag->setAttribute('TAG', '365');
$text->appendChild($txt_tag);

//1417
$txt_tag = $xml->createElement("TXT_TAG");
$txt_tag->setAttribute('TAG', '1417');
$txt_tag->setAttribute('DESC', 'guid');
$text->appendChild($txt_tag);

//128
$txt_tag = $xml->createElement("TXT_TAG", "1111111111");
$txt_tag->setAttribute('DESC', 'Amputation Mask');
$txt_tag->setAttribute('TAG', '128');
$text->appendChild($txt_tag);


//131
$txt_tag = $xml->createElement("TXT_TAG", "1111111111");
$txt_tag->setAttribute('DESC', 'Finger Taken Mask');
$txt_tag->setAttribute('TAG', '131');
$text->appendChild($txt_tag);

//135
$txt_tag = $xml->createElement("TXT_TAG", "1111");
$txt_tag->setAttribute('DESC', 'Slap Mask');
$txt_tag->setAttribute('TAG', '135');
$text->appendChild($txt_tag);

//133
$txt_tag = $xml->createElement("TXT_TAG", "100");
$txt_tag->setAttribute('DESC', 'Foto Mask');
$txt_tag->setAttribute('TAG', '133');
$text->appendChild($txt_tag);

//720
$txt_tag = $xml->createElement('TXT_TAG', base64_encode($row['rightthumb12']));
$txt_tag->setAttribute('TAG', '720');
$txt_tag->setAttribute('DESC', 'TAG_IMAGE1');
$text->appendChild($txt_tag);


//721
$txt_tag = $xml->createElement('TXT_TAG', base64_encode($row['rightindex6']));
$txt_tag->setAttribute('TAG', '721');
$txt_tag->setAttribute('DESC', 'TAG_IMAGE2');
$text->appendChild($txt_tag);

//722
$txt_tag = $xml->createElement('TXT_TAG', base64_encode($row['rightmiddle8']));
$txt_tag->setAttribute('TAG', '722');
$txt_tag->setAttribute('DESC', 'TAG_IMAGE3');
$text->appendChild($txt_tag);


//723
$txt_tag = $xml->createElement('TXT_TAG', base64_encode($row['rightring9']));
$txt_tag->setAttribute('TAG', '723');
$txt_tag->setAttribute('DESC', 'TAG_IMAGE4');
$text->appendChild($txt_tag);

//724
$txt_tag = $xml->createElement('TXT_TAG', base64_encode($row['rightlittle7']));
$txt_tag->setAttribute('TAG', '724');
$txt_tag->setAttribute('DESC', 'TAG_IMAGE5');
$text->appendChild($txt_tag);

//725
$txt_tag = $xml->createElement('TXT_TAG', base64_encode($row['leftthumb11']));
$txt_tag->setAttribute('TAG', '725');
$txt_tag->setAttribute('DESC', 'TAG_IMAGE6');
$text->appendChild($txt_tag);

//726
$txt_tag = $xml->createElement('TXT_TAG', base64_encode($row['leftindex4']));
$txt_tag->setAttribute('TAG', '726');
$txt_tag->setAttribute('DESC', 'TAG_IMAGE7');
$text->appendChild($txt_tag);


//727
$txt_tag = $xml->createElement('TXT_TAG', base64_encode($row['leftmiddle3']));
$txt_tag->setAttribute('TAG', '727');
$txt_tag->setAttribute('DESC', 'TAG_IMAGE8');
$text->appendChild($txt_tag);

//728
$txt_tag = $xml->createElement('TXT_TAG', base64_encode($row['leftring2']));
$txt_tag->setAttribute('TAG', '728');
$txt_tag->setAttribute('DESC', 'TAG_IMAGE9');
$text->appendChild($txt_tag);


//729
$txt_tag = $xml->createElement('TXT_TAG', base64_encode($row['leftlittle1']));
$txt_tag->setAttribute('TAG', '729');
$txt_tag->setAttribute('DESC', 'TAG_IMAGE10');
$text->appendChild($txt_tag);

//734
$txt_tag = $xml->createElement('TXT_TAG', base64_encode($row['leftfourprint5']));
$txt_tag->setAttribute('TAG', '734');
$txt_tag->setAttribute('DESC', 'TAG_CNT4LEFT');
$text->appendChild($txt_tag);


//735

$txt_tag = $xml->createElement('TXT_TAG', base64_encode($row['leftthumb11']));
$txt_tag->setAttribute('TAG', '735');
$txt_tag->setAttribute('DESC', 'TAG_CNTLEFT');
$text->appendChild($txt_tag);

//736

$txt_tag = $xml->createElement('TXT_TAG', base64_encode($row['rightthumb12']));
$txt_tag->setAttribute('TAG', '736');
$txt_tag->setAttribute('DESC', 'TAG_CNTRIGHT');
$text->appendChild($txt_tag);

//737


$txt_tag = $xml->createElement('TXT_TAG', base64_encode($row['rightfourprint10']));
$txt_tag->setAttribute('TAG', '737');
$txt_tag->setAttribute('DESC', 'TAG_CNT4RIGHT');
$text->appendChild($txt_tag);

//705

$txt_tag = $xml->createElement('TXT_TAG', base64_encode($row['face14']));
$txt_tag->setAttribute('TAG', '705');
$txt_tag->setAttribute('DESC', 'TAG_FOTO1');
$text->appendChild($txt_tag);

//706
$txt_tag = $xml->createElement('TXT_TAG');
$txt_tag->setAttribute('TAG', '706');
$txt_tag->setAttribute('DESC', 'TAG_FOTO2');
$text->appendChild($txt_tag);


//2200
$txt_tag = $xml->createElement('TXT_TAG');
$txt_tag->setAttribute('TAG', '2200');
$txt_tag->setAttribute('DESC', 'TAG_FOTO3');
$text->appendChild($txt_tag);

//$xml->save("final_bio_data.xml") or die("Unable to Create the file");
$filename = $row['applicant_passportno'];

header('Content-Disposition: attachment; filename=' . $filename . '.xml');
header("Content-Type: application/force-download");
header('Pragma: private');
header('Cache-control: private, must-revalidate');
echo $xml->saveXML();
//echo "<xmp>".$xml->saveXML()."</xmp>";

