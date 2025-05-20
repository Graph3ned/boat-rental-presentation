<?php
namespace App\Livewire;

use App\Models\rides_rental_db;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class Sales extends Component
{
    use WithPagination;

    public $totalPrice = 0;
    public $showModal = false;
    public $modalDetails;
    public $rideToDelete;
    public $paginate = 10;
    public $selectedUser = '';
    public $selectedRideType = '';
    public $classification = '';
    public $start_date = ''; // Added property for start date
    public $end_date = ''; // Added property for end date
    public $load = [];

    public function mount()
    {
        $this->load = rides_rental_db::all();
    }

    public function confirmDelete($rideId)
    {
        $this->rideToDelete = $rideId;
        $this->modalDetails = "Are you sure you want to delete this ride?";
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function deleteRide()
    {
        rides_rental_db::find($this->rideToDelete)->delete();
        $this->rideToDelete = null;
        $this->showModal = false;
        $this->totalPrice = rides_rental_db::sum('totalPrice');
    }

    public function updatedSelectedRideType($value)
    {
        if ($value === '') {
            $this->classification = '';
        }
    }

    public function resetFilter()
    {
        $this->selectedUser = '';
        $this->selectedRideType = '';
        $this->classification = '';
        $this->paginate = 10;
        $this->start_date = '';
        $this->end_date = '';
    }

    public function render()
    {
        // Apply filters to fetch the rides without pagination for total price calculation
        $filteredRidesQuery = rides_rental_db::query()
            ->when($this->selectedUser, fn($query) => $query->where('user', $this->selectedUser))
            ->when($this->selectedRideType, fn($query) => $query->where('rideType', $this->selectedRideType))
            ->when($this->classification, fn($query) => $query->where('classification', $this->classification))
            ->when($this->start_date && $this->end_date, function ($query) {
                $query->whereDate('created_at','>=', $this->start_date)
                ->whereDate('created_at','<=', $this->end_date);
            })
            ->orderBy('created_at', 'desc'); // Orders by the created_at column in descending order

        // Calculate the total price based on the filtered rides
        $this->totalPrice = $filteredRidesQuery->sum('totalPrice');

        // Fetch the rides with pagination (for display purposes)
        $rides = $filteredRidesQuery->paginate($this->paginate);

        // Fetch the distinct values for filtering
        $users = rides_rental_db::distinct()->pluck('user');
        $rideTypes = rides_rental_db::when($this->selectedUser, fn($query) => $query->where('user', $this->selectedUser))
            ->distinct()->pluck('rideType');
        $classifications = rides_rental_db::query()
            ->when($this->selectedUser !== '', fn($query) => $query->where('user', $this->selectedUser))
            ->when($this->selectedRideType !== '', fn($query) => $query->where('rideType', $this->selectedRideType))
            ->distinct()->pluck('classification');

        return view('livewire.sales', [
            'rides' => $rides,
            'users' => $users,
            'rideTypes' => $rideTypes,
            'classifications' => $classifications,
        ]);
    }
}
