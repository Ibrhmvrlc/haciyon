<?php

namespace App\Exports;

use App\Models\Program;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProgramsExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // Veritabanından verileri istediğiniz şekilde çekin ve dönüştürün
        return Program::all();
    }

    public function headings(): array
    {
        return [
            'Pompacı ID',
            'Tarih Saat',
            'Müşteri Adı',
            'Beton Cinsi',
            'Döküm Şekli',
            'Şantiye',
            'Metraj',
            'Yapı Elemanı',
        ];
    }

     /**
    * @param Program $event
    */
    public function map($event): array
    {
        return [
            $event->pompaci_id,
            $event->baslangic_saati,
            $event->musteri_adi,
            $event->beton_cinsi,
            $event->dokum_sekli,
            $event->santiye,
            $event->metraj,
            $event->yapi_elemani,
        ];
    }
}
