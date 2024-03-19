<?php

namespace App\Exports;

use App\Offer;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class OffersExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return Collection
    */
    public function collection()
    {
        return Offer::all();
    }

    /**
     * @return string[]
     */
    public function headings(): array
    {
        return [
            'ID',
            'Title',
            'User',
            'Category',
            'Area',
            'Description',
            'Status',
            'Anonymous',
            'District',
            'Created at'
        ];
    }

    /**
     * @param mixed $offer
     * @return array
     */
    public function map($offer): array
    {
        return [
            $offer->id,
            $offer->title,
            $offer->user->name,
            $offer->category->title,
            $offer->area,
            $offer->description,
            ($offer->status == 0) ? 'Deactive' : 'Active',
            ($offer->anonymous == 0) ? 'Xeyr' : 'Bəli',
            $offer->district->title,
            $offer->created_at
        ];
    }
}
