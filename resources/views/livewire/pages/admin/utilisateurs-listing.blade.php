<div class="space-y-5">

    {{-- ═════════════ STAT CHIPS ═════════════ --}}
    <div class="flex flex-wrap gap-3">

        {{-- Chip : boutiquiers (dynamique) --}}
        <div class="inline-flex items-center gap-2 rounded-lg border border-emerald-200 bg-emerald-50 px-3.5 py-2.5">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-emerald-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015A3.001 3.001 0 0 0 20.25 9.349m-16.5 0L2.25 5.25h19.5l-1.5 4.099" />
            </svg>
            <span class="text-[13px] font-semibold text-emerald-700">
                {{ $this->boutiquiers->count() }} boutiquiers
            </span>
        </div>

        {{-- Chip : employés actifs (DYNAMIQUE — Employes::where('actif', true)->count()) --}}
        <div class="inline-flex items-center gap-2 rounded-lg border border-emerald-200 bg-emerald-50 px-3.5 py-2.5">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-emerald-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z" />
            </svg>
            <span class="text-[13px] font-semibold text-emerald-700">
                {{ $this->employesActifs }} employés actifs
            </span>
        </div>
    </div>

    {{-- ═════════════ TABLEAU PROPRIÉTAIRES ═════════════ --}}
    <div>
        <p class="text-[11px] font-bold uppercase tracking-wider text-slate-500">
            Propriétaires de boutiques
        </p>

        <div class="mt-3 overflow-hidden rounded-xl border border-slate-200 bg-white">
            @if ($this->boutiquiers->isEmpty())
            <p class="px-4 py-10 text-center text-sm text-slate-400">Aucun utilisateur inscrit.</p>
            @else
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="border-b border-slate-200 bg-[#fafafa]">
                        <tr>
                            <th class="px-4 py-3 text-[11px] font-bold text-slate-500">Propriétaire</th>
                            <th class="px-4 py-3 text-[11px] font-bold text-slate-500">Boutique</th>
                            <th class="px-4 py-3 text-[11px] font-bold text-slate-500">Email</th>
                            <th class="px-4 py-3 text-[11px] font-bold text-slate-500">Plan</th>
                            <th class="px-4 py-3 text-[11px] font-bold text-slate-500">Employés</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        @foreach ($this->boutiquiers as $boutiquier)
                        <tr wire:key="boutiquier-{{ $boutiquier->id }}" class="transition hover:bg-slate-50/60">

                            {{-- Propriétaire --}}
                            <td class="px-4 py-3 text-[13px] font-semibold text-slate-800">
                                {{ $boutiquier->prenom }} {{ $boutiquier->nom }}
                            </td>

                            {{-- Boutique (première boutique du boutiquier) --}}
                            <td class="px-4 py-3 text-xs text-slate-500">
                                {{ $boutiquier->boutiques->first()->nom ?? '—' }}
                            </td>

                            {{-- Email --}}
                            <td class="px-4 py-3 text-xs text-slate-500">
                                {{ $boutiquier->email }}
                            </td>

                            {{-- Plan (FIGÉ — en attendant le module abonnements) --}}
                            <td class="px-4 py-3 text-[11px] font-bold text-slate-800">PRO</td>

                            {{-- Employés actifs (DYNAMIQUE — withCount hasManyThrough) --}}
                            <td class="px-4 py-3 text-xs font-semibold text-slate-700">
                                {{ $boutiquier->employes_actifs_count }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>
</div>