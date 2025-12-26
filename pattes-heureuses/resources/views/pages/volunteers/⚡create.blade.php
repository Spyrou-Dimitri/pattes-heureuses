<?php

use App\Enums\RoleVolunteer;
use App\Enums\SexeVolunteer;
use App\Jobs\ProcessUploadedImageJob;
use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;


new class extends Component {


    use WithFileUploads;

    public $avatar;
    public SexeVolunteer $selectedSexe;
    public RoleVolunteer $selectedRole;
    public string $lastName = '';
    public string $firstName = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $tel = '';

    //Créer les règles de validation
    protected function rules()
    {
        return [
            'avatar' => 'nullable|image|max:2048|mimes:jpg,jpeg,png,webp',
            'lastName' => 'required|min:3',
            'firstName' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'selectedSexe' => ['required', Rule::enum(SexeVolunteer::class)],
            'selectedRole' => ['required', Rule::enum(RoleVolunteer::class)],
            'password' => 'required|min:6|confirmed',
            'tel' => 'regex:/^\+?[0-9 ]{10,15}$/'
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

        $validated = $this->validate();
        if ($validated['avatar']) {
            $new_original_file_name = uniqid() . '.' . config('animalavatars.image_type');
            $full_path_to_original = Storage::putFileAs(
                config('animalavatars.original_path'),
                $validated['avatar'],
                $new_original_file_name
            );
            if ($full_path_to_original) {
                $validated['avatar'] = $new_original_file_name;
                ProcessUploadedImageJob::dispatchSync($full_path_to_original, $new_original_file_name);
            } else {
                $validated['avatar'] = '';
            }
        }

        $newUser = User::create([
            'avatar' => $validated['avatar'],
            'last_name' => $validated['lastName'],
            'first_name' => $validated['firstName'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'telephone' => $validated['tel'],
            'sexe' => $validated['selectedSexe'],
            'role' => $validated['selectedRole'],
        ]);

        Log::info('Fonctionne mailpit pitier: ' . $newUser->email);


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
                <div
                    class="border-t-2 border-t-main-blue pt-5 flex flex-col justify-between lg:grid lg:grid-cols-12 lg:items-center lg:gap-x-16">
                    <div class="lg:col-span-4 flex flex-col gap-2 w-full relative">
                        <input wire:model="avatar" type="file" id="avatar" class="absolute inset-0 hidden"
                               name="avatar">
                        <label for="avatar" class="cursor-pointer flex flex-col gap-2 items-center">
                            <img
                                @if($this->avatar)
                                    src="{!! $this->avatar->temporaryUrl() !!}"

                                @else {
                                src="{{asset('icons/file.svg')}}"
                                }
                                @endif
                                alt="" class="img-type-file">

                            @if($this->avatar)
                                {{--
                                <button href="#"
                                        wire:click.prevent="delete_img()"
                                        x-data="{hover : false}"
                                        @mouseenter="hover = true"
                                        @mouseleave="hover = false"
                                        class="bg-red-600 cursor-pointer absolute -top-[14px] -right-[14px] border-2 border-red-600 hover:bg-white duration-300 hover:duration-300 p-1 rounded-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                                         x-bind:fill="hover ? '#E7000B' : 'white'"
                                         viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                              d="M5.293 5.293a1 1 0 0 1 1.414 0L12 10.586l5.293-5.293a1 1 0 1 1 1.414 1.414L13.414 12l5.293 5.293a1 1 0 0 1-1.414 1.414L12 13.414l-5.293 5.293a1 1 0 0 1-1.414-1.414L10.586 12 5.293 6.707a1 1 0 0 1 0-1.414Z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </button>
                                --}}

                            @endif
                            @if($this->avatar === null)
                                <span class="text-xl font-poppins">
                                Importer une image
                            </span>
                            @endif


                        </label>
                        <span
                            class="font-poppins text-red-600 font-semibold">@error('avatar') {{ $message }} @enderror
                    </span>
                    </div>
                    <div class="flex flex-col gap-6 lg:col-span-8">
                        <div class="flex flex-col gap-6 sm:flex-row sm:justify-between">
                            <x-forms.input :required="true" wire:model.blur="firstName" class="w-full"
                                           :type="'text'"
                                           :name="'volunteer-first-name'"
                                           :label="'Nom'"
                                           :placeholder="'Doe'">
                                <span
                                    class="font-poppins text-red-600 font-semibold">@error('firstName') {{ $message }} @enderror
                                </span>
                            </x-forms.input>

                            <x-forms.input :required="true" wire:model.blur="lastName" class="w-full" :type="'text'"
                                           :name="'volunteer-last-name'"
                                           :label="'Prénom'"
                                           :placeholder="'John'">
                                <span
                                    class="font-poppins text-red-600 font-semibold">@error('lastName') {{ $message }} @enderror
                                </span>
                            </x-forms.input>

                        </div>
                        <div class="flex flex-col gap-6 sm:flex-row sm:justify-between">
                            <x-forms.select :required="true" wire:model.blur="selectedSexe" :name="'volunteer-sexe'"
                                            :label="'Sexe'"
                                            :options="SexeVolunteer::cases()"
                                            :disabled="'--Sélectionner un sexe--'">
                                    <span
                                        class="font-poppins text-red-600 font-semibold">@error('selectedSexe') {{ $message }} @enderror
                                </span>
                            </x-forms.select>
                            <x-forms.select wire:model.blur="selectedRole" :name="'volunteer-role'" :label="'Role'"
                                            :options="RoleVolunteer::cases()"
                                            :disabled="'--Selectionner un rôle--'">
                                    <span
                                        class="font-poppins text-red-600 font-semibold">@error('selectedRole') {{ $message }} @enderror
                                    </span>
                            </x-forms.select>
                        </div>
                        <div class="flex flex-col gap-6 sm:flex-row sm:justify-between">
                            <x-forms.input :required="true" wire:model.blur="email" class="w-full" :type="'email'"
                                           :name="'volunteer-email'"
                                           :label="'Email'"
                                           :placeholder="'john.doe@gmail.com'">
                                <span
                                    class="font-poppins text-red-600 font-semibold">@error('email') {{ $message }} @enderror
                                </span>
                            </x-forms.input>
                            <x-forms.input wire:model.blur="tel" class="w-full" :type="'tel'"
                                           :name="'volunteer-telephone'"
                                           :label="'Téléphone'"
                                           :placeholder="'+32 6 12 34 56 78'">
                                <span
                                    class="font-poppins text-red-600 font-semibold">@error('tel') {{ $message }} @enderror
                                </span>
                            </x-forms.input>
                        </div>
                        <div class="flex flex-col gap-6 sm:flex-row sm:justify-between">
                            <x-forms.input :required="true" wire:model.blur="password" class="w-full"
                                           :type="'password'"
                                           :name="'volunteer-password'"
                                           :label="'Mot de passe'" :placeholder="'**********'">
                                <span
                                    class="font-poppins text-red-600 font-semibold">@error('password') {{ $message }} @enderror
                                </span>
                            </x-forms.input>
                            <x-forms.input :required="true" wire:model.blur="password_confirmation" class="w-full"
                                           :type="'password'"
                                           :name="'volunteer-confirm-password'"
                                           :label="'Confirmer le mot de passe'" :placeholder="'**********'">
                                <span
                                    class="font-poppins text-red-600 font-semibold">@error('password_confirmation') {{ $message }} @enderror
                                </span>
                            </x-forms.input>
                        </div>
                    </div>
                </div>

            </fieldset>
            <x-forms.submit>
                Créer la fiche
            </x-forms.submit>
        </form>
    </x-admin.section>

</div>
