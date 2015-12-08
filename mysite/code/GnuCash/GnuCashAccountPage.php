<?php

class GnuCashAccountPage extends Page {
	static $db = array(
		'CurrencySymbol' => 'Varchar(10)',
		'Balance' => 'Decimal'
	);

    public function getCMSFields() {
        $fields = parent::getCMSFields();

        $fields->addFieldToTab('Root.Main', new TextField('CurrencySymbol'), 'Content');
        $fields->addFieldToTab('Root.Main', new CurrencyField('Balance'), 'Content');

        return $fields;
    }
}

class GnuCashAccountPage_Controller extends Page_Controller {

	public function Transactions() {
		$GnuCashTransactions = GnuCashTransactionObject::get()->filter(array(
			'SourceAccount' => $this->Title
		))->sort('Index', 'DESC');

		$transactions = new ArrayList();

		foreach ($GnuCashTransactions as $GnuCashTransaction) {
			$transactions->add(new ArrayData([
				'Date' => $GnuCashTransaction->Date,
				'Description' => $GnuCashTransaction->Description,
				'DestinationAccount' => $GnuCashTransaction->DestinationAccount,
				'Amount' => $GnuCashTransaction->Amount,
				'AmountNice' => number_format($GnuCashTransaction->Amount, 2).' '.$this->CurrencySymbol,
				'Balance' => $GnuCashTransaction->Balance,
				'BalanceNice' => number_format($GnuCashTransaction->Balance, 2).' '.$this->CurrencySymbol
			]));
		}

		return $transactions;
	}

}