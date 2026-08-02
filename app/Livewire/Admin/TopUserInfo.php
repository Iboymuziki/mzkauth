<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\On;  // ← manquant !
use App\Models\User;

class TopUserInfo extends Component
{
    #[On('updateTopUserInfo')]
    public function refreshInfo(): void {}

    public function render()
    {
        return view('livewire.admin.top-user-info', [
            'user' => User::findOrFail(auth()->id())
        ]);
    }
}