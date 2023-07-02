<?php

namespace Modules\Reserve\Http\Livewire\Pages\Front;

use Livewire\Component;
use Modules\Option\Entities\Option;
use Modules\Setting\Entities\Setting;

class ReservePage extends Component
{
    public $data;
    public $place;
    public $options = [];

    public $price;
    public $options_price = 0;

    public function AddNewOption(Option $option)
    {
        array_push($this->options, $option->id);
        $this->options_price += $option->amount;

        $final_price = ($this->price * $this->data['guest_count']) + $this->options_price;
        $this->dispatchBrowserEvent('reserveOptionsUpdated', ['price' => $final_price, 'options_price' => $this->options_price]);
    }

    public function RemoveOption(Option $option)
    {
        if (array_search($option->id, $this->options) !== false) {
            $key = array_search($option->id, $this->options);
            $this->options[$key] = null;
        }
        $this->options_price -= $option->amount;

        $final_price = ($this->price * $this->data['guest_count']) + $this->options_price;
        $this->dispatchBrowserEvent('reserveOptionsUpdated', ['price' => $final_price, 'options_price' => $this->options_price]);
    }

    public function mount()
    {
        $this->price = Setting::getPriceFromSettings();
    }

    public function render()
    {
        return view('reserve::livewire.pages.front.reserve-page');
    }
}
