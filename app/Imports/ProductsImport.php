<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToModel, WithHeadingRow
{
    /**
     * Map each row of the Excel file to a Product model.
     * Ensure only valid attributes are passed to the Product model.
     */
    public function model(array $row)
    {
        return new Product([
            'name' => $row['name'] ?? null,
            'category_id' => $row['category_id'] ?? null,
            'cost_price' => $row['cost_price'] ?? null,
            'price' => $row['price'] ?? null,
            'stock_quantity' => $row['stock_quantity'] ?? null,
            'discount' => $row['discount'] ?? null,
            'discount_start' => $row['discount_start'] ?? null,
            'discount_end' => $row['discount_end'] ?? null,
            'barcode' => $row['barcode'] ?? null,
        ]);
    }

    /**
     * Define the heading row for the import.
     */
    public function headingRow(): int
    {
        return 1;
    }
}
