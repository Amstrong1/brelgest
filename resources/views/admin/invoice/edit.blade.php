@extends('layouts.admin')
@section('content')
    <div class="container grid px-6 mx-auto">
        <h1 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Modifier une facture
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

                                <input name="num_fact" type="number" value="{{ $invoice->NumFacture }}" readonly
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
                                <select name="aib" id="aib_type" onchange="setAIB()"
                                    class="col-span-2 w-full pl-4 pr-2 text-sm text-gray-700 placeholder-gray-600 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input">
                                    <option value="AIB0">AIB0</option>
                                    <option value="AIB1">AIB1</option>
                                    <option value="AIB5">AIB5</option>
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
                            <div
                                class="relative w-72 max-w-xl mr-6 ml-6 mt-2 mb-2 focus-within:text-purple-500 grid grid-cols-3">
                                <label for=""
                                    class="font-semibold tracking-wide text-left text-gray-500 dark:text-gray-400 px-1 py-2">Nom</label>
                                <input name="new_name" type="text" value="{{ $invoice->NomCli }}"
                                    class="col-span-2 w-full pl-4 pr-2 text-sm text-gray-700 placeholder-gray-600 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input">
                            </div>

                            <div
                                class="relative w-72 max-w-xl mr-6 ml-6 mt-2 mb-2 focus-within:text-purple-500 grid grid-cols-3">
                                <label
                                    class="font-semibold tracking-wide text-left text-gray-500 dark:text-gray-400 px-1 py-2">IFU</label>
                                <input name="new_ifu" type="text" value="{{ $invoice->NumIFU }}"
                                    class="col-span-2 w-full pl-4 pr-2 text-sm text-gray-700 placeholder-gray-600 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input">
                            </div>

                            <div
                                class="relative w-72 max-w-xl mr-6 ml-6 mt-2 mb-2 focus-within:text-purple-500 grid grid-cols-3">
                                <label
                                    class="font-semibold tracking-wide text-left text-gray-500 dark:text-gray-400 px-1 py-2">Contact</label>
                                <input name="new_contact" type="text" value="{{ $invoice->Tel_1 }}"
                                    class="col-span-2 w-full pl-4 pr-2 text-sm text-gray-700 placeholder-gray-600 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input">
                            </div>
                        </div>

                        {{-- CTA facture --}}
                        <div>
                            <div class="relative mr-6 ml-6 mt-6 mb-6 focus-within:text-green-500">
                                <button onclick="setCustomer()"
                                    class="cursor-pointer w-full pl-4 pr-4 py-2 rounded-md text-sm font-medium leading-5 text-white transition-colors duration-150 bg-green-600 border border-transparent active:bg-green-600 hover:bg-green-700 focus:outline-none focus:shadow-outline-green">
                                    Valider
                                </button>
                            </div>
                            <div class="relative mr-6 ml-6 mt-6 mb-6 focus-within:text-red-500">
                                <a href="{{ route('admin.invoice.cancel_invoice') }}">
                                    <button type="button"
                                        class="cursor-pointer w-full pl-4 pr-4 py-2 rounded-md text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
                                        Annuler
                                    </button>
                                </a>
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
                                            <a href="{{ route('admin.pdfa4', [$invoice->NumFacture]) }}" target="blank"
                                                class="block hover:bg-gray-200
                                                    whitespace-no-wrap py-2 px-4">
                                                Papier A4
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.pdfticket', [$invoice->NumFacture]) }}" target="blank"
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


                        @if (isset($invoiceLines))
                            <table class="w-full whitespace-no-wrap">
                                <thead>
                                    <tr
                                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-100 dark:text-gray-400 dark:bg-gray-800">
                                        <th class="px-2 py-3">Désignation</th>
                                        <th class="px-2 py-3">Taxe</th>
                                        <th class="px-2 py-3">Qte</th>
                                        <th class="px-2 py-3">Prix Unit HT</th>
                                        <th class="px-2 py-3">Prix Unit TTC</th>
                                        <th class="px-2 py-3">Total TTC</th>
                                        <th class="px-2 py-3"></th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                    @php
                                        $hta = 0;
                                        $htb = 0;
                                        $htd = 0;
                                        $hte = 0;
                                        $aib = 0;
                                        $tvab = 0;
                                        $tvad = 0;
                                        $ttc = 0;
                                    @endphp

                                    @foreach ($invoiceLines as $invoiceLine)
                                        <tr>
                                            <td class="p-2 text-sm">{{ $invoiceLine->LibProd }}</td>
                                            <td class="p-2 text-sm">{{ $invoiceLine->TypeTaxe }}</td>
                                            <td class="p-2 text-sm">{{ $invoiceLine->Qtte }}</td>
                                            <td class="p-2 text-sm">
                                                {{ number_format($invoiceLine->PrixUnitHT, 0, '', ' ') }}
                                            </td>
                                            <td class="p-2 text-sm">
                                                {{ number_format($invoiceLine->PrixUniTTTC, 0, '', ' ') }}
                                            </td>
                                            <td class="p-2 text-sm">
                                                {{ number_format($invoiceLine->SousTotalTTC, 0, '', ' ') }}</td>

                                            {{-- <td>
                                    <button type="button" wire:click.prevent="edit({{ $prod->id }})" class="btn"><svg
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                            stroke="#00f" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>
                                    </button>
                                    <button type="button" wire:click.prevent="delete({{ $prod->id }})" onclick="setAIBInt()"
                                        class="btn"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="#f00" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </button>
                                </td> --}}
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
