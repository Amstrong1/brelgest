@extends('layouts.admin')
@section('content')
    <div class="container grid px-6 mx-auto">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Statistique par clients
        </h2>

        <div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">

                <div class="flex justify-start flex-1 lg:mr-32">
                    <form class="md:flex md:justify-start md:flex-1 lg:mr-32" action="{{ route('admin.statistique.consumer') }}"
                        method="post">
                        @csrf
                        <div class="relative w-64 max-w-xl mr-6 ml-6 mt-6 mb-6 focus-within:text-purple-500">
                            <label for="start_id"
                                class="font-semibold tracking-wide text-left text-gray-500 dark:text-gray-400">Date
                                début</label>
                            <div class="mt-6 absolute inset-y-0 flex items-center pl-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                                </svg>
                            </div>
                            <input id="start_id" name="start" type="date" required value="{{ request()->start }}"
                                class="w-full pl-8 pr-2 text-sm text-gray-700 placeholder-gray-600 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input">
                        </div>

                        <div class="relative w-64 max-w-xl mr-6 ml-6 mt-6 mb-6 focus-within:text-purple-500">
                            <label for="end_id"
                                class="font-semibold tracking-wide text-left text-gray-500 dark:text-gray-400">Date
                                fin</label>
                            <div class="mt-6 absolute inset-y-0 flex items-center pl-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                                </svg>
                            </div>
                            <input id="end_id" name="end" type="date" required value="{{ request()->end }}"
                                class="w-full pl-8 pr-2 text-sm text-gray-700 placeholder-gray-600 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input">
                        </div>

                        <div class="w-24 mr-4 ml-4 mt-8 focus-within:text-purple-500">
                            <button type="submit"
                                class="w-24 px-2 py-2 mb-4 mt-2 text-gray-700 placeholder-gray-600 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input">
                                {{-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12" />
                                </svg> --}}Actualiser
                            </button>
                        </div>
                    </form>
                </div>
                @if ($consumers != null)
                    <table class="w-full whitespace-no-wrap" id="datatable_cli">
                        <thead>
                            <tr
                                class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                <th class="px-2 py-2">Nom client</th>
                                <th class="px-2 py-2">Total TTC</th>
                                <th class="px-2 py-2">Total HT [E]</th>
                                <th class="px-2 py-2">Total HT [A-EX]</th>
                                <th class="px-2 py-2">Total HT [B]</th>
                                <th class="px-2 py-2">Total TVA [B]</th>
                                <th class="px-2 py-2">Total HT [D]</th>
                                <th class="px-2 py-2">Total TVA [D]</th>
                                {{-- <th class="px-2 py-2">Total TS [B]</th> --}}
                                <th class="px-2 py-2">Total AIB</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                            @foreach ($consumers as $consumer)
                                <tr class="text-gray-700 dark:text-gray-400">
                                    <td class="px-2 py-2 text-sm">
                                        {{ $consumer->NomCli }}
                                    </td>
                                    <td data-order="{{ $consumer->Montant_TTC }}" class="px-2 py-2 text-sm">
                                        {{ number_format($consumer->Montant_TTC, 0, '', ' ') }}
                                    </td>
                                    <td data-order="{{ $consumer->Montant_HT_E }}" class="px-2 py-2 text-sm">
                                        {{ number_format($consumer->Montant_HT_E, 0, '', ' ') }}
                                    </td>
                                    <td data-order="{{ $consumer->Montant_HT_AEX }}" class="px-2 py-2 text-sm">
                                        {{ number_format($consumer->Montant_HT_AEX, 0, '', ' ') }}
                                    </td>
                                    <td data-order="{{ $consumer->Montant_HT_B }}" class="px-2 py-2 text-sm">
                                        {{ number_format($consumer->Montant_HT_B, 0, '', ' ') }}
                                    </td>
                                    <td data-order="{{ $consumer->Montant_TVA_B }}" class="px-2 py-2 text-sm">
                                        {{ number_format($consumer->Montant_TVA_B, 0, '', ' ') }}
                                    </td>
                                    <td data-order="{{ $consumer->Montant_HT_D }}" class="px-2 py-2 text-sm">
                                        {{ number_format($consumer->Montant_HT_D, 0, '', ' ') }}
                                    </td>
                                    <td data-order="{{ $consumer->Montant_TVA_D }}" class="px-2 py-2 text-sm">
                                        {{ number_format($consumer->Montant_TVA_D, 0, '', ' ') }}
                                    </td>
                                    {{-- <td data-order="{{ $consumer->Montant_TS_B }}" class="px-2 py-2 text-sm">
                                        {{ number_format($consumer->Montant_TS_B, 0, '', ' ') }}
                                    </td> --}}
                                    <td data-order="{{ $consumer->Montant_AIB }}" class="px-2 py-2 text-sm">
                                        {{ number_format($consumer->Montant_AIB, 0, '', ' ') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif

            </div>
        </div>

    </div>
@endsection
