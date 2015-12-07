<?php

class GnuCashTransactionObject extends DataObject {
	static $db = array(
		'Index' => 'Int',
		'Date' => 'Date',
		'Description' => 'Text',
		'SourceAccount' => 'Text',
		'DestinationAccount' => 'Text',
		'Amount' => 'Currency',
		'Balance' => 'Currency'
	);

	static $has_one = array(
		'Page' => 'GnuCashPage'
	);
}