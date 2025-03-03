<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-bind:class="{ 'dark': isDarkMode }" x-data="{ isDarkMode: true }">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body {{ $attributes }}>
        <!-- <button class="absolute top-10 right-50 z-50 bg-black text-white dark:bg-white dark:text-black" @click="isDarkMode = ! isDarkMode">
            switch
        </button> -->
        {{ $slot }}
    </body>
</html>
