@extends('layouts.admin')
@section('content')
    <div class="container grid px-6 mx-auto">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Liste des fournisseurs
        </h2>

        <div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table id="provider" class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-2 py-2">Nom</th>
                            <th class="px-2 py-2">Adresse</th>
                            <th class="px-2 py-2">N° IFU</th>
                            <th class="px-2 py-2">Contact 1</th>
                            <th class="px-2 py-2">Email</th>
                            <th class="px-2 py-2">Code Postale</th>
                            <th class="px-2 py-2">Ville</th>
                            <th class="px-2 py-2">Pays</th>
                            <th class="px-2 py-2">Observation</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @foreach ($providers as $provider)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-2 py-2">
                                    {{ $provider->NomFrns }}
                                </td>
                                <td class="px-2 py-2 text-sm">
                                    {{ $provider->Adresse }}
                                </td>
                                <td class="px-2 py-2 text-sm">
                                    {{ $provider->NumIFU }}
                                </td>
                                <td class="px-2 py-2 text-sm">
                                    {{ $provider->Tel_1 }}
                                </td>
                                <td class="px-2 py-2 text-sm">
                                    {{ $provider->Email }}
                                </td>
                                <td class="px-2 py-2 text-sm">
                                    {{ $provider->CodePostal }}
                                </td>
                                <td class="px-2 py-2 text-sm">
                                    {{ $provider->Ville }}
                                </td>
                                <td class="px-2 py-2 text-sm">
                                    {{ $provider->Pays }}
                                </td>
                                <td class="px-2 py-2 text-sm">
                                    {{ $provider->Observation }}
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
