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
    public $total_price_without_discount;
    public $options_price = 0;

    public $is_submitted = 0;

    public $gateway = 'zarinpal';
    public $payment_url;

    private function DispatchOptionEvent($option_id = null)
    {
        $this->reserve->update(['amount' => $this->total_price]);

        $task_amount = CalculateTaskAmount($this->total_price);
        $this->dispatchBrowserEvent('reserveOptionsUpdated', ['option_id' => $option_id, 'price' => $this->total_price, 'options_price' => $this->options_price, 'task_amount' => $task_amount]);
    }

    public function AddNewOption($option_id, $price)
    {
        array_push($this->options, $option_id);
        $this->options_price += $price;
        $this->total_price += $price;

        $this->DispatchOptionEvent($option_id);
    }

    public function RemoveOption($option_id, $price)
    {
        if (array_search($option_id, $this->options) !== false) {
            $key = array_search($option_id, $this->options);
            $this->options[$key] = null;
        }
        $this->options_price -= $price;
        $this->total_price -= $price;

        $this->DispatchOptionEvent($option_id);
    }

    public function mount()
    {
        $this->payment_url = route('id-pay.payment', $this->reserve->id);
        $this->total_price = $this->reserve->amount;

        $options = $this->reserve->options()->get();
        if ($options) {
            $this->options = $options->pluck('id')->toArray();
            $this->DispatchOptionEvent();
        }

        $this->total_price_without_discount = intval($this->total_price + $this->place->CalculateDiscountAmount($this->reserve->hotel_room->price));
    }

    public function updated($propertyName)
    {
        if ($propertyName == 'gateway') {
            switch ($this->gateway) {
                case 'id_pay':
                    $this->payment_url = route('id-pay.payment', $this->reserve->id);
                    break;
                default:
                    $this->payment_url = route('zarinpal.payment', $this->reserve->id);
            }
        }
    }

    public function render()
    {
        return view('reserve::livewire.pages.front.reserve-page');
    }
}
