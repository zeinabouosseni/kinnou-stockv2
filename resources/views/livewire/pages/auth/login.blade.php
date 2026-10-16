<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <div class="flex min-h-screen items-center justify-center bg-slate-900 px-4">

        {{-- ── Carte de connexion ── --}}
        <div class="w-full max-w-[420px] rounded-2xl border border-slate-200/10
                bg-white p-10 shadow-2xl shadow-black/20">

            {{-- ── Logo / Icône ── --}}
            <div class="flex flex-col items-center">
                <div class="flex h-[60px] w-[60px] items-center justify-center
                        rounded-2xl bg-slate-800">
                    {{-- Icône SVG admin_panel_settings (Heroicons) --}}
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-7 w-7 text-white" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959
                             11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3
                             9.749c0 5.592 3.824 10.29 9 11.623 5.176
                             -1.332 9-6.03 9-11.622 0-1.31-.21-2.571
                             -.598-3.751h-.152c-3.196 0-6.1-1.248
                             -8.25-3.285Z" />
                    </svg>
                </div>

                <h1 class="mt-5 text-xl font-bold tracking-wide text-slate-900">
                    KINNOU-STOCK
                </h1>
                <p class="mt-1 text-[13px] text-slate-400">
                    Tableau de bord Administration
                </p>
            </div>

            {{-- ── Formulaire ── --}}
            <form wire:submit="connexion" class="mt-8 space-y-5">

                {{-- EMAIL --}}
                <div>
                    <label for="email"
                        class="mb-1.5 block text-[11px] font-bold uppercase
                              tracking-wider text-slate-400">
                        Email
                    </label>
                    <div class="relative">
                        <span class="pointer-events-none absolute inset-y-0 left-0
                                 flex items-center pl-3 text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-[18px] w-[18px]" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25
                                     2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75
                                     m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15
                                     A2.25 2.25 0 0 0 2.25 6.75m19.5 0v.243
                                     a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615
                                     a2.25 2.25 0 0 1-2.36 0L3.32 8.91
                                     a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                            </svg>
                        </span>
                        <input id="email"
                            type="email"
                            wire:model="email"
                            placeholder="admin@kinnou.bj"
                            class="w-full rounded-lg border border-slate-200
                                  bg-slate-50/50 py-2.5 pl-10 pr-4 text-sm
                                  text-slate-800 placeholder-slate-300
                                  outline-none transition
                                  focus:border-blue-500 focus:ring-2
                                  focus:ring-blue-500/20" />
                    </div>
                    @error('email')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- MOT DE PASSE --}}
                <div>
                    <label for="password"
                        class="mb-1.5 block text-[11px] font-bold uppercase
                              tracking-wider text-slate-400">
                        Mot de passe
                    </label>
                    <div class="relative">
                        <span class="pointer-events-none absolute inset-y-0 left-0
                                 flex items-center pl-3 text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-[18px] w-[18px]" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75
                                     m-.75 11.25h10.5a2.25 2.25 0 0 0
                                     2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25
                                     -2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75
                                     a2.25 2.25 0 0 0 2.25 2.25Z" />
                            </svg>
                        </span>
                        <input id="password"
                            :type="showPassword ? 'text' : 'password'"
                            wire:model="password"
                            placeholder="••••••••"
                            class="w-full rounded-lg border border-slate-200
                                  bg-slate-50/50 py-2.5 pl-10 pr-10 text-sm
                                  text-slate-800 placeholder-slate-300
                                  outline-none transition
                                  focus:border-blue-500 focus:ring-2
                                  focus:ring-blue-500/20" />
                        {{-- Toggle visibilité --}}
                        <button type="button"
                            @click="showPassword = !showPassword"
                            class="absolute inset-y-0 right-0 flex items-center
                                   pr-3 text-slate-300 hover:text-slate-500
                                   transition">
                            {{-- Œil ouvert --}}
                            <svg x-show="!showPassword"
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-[18px] w-[18px]" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639
                                     C3.423 7.51 7.36 4.5 12 4.5c4.638 0
                                     8.573 3.007 9.963 7.178.07.207.07.431
                                     0 .639C20.577 16.49 16.64 19.5 12
                                     19.5c-4.638 0-8.573-3.007-9.963
                                     -7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                            {{-- Œil barré --}}
                            <svg x-show="showPassword"
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-[18px] w-[18px]" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.98 8.223A10.477 10.477 0 0 0 1.934
                                     12c1.292 4.338 5.31 7.5 10.066 7.5
                                     .993 0 1.953-.138 2.863-.395M6.228
                                     6.228A10.451 10.451 0 0 1 12 4.5c4.756
                                     0 8.773 3.162 10.065 7.498a10.522
                                     10.522 0 0 1-4.293 5.774M6.228 6.228
                                     3 3m3.228 3.228 3.65 3.65m7.894 7.894
                                     L21 21m-3.228-3.228-3.65-3.65m0 0a3 3
                                     0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                            </svg>
                        </button>
                    </div>
                    @error('password')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Erreur globale --}}
                @if ($errorMessage)
                <p class="text-center text-sm text-red-500">
                    {{ $errorMessage }}
                </p>
                @endif

                {{-- Bouton --}}
                <button type="submit"
                    wire:loading.attr="disabled"
                    class="relative flex w-full items-center justify-center
                           rounded-lg bg-blue-600 px-4 py-2.5 text-sm
                           font-semibold text-white shadow-sm transition
                           hover:bg-blue-700 focus:outline-none
                           focus:ring-2 focus:ring-blue-500/40
                           disabled:cursor-not-allowed disabled:opacity-60">

                    {{-- Spinner --}}
                    <svg wire:loading
                        class="mr-2 h-4 w-4 animate-spin text-white"
                        xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10"
                            stroke="currentColor" stroke-width="4" />
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 0 1 8-8V0C5.373 0 0 5.373
                             0 12h4z" />
                    </svg>

                    <span wire:loading.remove>Se connecter</span>
                    <span wire:loading>Connexion…</span>
                </button>
            </form>
        </div>
    </div>

    @script
    <script>
        Alpine.data('loginForm', () => ({
            showPassword: false,
        }));
    </script>
    @endscript
</div>