<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\prices;
use App\Models\rides_rental_db;
use Carbon\Carbon;

class SalesEdit extends Component
{
    public $rideId;
    public $rideType = '';
    public $classification = '';
    public $life_jacket_usage = 0;
    public $pricePerHour = 0;   
    public $totalPrice = 0;
    public $user;
    public $prices = [];
    public $originalPricePerHour;
    public $note = '';
    public $duration = 60;
    public $date;
    public $timeStart;
    public $timeEnd;

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function mount($rideId)
    {
        $this->prices = prices::all()
            ->groupBy('ride_type')
            ->map(function ($group) {
                return $group->pluck('price_per_hour', 'classification')->toArray();
            })
            ->toArray();

        $this->rideId = $rideId;
        $this->loadRide();
        $this->originalPricePerHour = $this->pricePerHour;
        $this->updatePricePerHour();
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'rideType') {
            $this->classification = array_key_first($this->prices[$this->rideType]) ?? '';
        }

        if (in_array($propertyName, ['rideType', 'classification'])) {
            $this->updatePricePerHour();
        }

        if ($propertyName === 'duration') {
            $this->calculateTotalPrice();
        }
    }

    private function loadRide()
    {
        $ride = rides_rental_db::findOrFail($this->rideId);

        $this->rideType = $ride->rideType;
        $this->classification = $ride->classification;
        $this->life_jacket_usage = $ride->life_jacket_usage;
        $this->pricePerHour = $ride->pricePerHour;
        $this->totalPrice = $ride->totalPrice;
        $this->user = $ride->user;
        $this->note = $ride->note;
        $this->duration = $ride->duration;
        $this->date = Carbon::parse($ride->created_at)->format('Y-m-d');
        $this->timeStart = Carbon::parse($ride->timeStart)->format('H:i');
        $this->timeEnd = Carbon::parse($ride->timeEnd)->format('H:i');
    }

    private function updatePricePerHour()
    {
        if (
            $this->rideType &&
            isset($this->prices[$this->rideType]) &&
            isset($this->prices[$this->rideType][$this->classification])
        ) {
            $this->pricePerHour = $this->prices[$this->rideType][$this->classification];
            $this->calculateTotalPrice();
        } else {
            $this->pricePerHour = 0;
        }
    }

    private function calculateTotalPrice()
    {
        if ($this->pricePerHour > 0 && $this->duration > 0) {
            $this->totalPrice = ($this->pricePerHour / 60) * $this->duration;
        }
    }

    public function updateRides()
    {
        $ride = rides_rental_db::findOrFail($this->rideId);

        $ride->rideType = $this->rideType;
        $ride->classification = $this->classification;
        $ride->life_jacket_usage = $this->life_jacket_usage;
        $ride->pricePerHour = $this->pricePerHour;
        $ride->totalPrice = $this->totalPrice;
        $ride->user = $this->user;
        $ride->note = $this->note;
        $ride->duration = $this->duration;
        
        // Update the created_at date
        $dateTime = Carbon::parse($this->date . ' ' . $this->timeStart);
        $ride->created_at = $dateTime;
        
        // Update timeStart and timeEnd
        $ride->timeStart = $dateTime;
        $ride->timeEnd = Carbon::parse($this->date . ' ' . $this->timeEnd);

        $ride->save();

        $this->dispatch('closeModal');
        $this->dispatch('rideUpdated');
        $this->dispatch('refreshPage');
        
        session()->flash('message', 'Ride updated successfully!');
    }

    public function render()
    {
        return view('livewire.sales-edit');
    }
}
