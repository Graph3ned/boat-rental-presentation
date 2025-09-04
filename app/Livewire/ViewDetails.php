<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\prices;

class ViewDetails extends Component
{
    public $id;
    public $ride_type;
    public $prices = [];
    public $classificationShowModal = false;
    public $classificationModalDetails;
    public $classificationToDelete;
    public $alertMessage = null; 
    public $showModal = false;
    public $modalDetails;
    public $rideToDelete;
    
    public function classificationConfirmDelete($id)
    {
        $this->classificationToDelete = $id;
        $this->classificationModalDetails = "Are you sure you want to delete this classification?";
        $this->classificationShowModal = true;
    }

    public function classificationCloseModal()
    {
        $this->classificationShowModal = false;
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
    public function delete()
    {
        // Delete all prices with the same ride_type
        prices::where('ride_type', $this->rideToDelete)->delete();

        // Reload the page to reflect the changes
        return redirect()->route('AdminDashboard');
    }
    public function mount($ride_type)
    {
        $this->ride_type = $ride_type;

        // Fetch all prices for the given ride type (instead of just one)
        $this->prices = prices::where('ride_type', $this->ride_type)->get(); // get() will fetch multiple rows

        // If no prices are found, redirect
        
    }

    public function render()
    {
        return view('livewire.view-details'); // This will render your Livewire view
    }

    public function deleteClassification()
{
    // Assuming 'classificationToDelete' holds the ID of the classification to be deleted
    prices::where('id', $this->classificationToDelete)->delete();

    // After deleting, close the modal and refresh the page (or navigate back)
    $this->classificationShowModal = false;

    // Refresh prices list to reflect the deleted record
    $this->prices = prices::where('ride_type', $this->ride_type)->get();

    // You can redirect or just refresh
    // return redirect()->route('priceClassification', ['ride_type' => $this->ride_type]);
}
}
