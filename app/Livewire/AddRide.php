<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\prices;

class AddRide extends Component
{
    public $ride_type;
    public $classification;
    public $price_per_hour;
    public $rideTypes = []; // To store the list of ride types
    public $isCustomRideType = false;  // To toggle custom ride type input

    protected $rules = [
        'ride_type' => 'required|string',
        'classification' => 'required|string',
        'price_per_hour' => 'required|integer|min:1',
    ];

    public function mount()
    {
        // Fetch ride types from the database
        $this->rideTypes = prices::pluck('ride_type')->unique()->toArray(); // Make sure this is the right model
    }

    public function submit()
    {
        $this->validate();
        
        // Capitalize the first letter of every word
        $this->ride_type = ucwords($this->ride_type);
        $this->classification = ucwords($this->classification);

        // Replace spaces with underscores in both ride_type and classification
        $this->ride_type = str_replace(' ', '_', $this->ride_type);
        $this->classification = str_replace(' ', '_', $this->classification);

        // Save the data to the database
        prices::create([
            'ride_type' => $this->ride_type,
            'classification' => $this->classification,
            'price_per_hour' => $this->price_per_hour,
        ]);

        // Redirect with a success message
        session()->flash('success', 'Ride created successfully!');
        return redirect('admin/prices');
    }

    public function render()
    {
        return view('livewire.add-ride');
    }
}
