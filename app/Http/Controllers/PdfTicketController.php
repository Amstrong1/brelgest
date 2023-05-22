<?php

namespace App\Http\Controllers;

use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PdfTicketController extends Controller
{
    protected $fpdf = [];

    public function __construct()
    {
        $this->fpdf = new Fpdf('P', 'mm', array(80, 40));
        $this->fpdf->SetMargins(1, 2, 1);
        $this->fpdf->AddPage();
    }

    // invoice header function
    public function ligne_head_table($cle)
    {
        $this->fpdf->Cell(10, 2, $cle, 0, 0, 'L');
        $this->fpdf->Ln();
    }

    // products list table header function
    public function entete_prod_table()
    {
        $this->fpdf->Cell(2, 4, utf8_decode('N°'), 0, 0, 'C');
        $this->fpdf->Cell(20, 4, utf8_decode('Désignation'), 0, 0, 'C');
        $this->fpdf->Cell(5, 4, utf8_decode('Qte'), 0, 0, 'C');
        $this->fpdf->Cell(10, 4, utf8_decode('P.U HT'), 0, 0, 'C');
    }

    // each product line function
    public function ligne_table(
        $count,
        $prod,
        $qte,
        $pu
    ) {
        $this->fpdf->SetFillColor(255, 255, 255);
        $this->fpdf->Cell(2, 6, $count, 0, 0, 'C');
        $this->fpdf->Cell(20, 6, utf8_decode($prod), 0, 0, 'C');
        $this->fpdf->Cell(5, 6, $qte, 0, 0, 'C');
        $this->fpdf->Cell(10, 6, number_format($pu, 0, '', ' '), 0, 0, 'C');
        $this->fpdf->Ln();
    }

    // create case function
    public function my_cell($w, $h, $txt, $border, $ln, $align, $fill)
    {
        $this->fpdf->Cell($w, $h, $txt, $border, $ln, $align, $fill);
    }
    public function my_mcell($w, $h, $txt, $border, $align, $fill)
    {
        $this->fpdf->MultiCell($w, $h, $txt, $border, $align, $fill);
    }


    // invoice footer function
    public function sum_total($val1, $val2, $val3, $val4)
    {
        // $this->fpdf->Image($image, null, null, 0, 32);
        // $this->fpdf->Cell(0, 8, $image, 0, 0, 'L');
        $this->fpdf->Cell(35, 8, 'Code MECeF/DGI : ' . $val1, 0, 0, 'L');
        $this->fpdf->Ln();
        $this->fpdf->Cell(35, 8, 'MECeF NIM : ' . $val2, 0, 0, 'L');
        $this->fpdf->Ln();
        $this->fpdf->Cell(35, 8, 'Code MECeF/DGIMECeF Compteurs : ' . $val3, 0, 0, 'L');
        $this->fpdf->Ln();
        $this->fpdf->Cell(35, 8, 'MECeF Heure : ' . $val4, 0, 0, 'L');
        $this->fpdf->Ln();
    }

    public function index(Request $request, $fact)
    {
        //sans validation le client n'est pas enregistré
        //need request for get customer

        $struct = DB::table('gmonentreprise')
            ->select('NumIFU', 'RCCM', 'Denomination', 'ActiviteExerce')
            ->where('CodeStruct', '=', Auth::user()->CodeStruct)
            ->where('effacer', '=', 0)
            ->first();

        $this->fpdf->SetFont('Arial', 'B', 5);
        $this->my_mcell(0, 2, $struct->Denomination, 0, 'L', '0');
        $this->my_cell(0, 2, $struct->ActiviteExerce, 0, 0, 'L', '0');
        $this->fpdf->Ln();
        $this->my_cell(0, 2, $struct->NumIFU, 0, 0, 'L', '0');
        $this->fpdf->Ln();
        $this->my_cell(0, 2, $struct->RCCM, 0, 0, 'L', '0');
        $this->fpdf->Ln(3);

        $this->fpdf->SetFont('Arial', '', 4);
        $this->ligne_head_table(utf8_decode("Facture N° : " . $fact));
        $this->ligne_head_table(utf8_decode("CLIENT : "), utf8_decode("Opérateur : " . Auth::user()->Nom . ' ' . Auth::user()->Prénom));
        $this->ligne_head_table(utf8_decode("Date d'émission : " . date('d-m-Y')));

        $this->fpdf->Ln(3);
        $this->fpdf->SetFont('Arial', 'B', 5);
        $this->entete_prod_table();
        $this->fpdf->SetFont('Arial', '', 5);
        $this->fpdf->Ln();


        // table LigneFactureBrouillon
        $products = DB::table('t_lignefact_brouillon')
            ->join('t_produit', 't_lignefact_brouillon.product', '=', 't_produit.IDt_ProduitPK')
            ->select('t_lignefact_brouillon.Qtte', 't_lignefact_brouillon.TypeTaxe', 't_produit.RefCodeBar', 't_produit.LibProd', 't_produit.PrixHT')
            ->where('t_lignefact_brouillon.id_fact_brouillon', '=', $request->session()->get('facture_session_id'))
            ->where('t_lignefact_brouillon.AjouterPar', '=', Auth::user()->Login)
            ->get();

        $c = 0;
        $tax = 1;
        foreach ($products as $product) {

            if ($product->TypeTaxe == 'A' || $product->TypeTaxe == 'E') {
                $tax = 1;
            }
            if ($product->TypeTaxe == 'B' || $product->TypeTaxe == 'D') {
                $tax = 1.18;
            }

            $this->ligne_table(
                ++$c,
                $product->LibProd,
                $product->Qtte,
                $product->PrixHT,
            );
        }

        $this->fpdf->Ln(20);

        $this->fpdf->Output();
        exit;
    }
}
