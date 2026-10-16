<?php

namespace App\Livewire\Pages\Admin;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.admin', [
    'active'      => 'abonnements',
    'headerTitle' => 'Abonnements',
])]
#[Title('Abonnements — KINNOU-STOCK')]
class AbonnementListing extends Component
{
    public function render()
    {
        return view('livewire.pages.admin.abonnement-listing');
    }
}
