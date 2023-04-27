<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}

    <form>
        {{-- edition facture --}}
        <div class="md:flex md:flex-row">
            <div class="w-96 mt-6 mb-6 ml-6 mr-6 focus-within:text-purple-500">
                <label class="font-semibold tracking-wide text-left text-gray-500 dark:text-gray-400">Produit</label>
                <select data-te-select-init data-te-select-filter="true" wire:model="product"
                    class="w-96 text-sm text-gray-700 bg-gray-100 border-0 rounded-md dark:focus:shadow-outline-gray dark:bg-gray-700 dark:text-gray-200 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input">
                    <option value=""></option>
                    @foreach ($list_products as $list_product)
                        <option value="{{ $list_product->IDt_ProduitPK }}">
                            {{ $list_product->LibProd }}</option>
                    @endforeach
                </select>
            </div>
            <div class="w-20 mt-6 mb-6 ml-6 mr-6 focus-within:text-purple-500">
                <label class="font-semibold tracking-wide text-left text-gray-500 dark:text-gray-400">Qte</label>
                <input type="number" value="1" wire:model="Qtte"
                    class="w-20 text-sm text-gray-700 bg-gray-100 border-0 rounded-md dark:focus:shadow-outline-gray dark:bg-gray-700 dark:text-gray-200 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input">
            </div>
            <div class="w-20 mt-6 mb-6 ml-6 mr-6 focus-within:text-purple-500">
                <label class="font-semibold tracking-wide text-left text-gray-500 dark:text-gray-400">Type
                    Taxe</label>
                <select wire:model="TypeTaxe"
                    class="w-20 text-sm text-gray-700 bg-gray-100 border-0 rounded-md dark:focus:shadow-outline-gray dark:bg-gray-700 dark:text-gray-200 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input">
                    <option value=""></option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="D">D</option>
                    <option value="E">E</option>
                </select>
            </div>

            <div class="w-24 mt-6 mb-6 ml-6 mr-6 focus-within:text-purple-500">
                <button type="submit" wire:click.prevent="store"
                    class="w-24 cursor-pointer mt-4 mr-2 py-2 px-3 rounded-md text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Ajouter
                </button>
            </div>
        </div>
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
            @foreach ($prods as $prod)
                <tr>
                    <td class="p-2 text-sm">{{ $prod->LibProd }}</td>
                    <td class="p-2 text-sm">{{ $prod->TypeTaxe }}</td>
                    <td class="p-2 text-sm">{{ $prod->Qtte }}</td>
                    <td class="p-2 text-sm">{{ number_format($prod->PrixHT, 0, '', ' ') }}</td>
                    <td class="p-2 text-sm">{{ number_format($prod->PrixHT * $prod->Qtte, 0, '', ' ') }}</td>

                    @if ($prod->TypeTaxe == 'A' || $prod->TypeTaxe == 'E')
                        <td class="p-2 text-sm">{{ number_format($prod->PrixHT * $prod->Qtte, 0, '', ' ') }}</td>
                    @endif
                    @if ($prod->TypeTaxe == 'B' || $prod->TypeTaxe == 'D')
                        <td class="p-2 text-sm">{{ number_format($prod->PrixHT * $prod->Qtte * 1.18, 0, '', ' ') }}</td>
                    @endif

                    <td>
                        <button type="button" wire:click.prevent="edit({{ $prod->id }})" class="btn"><svg
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="#00f" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                            </svg>
                        </button>
                        <button type="button" wire:click.prevent="delete({{ $prod->id }})" class="btn"><svg
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="#f00" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
