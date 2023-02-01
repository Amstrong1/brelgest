@extends('layouts.admin')
@section('content')
    <div class="container grid px-6 mx-auto">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Stock actuel
        </h2>

        <div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table id="stcur" class="table-fixed whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-2 py-2 w-72">Articles</th>
                            <th class="px-2 py-2">Qte en stock</th>
                            <th class="px-2 py-2">Prix de vente</th>
                            <th class="px-2 py-2">Valeur financière du stock</th>
                            <th class="px-2 py-2">Qte totale entrée</th>
                            <th class="px-2 py-2">Qte totale sortie</th>
                            <th class="px-2 py-2">Qte totale vendue</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @foreach ($currents as $current)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-2 py-2 text-sm">
                                    {{ $current->LibProd }}
                                </td>
                                <td class="px-2 py-2 text-sm">
                                    {{ $current->QtteStock }}
                                </td>
                                <td class="px-2 py-2 text-sm">
                                    {{ number_format($current->PrixHT, 0, '', ' ') }}
                                </td>
                                <td class="px-2 py-2 text-sm">
                                    @php
                                        $previsonnel = $current->PrixHT * $current->QtteStock;
                                    @endphp
                                    {{ number_format($previsonnel, 0, '', ' ') }}
                                </td>
                                <td class="px-2 py-2 text-sm">
                                    {{ $current->qte_entree }}
                                </td>
                                <td class="px-2 py-2 text-sm">
                                    {{ $current->qte_sortie }}
                                </td>
                                <td class="px-2 py-2 text-sm">
                                    {{ number_format($current->qte_vendu, 0, '', ' ') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
