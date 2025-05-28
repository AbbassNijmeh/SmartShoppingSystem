<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromCollection, WithHeadings
{
    /**
     * Return a collection of products to be exported.
     */
    public function collection()
    {
        return Product::all();
    }

    /**
     * Define the headings for the exported file.
     */
    public function headings(): array
    {
        return array_keys(Product::first()->toArray());
    }
}
