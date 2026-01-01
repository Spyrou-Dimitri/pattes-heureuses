@props([
    'animal_id',
    'livewire' => false
])

<form class="flex flex-col gap-8 p-6 border border-main-blue rounded-lg bg-white"
      @if($livewire)
          wire:submit="create_adoption()"
      action="{{route('adoption.store')}}"
      method="POST"
    @endif

>
    @if(!$livewire)
        @csrf
    @endif

    <input name="animal_id" type="hidden" label="Animal" value="{{$animal_id}}">

    <fieldset class="flex flex-col gap-4">
        <legend>
            Informations personnelles
        </legend>
        <div class="flex flex-col gap-4 border-t-2 border-t-main-blue pt-5 lg:flex-row lg:justify-between">
            <x-forms.input :name="'last_name'"
                           :type="'text'"
                           :label="'Nom'"
                           :placeholder="'Doe'"
                           :required="true"
                           :wire:model.blur="$livewire ? 'last_name' : null"
            />


            <x-forms.input :name="'first_name'"
                           :type="'text'"
                           :label="'Prénom'"
                           :wire:model.blur="$livewire ? 'first_name' : null"
                           :placeholder="'John'"
                           :required="true">

            </x-forms.input>
        </div>
        <div class="flex flex-col gap-4 lg:flex-row lg:justify-between">
            <x-forms.input :name="'email'"
                           :type="'email'"
                           :label="'Email'"
                           :wire:model.blur="$livewire ? 'email' : null"
                           :placeholder="'john.doe@gmail.com'"
                           :required="true">

            </x-forms.input>
            <x-forms.input :name="'telephone'"
                           :type="'tel'"
                           :label="'Téléphone'"
                           :wire:model.blur="$livewire ? 'telephone' : null"
                           :placeholder="'0485 48 48 30'">

            </x-forms.input>
        </div>
    </fieldset>
    <fieldset class="flex flex-col gap-4">
        <legend>
            Informations sur votre logement
        </legend>
        <div class="flex flex-col gap-4 border-t-2 border-t-main-blue pt-5 lg:flex-row lg:justify-between">
            <x-forms.input :name="'housing_type'"
                           :type="'text'"
                           :label="'Type de logement'"
                           :wire:model.blur="$livewire ? 'housing_type' : null"
                           :placeholder="'Appartement'">
            </x-forms.input>
            <x-forms.input :name="'environment'"
                           :type="'text'"
                           :label="'Environnement'"
                           :wire:model.blur="$livewire ? 'environment' : null"

                           :placeholder="'Jardin / forêt'">
            </x-forms.input>
        </div>
    </fieldset>
    <fieldset class="flex flex-col gap-4">
        <legend>
            Expériences et motivations
        </legend>
        <div class="flex flex-col gap-4 border-t-2 border-t-main-blue pt-5">
            <x-forms.textarea
                :name="'motivations'"
                :label="'Pourquoi souhaitez-vous adopter ?'"
                :wire:model.blur="$livewire ? 'motivations' : null"
                :placeholder="'Je souhaite adopté Jean parce que je veux pouvoir lui donner un nouveaux foyer...'">

            </x-forms.textarea>
        </div>


    </fieldset>
    <x-forms.submit>
        Envoyer
    </x-forms.submit>

</form>
