<?php

namespace Modules\Dashboard\Http\Livewire\Pages;

use App\Http\Traits\Uploader;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithFileUploads;
use Modules\Dashboard\Http\Requests\ProfileRequest;
use Modules\User\Entities\User;

class ProfilePage extends Component
{
    use Uploader;
    use WithFileUploads;

    public $titlePage;
    public $item;

    public $first_name;
    public $last_name;
    public $username;
    public $password;
    public $password_confirmation;
    public $email;
    public $phone;
    public $avatar;

    protected function rules()
    {
        return (new ProfileRequest())->rules();
    }

    public function SubmitProfile()
    {
        $data = $this->validate();

        $data['avatar'] = $this->avatar ? $this->UploadRealTime($this->avatar , 'avatars', $this->phone) : $this->item->avatar;
        $password = $data['password'];
        unset($data['password']);

        $this->item->update($data);
        if ($password){
            $this->item->set_password($password);
            auth()->loginUsingId($this->item->id);
        }

        $this->avatar = null;

        $this->dispatchBrowserEvent('profileStatusUpdated');
    }

    //

    private function get_data_from_instance()
    {
        $this->item = auth()->user();
        $this->first_name = $this->item->first_name;
        $this->last_name = $this->item->last_name;
        $this->username = $this->item->username;
        $this->email = $this->item->email;
        $this->phone = $this->item->phone;
    }

    public function mount()
    {
        $this->get_data_from_instance();
    }

    public function render()
    {
        return view('dashboard::livewire.pages.profile-page');
    }
}
