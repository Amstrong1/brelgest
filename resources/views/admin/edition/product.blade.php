@extends('layouts.admin')
@section('content')
    <div class="container grid px-6 mx-auto">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Liste des produits
        </h2>

        <div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table id="prod" class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-2 py-2">Reference</th>
                            <th class="px-2 py-2">Produit</th>
                            <th class="px-2 py-2">Description</th>
                            <th class="px-2 py-2">Prix</th>
                            <th class="px-2 py-2">Qte Stock</th>
                            {{-- <th class="px-2 py-2">AssujetisTVA</th> --}}
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @foreach ($products as $product)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-2 py-2">
                                    {{ $product->RefProd }}
                                </td>
                                <td class="px-2 py-2 text-sm">
                                    {{ $product->LibProd }}
                                </td>
                                <td class="px-2 py-2 text-sm">
                                    {{ $product->Description }}
                                </td>
                                <td class="px-2 py-2 text-sm">
                                    {{ number_format($product->PrixHT, 0, '', ' ') }}
                                </td>
                                <td class="px-2 py-2 text-sm">
                                    {{ $product->QtteStock }}
                                </td>
                                {{-- <td class="px-2 py-2 text-sm">
                                    @if ($product->AssujetisTVA == 1)
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M4.5 12.75l6 6 9-13.5" />
                                        </svg>
                                    @endif
                                </td> --}}
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
