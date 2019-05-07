<?php

namespace App\Http\Controllers;

use App\House;
use Illuminate\Http\Request;

class HouseController extends Controller
{
    public function index(Request $request, HousesFilter $filters)
    {
        $houses = House::filter($filters)->get();
        return response()->json($houses->toArray());
    }

    public function importHouse(Request $request)
    {
        $this->validate($request, [
            'file' => 'required'
        ]);
        $file = $request->file('file');
        $csv = file_get_contents($file);
        $rows = array_map("str_getcsv", explode("\n", $csv));
        $header = array_shift($rows);
        foreach ($rows as $row) {
            $row = array_combine($header, $row);
            House::create([
                'name' => $row['Name'],
                'price' => $row['Price'],
                'bedrooms' => $row['Bedrooms'],
                'bathrooms' => $row['Bathrooms'],
                'storeys' => $row['Storeys'],
                'garages' => $row['Garages']
            ]);
        }
        return redirect()->back()->with('successfully', 'Файл успешно импортирован');
    }
}
