<?php

use function Livewire\Volt\layout;
use Livewire\Volt\Component;
use App\Models\Forum;

layout('components.layouts.app.sidebar');

new class extends Component {
    public bool $showForm = false;
    public ?int $editingId = null;

    public string $title = '';
    public string $description = '';
    public string $search = '';

    protected array $rules = [
        'title' => 'required|string|min:3|max:255',
        'description' => 'nullable|string|max:1000',
    ];

    public function with(): array
    {
        return ['title' => 'Kategori Forum'];
    }

    // Computed: $this->forums
    public function getForumsProperty()
    {
        $q = Forum::query()->withCount('posts')->latest();

        if (strlen($this->search)) {
            $q->where('title', 'like', "%{$this->search}%");
        }

        return $q->get();
    }

    public function create(): void
    {
        $this->resetForm();
        $this->showForm = true;
    }

    public function edit(int $id): void
    {
        $forum = Forum::findOrFail($id);

        $this->editingId = $forum->id;
        $this->title = (string) $forum->title;
        $this->description = (string) ($forum->description ?? '');
        $this->showForm = true;
    }

    public function save(): void
    {
        $data = $this->validate();

        if ($this->editingId) {
            Forum::whereKey($this->editingId)->update($data);
            session()->flash('success', 'Kategori forum diperbarui.');
        } else {
            Forum::create($data);
            session()->flash('success', 'Kategori forum ditambahkan.');
        }

        $this->resetForm();
        $this->dispatch('$refresh');
    }

    public function delete(int $id): void
    {
        Forum::whereKey($id)->delete();
        session()->flash('success', 'Kategori forum dihapus.');
        $this->dispatch('$refresh');
    }

    public function resetForm(): void
    {
        $this->reset(['showForm', 'editingId', 'title', 'description']);
    }
}; ?>

<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-primary">Kategori Forum</h1>
            <p class="text-zinc-600 mt-1">Kelola kategori forum diskusi</p>
        </div>

        <div class="flex items-center gap-3">
            <input
                type="text"
                wire:model.debounce.300ms="search"
                placeholder="Cari kategori..."
                class="px-3 py-2 border border-zinc-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary"
            />
            <button
                type="button"
                wire:click="create"
                class="px-6 py-3 bg-primary text-white rounded-lg hover:bg-primary-600 transition font-medium"
            >
                + Tambah Kategori
            </button>
        </div>
    </div>

    <!-- Flash message -->
    @if (session('success'))
        <div class="p-3 rounded-lg border border-green-200 bg-green-50 text-green-800">
            {{ session('success') }}
        </div>
    @endif

    <!-- Create/Edit Form -->
    @if($showForm)
        <div class="bg-white rounded-lg p-6 shadow-sm border border-zinc-200">
            <form wire:submit.prevent="save" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-zinc-700 mb-1">Judul</label>
                    <input
                        type="text"
                        wire:model.defer="title"
                        class="w-full px-4 py-2 rounded-lg border border-zinc-300 focus:ring-2 focus:ring-primary focus:border-primary"
                        placeholder="Nama kategori forum"
                    />
                    @error('title') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-zinc-700 mb-1">Deskripsi</label>
                    <textarea
                        wire:model.defer="description"
                        rows="3"
                        class="w-full px-4 py-2 rounded-lg border border-zinc-300 focus:ring-2 focus:ring-primary focus:border-primary"
                        placeholder="Deskripsi singkat kategori (opsional)"
                    ></textarea>
                    @error('description') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-center gap-3">
                    <button type="submit" class="px-5 py-2 bg-primary text-white rounded-lg hover:bg-primary-600">
                        {{ $editingId ? 'Simpan Perubahan' : 'Tambah Kategori' }}
                    </button>
                    <button type="button" wire:click="resetForm" class="px-5 py-2 border rounded-lg hover:bg-zinc-50">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    @endif

    <!-- Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white rounded-lg p-6 shadow-sm border border-zinc-200">
            <h3 class="text-sm font-medium text-zinc-600 mb-1">Total Kategori</h3>
            <p class="text-2xl font-bold text-zinc-900">{{ $this->forums->count() }}</p>
        </div>
        <div class="bg-white rounded-lg p-6 shadow-sm border border-zinc-200">
            <h3 class="text-sm font-medium text-zinc-600 mb-1">Total Postingan</h3>
            <p class="text-2xl font-bold text-primary">{{ $this->forums->sum('posts_count') }}</p>
        </div>
        <div class="bg-white rounded-lg p-6 shadow-sm border border-zinc-200">
            <h3 class="text-sm font-medium text-zinc-600 mb-1">Aktif</h3>
            <p class="text-2xl font-bold text-green-600">{{ $this->forums->count() }}</p>
        </div>
    </div>

    <!-- Forum Categories List -->
    <div class="bg-white rounded-lg shadow-sm border border-zinc-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-zinc-200">
            <h2 class="text-lg font-semibold text-primary">Daftar Kategori Forum</h2>
        </div>
        
        <div class="p-6 space-y-4">
            @forelse($this->forums as $forum)
                <div class="border border-zinc-200 rounded-lg p-6 hover:shadow-md transition">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <div class="flex items-center space-x-4 mb-3">
                                <div class="w-12 h-12 rounded-lg bg-primary/10 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-lg font-semibold text-zinc-900">{{ $forum->title }}</h3>
                                    <p class="text-sm text-zinc-600 mt-1">{{ $forum->description }}</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center space-x-6 mt-4">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4 text-zinc-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                                    </svg>
                                    <span class="text-sm text-zinc-600">{{ $forum->posts_count }} postingan</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4 text-zinc-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 01-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <span class="text-sm text-zinc-600">{{ optional($forum->created_at)->format('d M Y') }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="ml-6 flex flex-col space-y-2">
                            <button
                                type="button"
                                wire:click="edit({{ $forum->id }})"
                                class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-600 transition text-sm whitespace-nowrap"
                            >
                                Edit
                            </button>
                            <button
                                type="button"
                                onclick="if(!confirm('Hapus kategori?')) return false;"
                                wire:click="delete({{ $forum->id }})"
                                class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition text-sm whitespace-nowrap"
                            >
                                Hapus
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-12 text-zinc-500">
                    Tidak ada kategori forum
                </div>
            @endforelse
        </div>
    </div>
</div>