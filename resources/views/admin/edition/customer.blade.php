@extends('layouts.admin')
@section('content')
    <div class="container grid px-6 mx-auto">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Liste des clients
        </h2>

        <div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table id="cli" class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-2 py-2">Nom</th>
                            <th class="px-2 py-2">Adresse</th>
                            <th class="px-2 py-2">N° IFU</th>
                            <th class="px-2 py-2">RCCM</th>
                            <th class="px-2 py-2">Contact</th>
                            <th class="px-2 py-2">Email</th>
                            <th class="px-2 py-2">Ville</th>
                            <th class="px-2 py-2">Pays</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @foreach ($customers as $customer)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-2 py-2">
                                    {{ $customer->NomCli }}
                                </td>
                                <td class="px-2 py-2 text-sm">
                                    {{ $customer->Adresse }}
                                </td>
                                <td class="px-2 py-2 text-sm">
                                    {{ $customer->NumIFU }}
                                </td>
                                <td class="px-2 py-2 text-sm">
                                    {{ $customer->RCCM }}
                                </td>
                                <td class="px-2 py-2 text-sm">
                                    {{ $customer->Tel_1 }}
                                </td>
                                <td class="px-2 py-2 text-sm">
                                    {{ $customer->Email }}
                                </td>
                                <td class="px-2 py-2 text-sm">
                                    {{ $customer->Ville }}
                                </td>
                                <td class="px-2 py-2 text-sm">
                                    {{ $customer->Pays }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
