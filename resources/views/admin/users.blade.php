@extends('layouts.admin')
@section('content')
    <div class="container grid px-6 mx-auto">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Liste des utilisateurs
        </h2>

        <div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table id="user" class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-2 py-2">Nom</th>
                            <th class="px-2 py-2">Prénom</th>
                            <th class="px-2 py-2">Email</th>
                            <th class="px-2 py-2">Téléphone</th>
                            <th class="px-2 py-2">Etat</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @foreach ($users as $user)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-2 py-2 text-sm">
                                    {{ $user->Nom }}
                                </td>
                                <td class="px-2 py-2 text-sm">
                                    {{ $user->Prénom }}
                                </td>
                                <td class="px-2 py-2 text-sm">
                                    {{ $user->Email }}
                                </td>
                                <td class="px-2 py-2 text-sm">
                                    {{ $user->contact }}
                                </td>
                                <td class="px-2 py-2">
                                    @if ($user->valide == 1)
                                        Actif
                                    @else
                                        Non actif
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
