<?php

namespace App\Imports;

use App\Models\Musteri;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow; // Başlık satırını atlamak için

class MusteriImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Musteri([
            'name'     => $row[0],
            'email'    => $row[1], 
            'password' => $row[1],
        ]);
    }
}
