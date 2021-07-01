<?php

namespace App\Imports;

use App\Models\Products;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $collection){
        // dd($collection->toArray());

        foreach($collection->toArray() as $row){

            $product = new Products;
            $product->brand = $row['brand'];
            $product->model = $row['model'];
            $product->year = $row['year'];
            $product->vin_vds = $row['vin'];
            $product->catalog_code = $row['catalog_code'];
            $product->frame_no = $row['frame_no'];
            $product->partno = $row['partno'];
            $product->price = $row['price'];
            $product->quantity = $row['quantity'];
            $product->description = $row['description'];
            $product->image = $row['image'];
            $product->save();
        }
    }
}
