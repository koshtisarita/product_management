<?php

namespace App\Exports;



use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Categories;

class CategoryeExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Categories::all();
    }
}
