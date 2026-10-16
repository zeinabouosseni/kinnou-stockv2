<?php

namespace App\Livewire\Pages\Admin;


use App\Models\Boutiquiers;
use App\Models\Employers;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.admin', [
    'active'      => 'utilisateurs',
    'headerTitle' => 'Utilisateurs',
])]
#[Title('Utilisateurs — KINNOU-STOCK')]
class UtilisateursListing extends Component
{
    public function render()
    {
        return view('livewire.pages.admin.utilisateurs-listing');
    }
    #[Computed]
    public function boutiquiers()
    {
        return Boutiquiers::query()
            ->select('id', 'nom', 'prenom', 'email', 'status')
            ->with('boutiques:id,boutiquier_id,nom')
            ->withCount([
                'employes',
                'employes as employes_actifs_count' => fn($q) => $q->where('actif', true),
            ])
            ->orderBy('nom')
            ->get();
    }

    
    #[Computed]
    public function employesActifs(): int
    {
        return Employers::where('actif', true)->count();
    }
}
