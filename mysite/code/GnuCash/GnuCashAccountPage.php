<?php

class GnuCashAccountPage extends Page {

}

class GnuCashAccountPage_Controller extends Page_Controller {

	public function Transactions() {
		$GnuCashTransactions = GnuCashTransactionObject::get()->filter(array(
			'SourceAccount' => $this->Title
		))->sort('Date', 'DESC');

		$transactions = new ArrayList();

		foreach ($GnuCashTransactions as $GnuCashTransaction) {
			$transactions->add(new ArrayData([
				'Date' => $GnuCashTransaction->Date,
				'Description' => $GnuCashTransaction->Description,
				'DestinationAccount' => $GnuCashTransaction->DestinationAccount,
				'Amount' => $GnuCashTransaction->Amount,
				'Balance' => $GnuCashTransaction->Balance
			]));
		}

		return $transactions;
	}
}