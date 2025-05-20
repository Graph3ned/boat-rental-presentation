<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\rides_rental_db;
use Carbon\Carbon;

class AdditionalSalesSeeder extends Seeder
{
    public function run()
    {
        $rideTypes = [
            'Clear_Kayak' => [
                'Orange_Rope' => 300,
                'Red_Rope' => 300
            ],
            'Water_Bike' => [
                'Orange' => 200,
                'Green' => 200,
                'Blue' => 200,
                'Red' => 200,
                'Yellow' => 200
            ],
            'Boat' => [
                'Blue' => 300,
                'Pink' => 200,
                'Yellow' => 100
            ],
            'Paddle_Board' => [
                'Blue' => 100,
                'Yellow' => 100,
                'Yellow_Big' => 200,
                'Pink' => 100
            ]
        ];

        $staffNames = ['Edbert', 'Brent', 'Felips', 'Timoy'];
        
        // Generate a more balanced distribution of records
        $totalRecords = 500; // Total number of records to generate
        
        $startDate = Carbon::now()->subYear(); // Start from 1 year ago
        $endDate = Carbon::now(); // Up to now
        
        for ($i = 0; $i < $totalRecords; $i++) {
            // Generate a random date between start and end date
            $randomDate = Carbon::createFromTimestamp(
                rand($startDate->timestamp, $endDate->timestamp)
            );
            
            // Ensure business hours (8 AM to 6 PM)
            $timeStart = $randomDate->copy()->setHour(rand(8, 18))->setMinute(rand(0, 59));
            
            // Random ride type and classification
            $rideType = array_rand($rideTypes);
            $classification = array_rand($rideTypes[$rideType]);
            $pricePerHour = $rideTypes[$rideType][$classification];
            
            // Random duration between 30 minutes to 2 hours
            $duration = rand(30, 120);
            $timeEnd = $timeStart->copy()->addMinutes($duration);
            
            // Calculate total price
            $totalPrice = ($duration / 60) * $pricePerHour;
            
            // Create the record
            rides_rental_db::create([
                'user' => $staffNames[array_rand($staffNames)],
                'rideType' => $rideType,
                'classification' => $classification,
                'duration' => $duration,
                'life_jacket_usage' => rand(0, 5),
                'pricePerHour' => $pricePerHour,
                'totalPrice' => $totalPrice,
                'timeStart' => $timeStart,
                'timeEnd' => $timeEnd,
                'created_at' => $timeStart,
                'updated_at' => $timeStart
            ]);
        }
    }
} 