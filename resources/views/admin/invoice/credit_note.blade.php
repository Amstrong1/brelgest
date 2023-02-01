@extends('layouts.admin')
@section('content')
    <div class="container grid px-6 mx-auto">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Liste des factures d'avoir
        </h2>

        <div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table id="inv" class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-2 py-2">N° Facture d'avoir</th>
                            <th class="px-2 py-2">Date </th>
                            <th class="px-2 py-2">Client</th>
                            <th class="px-2 py-2" style="width: 100px">Montant</th>
                            <th class="px-2 py-2">Objet</th>
                            <th class="px-2 py-2">Voir</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @foreach ($fa_invoices as $fa_invoice)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td data-order="{{ $fa_invoice->NumFacture_FA }}" class="px-2 py-2 text-sm">
                                    {{ $fa_invoice->NumFacture_FA }}
                                </td>
                                
                                <td data-order="{{ $fa_invoice->DateFactureAvoir }}" class="px-2 py-2 text-sm">
                                    @php
                                        $date_table_avoir = explode('-', $fa_invoice->DateFactureAvoir);
                                        echo $date_table_avoir[2];
                                        echo '-';
                                        echo $date_table_avoir[1];
                                        echo '-';
                                        echo $date_table_avoir[0];
                                    @endphp
                                </td>
                                <td class="px-2 py-2 text-sm">
                                    {{ $fa_invoice->NomClient }}
                                </td>
                                <td data-order="{{ $fa_invoice->Montant_TTC }}" class="px-2 py-2 text-sm">
                                    {{ number_format($fa_invoice->Montant_TTC, 0, '', ' ') }}
                                </td>
                                <td class="px-2 py-2 text-sm">
                                    {{ $fa_invoice->Observation }}
                                </td>
                                <td class="px-2 py-2">
                                    <div class="flex items-center space-x-4 text-sm">
                                        <a href="{{ route('admin.invoice.show', [$fa_invoice->IDt_FacturePK]) }}"
                                            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                            aria-label="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
