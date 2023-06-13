@extends('layouts.admin')
@section('content')
    <div class="container grid px-6 mx-auto">

        <nav class="flex mt-2" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a class="text-gray-700 hover:text-gray-900 ml-1 md:ml-2 text-sm font-medium"
                        href="{{ route('admin.invoice.index', [$fact]) }}">Listes</a>
                </li>
                <li class="inline-flex items-center" aria-current="page">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="text-gray-700 hover:text-gray-900 ml-1 md:ml-2 text-sm font-medium">Détails</span>
                </li>
            </ol>
        </nav>

        <div class="flex justify-between">
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Détails de la facture choisie
            </h2>
            {{-- <div>                
                <a href=""
                    class="cursor-pointer inline-block pl-4 pr-4 py-2 rounded-md text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    Imprimer</a>
            </div> --}}
        </div>

        <div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap mb-4">
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @foreach ($details as $detail)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-2 py-2">N° Facture</td>
                                <td class="px-2 py-2">
                                    {{ $detail->NumFacture }}
                                </td>
                            </tr>
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-2 py-2">Date facture</td>
                                <td class="px-2 py-2">
                                    @php
                                        $date_table = explode('-', $detail->Date);
                                        echo $date_table[2];
                                        echo '-';
                                        echo $date_table[1];
                                        echo '-';
                                        echo $date_table[0];
                                    @endphp
                                </td>
                            </tr>
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-2 py-2">Type facture</td>
                                <td class="px-2 py-2">
                                    {{ $detail->TypeFacture }}
                                </td>
                            </tr>
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-2 py-2">Client</td>
                                <td class="px-2 py-2">
                                    {{ $detail->NomClient }}
                                </td>
                            </tr>
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-2 py-2">Objet</td>
                                <td class="px-2 py-2">
                                    {{ $detail->Observation }}
                                </td>
                            </tr>
                            @php
                                break;
                            @endphp
                        @endforeach
                    </tbody>
                </table>

                <table id="det" class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-2 py-2">Désignation</th>
                            <th class="px-2 py-2">Type Taxe</th>
                            <th class="px-2 py-2">Qte</th>
                            <th class="px-2 py-2">PrixUnit (HT)</th>
                            <th class="px-2 py-2">PrixUnitaire (TTC)</th>
                            <th class="px-2 py-2">Total (Qtte*PU_TTC)</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @php
                            $total = 0;
                        @endphp
                        @foreach ($details as $detail)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-2 py-2 text-sm">
                                    {{ $detail->LibProd }}
                                </td>
                                <td class="px-2 py-2 text-sm">
                                    {{ $detail->TypeTaxe }}
                                </td>
                                <td class="px-2 py-2 text-sm">
                                    {{ number_format($detail->Qtte, 0, '', ' ') }}
                                </td>
                                <td class="px-2 py-2 text-sm">
                                    {{ number_format($detail->PrixUnitHT, 0, '', ' ') }}
                                </td>
                                <td class="px-2 py-2 text-sm">
                                    {{ number_format($detail->PrixUniTTTC, 0, '', ' ') }}
                                </td>
                                <td class="px-2 py-2 text-sm">
                                    {{ number_format($detail->SousTotalTTC, 0, '', ' ') }}
                                    @php
                                        $total += $detail->SousTotalTTC;
                                    @endphp
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-2 py-2 text-sm font-semibold">Total</td>
                            <td class="px-2 py-2 text-sm" colspan="5">{{ number_format($total, 0, '', ' ') }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
