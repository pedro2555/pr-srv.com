<?php

class GnuCashPage extends Page {
	public static $db = array(
		'TransactionsCSV' => 'Text'
	);

	public static $has_many = array(
		'Transactions' => 'GnuCashTransactionObject'
	);

    public function getCMSFields() {
        $fields = parent::getCMSFields();

        $fields->addFieldToTab('Root.Main', new TextAreaField('TransactionsCSV'), 'Content');
        $fields->addFieldToTab('Root.Transactions', new GridField('Transactions', 'Transactions', GnuCashTransactionObject::get()));

        return $fields;
    }

	function onAfterWrite() {
		parent::onAfterWrite();
	}
}

class GnuCashPage_Controller extends Page_Controller {

	public static $allowed_actions = array(
		'recalc'
	);

	public function recalc() {

		// delete all GnuCashTransactionObject DataObjects
		$GnuCashTransactions = GnuCashTransactionObject::get();
		foreach ($GnuCashTransactions as $GnuCashTransaction) {
			$GnuCashTransaction->delete();
		}
		// reset all account page balances
		foreach (GnuCashAccountPage::get()->filter(array('ParentID' => $this->ID)) as $Account) {
			$Account->Balance = 0.0;
			$Account->write();
		}

		// calculate running balances and create transaction DataObjects
		$runningBalances = array();
		$index = 0;
		foreach (explode("\n", $this->TransactionsCSV) as &$line) {
			$line = str_getcsv($line);

			// filter out splits from transaction lines
			if ($line[7] == 'T') {
				$GnuCashTransaction = GnuCashTransactionObject::create();
				$GnuCashTransaction->Page = $this->ID;
				$GnuCashTransaction->Index = $index++;

				$GnuCashTransaction->Date = $line[0];
				$GnuCashTransaction->Description = $line[3];
				$GnuCashTransaction->SourceAccount = $line[1];
				$GnuCashTransaction->DestinationAccount = $line[6];
				//
				// Parse decimal and thousands separators
				//
				// Remove commas (,)
				$line[12] = str_replace(',', '', $line[12]);
				$GnuCashTransaction->Amount = $line[12];

				if (!array_key_exists($GnuCashTransaction->SourceAccount, $runningBalances)) {
					$runningBalances[$GnuCashTransaction->SourceAccount] = 0.0;
				}
				$runningBalances[$GnuCashTransaction->SourceAccount] += $GnuCashTransaction->Amount;
				$GnuCashTransaction->Balance = $runningBalances[$GnuCashTransaction->SourceAccount];

				$GnuCashTransaction->write();
			}
		}

		foreach ($runningBalances as $accountName => $balance) {
			$account = GnuCashAccountPage::get()->filter(array(
				'Title' => $accountName,
				'ParentID' => $this->ID
			));

			foreach ($account as $a) {
				$a->Balance = $balance;
				$a->write();
			}
		}

		$this::redirectBack();
	}
} 