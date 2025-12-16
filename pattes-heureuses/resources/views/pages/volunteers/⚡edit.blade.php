<?php

use App\Enums\RoleVolunteer;
use App\Enums\SexeVolunteer;
use Illuminate\Validation\Rule;
use Livewire\Component;
use App\Models\User;
use Livewire\WithFileUploads;

new class extends Component {

    use WithFileUploads;

    public User $user;
    public string $avatar = '';
    public string $selectedSexe = '';
    public string $selectedRole = '';
    public string $lastName = '';
    public string $firstName = '';
    public string $tel = '';
    public string $email = '';


    public function mount($id)
    {

        $this->user = User::findOrFail($id);
        $this->lastName = $this->user->last_name;
        $this->firstName = $this->user->first_name;
        $this->selectedSexe = $this->user->sexe->value;
        $this->selectedRole = $this->user->role->value;
        $this->tel = $this->user->telephone;
        $this->email = $this->user->email;
    }

    protected function rules()
    {
        return [
            'lastName' => 'required|min:3',
            'firstName' => 'required|min:3',
            'email' => ['required', Rule::unique('users')->ignore($this->user->id)],
            'selectedSexe' => ['required', Rule::enum(SexeVolunteer::class)],
            'selectedRole' => ['required', Rule::enum(RoleVolunteer::class)],
            'tel' => 'regex:/^\+?[0-9]{10,15}$/'
        ];
    }

    protected function messages()
    {
        return [
            'lastName.min' => ':attribute trop court (minimum 3 caractères).',
            'lastName.required' => 'Le :attribute est requis',
            'firstName.min' => ':attribute trop court (minimum 3 caractères).',
            'firstName.required' => 'Le :attribute est requis',
            'email.required' => 'Le :attribute est requis',
            'email.email' => 'Le format de l\'email est invalide',
            'email.unique' => 'Cet :attribute est déjà utilisé',
            'selectedSexe.required' => 'Veuillez définir un sexe',
            'selectedSexe.enum' => 'Cette valeur n\'est pas valide',
            'selectedRole.required' => 'Veuillez définir un role',
            'selectedRole.enum' => 'Cette valeur n\'est pas valide',
            'tel.regex' => 'Le :attribute doit faire entre 10 et 15 caractères'
        ];
    }

    protected function validationAttributes()
    {
        return [
            'lastName' => 'Prénom',
            'firstName' => 'Nom',
            'email' => 'email',
            'selectedSexe' => 'sexe',
            'selectedRole' => 'role',
            'password' => 'Mot de passe',
            'tel' => 'numéro de téléphone'
        ];
    }

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function update_user()
    {
        $this->validate();

        $this->user->update([
            'last_name' => $this->lastName,
            'first_name' => $this->firstName,
            'email' => $this->email,
            'sexe' => $this->selectedSexe,
            'role' => $this->selectedRole,
            'telephone' => $this->tel,
        ]);


        session()->flash('success', 'Profil modifié avec succès !');
    }


};
?>

<div class="relative">

    <x-admin.section :title="'Modifier votre profil'">
        <form action="#" wire:submit="update_user()" method="post"
              class="flex flex-col gap-12 border-2 border-main-blue rounded-lg p-6 bg-white">
            <fieldset class="flex flex-col gap-6">
                <legend>
                    Vos informations
                </legend>
                <div class="flex flex-col gap-6 sm:flex-row sm:justify-between border-t-2 border-t-main-blue pt-5">
                    <div class="flex flex-col gap-2 w-full">
                        <x-forms.input wire:model.blur="avatar" class="w-full"
                                       :type="'file'" :name="'volunteer-avatar'"
                                       :label="'Photo'"/>
                    </div>
                    <div class="flex flex-col gap-2 w-full">
                        <x-forms.select wire:model.blur="selectedSexe"
                                        :name="'volunteer-sexe'" :label="'Sexe'"
                                        :options="SexeVolunteer::cases()">
                            <option disabled value="">--Sélectionner un sexe--</option>
                        </x-forms.select>
                    </div>

                </div>
                <div class="flex flex-col gap-6 sm:flex-row sm:justify-between">
                    <div class="flex flex-col gap-2 w-full">
                        <x-forms.input :required="true" wire:model.blur="firstName" class="w-full" :type="'text'"
                                       :name="'volunteer-first-name'"

                                       :label="'Nom'"
                                       :placeholder="'Doe'"/>
                        <span
                            class="font-poppins text-red-600 font-semibold">@error('firstName') {{ $message }} @enderror</span>
                    </div>


                    <div class="flex flex-col gap-2 w-full">

                        <x-forms.input :required="true" wire:model.blur="lastName" class="w-full" :type="'text'"
                                       :name="'volunteer-last-name'"

                                       :label="'Prénom'"
                                       :placeholder="'John'"/>
                        <span
                            class="font-poppins text-red-600 font-semibold">@error('lastName') {{ $message }} @enderror</span>
                    </div>

                </div>
                <div class="flex flex-col gap-6 sm:flex-row sm:justify-between">
                    <div class="flex flex-col gap-2 w-full">

                        <x-forms.input :required="true" wire:model.blur="email" class="w-full" :type="'email'"
                                       :name="'volunteer-email'"

                                       :label="'Email'"
                                       :placeholder="'john.doe@gmail.com'"/>
                        <span
                            class="font-poppins text-red-600 font-semibold">@error('email') {{ $message }} @enderror</span>
                    </div>
                    <div class="flex flex-col gap-2 w-full">

                        <x-forms.input wire:model.blur="tel" class="w-full" :type="'tel'" :name="'volunteer-telephone'"

                                       :label="'Téléphone'"
                                       :placeholder="'+32 6 12 34 56 78'"/>
                        <span
                            class="font-poppins text-red-600 font-semibold">@error('tel') {{ $message }} @enderror</span>
                    </div>


                </div>
            </fieldset>
            <x-forms.submit>
                Modifier
            </x-forms.submit>
        </form>
    </x-admin.section>
    @if (session('success'))
        <div
            x-data="{ show: true }"
            x-show="show"
            x-transition.opacity.duration.500ms
            x-init="setTimeout(() => show = false, 2000)"
            class="animate-bounce fixed origin-center  -translate-x-1/2 -translate-y-1/2 top-1/2 right-1/2 font-fredoka lg:top-20 p-4 rounded-lg lg:right-10 text-center bg-white border-2 border-green-600 text-green-800 text-xl">
            {{ session('success') }}
        </div>
    @endif

</div>
