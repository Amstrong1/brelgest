@extends('layouts.admin')
@section('content')
    <div class="container grid px-6 mx-auto">
        <h1 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Nouvelle Facture
        </h1>

        <div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">

                <form action="{{ route('admin.invoice.store') }}" method="post">
                    @csrf

                    <div class="lg:flex lg:justify-between lg:mr-32">
                        {{-- Info facture --}}
                        <div id='form'>
                            <div
                                class="relative w-72 max-w-xl mr-6 ml-6 mt-6 mb-6 focus-within:text-purple-500 grid grid-cols-3">
                                <label for=""
                                    class="col-span-2 font-semibold tracking-wide text-left text-gray-500 dark:text-gray-400 px-1 py-2">N°
                                    Facture</label>

                                <input name="num_fact" type="number" value="{{ $invoices->NumFacture + 1 }}" disabled
                                    class="w-full pl-4 pr-2 text-sm text-gray-700 placeholder-gray-600 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input">
                            </div>

                            <div
                                class="relative w-72 max-w-xl mr-6 ml-6 mt-6 mb-6 focus-within:text-purple-500 grid grid-cols-3">
                                <label
                                    class="font-semibold tracking-wide text-left text-gray-500 dark:text-gray-400 px-1 py-2">Date</label>
                                <input name="fact_date" type="date" required value="{{ date('Y-m-d') }}"
                                    class="col-span-2 w-full pl-4 pr-2 text-sm text-gray-700 placeholder-gray-600 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input">
                            </div>

                            <div
                                class="relative w-72 max-w-xl mr-6 ml-6 mt-6 mb-6 focus-within:text-purple-500 grid grid-cols-3">
                                <label
                                    class="font-semibold tracking-wide text-left text-gray-500 dark:text-gray-400 px-1 py-2">Taux
                                    AIB
                                </label>
                                <select name="aib"
                                    class="col-span-2 w-full pl-4 pr-2 text-sm text-gray-700 placeholder-gray-600 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input">
                                    <option value="0/AIB0">AIB0</option>
                                    <option value="0.01/AIB1">AIB1</option>
                                    <option value="0.05/AIB5">AIB5</option>
                                </select>
                            </div>

                            <div
                                class="relative w-72 max-w-xl mr-6 ml-6 mt-6 mb-6 focus-within:text-purple-500 grid grid-cols-3">
                                <label
                                    class="font-semibold tracking-wide text-left text-gray-500 dark:text-gray-400 px-1 py-2">Objet</label>
                                <input type="text" name="object"
                                    class="col-span-2 w-full px-1 py-2 text-sm text-gray-700 placeholder-gray-600 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input">
                            </div>
                        </div>

                        {{-- client --}}
                        <div>
                            <div id="client_div"
                                class="relative w-72 max-w-xl mr-6 ml-6 mt-6 mb-6 focus-within:text-purple-500 grid grid-cols-3">
                                <label
                                    class="font-semibold tracking-wide text-left text-gray-500 dark:text-gray-400">Client</label>

                                <div class="col-span-2">
                                    <select data-te-select-init data-te-select-filter="true" name="customer"
                                        class="p-2 text-sm text-gray-700 placeholder-gray-600 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input">
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->IDt_ClientPK }}">
                                                {{ $customer->NomCli }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <fieldset class="border-1">
                                <legend
                                    class="font-semibold tracking-wide text-left text-gray-500 dark:text-gray-400 text-sm">
                                    <i>Nouveau client</i>
                                </legend>
                                <div
                                    class="relative w-72 max-w-xl mr-6 ml-6 mt-2 mb-2 focus-within:text-purple-500 grid grid-cols-3">
                                    <label for=""
                                        class="font-semibold tracking-wide text-left text-gray-500 dark:text-gray-400 px-1 py-2">Nom</label>
                                    <input name="new_name" type="text" value=""
                                        class="col-span-2 w-full pl-4 pr-2 text-sm text-gray-700 placeholder-gray-600 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input">
                                </div>

                                <div
                                    class="relative w-72 max-w-xl mr-6 ml-6 mt-2 mb-2 focus-within:text-purple-500 grid grid-cols-3">
                                    <label
                                        class="font-semibold tracking-wide text-left text-gray-500 dark:text-gray-400 px-1 py-2">IFU</label>
                                    <input name="new_ifu" type="text" value=""
                                        class="col-span-2 w-full pl-4 pr-2 text-sm text-gray-700 placeholder-gray-600 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input">
                                </div>

                                <div
                                    class="relative w-72 max-w-xl mr-6 ml-6 mt-2 mb-2 focus-within:text-purple-500 grid grid-cols-3">
                                    <label
                                        class="font-semibold tracking-wide text-left text-gray-500 dark:text-gray-400 px-1 py-2">Contact</label>
                                    <input name="new_contact" type="text" value=""
                                        class="col-span-2 w-full pl-4 pr-2 text-sm text-gray-700 placeholder-gray-600 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input">
                                </div>
                            </fieldset>
                        </div>

                        {{-- CTA facture --}}
                        <div>
                            <div class="relative mr-6 ml-6 mt-6 mb-6 focus-within:text-green-500">
                                <button type="submit"
                                    class="cursor-pointer w-full pl-4 pr-4 py-2 rounded-md text-sm font-medium leading-5 text-white transition-colors duration-150 bg-green-600 border border-transparent active:bg-green-600 hover:bg-green-700 focus:outline-none focus:shadow-outline-green">
                                    Valider
                                </button>
                            </div>
                            <div class="relative mr-6 ml-6 mt-6 mb-6 focus-within:text-red-500">
                                <button type="reset"
                                    class="cursor-pointer w-full pl-4 pr-4 py-2 rounded-md text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
                                    Annuler
                                </button>
                            </div>
                            <div class="relative mr-6 ml-6 mt-6 mb-6 focus-within:text-yellow-500">
                                <button type="button"
                                    class="cursor-pointer w-full pl-4 pr-4 py-2 rounded-md text-sm font-medium leading-5 text-white transition-colors duration-150 bg-yellow-600 border border-transparent active:bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:shadow-outline-yellow">
                                    Normaliser
                                </button>
                            </div>

                            <div class="relative mr-6 ml-6 mt-6 mb-6 focus-within:text-purple-500">
                                <div x-data="{ open: false }" class="relative">
                                    <button x-on:click="open= true"
                                        class="cursor-pointer w-full pl-4 pr-4 py-2 rounded-md text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                                        type="button">
                                        <span class="mr-1">Imprimer</span>
                                    </button>
                                    <ul x-show="open" x-on:click.away="open= false"
                                        class="bg-white text-gray-700 rounded shadow-lg absolute py-2
                                            mt-1"
                                        style="min-width:15rem">
                                        <li>
                                            <a href="#"
                                                class="block hover:bg-gray-200
                                                    whitespace-no-wrap py-2 px-4">
                                                Papier A4
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                class="block hover:bg-gray-200
                                                    whitespace-no-wrap py-2 px-4">
                                                Ticket
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        {{-- livewire crud --}}
                        @livewire('ligne-fact')

                        <div class="mt-8" id="total">
                            <div class="flex justify-between items-stretch">
                                <table id="total_ht" class="m-2">
                                    <tr
                                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-100 dark:text-gray-400 dark:bg-gray-800">
                                        <td class="px-1 py-1">TOTAL HT_A</td>
                                        <td class="px-1 py-1">
                                            <input
                                                class="w-28 ml-1 mr-1 text-sm text-gray-700 bg-gray-100 dark:bg-gray-800 text-right border-0 dark:text-gray-200 form-input"
                                                value="0" type="text" name="hta_total" id="hta_total" disabled>
                                        </td>
                                    </tr>
                                    <tr
                                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-100 dark:text-gray-400 dark:bg-gray-800">
                                        <td class="px-1 py-1">TOTAL HT_B</td>
                                        <td class="px-1 py-1"> <input
                                                class="w-28 ml-1 mr-1 text-sm text-gray-700 bg-gray-100 dark:bg-gray-800 text-right border-0 dark:text-gray-200 form-input"
                                                value="0" type="text" name="htb_total" id="htb_total" disabled>
                                        </td>
                                    </tr>
                                    <tr
                                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-100 dark:text-gray-400 dark:bg-gray-800">
                                        <td class="px-1 py-1">TOTAL HT_D</td>
                                        <td class="px-1 py-1"> <input
                                                class="w-28 ml-1 mr-1 text-sm text-gray-700 bg-gray-100 dark:bg-gray-800 text-right border-0 dark:text-gray-200 form-input"
                                                value="0" type="text" name="htd_total" id="htd_total" disabled>
                                        </td>
                                    </tr>
                                    <tr
                                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-100 dark:text-gray-400 dark:bg-gray-800">
                                        <td class="px-1 py-1">TOTAL HT_E</td>
                                        <td class="px-1 py-1"> <input
                                                class="w-28 ml-1 mr-1 text-sm text-gray-700 bg-gray-100 dark:bg-gray-800 text-right border-0 dark:text-gray-200 form-input"
                                                value="0" type="text" name="hte_total" id="hte_total" disabled>
                                        </td>
                                    </tr>
                                </table>
                                <table id="total_tva" class="m-2">
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
                                <table id="action" class="self-start m-2">
                                    <tr
                                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-100 dark:text-gray-400 dark:bg-gray-800">
                                        <td class="px-1 py-1">Montant percu</td>
                                        <td class="px-1 py-1"><input
                                                class="w-28 ml-1 mr-1 text-sm text-gray-700 bg-gray-100 dark:bg-gray-800 text-right border-0 dark:text-gray-200 form-input"
                                                type="number" name="mt_percu" id="mt_percu" value="0"
                                                onchange="reste_calcul()"></td>
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
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
