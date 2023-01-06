@section('content')
    <div class="container grid px-6 mx-auto">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Nouvelle Facture
        </h2>

        <div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">

                <table class="w-full whitespace-no-wrap mb-4">
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        {{-- @foreach ($details as $detail) --}}
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-2 py-2">N° Facture</td>
                            <td class="px-2 py-2">
                                {{-- {{ $detail->NumFacture }} --}}
                            </td>
                        </tr>
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-2 py-2">Date facture</td>
                            <td class="px-2 py-2">
                                {{-- {{ $detail->Date }} --}}
                            </td>
                        </tr>
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-2 py-2">Type facture</td>
                            <td class="px-2 py-2">
                                {{-- {{ $detail->TypeFacture }} --}}
                            </td>
                        </tr>
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-2 py-2">Client</td>
                            <td class="px-2 py-2">
                                {{-- {{ $detail->NomClient }} --}}
                            </td>
                        </tr>
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-2 py-2">Objet</td>
                            <td class="px-2 py-2">
                                {{-- {{ $detail->Observation }} --}}
                            </td>
                        </tr>
                        {{-- @php --}}
                        {{-- // break; --}}
                        {{-- // @endphp --}}
                        {{-- @endforeach --}}
                    </tbody>
                </table>

                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-100 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-2 py-3 w-12"></th>
                            <th class="px-2 py-3">Désignation</th>
                            <th class="px-2 py-3">Type de taxe</th>
                            <th class="px-2 py-3">Qte</th>
                            <th class="px-2 py-3">Prix Unit HT</th>
                            <th class="px-2 py-3">Total TTC</th>
                            <th class="px-2 py-3">Remise</th>
                        </tr>
                    </thead>
                    <tbody id="formTable" class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    </tbody>
                </table>

                <div class="hidden mt-8" id="total">
                    <div class="flex justify-between items-stretch">
                        <table id="total_ht">
                            <tr
                                class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-100 dark:text-gray-400 dark:bg-gray-800">
                                <td class="px-1 py-1">TOTAL HT_A</td>
                                <td class="px-1 py-1">
                                    <input
                                        class="w-28 ml-1 mr-1 text-sm text-gray-700 bg-gray-100 dark:bg-gray-800 text-right border-0 dark:text-gray-200 form-input"
                                        value="0" type="text" name="hta_total" id="hta_total" disabled>
                                </td>
                            </tr>
                            <tr
                                class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-100 dark:text-gray-400 dark:bg-gray-800">
                                <td class="px-1 py-1">TOTAL HT_B</td>
                                <td class="px-1 py-1"> <input
                                        class="w-28 ml-1 mr-1 text-sm text-gray-700 bg-gray-100 dark:bg-gray-800 text-right border-0 dark:text-gray-200 form-input"
                                        value="0" type="text" name="htb_total" id="htb_total" disabled>
                                </td>
                            </tr>
                            <tr
                                class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-100 dark:text-gray-400 dark:bg-gray-800">
                                <td class="px-1 py-1">TOTAL HT_C</td>
                                <td class="px-1 py-1"> <input
                                        class="w-28 ml-1 mr-1 text-sm text-gray-700 bg-gray-100 dark:bg-gray-800 text-right border-0 dark:text-gray-200 form-input"
                                        value="0" type="text" name="htc_total" id="htc_total" disabled>
                                </td>
                            </tr>
                            <tr
                                class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-100 dark:text-gray-400 dark:bg-gray-800">
                                <td class="px-1 py-1">TOTAL HT_D</td>
                                <td class="px-1 py-1"> <input
                                        class="w-28 ml-1 mr-1 text-sm text-gray-700 bg-gray-100 dark:bg-gray-800 text-right border-0 dark:text-gray-200 form-input"
                                        value="0" type="text" name="htd_total" id="htd_total" disabled>
                                </td>
                            </tr>
                            <tr
                                class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-100 dark:text-gray-400 dark:bg-gray-800">
                                <td class="px-1 py-1">TOTAL HT_E</td>
                                <td class="px-1 py-1"> <input
                                        class="w-28 ml-1 mr-1 text-sm text-gray-700 bg-gray-100 dark:bg-gray-800 text-right border-0 dark:text-gray-200 form-input"
                                        value="0" type="text" name="hte_total" id="hte_total" disabled>
                                </td>
                            </tr>
                            <tr
                                class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-100 dark:text-gray-400 dark:bg-gray-800">
                                <td class="px-1 py-1">TOTAL HT_F</td>
                                <td class="px-1 py-1"> <input
                                        class="w-28 ml-1 mr-1 text-sm text-gray-700 bg-gray-100 dark:bg-gray-800 text-right border-0 dark:text-gray-200 form-input"
                                        value="0" type="text" name="htf_total" id="htf_total" disabled>
                                </td>
                            </tr>
                        </table>
                        <table id="total_tva">
                            <tr
                                class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-100 dark:text-gray-400 dark:bg-gray-800">
                                <td class="px-1 py-1">TOTAL TVA_B</td>
                                <td class="px-1 py-1"><input
                                        class="w-28 ml-1 mr-1 text-sm text-gray-700 bg-gray-100 dark:bg-gray-800 text-right border-0 dark:text-gray-200 form-input"
                                        type="text" name="tva_btotal" id="tva_btotal" disabled>
                                </td>
                            </tr>
                            <tr
                                class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-100 dark:text-gray-400 dark:bg-gray-800">
                                <td class="px-1 py-1">TOTAL TVA_D</td>
                                <td class="px-1 py-1"><input
                                        class="w-28 ml-1 mr-1 text-sm text-gray-700 bg-gray-100 dark:bg-gray-800 text-right border-0 dark:text-gray-200 form-input"
                                        type="text" name="tva_dtotal" id="tva_dtotal" disabled>
                                </td>
                            </tr>
                            <tr
                                class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-100 dark:text-gray-400 dark:bg-gray-800">
                                <td class="px-1 py-1">TOTAL REMISE</td>
                                <td class="px-1 py-1"><input
                                        class="w-28 ml-1 mr-1 text-sm text-gray-700 bg-gray-100 dark:bg-gray-800 text-right border-0 dark:text-gray-200 form-input"
                                        type="text" name="t_remise" id="t_remise" disabled>
                                </td>
                            </tr>
                            <tr
                                class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-100 dark:text-gray-400 dark:bg-gray-800">
                                <td class="px-1 py-1">TOTAL AIB</td>
                                <td class="px-1 py-1"><input
                                        class="w-28 ml-1 mr-1 text-sm text-gray-700 bg-gray-100 dark:bg-gray-800 text-right border-0 dark:text-gray-200 form-input"
                                        type="text" name="aib_total" id="aib_total" disabled></td>
                            </tr>
                            <tr
                                class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-100 dark:text-gray-400 dark:bg-gray-800">
                                <td class="px-1 py-1">TOTAL TTC</td>
                                <td class="px-1 py-1"><input
                                        class="w-28 ml-1 mr-1 text-sm text-gray-700 bg-gray-100 dark:bg-gray-800 text-right border-0 dark:text-gray-200 form-input"
                                        type="text" name="ttc_total" id="ttc_total" disabled></td>
                            </tr>
                        </table>
                        <table id="action" class="self-start">
                            <tr
                                class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-100 dark:text-gray-400 dark:bg-gray-800">
                                <td class="px-1 py-1">Montant percu</td>
                                <td class="px-1 py-1"><input
                                        class="w-28 ml-1 mr-1 text-sm text-gray-700 bg-gray-100 dark:bg-gray-800 text-right border-0 dark:text-gray-200 form-input"
                                        type="number" name="mt_percu" id="mt_percu" value="0"
                                        onchange="reste_calcul()"></td>
                            </tr>
                            <tr
                                class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-100 dark:text-gray-400 dark:bg-gray-800">
                                <td class="px-1 py-1">Montant rendu</td>
                                <td class="px-1 py-1"><input
                                        class="w-28 ml-1 mr-1 text-sm text-gray-700 bg-gray-100 dark:bg-gray-800 text-right border-0 dark:text-gray-200 form-input"
                                        type="number" name="mt_rendu" id="mt_rendu" value="0"></td>
                            </tr>
                            <tr
                                class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-100 dark:text-gray-400 dark:bg-gray-800">
                                <td class="px-1 py-1">Reliquat</td>
                                <td class="px-1 py-1"><input
                                        class="w-28 ml-1 mr-1 text-sm text-gray-700 bg-gray-100 dark:bg-gray-800 text-right border-0 dark:text-gray-200 form-input"
                                        type="number" name="reliquat" id="reliquat" value="0"></td>
                            </tr>
                        </table>

                    </div>
                </div>

                </form>
            </div>
        </div>
    </div>
@endsection
