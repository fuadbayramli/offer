<?php

namespace App\Http\Controllers\Admin\Voyager;

use App\Exports\OffersExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExcelController extends Controller
{
    /**
     * @return BinaryFileResponse
     */
    public function exportOffer(){
        return Excel::download(new OffersExport, 'offers.xlsx');
    }
}
