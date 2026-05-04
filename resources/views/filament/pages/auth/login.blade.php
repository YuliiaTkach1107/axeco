
<div class="flex min-h-screen flex-col items-center justify-center gap-6 bg-[#ffffff] p-6 md:p-10">
    <div class="w-full max-w-sm">
        <div class="flex flex-col gap-8">

            <div class="flex flex-col items-center gap-4">
                <a href="/" class="flex flex-col items-center gap-2 font-medium">
                    <div class="mb-1 flex h-[100px] w-auto items-center justify-center rounded-md">
                        <x-filament-panels::logo />
                    </div>
                </a>

                <div class="space-y-2 text-center">
                    <h1 class="poppins text-xl font-medium text-[#0d4677] ">
                         Connectez-vous à votre compte
                    </h1>
                    <p class="text-center text-sm text-[#4c6e9a]">
                        Entrez vos identifiants ci-dessous pour continuer
                    </p>
                </div>
            </div>

            <form wire:submit.prevent="authenticate" class="flex flex-col gap-6 text-[#0d4677] w-[368px]">
                @foreach ($this->form->getComponents() as $component)
                    {{ $component }}
                @endforeach
                <button type="submit" class="mt-4 w-full inline-flex items-center justify-center gap-2 rounded-md bg-[#0d4677] px-4 py-2 text-sm font-medium text-white transition hover:bg-[#0d4677]/90 disabled:opacity-50 disabled:pointer-events-none">
                    Se connecter
                </button>
            </form>
            <div class="text-center text-sm text-[#4c6e9a]">
                Vous n’avez pas encore de compte ?
                <a href="/enter-code" class="underline underline-offset-4 hover:text-[#0d4677]">S’inscrire</a>
            </div>
            <div class="text-center text-sm text-[#4c6e9a] space-y-2">
                <a href="/forgot-password" class="text-[#0d4677] hover:underline"> Mot de passe oublié ?</a>
            </div>
        </div>
    </div>
</div>
