<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\Client;
use App\Models\MClient;


// Assuming the primary key column is named "id" in the "clients" table

// Update "email_address" where id = 1





Route::get('/check-database-connection', function () {
    
    // Attempt to get the connection object
    $connection = DB::connection();

    // Check if the connection is active
    if ($connection->getPdo()) {

        $count = 2;

        while($count <=360){
            $client = Client::where('id', $count)->first(); 
            if ($client) {
                $accountNumber = $client->account_no;
               if(MClient::where('id', $count)->update([
                'email_address' => $accountNumber,
            ])){
                    echo "Completed: ".$count;
                }
                else{
                    echo "Not yet!!!";
                }
            }

            $count +=1;
        }
    



    } else {
        return "Database not connected!";
    }
});


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
