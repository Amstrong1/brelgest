<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}

    <form>
        {{-- edition facture --}}
        @if ($updateMode)
            @include('livewire.update')
        @else
            @include('livewire.create')
        @endif
    </form>

    <table class="w-full whitespace-no-wrap">
        <thead>
            <tr
                class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-100 dark:text-gray-400 dark:bg-gray-800">
                <th class="px-2 py-3">Désignation</th>
                <th class="px-2 py-3">Taxe</th>
                <th class="px-2 py-3">Qte</th>
                <th class="px-2 py-3">Prix Unit HT</th>
                <th class="px-2 py-3">Prix Unit TTC</th>
                <th class="px-2 py-3">Total TTC</th>
                <th class="px-2 py-3"></th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
            @php
                $hta = 0;
                $htb = 0;
                $htd = 0;
                $hte = 0;
                $aib = 0;
                $tvab = 0;
                $tvad = 0;
                $ttc = 0;
            @endphp

            @foreach ($prods as $prod)
                <tr>
                    <td class="p-2 text-sm">{{ $prod->LibProd }}</td>
                    <td class="p-2 text-sm">{{ $prod->TypeTaxe }}</td>
                    <td class="p-2 text-sm">{{ $prod->Qtte }}</td>
                    <td class="p-2 text-sm">{{ number_format($prod->PrixHT, 0, '', ' ') }}</td>
                    <td class="p-2 text-sm">{{ number_format($prod->PrixHT * $prod->Qtte, 0, '', ' ') }}</td>

                    @if ($prod->TypeTaxe == 'A')
                        @php
                            $hta += $prod->PrixHT * $prod->Qtte;
                        @endphp
                        <td class="p-2 text-sm">{{ number_format($prod->PrixHT * $prod->Qtte, 0, '', ' ') }}</td>
                    @endif

                    @if ($prod->TypeTaxe == 'E')
                        @php
                            $hte += $prod->PrixHT * $prod->Qtte;
                        @endphp
                        <td class="p-2 text-sm">{{ number_format($prod->PrixHT * $prod->Qtte, 0, '', ' ') }}</td>
                    @endif

                    @if ($prod->TypeTaxe == 'B')
                        @php
                            $htb += $prod->PrixHT * $prod->Qtte;
                            $tvab += $prod->PrixHT * $prod->Qtte * 0.18;
                        @endphp
                        <td class="p-2 text-sm">{{ number_format($prod->PrixHT * $prod->Qtte * 1.18, 0, '', ' ') }}
                        </td>
                    @endif

                    @if ($prod->TypeTaxe == 'D')
                        @php
                            $hte += $prod->PrixHT * $prod->Qtte;
                            $tvad += $prod->PrixHT * $prod->Qtte * 0.18;
                        @endphp
                        <td class="p-2 text-sm">{{ number_format($prod->PrixHT * $prod->Qtte * 1.18, 0, '', ' ') }}
                        </td>
                    @endif

                    <td>
                        <button type="button" wire:click.prevent="edit({{ $prod->id }})" class="btn"><svg
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="#00f" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                            </svg>
                        </button>
                        <button type="button" wire:click.prevent="delete({{ $prod->id }})" onclick="setAIBInt()"
                            class="btn"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="#f00" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if ($prods->count() !== 0)
        <div class="mt-8">
            <div class="flex justify-between">
                <table id="total_ht" class="self-start m-2">
                    @if ($hta !== 0)
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-100 dark:text-gray-400 dark:bg-gray-800">
                            <td class="p-1">TOTAL HT_A</td>
                            <td class="p-1">
                                <input
                                    class="w-28 ml-1 mr-1 text-sm text-gray-700 bg-gray-100 dark:bg-gray-800 text-right border-0 dark:text-gray-200 form-input"
                                    value="{{ $hta }}" type="text" name="hta_total" id="hta_total"
                                    readonly>
                            </td>
                        </tr>
                    @endif
                    @if ($htb !== 0)
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-100 dark:text-gray-400 dark:bg-gray-800">
                            <td class="p-1">TOTAL HT_B</td>
                            <td class="p-1"> <input
                                    class="w-28 ml-1 mr-1 text-sm text-gray-700 bg-gray-100 dark:bg-gray-800 text-right border-0 dark:text-gray-200 form-input"
                                    value="{{ $htb }}" type="text" name="htb_total" id="htb_total"
                                    readonly>
                            </td>
                        </tr>
                    @endif
                    @if ($htd !== 0)
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-100 dark:text-gray-400 dark:bg-gray-800">
                            <td class="p-1">TOTAL HT_D</td>
                            <td class="p-1"> <input
                                    class="w-28 ml-1 mr-1 text-sm text-gray-700 bg-gray-100 dark:bg-gray-800 text-right border-0 dark:text-gray-200 form-input"
                                    value="{{ $htd }}" type="text" name="htd_total" id="htd_total"
                                    readonly>
                            </td>
                        </tr>
                    @endif
                    @if ($hte !== 0)
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-100 dark:text-gray-400 dark:bg-gray-800">
                            <td class="p-1">TOTAL HT_E</td>
                            <td class="p-1"> <input
                                    class="w-28 ml-1 mr-1 text-sm text-gray-700 bg-gray-100 dark:bg-gray-800 text-right border-0 dark:text-gray-200 form-input"
                                    value="{{ $hte }}" type="text" name="hte_total" id="hte_total"
                                    readonly>
                            </td>
                        </tr>
                    @endif
                </table>

                <table id="action" class="self-start m-2">
                    @if ($tvab !== 0)
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-100 dark:text-gray-400 dark:bg-gray-800">
                            <td class="p-1">TOTAL TVA_B</td>
                            <td class="p-1"><input
                                    class="w-28 ml-1 mr-1 text-sm text-gray-700 bg-gray-100 dark:bg-gray-800 text-right border-0 dark:text-gray-200 form-input"
                                    type="text" value="{{ number_format($tvab, 0, '', ' ') }}" name="tva_btotal"
                                    id="tva_btotal" readonly>
                            </td>
                        </tr>
                    @endif
                    @if ($tvad !== 0)
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-100 dark:text-gray-400 dark:bg-gray-800">
                            <td class="p-1">TOTAL TVA_D</td>
                            <td class="p-1"><input
                                    class="w-28 ml-1 mr-1 text-sm text-gray-700 bg-gray-100 dark:bg-gray-800 text-right border-0 dark:text-gray-200 form-input"
                                    type="text" value="{{ $tvad }}" name="tva_dtotal" id="tva_dtotal"
                                    readonly>
                            </td>
                        </tr>
                    @endif
                    <tr
                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-100 dark:text-gray-400 dark:bg-gray-800">
                        <td class="p-1">TOTAL AIB</td>
                        <td class="p-1"><input
                                class="w-28 ml-1 mr-1 text-sm text-gray-700 bg-gray-100 dark:bg-gray-800 text-right border-0 dark:text-gray-200 form-input"
                                type="text" value="0" name="aib_total" id="aib_total" readonly></td>
                    </tr>
                    <tr
                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-100 dark:text-gray-400 dark:bg-gray-800">
                        <td class="p-1">TOTAL TTC</td>
                        <td class="p-1"><input
                                class="w-28 ml-1 mr-1 text-sm text-gray-700 bg-gray-100 dark:bg-gray-800 text-right border-0 dark:text-gray-200 form-input"
                                type="text" value="{{ $hta + $htb + $htd + $hte + $tvab + $tvad }}"
                                name="ttc_total" id="ttc_total" readonly></td>
                    </tr>
                </table>
                <table id="action" class="self-start m-2">
                    <tr
                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-100 dark:text-gray-400 dark:bg-gray-800">
                        <td class="p-1">Montant percu</td>
                        <td class="p-1"><input onchange="setAmountReturn()"
                                class="w-28 ml-1 mr-1 text-sm text-gray-700 bg-gray-100 dark:bg-gray-800 text-right border-0 dark:text-gray-200 form-input"
                                type="number" name="mt_percu" id="mt_percu" value="0"></td>
                    </tr>
                    <tr
                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-100 dark:text-gray-400 dark:bg-gray-800">
                        <td class="p-1">Montant rendu</td>
                        <td class="p-1"><input onchange="setAmountRest()"
                                class="w-28 ml-1 mr-1 text-sm text-gray-700 bg-gray-100 dark:bg-gray-800 text-right border-0 dark:text-gray-200 form-input"
                                type="number" name="mt_rendu" id="mt_rendu" value="0"></td>
                        <input type="hidden" name="mt_a_rendre" id="mt_a_rendre">
                    </tr>
                    <tr
                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-100 dark:text-gray-400 dark:bg-gray-800">
                        <td class="p-1">Reliquat</td>
                        <td class="p-1"><input
                                class="w-28 ml-1 mr-1 text-sm text-gray-700 bg-gray-100 dark:bg-gray-800 text-right border-0 dark:text-gray-200 form-input"
                                type="number" name="reliquat" id="reliquat" value="0"></td>
                    </tr>
                </table>

            </div>
        </div>
    @endif
</div>
