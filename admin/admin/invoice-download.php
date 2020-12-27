<?php
session_start();
include('../includes/connection.php');

$ord = $_GET['ord'];
$usr = $_GET['usr'];
$status = $_GET['status'];

$getName = $connect2db->prepare("SELECT fname, lname FROM users WHERE id = ?");
$getName->execute([$usr]);
$name = $getName->fetch();
$names = $name->fname." ".$name->lname;

require ('fpdf/fpdf.php');
    class mypdf extends FPDF{

//echo $status;
function tableHead(){
        $this->SetFont('times', 'B', 12);
        $this->cell(75,10,'Subject',1,0,'C');
        $this->cell(65,10,'Percentage',1,0,'C');
        $this->cell(70,10,'Remark',1,0,'C');
        $this->cell(65,10,'Grade',1,0,'C');
        $this->Ln();
    }
}

$pdf = new mypdf();
$pdf->AliasNbPages();
$pdf->AddPage('L','A4', 0);
$pdf->image ('images/logo-white.png', 3);
$pdf ->SetFont("arial","B",12);
$pdf->Cell(50, 10, "Hello, ".$names, 0,1);
$pdf->Ln();
$pdf->Cell(50, 10, "Thank you for your order from EchteZalm. Your packaged has been processed and ready to be delivered to you.", 0,1);
$pdf->Cell(50, 10, "Your package would arrive between 1 - 2 days from now.Your order confirmation is below, thanks again for Patronizing us.", 0,1);
//$pdf->studentData();
$pdf->tableHead(); 
//$pdf->viewResult();
$pdf->output();


?>


