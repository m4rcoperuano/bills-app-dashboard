<?php


namespace App\Repositories;


use App\Repositories\Models\LedgerEntry;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class MoneyRepository implements IMoneyRepository
{
    public function getLedgerEntriesForAccount( $accountId, Carbon $maxDate = null ): Collection
    {
        if ( !$maxDate ) {
            $maxDate = now()->addMonths(2);
        }
        return DB::connection('mysql_bills')->table('ledger_entries')
            ->where('ledger_entries.account_id', $accountId)
            ->whereNull('ledger_entries.deleted_at')
            ->where('ledger_entries.entry_date', '<=', $maxDate)
            ->join('categories', 'categories.id', '=', 'ledger_entries.category_id')
            ->join('accounts', 'accounts.id', '=', 'ledger_entries.account_id')
            ->select(['ledger_entries.*', 'categories.name as category_name', 'accounts.name as account_name'])
            ->get()
            ->map( fn($item) => new LedgerEntry( (array)$item ) );
    }
}
