<?php
$link = mysqli_connect('localhost','root','');
mysqli_select_db($link,'hotelmanagement');



$customer = $_GET['cuid'];
$title = $_GET['tit'];
$firstn = $_GET['fna'];
$lastn = $_GET['lna'];
$nation = $_GET['nan'];
$phone = $_GET['ph'];
$roomt = $_GET['rt'];
$adult = $_GET['ad'];
$child = $_GET['ch'];
$ch_in = $_GET['chin'];
$ch_out = $_GET['chout'];

$fp = 0;
$tax = 1;

$myDate = date('d/m/Y');  
$tdate1 = strtotime($ch_in);
$tdate2 = strtotime($ch_out);
$difference = $tdate2 - $tdate1;
$dif = floor($difference/(84600));

$noad = ', No of Adults:';
$nocd = ', No of Childs:';
$space = '  ';
$fullname = $title.$space.$firstn.$space.$lastn;
$pho = 'Phone: ';

$dif2 = floor($difference/(84600));

if($roomt=='Deluxe Room'){
	$fp = 500 * $dif2;
	$tax = $fp +($fp * 0.15);
}

if($roomt=='Orchid Suite'){
	$fp = 2000 * $dif2;
	$tax = $fp +($fp * 0.15);

}

if($roomt=='Club Room'){
	$fp = 1500 * $dif2;
	$tax = $fp +($fp * 0.15);
}

if($roomt=='Premier Room'){
	$fp = 1000 * $dif2;
	$tax = $fp +($fp * 0.15);
}
$query = "INSERT INTO bill_generate(customer_id, customer_name, adult, check_in, check_out, total_price) VALUES ('$customer','$fullname','$adult','$ch_in', '$ch_out', '$tax')";
$result = mysqli_query($link, $query);



require('fpdf17/fpdf.php');

//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm

$pdf = new FPDF('P','mm','A4');

$pdf->AddPage();

//set font to arial, bold, 14pt
$pdf->SetFont('Arial','B',14);

//Cell(width , height , text , border , end line , [align] )

$pdf->Cell(130	,5,'HOTEL PASSA',0,0);
$pdf->Cell(59	,5,'INVOICE',0,1);

//set font to arial, regular, 12pt
$pdf->SetFont('Arial','',12);

$pdf->Cell(130	,5,'Maria Probst Straße 3',0,0);
$pdf->Cell(59	,5,'',0,1);

$pdf->Cell(130	,5,'[Heidelberg, Germany, 69123]',0,0);
$pdf->Cell(25	,5,'Date',0,0);
$pdf->Cell(34	,5,$myDate,0,1);

$pdf->Cell(130	,5,'Phone [+4925146982598]',0,0);
$pdf->Cell(25	,5,'Invoice #',0,0);
$pdf->Cell(34	,5,'9',0,1);

$pdf->Cell(130	,5,'Fax [+12345678]',0,0);
$pdf->Cell(25	,5,'Customer ID',0,0);
$pdf->Cell(34	,5,$customer,0,1);

//dummy empty cell as a vertical spacer
$pdf->Cell(189	,10,'',0,1);

//billing address
$pdf->Cell(100	,5,'Bill to',0,1);

//add dummy cell at beginning of each line for indentation
$pdf->Cell(10	,5,'',0,0);
$pdf->Cell(90	,5,$fullname,0,1);

$pdf->Cell(10	,5,'',0,0);
$pdf->Cell(90	,5,'[Company Name]',0,1);

$pdf->Cell(10	,5,'',0,0);
$pdf->Cell(90	,5,'[Address]',0,1);

$pdf->Cell(10	,5,'',0,0);
$pdf->Cell(90	,5,$pho.$phone,0,1);

//dummy empty cell as a vertical spacer
$pdf->Cell(189	,10,'',0,1);

//invoice contents
$pdf->SetFont('Arial','B',12);

$pdf->Cell(130	,5,'Description',1,0);
$pdf->Cell(25	,5,'Days',1,0);
$pdf->Cell(34	,5,'Amount',1,1);

$pdf->SetFont('Arial','',12);


$pdf->Cell(130	,15,$roomt.$noad.$adult.$nocd.$child,1,0);
$pdf->Cell(25	,15,$dif2,1,0);
$pdf->Cell(34	,15,$fp,1,1,'R');


//summary
$pdf->Cell(130	,5,'',0,0);
$pdf->Cell(25	,5,'Subtotal',0,0);
$pdf->Cell(4	,5,'$',1,0);
$pdf->Cell(30	,5,$fp,1,1,'R');

$pdf->Cell(130	,5,'',0,0);
$pdf->Cell(25	,5,'Taxable',0,0);
$pdf->Cell(4	,5,'%',1,0);
$pdf->Cell(30	,5,'15',1,1,'R');

$pdf->Cell(130	,5,'',0,0);
$pdf->Cell(25	,5,'Total Due',0,0);
$pdf->Cell(4	,5,'$',1,0);
$pdf->Cell(30	,5,$tax,1,1,'R');





















$pdf->Output();

?>