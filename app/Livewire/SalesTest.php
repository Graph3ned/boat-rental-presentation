<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\prices;
class SalesTest extends Component
{

    public $prices = [];
    public $showModal = false;
    public $modalDetails;
    public $rideToDelete;
    public function mount(){
        $this->prices=prices::all();
    }
    public function confirmDelete($ride_type)
    {
        $this->rideToDelete = $ride_type;
        $this->modalDetails = "Are you sure you want to delete ride? You will also delete all of it's classification";
        $this->showModal = true;
    }
    public function closeModal()
    {
        $this->showModal = false;
    }
    public function deleteRide()
    {
        // Delete all prices with the same ride_type
        prices::where('ride_type', $this->rideToDelete)->delete();

        // Flash a success message
        // session()->flash('message', 'All records for ride type ' . $ride_type . ' have been deleted.');

        // Reload the page to reflect the changes
        return redirect()->route('AdminDashboard');
    }
    public function render()
    {
        return view('livewire.sales-test');
    }
}
