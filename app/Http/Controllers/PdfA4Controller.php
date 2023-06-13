<?php

namespace App\Http\Controllers;

use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PdfA4Controller extends Controller
{
    protected $fpdf = [];

    public function __construct()
    {
        $this->fpdf = new Fpdf();
        $this->fpdf->AddPage();
    }

    // invoice header function
    public function ligne_head_table($cle, $valeur)
    {
        $this->fpdf->SetFillColor(155, 155, 155);
        $this->fpdf->Cell(95, 8, $cle, 0, 0, 'L', true);
        $this->fpdf->Cell(95, 8, $valeur, 0, 0, 'L', true);
        $this->fpdf->Ln();
    }

    // products list table header function
    public function entete_prod_table()
    {
        $this->fpdf->Cell(10, 8, utf8_decode('N°'), 1, 0, 'C');
        $this->fpdf->Cell(30, 8, utf8_decode('Référence'), 1, 0, 'C');
        $this->fpdf->Cell(70, 8, utf8_decode('Désignation'), 1, 0, 'C');
        $this->fpdf->Cell(10, 8, utf8_decode('Taxe'), 1, 0, 'C');
        $this->fpdf->Cell(10, 8, utf8_decode('Qte'), 1, 0, 'C');
        $this->fpdf->Cell(18, 8, utf8_decode('P.U HT'), 1, 0, 'C');
        $this->fpdf->Cell(18, 8, utf8_decode('P.U TTC'), 1, 0, 'C');
        $this->fpdf->Cell(24, 8, utf8_decode('Total TTC'), 1, 0, 'C');
    }

    // each product line function
    public function ligne_table(
        $count,
        $prod_ref,
        $prod,
        $tax,
        $qte,
        $ht,
        $ttc,
        $total
    ) {
        $this->fpdf->SetFillColor(255, 255, 255);
        $this->fpdf->Cell(10, 6, $count, 1, 0, 'C');
        $this->fpdf->Cell(30, 6, utf8_decode($prod_ref), 1, 0, 'L');
        $this->fpdf->Cell(70, 6, utf8_decode($prod), 1, 0, 'L');
        $this->fpdf->Cell(10, 6, $tax, 1, 0, 'C');
        $this->fpdf->Cell(10, 6, number_format($qte, 0, '', ' '), 1, 0, 'C');
        $this->fpdf->Cell(18, 6, number_format($ht, 0, '', ' '), 1, 0, 'R');
        $this->fpdf->Cell(18, 6, number_format($ttc, 0, '', ' '), 1, 0, 'R');
        $this->fpdf->Cell(24, 6, number_format($total, 0, '', ' '), 1, 0, 'R');
        $this->fpdf->Ln();
    }

    // create case function
    public function my_cell($w, $h, $txt, $border, $ln, $align, $fill)
    {
        $this->fpdf->Cell($w, $h, $txt, $border, $ln, $align, $fill);
    }

    // invoice footer function
    public function sum_total($image, $val1, $val2, $val3, $val4)
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
        $customerName = 'inconnu';
        $customerIFU = ' ';
        $customerTel = ' ';

        // le client est fourni par le champ select
        // if (!empty($request->customer)) {
        //     $client = DB::table('t_client')
        //         ->select('NomCli', 'NumIFU', 'Tel_1')
        //         ->where('IDt_ClientPK', '=', $request->customer)
        //         ->first();

        //     $customerName = $client->NomCli;
        //     $customerIFU = $client->NumIFU;
        //     $customerTel = $client->Tel_1;
        // }

        // // le client est fourni par le formulaire
        // if (!empty($request->new_name) || !empty($request->new_ifu)) {
        //         $customerName = $request->new_name;
        //         $customerIFU = $request->new_contact;
        //         $customerTel = $request->new_ifu;
        // }

        $struct = DB::table('gmonentreprise')
            ->select('NumIFU', 'RCCM', 'Denomination', 'ActiviteExerce')
            ->where('CodeStruct', '=', Auth::user()->CodeStruct)
            ->where('effacer', '=', 0)
            ->first();

        $this->fpdf->SetFont('Arial', 'B', 15);
        $this->my_cell(0, 10, $struct->Denomination, 0, 0, 'L', '0');
        $this->fpdf->Ln(5);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->my_cell(0, 10, $struct->ActiviteExerce, 0, 0, 'L', '0');
        $this->fpdf->Ln(5);
        $this->my_cell(0, 10, utf8_decode('IFU n° ') . $struct->NumIFU . ' - ' . $struct->RCCM, 0, 0, 'L', '0');
        $this->fpdf->Ln(12);

        $this->ligne_head_table(utf8_decode("DELIVRE A"), utf8_decode("FACTURE"));
        $this->fpdf->SetFont('Arial', '', 10);
        $this->ligne_head_table(utf8_decode("CLIENT : " . $customerName), utf8_decode("Opérateur : " . Auth::user()->Nom . ' ' . Auth::user()->Prénom));
        $this->ligne_head_table(utf8_decode("N° IFU : " . $customerIFU), utf8_decode("Facture N° : " . $fact));
        $this->ligne_head_table(utf8_decode("CONTACTS : " . $customerTel), utf8_decode("Date d'émission : " . date('d-m-Y')));

        $this->fpdf->Ln(10);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->entete_prod_table();
        $this->fpdf->SetFont('Arial', '', 8);
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
                $product->RefCodeBar,
                $product->LibProd,
                $product->TypeTaxe,
                $product->Qtte,
                $product->PrixHT,
                $product->PrixHT * $product->Qtte,
                $product->PrixHT * $product->Qtte * $tax
            );
        }

        $this->fpdf->Ln(20);

        $this->fpdf->Output();
        exit;
    }
}
