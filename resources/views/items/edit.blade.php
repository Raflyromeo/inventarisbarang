<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Inventaris IT') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('items.update', $item) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Nama Barang (Text) -->
                        <div class="mb-4">
                            <x-input-label for="name" :value="__('Nama Barang')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $item->name)" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Kategori (Select) -->
                        <div class="mb-4">
                            <x-input-label for="category" :value="__('Kategori')" />
                            <select id="category" name="category" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" required>
                                <option value="">-- Pilih Kategori --</option>
                                <option value="Laptop" {{ old('category', $item->category) == 'Laptop' ? 'selected' : '' }}>Laptop</option>
                                <option value="PC Desktop" {{ old('category', $item->category) == 'PC Desktop' ? 'selected' : '' }}>PC Desktop</option>
                                <option value="Printer" {{ old('category', $item->category) == 'Printer' ? 'selected' : '' }}>Printer</option>
                                <option value="Proyektor" {{ old('category', $item->category) == 'Proyektor' ? 'selected' : '' }}>Proyektor</option>
                                <option value="Server" {{ old('category', $item->category) == 'Server' ? 'selected' : '' }}>Server</option>
                                <option value="Networking" {{ old('category', $item->category) == 'Networking' ? 'selected' : '' }}>Networking</option>
                                <option value="Lainnya" {{ old('category', $item->category) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            <x-input-error :messages="$errors->get('category')" class="mt-2" />
                        </div>

                        <!-- Foto Barang (File/Image) -->
                        <div class="mb-4">
                            <x-input-label for="image" :value="__('Foto Barang')" />
                            @if($item->image)
                                <div class="mt-2 mb-2">
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="Foto Barang" class="w-32 h-32 object-cover rounded-md border border-gray-200">
                                </div>
                            @endif
                            <input id="image" type="file" name="image" class="block mt-1 w-full border border-gray-300 rounded-md shadow-sm p-2 bg-gray-50 focus:border-indigo-500 focus:ring-indigo-500" accept="image/*" />
                            <p class="text-sm text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengubah foto.</p>
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>

                        <!-- Waktu Pembelian (Time Picker / DateTime) -->
                        <div class="mb-4">
                            <x-input-label for="purchase_time" :value="__('Waktu Pembelian')" />
                            <input id="purchase_time" type="datetime-local" name="purchase_time" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" value="{{ old('purchase_time', $item->purchase_time) }}" />
                            <x-input-error :messages="$errors->get('purchase_time')" class="mt-2" />
                        </div>

                        <!-- Lokasi (Auto Complete) -->
                        <div class="mb-4">
                            <x-input-label for="location" :value="__('Lokasi (Gedung/Ruangan)')" />
                            <x-text-input id="location" list="location-list" class="block mt-1 w-full" type="text" name="location" :value="old('location', $item->location)" placeholder="Ketik atau pilih lokasi..." />
                            <datalist id="location-list">
                                <option value="Ruang Paripurna DPR">
                                <option value="Ruang Rapat Komisi I">
                                <option value="Ruang Rapat Komisi II">
                                <option value="Ruang Rapat Komisi III">
                                <option value="Ruang Fraksi">
                                <option value="Pusat Data DPR">
                                <option value="Gedung Nusantara I">
                                <option value="Gedung Nusantara II">
                            </datalist>
                            <x-input-error :messages="$errors->get('location')" class="mt-2" />
                        </div>

                        <!-- Deskripsi -->
                        <div class="mb-4">
                            <x-input-label for="description" :value="__('Deskripsi Spesifikasi')" />
                            <textarea id="description" name="description" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" rows="3">{{ old('description', $item->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('items.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 active:bg-gray-500 focus:outline-none focus:border-gray-500 focus:ring ring-gray-200 disabled:opacity-25 transition ease-in-out duration-150 mr-4">
                                Batal
                            </a>
                            <x-primary-button>
                                <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                                {{ __('Perbarui Barang') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
