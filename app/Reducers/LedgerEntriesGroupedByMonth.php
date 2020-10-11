<?php


namespace App\Reducers;


use App\Repositories\Models\LedgerEntry;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class LedgerEntriesGroupedByMonth
{
    /**
     * @param Collection|LedgerEntry[] $ledgerEntries
     * @return Collection
     */
    public static function reduce(Collection $ledgerEntries)
    {
        $modified         = collect();
        $uniqueMonthDates = $ledgerEntries
            ->sortBy('entryDate')
            ->map(fn(LedgerEntry $entry) => $entry->entryDate()->format('Y-m-01'))
            ->unique();

        foreach ($uniqueMonthDates as $startDate) {
            $startDateCarbon = Carbon::parse($startDate);
            $endDateCarbon   = $startDateCarbon->clone()->endOfMonth();

            $entriesFiltered = $ledgerEntries->filter( fn(LedgerEntry $entry) => $entry->entryDate()->betweenIncluded($startDateCarbon, $endDateCarbon) );
            $modified->add([
                "startDate"     => $startDateCarbon->format('Y-m-d'),
                "endDate"       => $endDateCarbon->format('Y-m-d'),
                "ledgerEntries" => $entriesFiltered->values()
            ]);
        }

        return $modified;
    }
}
