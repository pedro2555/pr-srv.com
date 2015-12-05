<?php

class GnuCashPage extends Page {
	public static $db = array(
		'TransactionsCSV' => 'Text'
	);

    public function getCMSFields() {
        $fields = parent::getCMSFields();

        $fields->addFieldToTab('Root.Main', new TextAreaField('TransactionsCSV'), 'Content');

        return $fields;
    }
}

class GnuCashPage_Controller extends Page_Controller {
	public static $allowed_actions = array(
		'getTableTransactions'	
	);

	public function getTableTransactions() {

		$runningBalance = 0.0;
		$amount = 0.0;

		$return = '<table class="table table-condensed table-hover">';
      	$return .= '<tr><th>Data</th><th>Descrição</th><th>Conta</th><th>Valor</th><th>Saldo</th></tr>';



		$arr = explode("\n", $this->TransactionsCSV);
		foreach ($arr as &$line) {
			$line = str_getcsv($line);

			if ($line[7] == 'T') {
				$amount = (float)(str_replace(',', '.', str_replace('.', '', $line[12])));
				$runningBalance += $amount;
				$return .= '<tr><td>'.$line[0].'</td><td>'.$line[3].'</td><td>'.$line[6].'</td><td>'.number_format($amount, 2).'</td><td>'.number_format($runningBalance, 2).'</td></tr>';
			}
		}


      	$return .= '</table>';

      	return $return;
	}
}