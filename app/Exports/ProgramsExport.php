<?php

namespace App\Exports;

use App\Models\Pompacilar;
use App\Models\Program;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ProgramsExport implements FromView, ShouldAutoSize
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

        return view('example_export', compact('data', 'events'));
    }
}
