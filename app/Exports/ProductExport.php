<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Product;
use App\Models\Categories;

class ProductExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Product::join('categories as c','cat_id','=','c.id')
        ->select('products.*','c.name as category_name')->orderBy('id','DESC')->get();
        

         
    }
}
