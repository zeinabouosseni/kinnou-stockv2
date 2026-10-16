<?php

namespace App\Livewire\Pages\Admin;

use App\Models\Boutiques;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.admin', [
    'active'      => 'statistiques',
    'headerTitle' => 'Statistiques',
])]
#[Title('Statistiques — KINNOU-STOCK')]
class StatistiquesManager extends Component
{
    public function render()
    {
        return view('livewire.pages.admin.statistiques-manager');
    }


    #[Computed]
    public function plans(): array
    {
        return [
            ['label' => 'Gratuit',  'count' => 12, 'prix' => 0,     'color' => '#d1d5db'],
            ['label' => 'Starter',  'count' => 5,  'prix' => 2_500, 'color' => '#10b981'],
            ['label' => 'Pro',      'count' => 8,  'prix' => 5_000, 'color' => '#047857'],
            ['label' => 'Business', 'count' => 3,  'prix' => 12_000, 'color' => '#f59e0b'],
        ];
    }


    #[Computed]
    public function donut(): array
    {
        $total    = array_sum(array_column($this->plans, 'count'));
        $segments = [];
        $start    = 0;

        foreach ($this->plans as $plan) {
            $angle = $total > 0 ? ($plan['count'] / $total) * 360 : 0;

            $segments[] = [
                ...$plan,
                'start' => round($start, 2),
                'end'   => round($start + $angle, 2),
                'pct'   => $total > 0 ? round(($plan['count'] / $total) * 100) : 0,
            ];

            $start += $angle;
        }

        return ['segments' => $segments, 'total' => $total];
    }

    #[Computed]
    public function donutGradient(): string
    {
        $parts = array_map(
            fn($s) => "{$s['color']} {$s['start']}deg {$s['end']}deg",
            $this->donut['segments']
        );

        return 'conic-gradient(' . implode(', ', $parts) . ')';
    }


    #[Computed]
    public function statsBoutiques(): array
    {
        $row = Boutiques::query()
            ->selectRaw('COUNT(*) as total')
            ->selectRaw("SUM(status = 'actif') as actives")
            ->selectRaw("SUM(status = 'inactif') as suspendues")
            ->first();

        return [
            'total'      => (int) $row->total,
            'actives'    => (int) $row->actives,
            'suspendues' => (int) $row->suspendues,
            'expirees'   => 2, // FIGÉ — module abonnements à venir
        ];
    }


    #[Computed]
    public function revenusMois(): int
    {
        return array_sum(array_map(
            fn($p) => $p['count'] * $p['prix'],
            $this->plans
        ));
    }
}
