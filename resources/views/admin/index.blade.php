@extends('layouts.admin')
@section('content')
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Tableau de bord
        </h2>

        <!-- Cards -->
        <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
            <!-- Card -->
            <div class="flex p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                <div
                    class="w-10 p-2 mr-4 text-red-500 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m6 4.125l2.25 2.25m0 0l2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                    </svg>
                </div>
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                        Produits en rupture de stock
                    </p>
                    <p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-200">
                        {{ $alerts_req }}
                    </p>
                    <hr>
                    <p class="mt-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                        <a href="{{ route('admin.stock.empty') }}">Voir plus</a>
                    </p>
                </div>
            </div>
            <!-- Card -->
            <div class="flex p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                <div
                    class="w-10 p-2 mr-4 text-red-500 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                    </svg>
                </div>
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                        Bientôt en rupture de stock
                    </p>
                    <p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-200">
                        {{ $alerts_req2 }}
                    </p>
                    <hr>
                    <p class="mt-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                        <a href="{{ route('admin.stock.empty_soon') }}">Voir plus</a>
                    </p>
                </div>
            </div>
            <!-- Card -->
            <div class="flex p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                <div class="w-10 p-2 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M20.893 13.393l-1.135-1.135a2.252 2.252 0 01-.421-.585l-1.08-2.16a.414.414 0 00-.663-.107.827.827 0 01-.812.21l-1.273-.363a.89.89 0 00-.738 1.595l.587.39c.59.395.674 1.23.172 1.732l-.2.2c-.212.212-.33.498-.33.796v.41c0 .409-.11.809-.32 1.158l-1.315 2.191a2.11 2.11 0 01-1.81 1.025 1.055 1.055 0 01-1.055-1.055v-1.172c0-.92-.56-1.747-1.414-2.089l-.655-.261a2.25 2.25 0 01-1.383-2.46l.007-.042a2.25 2.25 0 01.29-.787l.09-.15a2.25 2.25 0 012.37-1.048l1.178.236a1.125 1.125 0 001.302-.795l.208-.73a1.125 1.125 0 00-.578-1.315l-.665-.332-.091.091a2.25 2.25 0 01-1.591.659h-.18c-.249 0-.487.1-.662.274a.931.931 0 01-1.458-1.137l1.411-2.353a2.25 2.25 0 00.286-.76m11.928 9.869A9 9 0 008.965 3.525m11.928 9.868A9 9 0 118.965 3.525" />
                    </svg>
                </div>
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                        Nombre de fournisseurs
                    </p>
                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-2">
                        {{ $providers_req }}
                    </p>
                    <hr>
                    <p class="inline-block align-baseline mt-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                        <a href="{{ route('admin.edition.provider') }}">Voir plus</a>
                    </p>
                </div>
            </div>
            <!-- Card -->
            <div class="flex p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                <div class="w-10 p-2 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                    </svg>
                </div>
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                        Nombre de clients
                    </p>
                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-2">
                        {{ $customers_req }}
                    </p>
                    <hr>
                    <p class="inline-block align-baseline mt-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                        <a href="{{ route('admin.edition.customer') }}">Voir plus</a>
                    </p>
                </div>
            </div>
            <!-- Card -->
            <div class="flex p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                <div class="w-10 p-2 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6.429 9.75L2.25 12l4.179 2.25m0-4.5l5.571 3 5.571-3m-11.142 0L2.25 7.5 12 2.25l9.75 5.25-4.179 2.25m0 0L21.75 12l-4.179 2.25m0 0l4.179 2.25L12 21.75 2.25 16.5l4.179-2.25m11.142 0l-5.571 3-5.571-3" />
                    </svg>
                </div>
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                        Nombre de produits
                    </p>
                    <p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-200">
                        {{ $products_req }}
                    </p>
                    <hr>
                    <p class="mt-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                        <a href="{{ route('admin.edition.product') }}">Voir plus</a>
                    </p>
                </div>
            </div>
            <!-- Card -->
            <div class="flex p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                <div
                    class="w-10 p-2 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                    </svg>
                </div>
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                        Nombre de factures
                    </p>
                    <p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-200">
                        {{ $invoices_req }}
                    </p>
                    <hr>
                    <p class="mt-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                        <a href="{{ route('admin.invoice.index') }}">Voir plus</a>
                    </p>
                </div>
            </div>
            <!-- Card -->
            <div class="flex p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                <div
                    class="w-10 p-2 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 01-.982-3.172M9.497 14.25a7.454 7.454 0 00.981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 007.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25c2.291 0 4.545.16 6.75.47v1.516M7.73 9.728a6.726 6.726 0 002.748 1.35m8.272-6.842V4.5c0 2.108-.966 3.99-2.48 5.228m2.48-5.492a46.32 46.32 0 012.916.52 6.003 6.003 0 01-5.395 4.972m0 0a6.726 6.726 0 01-2.749 1.35m0 0a6.772 6.772 0 01-3.044 0" />
                    </svg>
                </div>
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                        @php
                            echo "Chiffre d'affaires du " .date('d-m-Y');
                        @endphp
                    </p>
                    <p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-200">
                        @foreach ($invoices_count as $invoice_count)
                            {{ number_format($invoice_count->Montant_TTC, 0, '', ' ') }}
                        @endforeach
                    </p>
                    <hr>
                    <p class="mt-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                        <a href="{{ route('admin.statistique.consumer') }}">Voir plus</a>
                    </p>
                </div>
            </div>
            <!-- Card -->
            <div class="flex p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                <div
                    class="w-10 p-2 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>
                </div>
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                        Nombre d'utilisateurs
                    </p>
                    <p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-200">
                        {{ $users_req }}
                    </p>
                    <hr>
                    <p class="mt-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                        <a href="{{ route('admin.users') }}">Voir plus</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
