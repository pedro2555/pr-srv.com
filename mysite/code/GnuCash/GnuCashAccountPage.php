<?php

class GnuCashAccountPage extends Page {

}

class GnuCashAccountPage_Controller extends Page_Controller {
	public function Transactions() {
		$GnuCashTransactions = GnuCashTransactionObject::get()->filter(array(
			'SourceAccount' = $this->Title
		))->sort('Date');
	}
}