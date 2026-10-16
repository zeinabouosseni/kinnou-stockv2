<div class="p-6 space-y-6">

    {{-- ═════════════ EN-TÊTE DE PAGE ═════════════ --}}
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-xl font-bold text-slate-800">Gestion des boutiques</h2>
            <p class="text-sm text-slate-500">
                {{ $this->stats['total'] }} boutique(s) enregistrée(s) sur la plateforme
            </p>
        </div>

    </div>

    {{-- ═════════════ MINI STATS ═════════════ --}}
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">

        {{-- Total --}}
        <div class="flex items-center gap-4 rounded-xl border border-slate-200 bg-white p-4 shadow-sm">
            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015A3.001 3.001 0 0 0 20.25 9.349m-16.5 0L2.25 5.25h19.5l-1.5 4.099" />
                </svg>
            </div>
            <div>
                <p class="text-xs font-medium text-slate-500">Total boutiques</p>
                <p class="text-xl font-bold text-slate-800">{{ $this->stats['total'] }}</p>
            </div>
        </div>

        {{-- Actives --}}
        <div class="flex items-center gap-4 rounded-xl border border-slate-200 bg-white p-4 shadow-sm">
            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
            </div>
            <div>
                <p class="text-xs font-medium text-slate-500">Actives</p>
                <p class="text-xl font-bold text-slate-800">{{ $this->stats['actives'] }}</p>
            </div>
        </div>

        {{-- Inactives --}}
        <div class="flex items-center gap-4 rounded-xl border border-slate-200 bg-white p-4 shadow-sm">
            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-lg bg-slate-100 text-slate-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 0 0 5.636 5.636m12.728 12.728A9 9 0 0 1 5.636 5.636m12.728 12.728L5.636 5.636" />
                </svg>
            </div>
            <div>
                <p class="text-xs font-medium text-slate-500">Inactives</p>
                <p class="text-xl font-bold text-slate-800">{{ $this->stats['inactives'] }}</p>
            </div>
        </div>
    </div>

    {{-- ═════════════ BARRE DE FILTRES ═════════════ --}}
    <div class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm">
        <div class="flex flex-wrap items-center gap-2">

            {{-- Recherche --}}
            <div class="relative flex-1 min-w-[220px]">
                <svg xmlns="http://www.w3.org/2000/svg" class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
                <input type="text"
                    wire:model.live.debounce.400ms="search"
                    placeholder="Rechercher une boutique, un propriétaire, un quartier…"
                    class="w-full rounded-lg border border-slate-200 bg-slate-50 py-2 pl-9 pr-3 text-sm text-slate-700 outline-none placeholder:text-slate-400 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-600/20" />
            </div>

            {{-- Filtre Statut --}}
            <select wire:model.live="filterStatus"
                class="rounded-lg border border-slate-200 bg-slate-50 py-2 pl-3 pr-8 text-sm text-slate-700 outline-none focus:border-emerald-600 focus:ring-2 focus:ring-emerald-600/20">
                <option value="tous">Tous les statuts</option>
                <option value="actif">Actif</option>
                <option value="inactif">Inactif</option>
            </select>

            {{-- Filtre Plan (FIGÉ) --}}
            <select wire:model.live="filterPlan"
                class="rounded-lg border border-slate-200 bg-slate-50 py-2 pl-3 pr-8 text-sm text-slate-700 outline-none focus:border-emerald-600 focus:ring-2 focus:ring-emerald-600/20">
                <option value="tous">Tous les plans</option>
                <option value="gratuit">Gratuit</option>
                <option value="pro">Pro</option>
                <option value="business">Business</option>
            </select>

            {{-- Reset --}}
            @if ($search || $filterStatus !== 'tous' || $filterPlan !== 'tous')
            <button wire:click="resetFilters"
                class="inline-flex items-center gap-1.5 rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs font-medium text-slate-600 transition hover:bg-slate-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
                Réinitialiser
            </button>
            @endif
        </div>
    </div>

    {{-- ═════════════ TABLEAU ═════════════ --}}
    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="border-b border-slate-200 bg-slate-50">
                    <tr>
                        {{-- Boutique (triable) --}}
                        <th class="px-5 py-3 text-left">
                            <button wire:click="sortBy('nom')"
                                class="group inline-flex items-center gap-1 text-[11px] font-bold uppercase tracking-wider text-slate-500 hover:text-slate-700">
                                Boutique
                                @if ($sortField === 'nom')
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    @if ($sortDirection === 'asc')
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75 12 8.25l7.5 7.5" />
                                    @else
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                    @endif
                                </svg>
                                @endif
                            </button>
                        </th>
                        <th class="px-5 py-3 text-left text-[11px] font-bold uppercase tracking-wider text-slate-500">Propriétaire</th>
                        <th class="px-5 py-3 text-left text-[11px] font-bold uppercase tracking-wider text-slate-500">Contact</th>
                        {{-- Quartier (triable) --}}
                        <th class="px-5 py-3 text-left">
                            <button wire:click="sortBy('quartier')"
                                class="group inline-flex items-center gap-1 text-[11px] font-bold uppercase tracking-wider text-slate-500 hover:text-slate-700">
                                Quartier
                                @if ($sortField === 'quartier')
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    @if ($sortDirection === 'asc')
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75 12 8.25l7.5 7.5" />
                                    @else
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                    @endif
                                </svg>
                                @endif
                            </button>
                        </th>
                        <th class="px-5 py-3 text-left text-[11px] font-bold uppercase tracking-wider text-slate-500">Abonnement</th>
                        <th class="px-5 py-3 text-left text-[11px] font-bold uppercase tracking-wider text-slate-500">Statut</th>
                        <th class="px-5 py-3 text-right text-[11px] font-bold uppercase tracking-wider text-slate-500">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($this->boutiques as $boutique)
                    @php
                    // ── Plan FIGÉ (rotation déterministe id % 3) ──
                    $plan = ['gratuit', 'pro', 'business'][$boutique->id % 3];
                    $planConfig = [
                    'gratuit' => ['label' => 'Gratuit', 'bg' => 'bg-slate-100', 'text' => 'text-slate-600'],
                    'pro' => ['label' => 'Pro', 'bg' => 'bg-emerald-100', 'text' => 'text-emerald-700'],
                    'business' => ['label' => 'Business', 'bg' => 'bg-amber-100', 'text' => 'text-amber-700'],
                    ][$plan];

                    $isActif = $boutique->status === 'actif';
                    @endphp

                    <tr wire:key="boutique-{{ $boutique->id }}" class="transition hover:bg-slate-50/60">

                        {{-- Boutique --}}
                        <td class="whitespace-nowrap px-5 py-4">
                            <div class="flex items-center gap-3">
                                @if ($boutique->logo)
                                <img src="{{ asset('storage/' . $boutique->logo) }}"
                                    alt="{{ $boutique->nom }}"
                                    class="h-9 w-9 rounded-lg object-cover" />
                                @else
                                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-emerald-100 text-xs font-bold text-emerald-700">
                                    {{ mb_strtoupper(mb_substr($boutique->nom, 0, 2)) }}
                                </div>
                                @endif
                                <div>
                                    <p class="font-semibold text-slate-800">{{ $boutique->nom }}</p>
                                    <p class="text-[11px] text-slate-400">#{{ $boutique->id }}</p>
                                </div>
                            </div>
                        </td>

                        {{-- Propriétaire --}}
                        <td class="whitespace-nowrap px-5 py-4">
                            @if ($boutique->boutiquier)
                            <p class="font-medium text-slate-700">
                                {{ $boutique->boutiquier->prenom }} {{ $boutique->boutiquier->nom }}
                            </p>
                            <p class="text-[11px] text-slate-400">{{ $boutique->boutiquier->email }}</p>
                            @else
                            <span class="text-slate-400">—</span>
                            @endif
                        </td>

                        {{-- Contact --}}
                        <td class="whitespace-nowrap px-5 py-4">
                            @if ($boutique->boutiquier?->telephone)
                            <p class="text-slate-600">{{ $boutique->boutiquier->telephone }}</p>
                            <p class="text-[11px] text-slate-400">{{ $boutique->boutiquier->ville ?? '' }}</p>
                            @else
                            <span class="text-slate-400">—</span>
                            @endif
                        </td>

                        {{-- Quartier --}}
                        <td class="whitespace-nowrap px-5 py-4 text-slate-600">
                            {{ $boutique->quartier ?? '—' }}
                        </td>

                        {{-- Plan (FIGÉ) --}}
                        <td class="whitespace-nowrap px-5 py-4">
                            <span class="inline-flex items-center rounded-full px-2.5 py-1 text-[11px] font-semibold {{ $planConfig['bg'] }} {{ $planConfig['text'] }}">
                                {{ $planConfig['label'] }}
                            </span>
                        </td>

                        {{-- Statut --}}
                        <td class="whitespace-nowrap px-5 py-4">
                            @if ($isActif)
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-100 px-2.5 py-1 text-[11px] font-semibold text-emerald-700">
                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                Actif
                            </span>
                            @else
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-slate-100 px-2.5 py-1 text-[11px] font-semibold text-slate-600">
                                <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span>
                                Inactif
                            </span>
                            @endif
                        </td>

                        {{-- Actions --}}
                        <td class="whitespace-nowrap px-5 py-4">
                            <div class="flex items-center justify-end gap-1.5">

                                {{-- Toggle actif/inactif --}}
                                <button type="button"
                                    wire:click="toggleStatus({{ $boutique->id }})"
                                    wire:loading.attr="disabled"
                                    wire:target="toggleStatus({{ $boutique->id }})"
                                    title="{{ $isActif ? 'Désactiver' : 'Activer' }}"
                                    class="relative mr-1 inline-flex h-5 w-9 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-emerald-500/40
                                                   {{ $isActif ? 'bg-emerald-600' : 'bg-slate-300' }}">
                                    <span class="pointer-events-none inline-block h-4 w-4 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out
                                                     {{ $isActif ? 'translate-x-4' : 'translate-x-0' }}"></span>
                                </button>

                                {{-- Voir (route à brancher) --}}
                                <a href="#" title="Voir les détails"
                                    class="rounded-md p-1.5 text-slate-400 transition hover:bg-slate-100 hover:text-slate-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </a>

                                {{-- Modifier (route à brancher) --}}
                                <a href="#" title="Modifier"
                                    class="rounded-md p-1.5 text-slate-400 transition hover:bg-slate-100 hover:text-emerald-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </a>

                                {{-- Supprimer (fonctionnel avec confirmation) --}}
                                <button type="button"
                                    wire:click="deleteBoutique({{ $boutique->id }})"
                                    wire:confirm="Supprimer définitivement « {{ $boutique->nom }} » ?"
                                    title="Supprimer"
                                    class="rounded-md p-1.5 text-slate-400 transition hover:bg-red-50 hover:text-red-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-5 py-12 text-center">
                            <div class="flex flex-col items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015A3.001 3.001 0 0 0 20.25 9.349m-16.5 0L2.25 5.25h19.5l-1.5 4.099" />
                                </svg>
                                <p class="text-sm font-medium text-slate-500">Aucune boutique trouvée</p>
                                <p class="text-xs text-slate-400">Essayez de modifier vos filtres ou votre recherche</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if ($this->boutiques->hasPages())
        <div class="border-t border-slate-100 px-5 py-3">
            {{ $this->boutiques->links() }}
        </div>
        @endif
    </div>
</div>