<?php

use function Livewire\Volt\layout;
use Livewire\Volt\Component;

layout('components.layouts.user.sidebar');

new class extends Component {
    public function with(): array
    {
        return [
            'title' => 'Dashboard',
        ];
    }
}; ?>

<div>
    <h1 class="text-4xl font-bold text-primary mb-4">Dashboard User</h1>
    <p class="text-zinc-600">Selamat datang di dashboard Anda!</p>
</div>