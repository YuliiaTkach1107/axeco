<x-filament-widgets::widget>
    @php($user = auth()->user())
    @if($user->role === 'admin')
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
    @endif
    @if($user->role === 'proprietaire')
        <x-filament::section>
            <x-slot name="heading">
                <div class="flex items-center gap-2">
                    <x-filament::icon
                        icon="heroicon-m-bolt"
                        class="h-5 w-5 text-primary-500"
                    />
                    <span class="text-base font-semibold tracking-tight">
                        Actions rapides
                    </span>
                </div>
            </x-slot>

            <div class="grid grid-cols-1 gap-3">

                {{-- Créer ticket --}}
                <x-filament::button
                    href="{{ route('filament.admin.resources.gestion.tickets.create') }}"
                    tag="a"
                    icon="heroicon-m-wrench-screwdriver"
                    color="gray"
                    class="justify-center md:justify-start shadow-sm h-12"
                >
                    Créer une demande
                </x-filament::button>

                {{-- Voir mes annonces --}}
                <x-filament::button
                    href="{{ route('filament.admin.resources.gestion.announcements.index') }}"
                    tag="a"
                    icon="heroicon-m-megaphone"
                    color="gray"
                    class="justify-center md:justify-start shadow-sm ring-1 ring-gray-950/5 h-12"
                >
                    Voir mes annonces
                </x-filament::button>

                {{-- Voir mes résidents --}}
                <x-filament::button
                    href="{{ route('filament.admin.resources.gestion.residents.index') }}"
                    tag="a"
                    icon="heroicon-m-user-group"
                    color="gray"
                    class="justify-center md:justify-start shadow-sm ring-1 ring-gray-950/5 h-12"
                >
                    Voir mes résidents
                </x-filament::button>

            </div>
        </x-filament::section>
    @endif
    @if($user->role === 'resident')
    <x-filament::section>
        <x-slot name="heading">
            <div class="flex items-center gap-2">
                <x-filament::icon
                    icon="heroicon-m-bolt"
                    class="h-5 w-5 text-primary-500"
                />
                <span class="text-base font-semibold tracking-tight">
                    Actions rapides
                </span>
            </div>
        </x-slot>

        <div class="grid grid-cols-1 gap-3">

            {{-- Créer demande --}}
            <x-filament::button
                href="{{ route('filament.admin.resources.gestion.tickets.create') }}"
                tag="a"
                icon="heroicon-m-wrench-screwdriver"
                color="gray"
                class="justify-center md:justify-start shadow-sm h-12"
            >
                Créer une demande
            </x-filament::button>

            {{-- Mes demandes --}}
            <x-filament::button
                href="{{ route('filament.admin.resources.gestion.tickets.index') }}"
                tag="a"
                icon="heroicon-m-inbox"
                color="gray"
                class="justify-center md:justify-start shadow-sm h-12"
            >
                Mes demandes
            </x-filament::button>

            {{-- Annonces du bâtiment --}}
            <x-filament::button
                href="{{ route('filament.admin.resources.gestion.announcements.index') }}"
                tag="a"
                icon="heroicon-m-megaphone"
                color="gray"
                class="justify-center md:justify-start shadow-sm h-12"
            >
                Annonces du bâtiment
            </x-filament::button>

            {{-- Documents --}}
            <x-filament::button
                href="{{ route('filament.admin.resources.gestion.documents.index') }}"
                tag="a"
                icon="heroicon-m-document-text"
                color="gray"
                class="justify-center md:justify-start shadow-sm h-12"
            >
                Documents
            </x-filament::button>

        </div>
    </x-filament::section>
@endif
</x-filament-widgets::widget>