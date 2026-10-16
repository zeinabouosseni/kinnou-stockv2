<?php

namespace App\Livewire\Pages\Admin;

use App\Models\Boutiques;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;

#[Layout('layouts.admin', [
    'active'      => 'dashboard',
    'headerTitle' => 'Tableau de bord',
])]
#[Title('Tableau de bord — KINNOU-STOCK')]
class Dashboard extends Component
{


    use WithPagination;

    public string $search = '';
    public string $filterStatus = 'tous'; // tous | actif | inactif
    public string $filterPlan   = 'tous'; // tous | gratuit | pro | business

    protected $queryString = [
        'search'       => ['except' => ''],
        'filterStatus' => ['except' => 'tous'],
        'filterPlan'   => ['except' => 'tous'],
    ];

    public function render()
    {
        return view('livewire.pages.admin.dashboard');
    }


    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingFilterStatus(): void
    {
        $this->resetPage();
    }

    public function resetFilters(): void
    {
        $this->reset('search', 'filterStatus');
        $this->resetPage();
    }


    public function toggleStatus(int $id): void
    {
        $boutique = Boutiques::findOrFail($id);

        $boutique->update([
            'status' => $boutique->status === 'actif' ? 'inactif' : 'actif',
        ]);
    }

    #[Computed]
    public function stats(): object
    {
        return Boutiques::query()
            ->selectRaw('count(*) as total')
            ->selectRaw("sum(status = 'actif') as actives")
            ->selectRaw("sum(status = 'inactif') as inactives")
            ->first();
    }

    /** Plans et revenus encore figés. */
    #[Computed]
    public function plans(): array
    {
        return [
            'expires'  => 2,
            'pro'      => 8,
            'business' => 3,
            'revenus'  => 155000,
        ];
    }

    #[Computed]
    public function boutiques()
    {
        return Boutiques::query()
            ->with('boutiquier:id,nom,prenom,email')
            ->when($this->search, function ($query) {
                $search = '%' . $this->search . '%';

                $query->where(function ($query) use ($search) {
                    $query->where('nom', 'like', $search)
                        ->orWhere('quartier', 'like', $search)
                        ->orWhereHas('boutiquier', function ($query) use ($search) {
                            $query->where('nom', 'like', $search)
                                ->orWhere('prenom', 'like', $search)
                                ->orWhere('email', 'like', $search);
                        });
                });
            })
            ->when($this->filterStatus !== 'tous', fn($query) => $query->where('status', $this->filterStatus))
            ->latest('id')
            ->paginate(8);
    }
}
