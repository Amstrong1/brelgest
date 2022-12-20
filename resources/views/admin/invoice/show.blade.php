@extends('layouts.admin')
@section('content')
    <div class="container grid px-6 mx-auto">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Détails de la facture choisie
        </h2>

        <div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <h3 class="my-6 text-xl font-semibold text-gray-700 dark:text-gray-200">
                    Information client</h3>
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
                                    {{ $detail->Date }}
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
                            <th class="px-2 py-2">Pack de</th>
                            <th class="px-2 py-2">Qte</th>
                            <th class="px-2 py-2">PrixUnit (HT)</th>
                            <th class="px-2 py-2">PrixUnitaire (TTC)</th>
                            <th class="px-2 py-2">Total (Qtte*PU_TTC)</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @foreach ($details as $detail)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-2 py-2 text-sm">
                                    {{ $detail->LibProd }}
                                </td>
                                <td class="px-2 py-2 text-sm">
                                    {{ $detail->TypeTaxe }}
                                </td>
                                <td class="px-2 py-2 text-sm"></td>
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
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
