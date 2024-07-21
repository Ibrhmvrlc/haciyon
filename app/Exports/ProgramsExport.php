<?php

namespace App\Exports;

use App\Models\Pompacilar;
use App\Models\Program;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProgramsExport implements FromView, ShouldAutoSize, WithStyles
{
    protected $tarih;

    public function __construct($tarih)
    {
        $this->tarih = $tarih;
    }

    public function view(): View
    {
        $baslangic_saati = $this->tarih . ' 00:00:00';
        $bitis_saati = $this->tarih . ' 23:59:59';

        $pompacilar = Pompacilar::all();
        $events = Program::whereBetween('baslangic_saati', [$baslangic_saati, $bitis_saati])->get();
        // Programs tablosundan pompacı_id'si 0 olan ve dokum_sekli 'MİKSERLİ' olanları çek
        $mikserliler = Program::whereBetween('baslangic_saati', [$baslangic_saati, $bitis_saati])
        ->where('pompaci_id', 0)->where('dokum_sekli', 'MİKSERLİ')->get();
        // Programs tablosundan pompacı_id'si 0 olan ve dokum_sekli 'MİKSERLİ' olanları çek
        $santralaltilar = Program::whereBetween('baslangic_saati', [$baslangic_saati, $bitis_saati])
        ->where('pompaci_id', 0)->where('dokum_sekli', 'SANTRAL ALTI')->get();

        $data = [];
        foreach ($pompacilar as $pompaci) {
            $pompaciEvents = $events->where('pompaci_id', $pompaci->id);
            if ($pompaciEvents->isNotEmpty()) {
                $data[] = [
                    'pompaci' => $pompaci,
                    'events' => $pompaciEvents,
                    'event_count' => $pompaciEvents->count(),
                ];
            }
        }

        return view('example_export', compact('data', 'mikserliler', 'santralaltilar'));
    }

    public function styles(Worksheet $sheet)
    {
        
        $startRow = 1; // Başlıklar ilk satırda
        $endRow = 15; // Veri satırları
        $startColumn = 'A';
        $endColumn = 'C'; // Bu aralığı view'deki tabloya göre ayarlayın

        // Son sütunu dinamik olarak belirleyin
        $endColumn = $sheet->getHighestColumn();

        // Son satırı dinamik olarak belirleyin
        $endRow = $sheet->getHighestRow();

        // Verinin olduğu hücre aralığını tanımlayın
        $cellRange = $startColumn . $startRow . ':' . $endColumn . $endRow;

        // Tüm hücrelerin sınırlarını ayarlayın
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ];

        $sheet->getStyle($cellRange)->applyFromArray($styleArray);

        // Alternatif olarak, belirli hücrelere sınır eklemek isterseniz:
        // $sheet->getStyle('A1:C1')->applyFromArray($styleArray);

        return [
            // Başka stil ayarları varsa burada yapabilirsiniz
        ];
    }
}
