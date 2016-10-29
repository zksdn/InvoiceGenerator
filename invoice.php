<?php
/* Invoice Generator - 2015
 * Free and Open Source
 * Developed by Mohamed Zakaria SAIDANE
 * https://github.com/medzaksdn/InvoiceGenerator
 */

if (!isset($_POST["tax"]) || !isset($_POST["discount"]) || !isset($_POST["currency"]) || !isset($_POST["invoiceName"]) || !isset($_POST["invoiceID"]) || !isset($_POST["invoiceDate"]) || !isset($_POST["businessName1"]) || !isset($_POST["adressline1"]) || !isset($_POST["phone1"]) || !isset($_POST["email1"]) || !isset($_POST["businessName2"]) || !isset($_POST["adressline2"]) || !isset($_POST["phone2"]) || !isset($_POST["email2"]) || !isset($_POST["nbritem"]) || !isset($_POST["subtotalhidden"]) || !isset($_POST["discountvalue"]) || !isset($_POST["taxvalue"]) || !isset($_POST["totalhidden"]) || !isset($_POST["notes"]) || !isset($_POST["terms"])) {
    header('Location: invoice.html');
}

// this function 
function renderPhpToString($phpfile, $variables=null) {
    if (is_array($variables) && !empty($variables)) {
        extract($variables);
    }
    ob_start();
    include $phpfile;
    return ob_get_clean();
}

$tax = $_POST["tax"];
$discount = $_POST["discount"];
$currency = $_POST["currency"];

$invoiceName = $_POST["invoiceName"];
$invoiceID = $_POST["invoiceID"];
$invoiceDate = $_POST["invoiceDate"];

$businessName1 = $_POST["businessName1"];
$adressline1 = $_POST["adressline1"];
$phone1 = $_POST["phone1"];
$email1 = $_POST["email1"];

$businessName2 = $_POST["businessName2"];
$adressline2 = $_POST["adressline2"];
$phone2 = $_POST["phone2"];
$email2 = $_POST["email2"];

$nbritem = $_POST["nbritem"];

$subtotalhidden = $_POST["subtotalhidden"];
$discountvalue = $_POST["discountvalue"];
$taxvalue = $_POST["taxvalue"];
$totalhidden = $_POST["totalhidden"];

$notes = $_POST["notes"];
$terms = $_POST["terms"];

$items='';
for ($i = 1; $i <= $nbritem; $i++)
{
    $items=$items.
	'<tr>
       <td style="width: 30%;">'.$_POST["item".$i].'</td>
	   <td style="width: 20%;">'.$_POST["quantity".$i].'</td>
	   <td style="width: 25%;">'.$_POST["price".$i].' '.$currency.' </td>
	   <td style="width: 25%;"> '.$_POST["subtothidden".$i].' '.$currency.'</td>
	</tr>';
}

if($notes==""){ $notesdisplay = ""; } else{ $notesdisplay = "Notes :";}
if($terms==""){ $termsdisplay = ""; } else{ $termsdisplay = "Terms :";}


// Upload logo
$target_dir ="company-logo/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false)
	{
        $uploadOk = 1;
    } 
	else
	{
        $uploadOk = 0;
    }
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
    $uploadOk = 0;
}
// Check if $uploadOk
if ($uploadOk == 1) {
	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
		$logo = '<img src="company-logo/'.basename( $_FILES["fileToUpload"]["name"]).'" style="width: 50mm;" />';
    } 
	else {
        $logo="";
    }
}
//end upload logo

$vars = array(
"invoiceID"=>$invoiceID, 
"invoiceDate"=>$invoiceDate, 
"invoiceName"=>$invoiceName, 
"logo"=>$logo, 
"businessName1"=>$businessName1, 
"adressline1"=>$adressline1,  
"phone1"=>$phone1,  
"email1"=>$email1, 
"businessName2"=>$businessName2, 
"adressline2"=>$adressline2,  
"phone2"=>$phone2,  
"email2"=>$email2,  
"items"=>$items, 
"subtotalhidden"=>$subtotalhidden, 
"currency"=>$currency, 
"discountvalue"=>$discountvalue, 
"taxvalue"=>$taxvalue, 
"totalhidden"=>$totalhidden, 
"currency"=>$currency, 
"notesdisplay"=>$notesdisplay, 
"termsdisplay"=>$termsdisplay, 
"notes"=>$notes, 
"terms"=>$terms, 
);

$html = renderPhpToString("template.php",  $vars);

require_once __DIR__.'/vendor/html2pdf/html2pdf.class.php';
$html2pdf = new HTML2PDF('P','A4','fr');
$html2pdf->pdf->SetDisplayMode('real');
$html2pdf->writeHTML($html);
$html2pdf->Output('invoice.pdf', 'F');

header('Location: invoice.pdf');
?>