@extends('layouts.admin')
@section('content')
    <div class="container grid px-6 mx-auto">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Articles entrés en stock
        </h2>

        <div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table id="stent" class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-2 py-2">Références</th>
                            <th class="px-2 py-2">Articles</th>
                            <th class="px-2 py-2">Date d'entrée</th>
                            <th class="px-2 py-2">Qte</th>
                            <th class="px-2 py-2">Prix d'achat unitaire</th>
                            <th class="px-2 py-2">Prix d'achat total</th>
                            <th class="px-2 py-2">Observation</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @foreach ($entries as $entrie)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-2 py-2">
                                    {{ $entrie->RefCodeBar }}
                                </td>
                                <td class="px-2 py-2 text-sm">
                                    {{ $entrie->LibProd }}
                                </td>
                                <td class="px-2 py-2">
                                    @php
                                        $date_table = explode('-', $entrie->DateEntree);
                                        echo $date_table[2];
                                        echo '-';
                                        echo $date_table[1];
                                        echo '-';
                                        echo $date_table[0];
                                    @endphp
                                </td>
                                <td class="px-2 py-2 text-sm">
                                    {{ $entrie->Qtte }}
                                </td>
                                <td class="px-2 py-2 text-sm">
                                    {{ number_format($entrie->Pri_AchatTotal, 0, '', ' ') }}
                                </td>
                                <td class="px-2 py-2 text-sm">
                                    {{ number_format($entrie->Pri_AchatTotal, 0, '', ' ') / $entrie->Qtte }}
                                </td>
                                <td class="px-2 py-2 text-sm">
                                    {{ $entrie->Observation }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
