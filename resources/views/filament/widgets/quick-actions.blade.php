<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            <div class="flex items-center gap-2">
                <x-filament::icon
                    icon="heroicon-m-bolt"
                    class="h-5 w-5 text-primary-500"
                />
                <span class="text-base font-semibold tracking-tight">Actions rapides</span>
            </div>
        </x-slot>

        <div class="grid grid-cols-1 gap-3">
            {{-- Copropriété --}}
            <x-filament::button
                href="{{ route('filament.admin.resources.gestion.buildings.create') }}"
                tag="a"
                icon="heroicon-m-home-modern"
                color="gray"
                class="justify-center md:justify-start shadow-sm ring-1 ring-gray-950/5 h-12 "
            >
                Ajouter une copropriété
            </x-filament::button>

            {{-- Appartement --}}
            <x-filament::button
                href="{{ route('filament.admin.resources.gestion.apartments.create') }}"
                tag="a"
                icon="heroicon-m-key"
                color="gray"
                class="justify-center md:justify-start shadow-sm ring-1 ring-gray-950/5 h-12"
            >
                Nouvel appartement
            </x-filament::button>

            {{-- Résident --}}
            <x-filament::button
                href="{{ route('filament.admin.resources.gestion.residents.create') }}"
                tag="a"
                icon="heroicon-m-user-plus"
                color="gray"
                class="justify-center md:justify-start shadow-sm ring-1 ring-gray-950/5 h-12"
            >
                Inscrire un résident
            </x-filament::button>

            {{-- Demande --}}
            <x-filament::button
                href="{{ route('filament.admin.resources.gestion.tickets.create') }}"
                tag="a"
                icon="heroicon-m-wrench-screwdriver"
                color="gray"
                class="justify-center md:justify-start shadow-sm h-12"
            >
                Créer une demande
            </x-filament::button>

            {{-- Entrepreneur --}}
            <x-filament::button
                href="{{ route('filament.admin.contractors.resources.gestion.contractors.create') }}"
                tag="a"
                icon="heroicon-m-briefcase"
                color="gray"
                class="justify-center md:justify-start shadow-sm ring-1 ring-gray-950/5 h-12"
            >
                Ajouter un entrepreneur
            </x-filament::button>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>