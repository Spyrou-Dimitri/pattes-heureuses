<?php

use App\Enums\RoleVolunteer;
use App\Enums\SexeVolunteer;
use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;


new class extends Component {


    use WithFileUploads;

    public string $avatar = '';
    public string $selectedSexe = '';
    public string $selectedRole = '';
    public string $lastName = '';
    public string $firstName = '';
    public string $email = '';
    public string $password = '';
    public string $tel = '';


    //Créer les règles de validation
    protected function rules()
    {
        return [
            'lastName' => 'required|min:3',
            'firstName' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'selectedSexe' => ['required', Rule::enum(SexeVolunteer::class)],
            'selectedRole' => ['required', Rule::enum(RoleVolunteer::class)],
            'password' => 'required|min:6',
            'tel' => 'regex:/^\+?[0-9]{10,15}$/'
        ];
    }

    //Messages d'erreur
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
            'password.required' => 'Le :attribute est requis',
            'password.min' => ':attribute trop court (minimum 6 caractères).',
            'tel.regex' => 'Le :attribute doit faire entre 10 et 15 caractères'
        ];
    }

    //Remplacer le wire:model par un nom plus humain dans le message d'erreur
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


    public function save_volunteer()
    {

        $this->validate();

        $newUser = User::create([
            'avatar' => $this->avatar,
            'last_name' => $this->lastName,
            'first_name' => $this->firstName,
            'email' => $this->email,
            'password' => $this->password,
            'telephone' => $this->tel,
            'sexe' => $this->selectedSexe,
            'role' => $this->selectedRole,
        ]);


        return redirect()->route('volunteers-show', ['id' => $newUser->id]);


    }
};
?>
<div>
    <x-admin.section :title="'Créer un nouveau profil'">
        <form action="#" wire:submit="save_volunteer()" method="post"
              class="flex flex-col gap-12 border-2 border-main-blue rounded-lg p-6 bg-white">
            <fieldset class="flex flex-col gap-6">
                <legend>
                    Informations sur le bénévole
                </legend>
                <div class="flex flex-col gap-6 sm:flex-row sm:justify-between border-t-2 border-t-main-blue pt-5">
                    <div class="flex flex-col gap-2 w-full">
                        <x-forms.input wire:model.blur="avatar" class="w-full" :type="'file'" :name="'volunteer-avatar'"
                                       :label="'Photo'"/>
                    </div>
                    <div class="flex flex-col gap-2 w-full">
                        <x-forms.select wire:model.blur="selectedSexe" :name="'volunteer-sexe'" :label="'Sexe'"
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

                        <x-forms.input wire:model.blur="password" class="w-full" :type="'password'"
                                       :name="'volunteer-password'"
                                       :label="'Mot de passe'" :placeholder="'**********'"/>
                        <span
                            class="font-poppins text-red-600 font-semibold">@error('password') {{ $message }} @enderror
                        </span>
                    </div>
                </div>
                <div class="flex flex-col gap-6 sm:flex-row sm:justify-between">
                    <div class="flex flex-col gap-2 w-full">

                        <x-forms.input wire:model.blur="tel" class="w-full" :type="'tel'" :name="'volunteer-telephone'"
                                       :label="'Téléphone'"
                                       :placeholder="'+32 6 12 34 56 78'"/>
                        <span
                            class="font-poppins text-red-600 font-semibold">@error('tel') {{ $message }} @enderror</span>
                    </div>
                    <div class="flex flex-col gap-2 w-full">

                        <x-forms.select wire:model.blur="selectedRole" :name="'volunteer-role'" :label="'Role'"
                                        :options="RoleVolunteer::cases()">
                            <option disabled value="">--Selectionner un rôle--</option>
                        </x-forms.select>
                    </div>
                </div>
            </fieldset>
            <x-forms.submit>
                Créer la fiche
            </x-forms.submit>
        </form>
    </x-admin.section>

</div>
