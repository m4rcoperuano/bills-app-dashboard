<?php


namespace App\Repositories\Models;


use Carbon\Carbon;

class LedgerEntry
{
    public int $id;
    public string $name;
    public string $type;
    public int $categoryId;
    public string $categoryName;
    public int $accountId;
    public string $accountName;
    public ?int $recurringLedgerEntryConfigId;
    public ?int $paidByPaymentSourceId;
    public string $amount;
    public string $entryDate;
    public bool $isPaid;
    public ?string $note;
    public string $createdAt;
    public ?int $importId;


    /**
     * LedgerEntry constructor.
     */
    public function __construct($data)
    {
        $this->id                           = $data['id'];
        $this->name                         = $data['name'];
        $this->type                         = $data['type'];
        $this->categoryId                   = $data['category_id'];
        $this->categoryName                 = $data['category_name'];
        $this->accountId                    = $data['account_id'];
        $this->accountName                  = $data['account_name'];
        $this->recurringLedgerEntryConfigId = $data['recurring_ledger_entry_config_id'];
        $this->paidByPaymentSourceId        = $data['paid_by_payment_source_id'];
        $this->amount                       = $data['amount'];
        $this->entryDate                    = $data['entry_date'];
        $this->isPaid                       = $data['is_paid'];
        $this->note                         = $data['note'];
        $this->createdAt                    = $data['created_at'];
        $this->importId                     = $data['import_id'];
    }

    public function entryDate() : Carbon {
        return Carbon::parse($this->entryDate);
    }
}
