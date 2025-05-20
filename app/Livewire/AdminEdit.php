<?php

namespace App\Livewire;

use App\Models\prices;
use Livewire\Component;

class AdminEdit extends Component
{
    public $price;         // Store the price object
    public $ride_type;     // Store the ride_type that can be edited

    // Mount method to load the price data
    public function mount($ride_type)
    {
        // Find the price record by ride_type and load its values
        $this->price = prices::where('ride_type', $ride_type)->firstOrFail();
        $this->ride_type = $this->price->ride_type;
    }

    // Update only the ride_type field
    public function updatePrice()
    {
        // Validate the ride_type field only
        $this->validate([
            'ride_type' => 'required|string|max:255',
        ]);

        // Capitalize the first letter of the ride type
        $this->ride_type = ucfirst($this->ride_type);

        // Update all records with the same ride_type
        prices::where('ride_type', $this->price->ride_type)->update([
            'ride_type' => $this->ride_type,
        ]);

        // Flash a success message
        session()->flash('message', 'Ride type updated successfully!');

        // Redirect to the admin dashboard (or wherever you need to go)
        return redirect()->route('priceClassification', ['ride_type' => $this->ride_type]);
    }

    // Render the component view
    public function render()
    {
        return view('livewire.admin-edit');
    }
}
