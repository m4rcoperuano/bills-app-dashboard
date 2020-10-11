<?php


namespace App\Repositories;


use App\Repositories\Models\LedgerEntry;
use Illuminate\Support\Collection;

interface IMoneyRepository
{
    /**
     * @param $accountId
     * @return Collection|LedgerEntry[]
     */
    public function getLedgerEntriesForAccount( $accountId ): Collection;
}
