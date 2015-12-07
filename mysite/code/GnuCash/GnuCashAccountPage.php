<?php

class GnuCashAccountPage extends Page {
	static $db = array(
		'CurrencySymbol' => 'Varchar(10)'
	);

    public function getCMSFields() {
        $fields = parent::getCMSFields();

        $fields->addFieldToTab('Root.Main', new TextField('CurrencySymbol'), 'Content');

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
				'Amount' => number_format($GnuCashTransaction->Amount, 2).' '.$this->CurrencySymbol,
				'Balance' => number_format($GnuCashTransaction->Balance, 2).' '.$this->CurrencySymbol
			]));
		}

		return $transactions;
	}

	public function Balance() {
		return number_format(abs(GnuCashTransactionObject::get()->filter(array(
			'SourceAccount' => $this->Title
		))->sort('Index', 'DESC')->first()->Balance), 2).' '.$this->CurrencySymbol;
	}

	public function IsBalanceCredit() {
		$balance = GnuCashTransactionObject::get()->filter(array(
			'SourceAccount' => $this->Title
		))->sort('Index', 'DESC')->first()->Balance;
		if ($balance >= 0) {
			return false;
		}
		return true;
	}

}