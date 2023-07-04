<?php

namespace Modules\Reserve\Http\Livewire\Pages\Front;

use Livewire\Component;
use Modules\Option\Entities\Option;
use Modules\Reserve\Entities\Reserve;
use Modules\Setting\Entities\Setting;

class ReservePage extends Component
{
    public $data;
    public $place;
    public $reserve;
    public $options = [];

    public $price;
    public $total_price;
    public $options_price = 0;

    private function DispatchOptionEvent()
    {
        $this->reserve->update(['amount' => $this->total_price]);
        $this->dispatchBrowserEvent('reserveOptionsUpdated', ['price' => $this->total_price, 'options_price' => $this->options_price]);
    }

    public function AddNewOption(Option $option)
    {
        array_push($this->options, $option->id);
        $this->options_price += $option->amount;
        $this->total_price += $option->amount;

        $this->DispatchOptionEvent();
    }

    public function RemoveOption(Option $option)
    {
        if (array_search($option->id, $this->options) !== false) {
            $key = array_search($option->id, $this->options);
            $this->options[$key] = null;
        }
        $this->options_price -= $option->amount;
        $this->total_price -= $option->amount;
        $this->dispatchBrowserEvent('reserveOptionsUpdated', ['price' => $this->total_price, 'options_price' => $this->options_price]);
    }

    public function mount()
    {
//        $this->price = Setting::getPriceFromSettings();
//        $this->total_price = $this->price * $this->data['guest_count'];
        $this->total_price = $this->reserve->amount;

        $options = $this->reserve->options()->get();
        if ($options){
            $this->options = $options->pluck('id')->toArray();
            $this->options_price = $options->sum('amount');
            $this->DispatchOptionEvent();
        }
    }

    public function render()
    {
        return view('reserve::livewire.pages.front.reserve-page');
    }
}
