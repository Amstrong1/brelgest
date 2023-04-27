<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\LigneFactureBrouillon;

class LigneFact extends Component
{
    public $prods, $product, $Qtte, $TypeTaxe, $prod_id;
    public $updateMode = false;

    public function render(Request $request)
    {
        $list_products = DB::table('t_produit')
            ->select('IDt_ProduitPK', 'LibProd')
            ->where('t_produit.CodeStruct', '=', Auth::user()->CodeStruct)
            ->where('t_produit.effacer', '=', 0)
            ->orderBy('LibProd', 'asc')
            ->get();

        $this->prods = DB::table('t_lignefact_brouillon')
            ->join('t_produit', 't_produit.IDt_ProduitPK', '=', 't_lignefact_brouillon.product')
            ->select('t_produit.LibProd', 't_produit.PrixHT', 't_lignefact_brouillon.id', 't_lignefact_brouillon.Qtte', 't_lignefact_brouillon.TypeTaxe')
            ->where("id_fact_brouillon", $request->session()->get('facture_session_id'))
            ->orderBy('id', 'asc')
            ->get();

        return view('livewire.ligne-fact', compact('list_products'));
    }

    private function resetInputFields()
    {
        $this->product = '';
        $this->Qtte = '';
        $this->TypeTaxe = '';
    }

    public function store(Request $request)
    {
        $validate = $this->validate([
            'product' => 'required',
            'Qtte' => 'required',
            'TypeTaxe' => 'required',
        ]);

        $other_attr = [
            "id_fact_brouillon" => $request->session()->get('facture_session_id'),
            "AjouterPar" => Auth::user()->Login
        ];

        $all_attr = array_merge($other_attr, $validate);

        LigneFactureBrouillon::create($all_attr);

        $this->resetInputFields();
    }

    public function edit($id)
    {
        $post = LigneFactureBrouillon::findOrFail($id);
        $this->prod_id = $id;
        $this->Qtte = $post->Qtte;
        $this->TypeTaxe = $post->TypeTaxe;

        $this->updateMode = true;
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function update()
    {
        $validatedDate = $this->validate([
            'Qtte' => 'required',
            'TypeTaxe' => 'required',
        ]);

        $post = LigneFactureBrouillon::find($this->prod_id);
        $post->update([
            'Qtte' => $this->Qtte,
            'TypeTaxe' => $this->TypeTaxe,
        ]);

        $this->updateMode = false;

        $this->resetInputFields();
    }

    public function delete($id)
    {
        LigneFactureBrouillon::find($id)->delete();
    }
}
