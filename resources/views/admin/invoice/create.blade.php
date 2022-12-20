@extends('layouts.admin')
@section('content')
    <div class="container grid px-6 mx-auto">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Nouvelle Facture
        </h2>

        <div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">

                <form action="{{ route('admin.invoice.store') }}" method="post">
                    @csrf

                    <div class="lg:flex lg:justify-between lg:mr-32">
                        {{-- Info facture --}}
                        <div>
                            <div class="relative w-64 max-w-xl mr-6 ml-6 mt-6 mb-6 focus-within:text-purple-500">
                                <label for=""
                                    class="font-semibold tracking-wide text-left text-gray-500 dark:text-gray-400">N°
                                    Facture</label>

                                <input name="num_fact" type="number" disabled value="{{ $invoices->NumFacture + 1 }}"
                                    class="w-full pl-4 pr-2 text-sm text-gray-700 placeholder-gray-600 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input">
                            </div>

                            <div class="relative w-64 max-w-xl mr-6 ml-6 mt-6 mb-6 focus-within:text-purple-500">
                                <label
                                    class="font-semibold tracking-wide text-left text-gray-500 dark:text-gray-400">Date</label>
                                <input name="fact_date" type="date" required value="{{ date('Y-m-d') }}"
                                    class="w-full pl-4 pr-2 text-sm text-gray-700 placeholder-gray-600 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input">
                            </div>

                            <div class="relative w-64 max-w-xl mr-6 ml-6 mt-6 mb-6 focus-within:text-purple-500">
                                <label
                                    class="font-semibold tracking-wide text-left text-gray-500 dark:text-gray-400">Client</label>

                                <select
                                    class="w-full pl-4 pr-2 text-sm text-gray-700 placeholder-gray-600 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"
                                    name="customer">
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->IDt_ClientPK }}/{{ $customer->NomCli }}">
                                            {{ $customer->NomCli }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="relative w-64 max-w-xl mr-6 ml-6 mt-6 mb-6 focus-within:text-purple-500">
                                <label
                                    class="font-semibold tracking-wide text-left text-gray-500 dark:text-gray-400">Objet</label>
                                <textarea name="object" style="resize: none"
                                    class="w-full pl-4 pr-2 text-sm text-gray-700 placeholder-gray-600 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"></textarea>
                            </div>
                        </div>

                        {{-- Nouveau client --}}
                        <div>
                            <h3 class="mt-6 ml-6 font-semibold tracking-wide text-left text-gray-500 dark:text-gray-400">
                                Nouveau Client</h3>
                            <div class="relative w-64 max-w-xl mr-6 ml-6 mt-6 mb-6 focus-within:text-purple-500">
                                <label for=""
                                    class="font-semibold tracking-wide text-left text-gray-500 dark:text-gray-400">Nom</label>

                                <input name="new_name" type="text" value=""
                                    class="w-full pl-4 pr-2 text-sm text-gray-700 placeholder-gray-600 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input">
                            </div>

                            <div class="relative w-64 max-w-xl mr-6 ml-6 mt-6 mb-6 focus-within:text-purple-500">
                                <label
                                    class="font-semibold tracking-wide text-left text-gray-500 dark:text-gray-400">IFU</label>
                                <input name="new_ifu" type="text" value=""
                                    class="w-full pl-4 pr-2 text-sm text-gray-700 placeholder-gray-600 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input">
                            </div>

                            <div class="relative w-64 max-w-xl mr-6 ml-6 mt-6 mb-6 focus-within:text-purple-500">
                                <label
                                    class="font-semibold tracking-wide text-left text-gray-500 dark:text-gray-400">Contact</label>
                                <input name="new_contact" type="text" value=""
                                    class="w-full pl-4 pr-2 text-sm text-gray-700 placeholder-gray-600 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input">
                            </div>
                        </div>

                        {{-- CTA facture --}}
                        <div>
                            <div class="relative mr-6 ml-6 mt-6 mb-6 focus-within:text-purple-500">
                                <button type="submit"
                                    class="cursor-pointer w-full pl-4 pr-4 py-2 rounded-md text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                    Valider
                                </button>
                            </div>
                            <div class="relative mr-6 ml-6 mt-6 mb-6 focus-within:text-purple-500">
                                <button type="reset"
                                    class="cursor-pointer w-full pl-4 pr-4 py-2 rounded-md text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                    Annuler
                                </button>
                            </div>
                            <div class="relative mr-6 ml-6 mt-6 mb-6 focus-within:text-purple-500">
                                <button type="button"
                                    class="cursor-pointer w-full pl-4 pr-4 py-2 rounded-md text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                    Normaliser
                                </button>
                            </div>
                            <div class="relative mr-6 ml-6 mt-6 mb-6 focus-within:text-purple-500">
                                <button type="button"
                                    class="cursor-pointer w-full pl-4 pr-4 py-2 rounded-md text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                    Imprimer
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- edition facture --}}
                    <div class="md:flex md:flex-row">
                        <div class="w-20 mt-6 mb-6 ml-6 mr-6 focus-within:text-purple-500">
                            <label
                                class="font-semibold tracking-wide text-left text-gray-500 dark:text-gray-400">Qte</label>
                            <input name="qte" type="number" value="1"
                                class="w-20 text-sm text-gray-700 bg-gray-100 border-0 rounded-md dark:focus:shadow-outline-gray dark:bg-gray-700 dark:text-gray-200 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input">
                        </div>
                        <div class="w-80 mt-6 mb-6 ml-6 mr-6 focus-within:text-purple-500">
                            <label
                                class="font-semibold tracking-wide text-left text-gray-500 dark:text-gray-400">Produit</label>
                            <select id="liste" name="livesearch"
                                class="livesearch w-80 text-sm text-gray-700 bg-gray-100 border-0 rounded-md dark:focus:shadow-outline-gray dark:bg-gray-700 dark:text-gray-200 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input">
                            </select>
                        </div>
                        <div class="w-20 mt-6 mb-6 ml-6 mr-6 focus-within:text-purple-500">
                            <label class="font-semibold tracking-wide text-left text-gray-500 dark:text-gray-400">Type
                                Taxe</label>
                            <select name="tax"
                                class="w-20 text-sm text-gray-700 bg-gray-100 border-0 rounded-md dark:focus:shadow-outline-gray dark:bg-gray-700 dark:text-gray-200 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input">
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                                <option value="E">E</option>
                                <option value="F">F</option>
                            </select>
                        </div>
                        <div class="w-20 mt-6 mb-6 ml-6 mr-6 focus-within:text-purple-500">
                            <label class="font-semibold tracking-wide text-left text-gray-500 dark:text-gray-400">%
                                Remise</label>
                            <input name="remise" type="text" value="0.00"
                                class="w-20 text-sm text-gray-700 bg-gray-100 border-0 rounded-md dark:focus:shadow-outline-gray dark:bg-gray-700 dark:text-gray-200 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input">
                        </div>
                        <div class="w-24 mt-6 mb-6 ml-6 mr-6 focus-within:text-purple-500">
                            <label class="font-semibold tracking-wide text-left text-gray-500 dark:text-gray-400">Taux AIB
                            </label>
                            <select name="aib" onchange="aib_calcul()"
                                class="w-24 text-sm text-gray-700 bg-gray-100 border-0 rounded-md dark:focus:shadow-outline-gray dark:bg-gray-700 dark:text-gray-200 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input">
                                <option value="0">AIB0</option>
                                <option value="0.01">AIB1</option>
                                <option value="0.05">AIB5</option>
                            </select>
                        </div>
                        <div class="w-24 mt-6 mb-6 ml-6 mr-6 focus-within:text-purple-500">
                            <button type="button" id="add"
                                class="w-24 cursor-pointer mt-4 mr-2 py-2 px-3 rounded-md text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                                onclick="addRow()">Ajouter
                            </button>
                        </div>
                    </div>

                    <table class="w-full whitespace-no-wrap">
                        <thead>
                            <tr
                                class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-100 dark:text-gray-400 dark:bg-gray-800">
                                <th class="px-2 py-3 w-12"></th>
                                <th class="px-2 py-3">Désignation</th>
                                <th class="px-2 py-3">Type de taxe</th>
                                <th class="px-2 py-3">Qte</th>
                                <th class="px-2 py-3">Prix Unit HT</th>
                                <th class="px-2 py-3">Total TTC</th>
                                <th class="px-2 py-3">Remise</th>
                            </tr>
                        </thead>
                        <tbody id="formTable" class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        </tbody>
                    </table>

                    <div class="hidden mt-8" id="total">
                        <div class="flex justify-between items-stretch">
                            <table id="total_ht">
                                <tr
                                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-100 dark:text-gray-400 dark:bg-gray-800">
                                    <td class="px-1 py-1">TOTAL HT_A</td>
                                    <td class="px-1 py-1">
                                        <input
                                            class="w-28 ml-1 mr-1 text-sm text-gray-700 bg-gray-100 dark:bg-gray-800 text-right border-0 dark:text-gray-200 form-input" value="0"
                                            type="text" name="hta_total" id="hta_total" disabled>
                                    </td>
                                </tr>
                                <tr
                                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-100 dark:text-gray-400 dark:bg-gray-800">
                                    <td class="px-1 py-1">TOTAL HT_B</td>
                                    <td class="px-1 py-1"> <input
                                            class="w-28 ml-1 mr-1 text-sm text-gray-700 bg-gray-100 dark:bg-gray-800 text-right border-0 dark:text-gray-200 form-input" value="0"
                                            type="text" name="htb_total" id="htb_total" disabled>
                                    </td>
                                </tr>
                                <tr
                                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-100 dark:text-gray-400 dark:bg-gray-800">
                                    <td class="px-1 py-1">TOTAL HT_C</td>
                                    <td class="px-1 py-1"> <input
                                            class="w-28 ml-1 mr-1 text-sm text-gray-700 bg-gray-100 dark:bg-gray-800 text-right border-0 dark:text-gray-200 form-input" value="0"
                                            type="text" name="htc_total" id="htc_total" disabled>
                                    </td>
                                </tr>
                                <tr
                                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-100 dark:text-gray-400 dark:bg-gray-800">
                                    <td class="px-1 py-1">TOTAL HT_D</td>
                                    <td class="px-1 py-1"> <input
                                            class="w-28 ml-1 mr-1 text-sm text-gray-700 bg-gray-100 dark:bg-gray-800 text-right border-0 dark:text-gray-200 form-input" value="0"
                                            type="text" name="htd_total" id="htd_total" disabled>
                                    </td>
                                </tr>
                                <tr
                                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-100 dark:text-gray-400 dark:bg-gray-800">
                                    <td class="px-1 py-1">TOTAL HT_E</td>
                                    <td class="px-1 py-1"> <input
                                            class="w-28 ml-1 mr-1 text-sm text-gray-700 bg-gray-100 dark:bg-gray-800 text-right border-0 dark:text-gray-200 form-input" value="0"
                                            type="text" name="hte_total" id="hte_total" disabled>
                                    </td>
                                </tr>
                                <tr
                                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-100 dark:text-gray-400 dark:bg-gray-800">
                                    <td class="px-1 py-1">TOTAL HT_F</td>
                                    <td class="px-1 py-1"> <input
                                            class="w-28 ml-1 mr-1 text-sm text-gray-700 bg-gray-100 dark:bg-gray-800 text-right border-0 dark:text-gray-200 form-input" value="0"
                                            type="text" name="htf_total" id="htf_total" disabled>
                                    </td>
                                </tr>
                            </table>
                            <table id="total_tva">
                                <tr
                                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-100 dark:text-gray-400 dark:bg-gray-800">
                                    <td class="px-1 py-1">TOTAL TVA_B</td>
                                    <td class="px-1 py-1"><input
                                            class="w-28 ml-1 mr-1 text-sm text-gray-700 bg-gray-100 dark:bg-gray-800 text-right border-0 dark:text-gray-200 form-input"
                                            type="text" name="tva_btotal" id="tva_btotal" disabled>
                                    </td>
                                </tr>
                                <tr
                                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-100 dark:text-gray-400 dark:bg-gray-800">
                                    <td class="px-1 py-1">TOTAL TVA_D</td>
                                    <td class="px-1 py-1"><input
                                            class="w-28 ml-1 mr-1 text-sm text-gray-700 bg-gray-100 dark:bg-gray-800 text-right border-0 dark:text-gray-200 form-input"
                                            type="text" name="tva_dtotal" id="tva_dtotal" disabled>
                                    </td>
                                </tr>
                                <tr
                                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-100 dark:text-gray-400 dark:bg-gray-800">
                                    <td class="px-1 py-1">TOTAL REMISE</td>
                                    <td class="px-1 py-1"><input
                                            class="w-28 ml-1 mr-1 text-sm text-gray-700 bg-gray-100 dark:bg-gray-800 text-right border-0 dark:text-gray-200 form-input"
                                            type="text" name="t_remise" id="t_remise" disabled>
                                    </td>
                                </tr>
                                <tr
                                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-100 dark:text-gray-400 dark:bg-gray-800">
                                    <td class="px-1 py-1">TOTAL AIB</td>
                                    <td class="px-1 py-1"><input
                                            class="w-28 ml-1 mr-1 text-sm text-gray-700 bg-gray-100 dark:bg-gray-800 text-right border-0 dark:text-gray-200 form-input"
                                            type="text" name="aib_total" id="aib_total" disabled></td>
                                </tr>
                                <tr
                                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-100 dark:text-gray-400 dark:bg-gray-800">
                                    <td class="px-1 py-1">TOTAL TTC</td>
                                    <td class="px-1 py-1"><input
                                            class="w-28 ml-1 mr-1 text-sm text-gray-700 bg-gray-100 dark:bg-gray-800 text-right border-0 dark:text-gray-200 form-input"
                                            type="text" name="ttc_total" id="ttc_total" disabled></td>
                                </tr>
                            </table>
                            <table id="action" class="self-start">
                                <tr
                                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-100 dark:text-gray-400 dark:bg-gray-800">
                                    <td class="px-1 py-1">Montant percu</td>
                                    <td class="px-1 py-1"><input
                                            class="w-28 ml-1 mr-1 text-sm text-gray-700 bg-gray-100 dark:bg-gray-800 text-right border-0 dark:text-gray-200 form-input"
                                            type="number" name="mt_percu" id="mt_percu" value="0" onchange="reste_calcul()"></td>
                                </tr>
                                <tr
                                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-100 dark:text-gray-400 dark:bg-gray-800">
                                    <td class="px-1 py-1">Montant rendu</td>
                                    <td class="px-1 py-1"><input
                                            class="w-28 ml-1 mr-1 text-sm text-gray-700 bg-gray-100 dark:bg-gray-800 text-right border-0 dark:text-gray-200 form-input"
                                            type="number" name="mt_rendu" id="mt_rendu" value="0"></td>
                                </tr>
                                <tr
                                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-100 dark:text-gray-400 dark:bg-gray-800">
                                    <td class="px-1 py-1">Reliquat</td>
                                    <td class="px-1 py-1"><input
                                            class="w-28 ml-1 mr-1 text-sm text-gray-700 bg-gray-100 dark:bg-gray-800 text-right border-0 dark:text-gray-200 form-input"
                                            type="number" name="reliquat" id="reliquat" value="0"></td>
                                </tr>
                            </table>

                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
