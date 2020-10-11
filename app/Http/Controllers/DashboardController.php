<?php

namespace App\Http\Controllers;

use App\Reducers\LedgerEntriesGroupedByMonth;
use App\Repositories\IMoneyRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * @var IMoneyRepository
     */
    private IMoneyRepository $moneyRepository;

    /**
     * DashboardController constructor.
     * @param IMoneyRepository $moneyRepository
     */
    public function __construct(IMoneyRepository $moneyRepository)
    {
        $this->moneyRepository = $moneyRepository;
    }

    public function __invoke(Request $request)
    {
        $ledgerEntries = $this->moneyRepository->getLedgerEntriesForAccount( 1 );

        return Inertia::render('Dashboard/Index', [
            'ledgerEntriesGroupedByMonth' => LedgerEntriesGroupedByMonth::reduce( $ledgerEntries )
        ]);
    }
}
