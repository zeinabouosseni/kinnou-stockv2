<div class="p-6">

    <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">

        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm lg:col-span-2">
            <p class="text-sm font-bold text-slate-800">Répartition des plans</p>

            <div class="mt-5 flex flex-col items-center gap-8 sm:flex-row sm:justify-around">

                <div class="relative h-52 w-52 shrink-0 rounded-full transition-transform hover:scale-[1.02]"
                    style="background: {{ $this->donutGradient }}">

                    {{-- Trou central (centerSpaceRadius) --}}
                    <div class="absolute inset-0 m-auto flex h-[88px] w-[88px] flex-col items-center justify-center rounded-full bg-white shadow-inner">
                        <span class="text-2xl font-bold text-slate-800">{{ $this->donut['total'] }}</span>
                        <span class="text-[10px] font-medium uppercase tracking-wide text-slate-400">boutiques</span>
                    </div>
                </div>


                <ul class="w-full max-w-[220px] space-y-3">
                    @foreach ($this->donut['segments'] as $segment)
                    <li class="flex items-center gap-3">
                        <span class="h-3 w-3 shrink-0 rounded-sm" style="background: {{ $segment['color'] }}"></span>
                        <div class="flex flex-1 items-baseline justify-between">
                            <span class="text-[13px] font-medium text-slate-600">{{ $segment['label'] }}</span>
                            <span class="text-[13px] font-bold text-slate-800">
                                {{ $segment['count'] }}
                                <span class="ml-1 text-[11px] font-normal text-slate-400">({{ $segment['pct'] }}%)</span>
                            </span>
                        </div>
                    </li>


                    <div class="h-1 w-full overflow-hidden rounded-full bg-slate-100">
                        <div class="h-full rounded-full transition-all duration-500"
                            style="width: {{ $segment['pct'] }}%; background: {{ $segment['color'] }}"></div>
                    </div>
                    @endforeach
                </ul>
            </div>
        </div>


        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm font-bold text-slate-800">Résumé financier</p>

            <ul class="mt-4 divide-y divide-slate-100">

                {{-- Total boutiques (dynamique) --}}
                <li class="flex items-center justify-between py-2.5">
                    <span class="text-[13px] text-slate-500">Total boutiques</span>
                    <span class="text-[13px] font-bold text-slate-800">{{ $this->statsBoutiques['total'] }}</span>
                </li>

                {{-- Actives (dynamique) --}}
                <li class="flex items-center justify-between py-2.5">
                    <span class="text-[13px] text-slate-500">Actives</span>
                    <span class="inline-flex items-center gap-1.5 text-[13px] font-bold text-emerald-700">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                        {{ $this->statsBoutiques['actives'] }}
                    </span>
                </li>

                {{-- Suspendues (dynamique) --}}
                <li class="flex items-center justify-between py-2.5">
                    <span class="text-[13px] text-slate-500">Suspendues</span>
                    <span class="inline-flex items-center gap-1.5 text-[13px] font-bold text-slate-700">
                        <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span>
                        {{ $this->statsBoutiques['suspendues'] }}
                    </span>
                </li>

                {{-- Expirées (FIGÉ) --}}
                <li class="flex items-center justify-between py-2.5">
                    <span class="text-[13px] text-slate-500">Expirées</span>
                    <span class="inline-flex items-center gap-1.5 text-[13px] font-bold text-red-600">
                        <span class="h-1.5 w-1.5 rounded-full bg-red-500"></span>
                        {{ $this->statsBoutiques['expirees'] }}
                    </span>
                </li>

                {{-- Revenus estimés (figé, dérivé des plans) --}}
                <li class="flex items-center justify-between pt-3.5">
                    <span class="text-[13px] font-medium text-slate-600">Revenus estimés</span>
                    <span class="text-[15px] font-bold text-emerald-700">
                        {{ number_format($this->revenusMois, 0, ',', ' ') }} FCFA
                    </span>
                </li>
            </ul>

            {{-- Mini carte revenus/mois --}}
            <div class="mt-4 rounded-lg bg-emerald-50 p-3.5">
                <div class="flex items-center justify-between">
                    <p class="text-[11px] font-semibold uppercase tracking-wide text-emerald-700">MRR</p>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" />
                    </svg>
                </div>
                <p class="mt-1 text-lg font-bold text-emerald-800">
                    {{ number_format($this->revenusMois, 0, ',', ' ') }} <span class="text-xs font-medium">FCFA/mois</span>
                </p>
            </div>
        </div>
    </div>
</div>