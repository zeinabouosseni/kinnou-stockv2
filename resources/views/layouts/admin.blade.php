<!DOCTYPE html>
<html lang="fr" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'KINNOU-STOCK' }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="h-full overflow-hidden bg-slate-100 font-['Inter',sans-serif] antialiased">

    <div class="flex h-screen">

        {{-- ═══════════ SIDEBAR ═══════════ --}}
        <x-admin.sidebar :active="$active ?? 'dashboard'" />
        <div class="flex flex-1 flex-col overflow-hidden">
            <x-admin.header :title="$headerTitle ?? 'Tableau de bord'" />
            {{-- CONTENU --}}
            <main class="flex-1 overflow-y-auto p-6">
                {{ $slot }}
            </main>
        </div>
    </div>

    @livewireScripts
</body>

</html>