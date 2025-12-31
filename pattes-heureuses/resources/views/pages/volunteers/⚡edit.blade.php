<?php

use App\Enums\RoleVolunteer;
use App\Enums\SexeVolunteer;
use App\Jobs\ProcessUploadedImageJob;
use Illuminate\Validation\Rule;
use Livewire\Component;
use App\Models\User;
use Livewire\WithFileUploads;

new class extends Component {

    use WithFileUploads;

    public User $user;

    public $new_avatar = null;
    public $avatar;
    public string $selectedSexe = '';
    public string $selectedRole = '';
    public string $lastName = '';
    public string $firstName = '';
    public string $tel = '';
    public string $email = '';


    public function mount($id)
    {

        $this->user = User::findOrFail($id);
        $this->authorize('update', $this->user);
        $this->avatar = $this->user->avatar;
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
            'new_avatar' => 'nullable|image|max:2048|mimes:jpg,jpeg,png,webp',
            'email' => ['required', Rule::unique('users')->ignore($this->user->id)],
            'selectedSexe' => ['required', Rule::enum(SexeVolunteer::class)],
            'selectedRole' => ['required', Rule::enum(RoleVolunteer::class)],
            'tel' => 'regex:/^\+?[0-9 ]{10,15}$/'

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
        $validated = $this->validate();
        $avatarPath = $this->user->avatar;
        if (!empty($validated['new_avatar'])) {
            $avatarPath = uniqid() . '.' . config('animalavatars.image_type');
            $fullPath = Storage::putFileAs(
                config('animalavatars.original_path'),
                $validated['new_avatar'],
                $avatarPath
            );
            if ($fullPath) {
                ProcessUploadedImageJob::dispatchSync($fullPath, $avatarPath);
            }
        }

        $this->user->update([
            'last_name' => $validated['lastName'],
            'first_name' => $validated['firstName'],
            'avatar' => $avatarPath,
            'email' => $validated['email'],
            'sexe' => $validated['selectedSexe'],
            'role' => $validated['selectedRole'],
            'telephone' => $validated['tel'],
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
                <div
                    class="border-t-2 border-t-main-blue pt-5 flex flex-col justify-between lg:grid lg:grid-cols-12 lg:items-center lg:gap-x-16">
                    <div class="lg:col-span-4 flex flex-col gap-2 w-full relative">
                        <input wire:model="new_avatar" type="file" id="avatar" class="absolute inset-0 hidden"
                               name="avatar">
                        <label for="avatar" class="cursor-pointer flex flex-col gap-2 items-center">
                            @if($this->new_avatar)
                                <img src="{!! $this->new_avatar->temporaryUrl() !!}" alt="Photo de"
                                     class="img-type-file">
                            @else
                                @if(str_starts_with($this->avatar, 'public/img/personnel/'))
                                <img src="{{asset(str_replace('public/', '', $this->avatar))}}" alt=""
                                     class="img-type-file">
                                @else
                                    <img src="{{asset('upload_img/animals/originals/' . $this->avatar)}}" alt=""
                                         class="img-type-file">
                                @endif
                            @endif
                            @if($this->new_avatar)
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
                            @endif

                        </label>
                        <span
                            class="font-poppins text-red-600 font-semibold">@error('avatar') {{ $message }} @enderror
                        </span>
                    </div>
                    <div class="flex flex-col gap-6 lg:col-span-8">
                        <div class="flex flex-col gap-6 sm:flex-row sm:justify-between">
                            <x-forms.input :required="true" wire:model.blur="firstName" class="w-full" :type="'text'"
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
                            <x-forms.select wire:model.blur="selectedSexe"
                                            :name="'volunteer-sexe'" :label="'Sexe'"
                                            :options="SexeVolunteer::cases()" :disabled="'--Sélectionner un sexe--'">
                            <span
                                class="font-poppins text-red-600 font-semibold">@error('selectedSexe') {{ $message }} @enderror
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
