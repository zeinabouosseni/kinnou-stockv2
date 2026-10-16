<div class="space-y-6">

    {{-- ── Plans ── --}}
    <div class="grid grid-cols-1 gap-3.5 sm:grid-cols-2 xl:grid-cols-4">

        <div class="flex min-h-[148px] flex-col rounded-xl border border-slate-200 bg-white p-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-[22px] w-[22px] text-emerald-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.8 2.2 4.2 4.6 4.2 7.2A4.2 4.2 0 0 1 12 14.4 4.2 4.2 0 0 1 7.8 10.2C7.8 7.6 9.2 5.2 12 3Z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 14.4V21" />
            </svg>
            <div class="mt-auto pt-6">
                <p class="text-sm font-bold text-slate-800">Gratuit</p>
                <p class="text-xs text-slate-400">14 boutiques</p>
            </div>
        </div>

        <div class="flex min-h-[148px] flex-col rounded-xl border border-slate-200 bg-white p-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-[22px] w-[22px] text-emerald-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.59 14.37a6 6 0 0 1-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 0 0 6.16-12.12A14.98 14.98 0 0 0 9.631 8.41m5.96 5.96a14.926 14.926 0 0 1-5.841 2.58m-.119-8.54a6 6 0 0 0-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 0 0-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 0 1-2.448-2.448 14.9 14.9 0 0 1 .06-.312m-2.24 2.39a4.493 4.493 0 0 0-1.757 4.306 4.493 4.493 0 0 0 4.306-1.758M16.5 9a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
            </svg>
            <div class="mt-auto pt-6">
                <p class="text-sm font-bold text-slate-800">Starter</p>
                <p class="text-xs text-slate-400">6 boutiques</p>
                <p class="mt-1 text-[13px] font-semibold text-emerald-700">15 000 FCFA</p>
            </div>
        </div>

        <div class="flex min-h-[148px] flex-col rounded-xl border border-slate-200 bg-white p-4">
            <div class="flex items-start justify-between">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-[22px] w-[22px] text-emerald-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                </svg>
                <span class="rounded-full bg-emerald-50 px-2 py-0.5 text-[9px] font-bold text-emerald-700">Populaire</span>
            </div>
            <div class="mt-auto pt-6">
                <p class="text-sm font-bold text-slate-800">Pro</p>
                <p class="text-xs text-slate-400">8 boutiques</p>
                <p class="mt-1 text-[13px] font-semibold text-emerald-700">40 000 FCFA</p>
            </div>
        </div>

        <div class="flex min-h-[148px] flex-col rounded-xl border border-slate-200 bg-white p-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-[22px] w-[22px] text-emerald-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
            </svg>
            <div class="mt-auto pt-6">
                <p class="text-sm font-bold text-slate-800">Business</p>
                <p class="text-xs text-slate-400">3 boutiques</p>
                <p class="mt-1 text-[13px] font-semibold text-emerald-700">36 000 FCFA</p>
            </div>
        </div>
    </div>

    {{-- ── Boutiques à relancer ── --}}
    <div>
        <p class="text-[11px] font-bold uppercase tracking-wider text-slate-500">Boutiques à relancer</p>

        <div class="mt-3 overflow-hidden rounded-xl border border-slate-200 bg-white">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="border-b border-slate-200 bg-slate-50">
                        <tr>
                            <th class="px-5 py-3 text-left text-[11px] font-bold uppercase tracking-wider text-slate-500">Boutique</th>
                            <th class="px-5 py-3 text-left text-[11px] font-bold uppercase tracking-wider text-slate-500">Propriétaire</th>
                            <th class="px-5 py-3 text-left text-[11px] font-bold uppercase tracking-wider text-slate-500">Quartier</th>
                            <th class="px-5 py-3 text-left text-[11px] font-bold uppercase tracking-wider text-slate-500">Abonnement</th>
                            <th class="px-5 py-3 text-left text-[11px] font-bold uppercase tracking-wider text-slate-500">Statut</th>
                            <th class="px-5 py-3 text-right text-[11px] font-bold uppercase tracking-wider text-slate-500">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <tr>
                            <td class="whitespace-nowrap px-5 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-emerald-100 text-xs font-bold text-emerald-700">MA</div>
                                    <div>
                                        <p class="font-semibold text-slate-800">Mini Market Awa</p>
                                        <p class="text-[11px] text-slate-400">#104</p>
                                    </div>
                                </div>
                            </td>
                            <td class="whitespace-nowrap px-5 py-4">
                                <p class="font-medium text-slate-700">Awa Dossou</p>
                                <p class="text-[11px] text-slate-400">awa@kinnou.bj</p>
                            </td>
                            <td class="whitespace-nowrap px-5 py-4 text-slate-600">Akpakpa</td>
                            <td class="whitespace-nowrap px-5 py-4">
                                <span class="inline-flex rounded-full bg-slate-100 px-2.5 py-1 text-[11px] font-semibold text-slate-600">Gratuit</span>
                            </td>
                            <td class="whitespace-nowrap px-5 py-4">
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-100 px-2.5 py-1 text-[11px] font-semibold text-amber-700">
                                    <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                                    À relancer
                                </span>
                            </td>
                            <td class="whitespace-nowrap px-5 py-4 text-right">
                                <a href="#" class="rounded-lg border border-emerald-200 px-3 py-1.5 text-xs font-semibold text-emerald-700 hover:bg-emerald-50">Relancer</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="whitespace-nowrap px-5 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-emerald-100 text-xs font-bold text-emerald-700">SB</div>
                                    <div>
                                        <p class="font-semibold text-slate-800">Super Marché Bio</p>
                                        <p class="text-[11px] text-slate-400">#87</p>
                                    </div>
                                </div>
                            </td>
                            <td class="whitespace-nowrap px-5 py-4">
                                <p class="font-medium text-slate-700">Koffi Mensah</p>
                                <p class="text-[11px] text-slate-400">koffi@kinnou.bj</p>
                            </td>
                            <td class="whitespace-nowrap px-5 py-4 text-slate-600">Cotonou</td>
                            <td class="whitespace-nowrap px-5 py-4">
                                <span class="inline-flex rounded-full bg-emerald-100 px-2.5 py-1 text-[11px] font-semibold text-emerald-700">Pro</span>
                            </td>
                            <td class="whitespace-nowrap px-5 py-4">
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-red-100 px-2.5 py-1 text-[11px] font-semibold text-red-600">
                                    <span class="h-1.5 w-1.5 rounded-full bg-red-500"></span>
                                    Expiré
                                </span>
                            </td>
                            <td class="whitespace-nowrap px-5 py-4 text-right">
                                <a href="#" class="rounded-lg border border-emerald-200 px-3 py-1.5 text-xs font-semibold text-emerald-700 hover:bg-emerald-50">Relancer</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="whitespace-nowrap px-5 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-emerald-100 text-xs font-bold text-emerald-700">PP</div>
                                    <div>
                                        <p class="font-semibold text-slate-800">Pharmacie du Port</p>
                                        <p class="text-[11px] text-slate-400">#62</p>
                                    </div>
                                </div>
                            </td>
                            <td class="whitespace-nowrap px-5 py-4">
                                <p class="font-medium text-slate-700">Nadia Sossa</p>
                                <p class="text-[11px] text-slate-400">nadia@kinnou.bj</p>
                            </td>
                            <td class="whitespace-nowrap px-5 py-4 text-slate-600">Fidjrossè</td>
                            <td class="whitespace-nowrap px-5 py-4">
                                <span class="inline-flex rounded-full bg-amber-100 px-2.5 py-1 text-[11px] font-semibold text-amber-700">Business</span>
                            </td>
                            <td class="whitespace-nowrap px-5 py-4">
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-slate-100 px-2.5 py-1 text-[11px] font-semibold text-slate-600">
                                    <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span>
                                    Suspendu
                                </span>
                            </td>
                            <td class="whitespace-nowrap px-5 py-4 text-right">
                                <a href="#" class="rounded-lg border border-emerald-200 px-3 py-1.5 text-xs font-semibold text-emerald-700 hover:bg-emerald-50">Relancer</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>