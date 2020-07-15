<?php

namespace App\Imports\NoticiaContravencionalImport;

use App\Models\NoticiaContravencional as ModelsNoticiaContravencional;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class NoticiaContravencionalImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            ModelsNoticiaContravencional::create(

            );
        }
    }
}
