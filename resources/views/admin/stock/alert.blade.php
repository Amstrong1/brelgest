@extends('layouts.admin')
@section('content')
    <div class="container grid px-6 mx-auto">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Articles à réapprovisionner
        </h2>

        <div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table id="stal" class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-2 py-2">Références</th>
                            <th class="px-2 py-2">Articles</th>
                            <th class="px-2 py-2">Qtés en stock</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @foreach ($alerts as $alert)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-2 py-2 text-sm">
                                    {{ $alert->RefCodeBar }}
                                </td>
                                <td class="px-2 py-2 text-sm">
                                    {{ $alert->LibProd }}
                                </td>
                                <td class="px-2 py-2 text-sm">
                                    {{ $alert->QtteStock }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
