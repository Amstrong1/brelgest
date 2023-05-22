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
        <button type="submit" wire:click.prevent="store" onclick="setAIBInt()"
            class="w-24 cursor-pointer mt-4 mr-2 py-2 px-3 rounded-md text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Ajouter
        </button>
    </div>
</div>
