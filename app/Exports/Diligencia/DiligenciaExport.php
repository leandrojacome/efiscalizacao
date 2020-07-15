<?php

namespace App\Exports\Diligencia;

use App\Models\Diligencia;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DiligenciaExport implements FromView
{
    /**
     * @inheritDoc
     */
    public function view(): View
    {
        return view('diligencia.export', ['diligencias' => Diligencia::all()]);
    }
}
