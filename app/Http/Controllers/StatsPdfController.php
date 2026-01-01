<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class StatsPdfController extends Controller
{
    public function monthly_stats()
    {
        $pdf = Pdf::loadView('pdf.monthly-stats');
        return $pdf->download('statistiques-mois.pdf');
    }
}
