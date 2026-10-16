@props(['title' => 'Tableau de bord'])

<header class="flex h-16 shrink-0 items-center justify-between border-b border-slate-200 bg-white px-6">

    {{-- Titre --}}
    <h1 class="text-lg font-semibold text-slate-800">{{ $title }}</h1>

    {{-- Côté Droit --}}
    <div class="flex items-center gap-4">

        {{-- Zone de recherche (Le focus passe au vert émeraude) --}}
        <div class="relative hidden md:block">
            <svg xmlns="http://www.w3.org/2000/svg"
                class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400"
                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
            <input type="text" placeholder="Rechercher…"
                class="w-56 rounded-lg border border-slate-200 bg-slate-50 py-2 pl-9 pr-3 text-sm text-slate-700 outline-none placeholder:text-slate-400 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-600/20 transition-all" />
        </div>

        {{-- Cloche de notifications --}}
        <a href="#" class="relative text-slate-500 transition hover:text-slate-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
            </svg>
            <span class="absolute -right-1 -top-1 flex h-4 min-w-[16px] items-center justify-center rounded-full bg-red-500 px-1 text-[9px] font-bold text-white">
                3
            </span>
        </a>

        {{-- Séparateur --}}
        <div class="h-6 w-px bg-slate-200"></div>

        {{-- Profil (Avatar en vert foncé) --}}
        <div class="flex items-center gap-2">
            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-700 text-[11px] font-bold text-white shadow-sm">
                SA
            </div>
            <span class="hidden text-sm font-medium text-slate-700 sm:block">
                Super Admin
            </span>
        </div>
    </div>
</header>