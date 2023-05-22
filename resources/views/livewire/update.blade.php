<div class="md:flex md:flex-row">
    <div class="w-96 mt-6 mb-6 ml-3 mr-3 focus-within:text-purple-500">
        <label class="font-semibold tracking-wide text-left text-gray-500 dark:text-gray-400">Modifier une ligne</label>

        @php
            $produit = DB::table('t_produit')
                ->select('LibProd')
                ->where('IDt_ProduitPK', '=', session()->get('product'))
                ->first();
        @endphp

        <input type="text" readonly value="{{ $produit->LibProd }}"
            class="w-96 text-sm text-gray-700 bg-gray-100 border-0 rounded-md dark:focus:shadow-outline-gray dark:bg-gray-700 dark:text-gray-200 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input">
    </div>

    <div class="w-32 mt-6 mb-6 ml-3 mr-3 focus-within:text-purple-500">
        <label class="font-semibold tracking-wide text-left text-gray-500 dark:text-gray-400">Prix HT</label>
        <input type="number" wire:model="pu"
            class="w-32 text-sm text-gray-700 bg-gray-100 border-0 rounded-md dark:focus:shadow-outline-gray dark:bg-gray-700 dark:text-gray-200 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input">
    </div>

    <div class="w-20 mt-6 mb-6 ml-3 mr-3 focus-within:text-purple-500">
        <label class="font-semibold tracking-wide text-left text-gray-500 dark:text-gray-400">Qte</label>
        <input type="number" wire:model="Qtte"
            class="w-20 text-sm text-gray-700 bg-gray-100 border-0 rounded-md dark:focus:shadow-outline-gray dark:bg-gray-700 dark:text-gray-200 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input">
    </div>

    <div class="w-20 mt-6 mb-6 ml-3 mr-3 focus-within:text-purple-500">
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

    <div class="w-24 mt-6 mb-6 ml-3 mr-3 focus-within:text-purple-500">
        <button type="submit" wire:click.prevent="update"
            class="w-24 cursor-pointer mt-4 mr-1 py-2 px-3 rounded-md text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Modifier
        </button>
    </div>

    <div class="w-24 mt-6 mb-6 ml-3 mr-3 focus-within:text-red-500">
        <button type="submit" wire:click.prevent="cancel" onclick="setAIBInt()"
            class="w-24 cursor-pointer mt-4 mr-1 py-2 px-3 rounded-md text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">Annuler
        </button>
    </div>
</div>
