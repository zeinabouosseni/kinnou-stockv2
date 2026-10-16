<?php

namespace App\Livewire\Pages\Admin;

use App\Models\Boutiques;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.admin', [
    'active'      => 'boutiques',
    'headerTitle' => 'Boutiques',
])]
#[Title('Boutiques — KINNOU-STOCK')]
class ListingBoutiques extends Component
{

    use WithPagination;

    #[Url]
    public string $search = '';

    #[Url]
    public string $filterStatus = 'tous';

    #[Url]
    public string $filterPlan = 'tous';

    public string $sortField    = 'id';
    public string $sortDirection = 'desc';

    public function render()
    {
        return view('livewire.pages.admin.listing-boutiques');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function updatingFilterStatus()
    {
        $this->resetPage();
    }
    public function updatingFilterPlan()
    {
        $this->resetPage();
    }


    #[Computed]
    public function stats(): array
    {
        $row = Boutiques::query()
            ->selectRaw('COUNT(*) as total')
            ->selectRaw("SUM(status = 'actif') as actives")
            ->selectRaw("SUM(status = 'inactif') as inactives")
            ->first();

        return [
            'total'     => (int) $row->total,
            'actives'   => (int) $row->actives,
            'inactives' => (int) $row->inactives,
        ];
    }


    #[Computed]
    public function boutiques()
    {
        return Boutiques::query()
            ->with('boutiquier:id,nom,prenom,email,telephone,ville')
            ->when($this->search, function ($q) {
                $q->where(function ($sub) {
                    $sub->where('nom', 'like', "%{$this->search}%")
                        ->orWhere('quartier', 'like', "%{$this->search}%")
                        ->orWhereHas('boutiquier', function ($b) {
                            $b->where('nom', 'like', "%{$this->search}%")
                                ->orWhere('prenom', 'like', "%{$this->search}%")
                                ->orWhere('email', 'like', "%{$this->search}%")
                                ->orWhere('telephone', 'like', "%{$this->search}%");
                        });
                });
            })
            ->when(
                $this->filterStatus !== 'tous',
                fn($q) =>
                $q->where('status', $this->filterStatus)
            )
            // ── FIGÉ : plan dérivé de id % 3 (en attendant le module abonnements) ──
            ->when($this->filterPlan !== 'tous', function ($q) {
                $map = ['gratuit' => 0, 'pro' => 1, 'business' => 2];
                $q->whereRaw('id % 3 = ?', [$map[$this->filterPlan]]);
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);
    }



    public function sortBy(string $field): void
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField    = $field;
            $this->sortDirection = 'asc';
        }
        $this->resetPage();
    }

    public function toggleStatus(int $id): void
    {
        $boutique = Boutiques::findOrFail($id);

        $boutique->update([
            'status' => $boutique->status === 'actif' ? 'inactif' : 'actif',
        ]);

        unset($this->stats, $this->boutiques);

        $this->dispatch(
            'notify',
            type: 'success',
            message: "Boutique « {$boutique->nom} » " .
                ($boutique->status === 'actif' ? 'activée' : 'désactivée') . "."
        );
    }

    public function deleteBoutique(int $id): void
    {
        $boutique = Boutiques::findOrFail($id);
        $nom = $boutique->nom;

        if ($boutique->logo) {
            Storage::disk('public')->delete($boutique->logo);
        }

        $boutique->delete();

        unset($this->stats, $this->boutiques);

        $this->dispatch(
            'notify',
            type: 'success',
            message: "Boutique « {$nom} » supprimée."
        );
    }

    public function resetFilters(): void
    {
        $this->reset(['search', 'filterStatus', 'filterPlan']);
        $this->resetPage();
    }
}
