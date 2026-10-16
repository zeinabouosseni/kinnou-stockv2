@props(['active' => null])

@php
// Si la prop 'active' n'est pas passée, on détecte automatiquement la route courante
$currentActive = $active ?? match(true) {
request()->routeIs('admin.dashboard*') => 'dashboard',
request()->routeIs('admin.boutiques*') => 'boutiques',
request()->routeIs('admin.abonnements*') => 'abonnements',
request()->routeIs('admin.utilisateurs*') => 'utilisateurs',
request()->routeIs('admin.statistiques*') => 'statistiques',
request()->routeIs('admin.notifications*') => 'notifications',
request()->routeIs('admin.parametres*') => 'parametres',
default => 'dashboard',
};

$nomAdmin = auth()->check() ? auth()->user()->name : 'zeina';
$initiales = Illuminate\Support\Str::of($nomAdmin)->explode(' ')->map(fn($w) => mb_substr($w, 0, 1))->take(2)->join('');
@endphp

<aside class="flex h-screen w-60 shrink-0 flex-col bg-[#1e3a5f] text-white">

    {{-- ── LOGO ── --}}
    <div class="flex items-center gap-3 px-5 pb-6 pt-7">
        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#16a34a] shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
            </svg>
        </div>
        <div class="leading-tight">
            <span class="text-sm font-extrabold tracking-wide text-white">
                KINNOU-STOCK
            </span>
            <span class="block text-xs font-medium text-[#93c5fd]/80">Administration</span>
        </div>
    </div>

    <div class="mx-5 border-t border-white/10"></div>

    {{-- ── NAVIGATION ── --}}
    <nav class="mt-4 flex-1 space-y-1 overflow-y-auto px-3">

        {{-- 1. TABLEAU DE BORD --}}
        <a href="{{ route('admin.dashboard') }}" wire:navigate
            class="group flex items-center gap-3 rounded-xl py-3 pl-3 pr-4 transition-all duration-200 
            {{ $currentActive === 'dashboard' 
                ? 'border-l-4 border-[#16a34a] bg-white/10 text-white font-semibold' 
                : 'border-l-4 border-transparent text-[#93c5fd] hover:bg-white/5 hover:text-white font-normal' }}">
            <span class="shrink-0 transition-colors {{ $currentActive === 'dashboard' ? 'text-white' : 'text-[#93c5fd] group-hover:text-white' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25a2.25 2.25 0 0 1-2.25-2.25v-2.25Z" />
                </svg>
            </span>
            <span class="text-[14px]">Tableau de bord</span>
        </a>

        {{-- 2. BOUTIQUES --}}
        <a href="{{ route('admin.boutiques') }}" wire:navigate
            class="group flex items-center gap-3 rounded-xl py-3 pl-3 pr-4 transition-all duration-200 
            {{ $currentActive === 'boutiques' 
                ? 'border-l-4 border-[#16a34a] bg-white/10 text-white font-semibold' 
                : 'border-l-4 border-transparent text-[#93c5fd] hover:bg-white/5 hover:text-white font-normal' }}">
            <span class="shrink-0 transition-colors {{ $currentActive === 'boutiques' ? 'text-white' : 'text-[#93c5fd] group-hover:text-white' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015A3.001 3.001 0 0 0 20.25 9.349m-16.5 0L2.25 5.25h19.5l-1.5 4.099" />
                </svg>
            </span>
            <span class="text-[14px]">Boutiques</span>
        </a>

        {{-- 3. ABONNEMENTS --}}
        <a href="{{ route('admin.abonnements') }}" wire:navigate
            class="group flex items-center gap-3 rounded-xl py-3 pl-3 pr-4 transition-all duration-200 
            {{ $currentActive === 'abonnements' 
                ? 'border-l-4 border-[#16a34a] bg-white/10 text-white font-semibold' 
                : 'border-l-4 border-transparent text-[#93c5fd] hover:bg-white/5 hover:text-white font-normal' }}">
            <span class="shrink-0 transition-colors {{ $currentActive === 'abonnements' ? 'text-white' : 'text-[#93c5fd] group-hover:text-white' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15A2.25 2.25 0 0 0 2.25 6.75v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                </svg>
            </span>
            <span class="text-[14px]">Abonnements</span>
        </a>

        {{-- 4. UTILISATEURS --}}
        <a href="{{ route('admin.utilisateurs') }}" wire:navigate
            class="group flex items-center gap-3 rounded-xl py-3 pl-3 pr-4 transition-all duration-200 
            {{ $currentActive === 'utilisateurs' 
                ? 'border-l-4 border-[#16a34a] bg-white/10 text-white font-semibold' 
                : 'border-l-4 border-transparent text-[#93c5fd] hover:bg-white/5 hover:text-white font-normal' }}">
            <span class="shrink-0 transition-colors {{ $currentActive === 'utilisateurs' ? 'text-white' : 'text-[#93c5fd] group-hover:text-white' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                </svg>
            </span>
            <span class="text-[14px]">Utilisateurs</span>
        </a>

        {{-- 5. STATISTIQUES --}}
        <a href="{{ route('admin.statistiques') }}" wire:navigate
            class="group flex items-center gap-3 rounded-xl py-3 pl-3 pr-4 transition-all duration-200 
            {{ $currentActive === 'statistiques' 
                ? 'border-l-4 border-[#16a34a] bg-white/10 text-white font-semibold' 
                : 'border-l-4 border-transparent text-[#93c5fd] hover:bg-white/5 hover:text-white font-normal' }}">
            <span class="shrink-0 transition-colors {{ $currentActive === 'statistiques' ? 'text-white' : 'text-[#93c5fd] group-hover:text-white' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                </svg>
            </span>
            <span class="text-[14px]">Statistiques</span>
        </a>

        {{-- 6. NOTIFICATIONS --}}
        <a href="#"
            class="group flex items-center gap-3 rounded-xl py-3 pl-3 pr-4 transition-all duration-200 
            {{ $currentActive === 'notifications' 
                ? 'border-l-4 border-[#16a34a] bg-white/10 text-white font-semibold' 
                : 'border-l-4 border-transparent text-[#93c5fd] hover:bg-white/5 hover:text-white font-normal' }}">
            <span class="shrink-0 transition-colors {{ $currentActive === 'notifications' ? 'text-white' : 'text-[#93c5fd] group-hover:text-white' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                </svg>
            </span>
            <span class="text-[14px]">Notifications</span>

            <span class="ml-auto flex h-5 min-w-[20px] items-center justify-center rounded-full bg-red-600 px-1 text-[10px] font-bold text-white">
                20
            </span>
        </a>

        {{-- 7. PARAMÈTRES --}}
        <a href="#"
            class="group flex items-center gap-3 rounded-xl py-3 pl-3 pr-4 transition-all duration-200 
            {{ $currentActive === 'parametres' 
                ? 'border-l-4 border-[#16a34a] bg-white/10 text-white font-semibold' 
                : 'border-l-4 border-transparent text-[#93c5fd] hover:bg-white/5 hover:text-white font-normal' }}">
            <span class="shrink-0 transition-colors {{ $currentActive === 'parametres' ? 'text-white' : 'text-[#93c5fd] group-hover:text-white' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.212-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
            </span>
            <span class="text-[14px]">Paramètres</span>
        </a>

    </nav>

    {{-- ── PROFIL ADMIN (Bas de page) ── --}}
    <div class="border-t border-white/10 p-4">
        <div class="flex items-center gap-3">
            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-[#16a34a] text-sm font-bold text-white shadow-md">
                {{ strtoupper($initiales) }}
            </div>

            <div class="min-w-0 flex-1">
                <p class="truncate text-sm font-bold text-white leading-tight">
                    {{ $nomAdmin }}
                </p>
                <p class="text-xs text-[#93c5fd]/80">Super Admin</p>
            </div>

            <a href="#" title="Déconnexion" class="shrink-0 p-1 text-[#93c5fd] transition-colors hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                </svg>
            </a>
        </div>
    </div>
</aside>