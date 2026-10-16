<div class="space-y-6 p-6">


    <div class="relative overflow-hidden rounded-2xl bg-[#1e3a5f] p-6 shadow-md">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-[13px] font-medium text-blue-200/80">
                    Revenus estimés du mois
                </p>
                <p class="mt-2 text-[32px] font-bold leading-none text-white">
                    {{ number_format($this->plans['revenus'], 0, ',', ' ') }}
                    <span class="text-2xl font-bold text-white">FCFA</span>
                </p>
                <p class="mt-3 text-[13px] text-blue-200/80">
                    {{ $this->stats->actives }} boutiques actives sur la plateforme
                </p>
            </div>

            {{-- Icône graphique à droite --}}
            <div class="hidden md:block">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-blue-300/40" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" />
                </svg>
            </div>
        </div>
    </div>


    <div>
        <p class="mb-3 text-[11px] font-bold uppercase tracking-wider text-slate-500">
            Vue d'ensemble
        </p>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">

            <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm transition hover:shadow-md">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-xs font-medium text-slate-500">Boutiques totales</p>
                        <p class="mt-1 text-2xl font-bold text-slate-800">{{ $this->stats->total }}</p>
                        <p class="mt-1 text-[11px] font-semibold text-emerald-600">
                            ↑ +{{ $this->stats->total }}
                        </p>
                    </div>
                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015A3.001 3.001 0 0 0 20.25 9.349m-16.5 0L2.25 5.25h19.5l-1.5 4.099" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm transition hover:shadow-md">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-xs font-medium text-slate-500">Boutiques actives</p>
                        <p class="mt-1 text-2xl font-bold text-slate-800">{{ $this->stats->actives }}</p>
                        <p class="mt-1 text-[11px] font-medium text-slate-400">
                            {{ $this->stats->total > 0 ? round(($this->stats->actives / $this->stats->total) * 100) : 0 }}% du total
                        </p>
                    </div>
                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm transition hover:shadow-md">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-xs font-medium text-slate-500">Abonnements expirés</p>
                        <p class="mt-1 text-2xl font-bold text-slate-800">{{ $this->plans['expires'] }}</p>
                        <p class="mt-1 text-[11px] font-semibold text-red-500">À relancer</p>
                    </div>
                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-red-50 text-red-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm transition hover:shadow-md">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-xs font-medium text-slate-500">Plans payants</p>
                        <p class="mt-1 text-2xl font-bold text-slate-800">
                            {{ $this->plans['pro'] + $this->plans['business'] }}
                        </p>
                        <p class="mt-1 text-[11px] font-medium text-slate-400">Pro + Business</p>
                    </div>
                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-amber-50 text-amber-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ═════════════ 3. FILTRES ═════════════ --}}
    <div class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm">
        <div class="flex flex-col gap-3 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <p class="text-[11px] font-bold uppercase tracking-wider text-slate-500">
                    Boutiques récentes
                </p>
                <p class="text-xs text-slate-400">Gérer, filtrer et activer vos boutiques</p>
            </div>

            <div class="flex flex-wrap items-center gap-2">
                <div class="relative">
                    <svg xmlns="http://www.w3.org/2000/svg" class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                    <input type="text"
                        wire:model.live.debounce.400ms="search"
                        placeholder="Rechercher…"
                        class="w-52 rounded-lg border border-slate-200 bg-slate-50 py-2 pl-9 pr-3 text-sm text-slate-700 outline-none placeholder:text-slate-400 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-600/20" />
                </div>

                <select wire:model.live="filterStatus"
                    class="rounded-lg border border-slate-200 bg-slate-50 py-2 pl-3 pr-8 text-sm text-slate-700 outline-none focus:border-emerald-600 focus:ring-2 focus:ring-emerald-600/20">
                    <option value="tous">Tous les statuts</option>
                    <option value="actif">Actif</option>
                    <option value="inactif">Inactif</option>
                </select>

                @if ($this->search || $this->filterStatus !== 'tous')
                <button wire:click="resetFilters"
                    type="button"
                    class="rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs font-medium text-slate-600 transition hover:bg-slate-50">
                    Réinitialiser
                </button>
                @endif
            </div>
        </div>
    </div>

    {{-- ═════════════ 4. TABLEAU ═════════════ --}}
    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="border-b border-slate-200 bg-slate-50">
                    <tr>
                        <th class="px-5 py-3 text-left text-[11px] font-bold uppercase tracking-wider text-slate-500">Boutique</th>
                        <th class="px-5 py-3 text-left text-[11px] font-bold uppercase tracking-wider text-slate-500">Propriétaire</th>
                        <th class="px-5 py-3 text-left text-[11px] font-bold uppercase tracking-wider text-slate-500">Quartier</th>
                        <th class="px-5 py-3 text-left text-[11px] font-bold uppercase tracking-wider text-slate-500">Abonnement</th>
                        <th class="px-5 py-3 text-left text-[11px] font-bold uppercase tracking-wider text-slate-500">Statut</th>
                        <th class="px-5 py-3 text-right text-[11px] font-bold uppercase tracking-wider text-slate-500">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($this->boutiques as $boutique)
                    <tr wire:key="boutique-{{ $boutique->id }}" class="transition hover:bg-slate-50/60">
                        <td class="whitespace-nowrap px-5 py-4">
                            <div class="flex items-center gap-3">
                                @if ($boutique->logo)
                                <img src="{{ asset('storage/'.$boutique->logo) }}"
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

                        <td class="whitespace-nowrap px-5 py-4 text-slate-600">
                            {{ $boutique->quartier ?? '—' }}
                        </td>

                        {{-- Abonnement encore figé --}}
                        <td class="whitespace-nowrap px-5 py-4">
                            @switch($boutique->id % 3)
                            @case(1)
                            <span class="inline-flex rounded-full bg-emerald-100 px-2.5 py-1 text-[11px] font-semibold text-emerald-700">Pro</span>
                            @break
                            @case(2)
                            <span class="inline-flex rounded-full bg-amber-100 px-2.5 py-1 text-[11px] font-semibold text-amber-700">Business</span>
                            @break
                            @default
                            <span class="inline-flex rounded-full bg-slate-100 px-2.5 py-1 text-[11px] font-semibold text-slate-600">Gratuit</span>
                            @endswitch
                        </td>

                        <td class="whitespace-nowrap px-5 py-4">
                            @if ($boutique->status === 'actif')
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

                        <td class="whitespace-nowrap px-5 py-4">
                            <div class="flex items-center justify-end gap-2">
                                <button type="button"
                                    wire:click="toggleStatus({{ $boutique->id }})"
                                    wire:loading.attr="disabled"
                                    wire:target="toggleStatus({{ $boutique->id }})"
                                    title="{{ $boutique->status === 'actif' ? 'Désactiver' : 'Activer' }}"
                                    class="relative inline-flex h-5 w-9 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-emerald-500/40 {{ $boutique->status === 'actif' ? 'bg-emerald-600' : 'bg-slate-300' }}">
                                    <span class="pointer-events-none inline-block h-4 w-4 rounded-full bg-white shadow transition duration-200 {{ $boutique->status === 'actif' ? 'translate-x-4' : 'translate-x-0' }}"></span>
                                </button>

                                <a href="#"
                                    title="Voir les détails"
                                    class="rounded-md p-1.5 text-slate-400 transition hover:bg-slate-100 hover:text-slate-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-5 py-12 text-center">
                            <p class="text-sm font-medium text-slate-500">Aucune boutique trouvée</p>
                            <p class="mt-1 text-xs text-slate-400">Essayez de modifier vos filtres</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($this->boutiques->hasPages())
        <div class="border-t border-slate-100 px-5 py-3">
            {{ $this->boutiques->links() }}
        </div>
        @endif
    </div>
</div>