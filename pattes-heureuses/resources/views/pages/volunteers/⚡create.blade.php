<?php

use App\Enums\RoleVolunteer;
use App\Enums\SexeVolunteer;
use App\Jobs\ProcessUploadedImageJob;
use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;


new #[Title('Create Post')] class extends Component {


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
    public array $disponibilities = [];
    public array $days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
    public array $time_slots = ['morning' => 'Matin', 'afternoon' => 'Après-midi'];

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
            'tel' => 'regex:/^\+?[0-9 ]{10,15}$/',
            'disponibilities' => 'nullable|array',
            'disponibilities.*.*' => 'boolean',
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
            'tel' => 'numéro de téléphone',
            'disponibilities' => 'disnobilitiés',

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
            'password' => bcrypt($validated['password']),
            'telephone' => $validated['tel'],
            'sexe' => $validated['selectedSexe'],
            'role' => $validated['selectedRole'],
            'disponibilities' => $validated['disponibilities'],
        ]);

        Log::info('Fonctionne mailpit pitier: ' . $newUser->email);


        return redirect()->route('volunteers-show', ['id' => $newUser->id]);


    }
};
?>
<div>
    <x-admin.section :title="'Créer un nouveau profil'">
        <form wire:submit="save_volunteer"
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
            <fieldset class="flex flex-col gap-6">
                <legend>
                    Disponibilités du bénévole
                </legend>
                <table class="w-full">
                    <thead class="bg-gray-100">
                    <tr class="font-poppins font-bold">
                        <th class="p-4 text-left border border-gray-300"></th>
                        @foreach($this->days as $day)
                            <th class="p-4 border border-gray-300">{{$day}}</th>
                        @endforeach
                    </tr>

                    </thead>
                    <tbody>
                    @foreach($this->time_slots as $time_slot => $label)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2 font-semibold bg-gray-50">{{ $label }}</td>
                            @foreach($this->days as $day)
                                <td class="border border-gray-300 text-center transition-colors {{ $disponibilities[$day][$time_slot] ?? false ? 'bg-green-100' : 'bg-red-50' }}">
                                    <label class="flex items-center justify-center gap-2 w-full py-4 cursor-pointer"
                                           for="disponibilities_{{ $day }}_{{ $time_slot }}">
                                        <input type="checkbox"
                                               id="disponibilities_{{ $day }}_{{ $time_slot }}"
                                               wire:model.live="disponibilities.{{ $day }}.{{ $time_slot }}"
                                               class="sr-only">
                                        <span
                                            class="font-semibold {{ $disponibilities[$day][$time_slot] ?? false ? 'text-green-700' : 'text-red-700' }}">
                                            {{ $disponibilities[$day][$time_slot] ?? false ? 'Oui' : 'Non' }}
                                        </span>
                                    </label>
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </fieldset>

            <x-forms.submit>
                Créer la fiche
            </x-forms.submit>
        </form>
    </x-admin.section>

</div>
