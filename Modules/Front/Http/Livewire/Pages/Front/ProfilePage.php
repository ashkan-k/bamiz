<?php

namespace Modules\Front\Http\Livewire\Pages\Front;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Dashboard\Http\Requests\ProfileRequest;
use Modules\Reserve\Entities\Reserve;

class ProfilePage extends Component
{
    use WithPagination;

    public $titlePage = '';
    public $pagination;
    public $search = '';
    public $data;
    public $status;
    protected $items;

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

        $data['avatar'] = $this->avatar ? $this->UploadRealTime($this->avatar , 'avatars', $this->username) : $this->item->avatar;
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

    private function get_data_from_instance()
    {
        $this->user = auth()->user();
        $this->first_name = $this->item->first_name;
        $this->last_name = $this->item->last_name;
        $this->username = $this->item->username;
        $this->email = $this->item->email;
        $this->phone = $this->item->phone;
    }

    public function mount()
    {
        $this->status = request('status');
        $this->pagination = env('PAGINATION', 10);

        $this->get_data_from_instance();
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['search', 'pagination']))
        {
            $this->resetPage();
        }
    }

    public function cancel(Reserve $reserve)
    {
        $reserve->delete();
    }

    private function Filter()
    {
        $this->items = $this->status != null ? $this->items->where(['status' => $this->status]) : $this->items;
        return $this->items;
    }

    public function render()
    {
        $this->items = auth()->user()->reserves()->latest();
        $this->items = $this->Filter();
        return view('front::livewire.pages.front.profile-page', ['items' => $this->items->paginate($this->pagination)]);
    }
}
