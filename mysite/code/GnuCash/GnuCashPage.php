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

	public function getTableTransactions($accountName) {
		// Final associative transactions array
		$arrTransactions = array();

		// Parse CSV data into a PHP array in ascending chronologic order
		$arr = explode("\n", $this->TransactionsCSV);

		// Calculate running balances
		$index = 0;
		$runningBalance = 0.0;
		foreach ($arr as &$line) {
			$line = str_getcsv($line);

			if ($line[7] == 'T' && $line[1] == $accountName) {

				$arrTransactions[$index]['Data'] = $line[0];
				$arrTransactions[$index]['Descricao'] = $line[3];
				$arrTransactions[$index]['Conta'] = $line[6];
				$arrTransactions[$index]['Valor'] = (float)(str_replace(',', '.', str_replace('.', '', $line[12])));

				$runningBalance += $arrTransactions[$index]['Valor'];
				$arrTransactions[$index]['Saldo'] = $runningBalance;

				$index++;
			}
		}

		// invert array to descending chronologic order
		$arrTransactions = array_reverse($arrTransactions);


		$return = '<table class="table table-condensed table-hover table-striped">';
      	$return .= '<tr><th>Data</th><th>Descrição</th><th>Conta</th><th>Valor</th><th>Saldo</th></tr>';



		$arr = explode("\n", $this->TransactionsCSV);



		foreach ($arrTransactions as &$line) {
			if (number_format($line['Saldo'], 2) == "0.00")
				$return .= '<tr class="success"><td>'.$line['Data'].'</td><td>'.$line['Descricao'].'</td><td>'.$line['Conta'].'</td><td>'.number_format($line['Valor'], 2).' Kz</td><td>'.number_format($line['Saldo'], 2).' Kz</td></tr>';
			else
				$return .= '<tr><td>'.$line['Data'].'</td><td>'.$line['Descricao'].'</td><td>'.$line['Conta'].'</td><td>'.number_format($line['Valor'], 2).' Kz</td><td>'.number_format($line['Saldo'], 2).' Kz</td></tr>';
		}


      	$return .= '</table>';

      	$return .= '<h4><strong>';
      	$return .= ($runningBalance >= 0) ? 'Total em dívida: '.number_format($runningBalance, 2).' Kz' : 'Total em crédito: '.number_format(abs($runningBalance), 2).' Kz';
      	$return .= '</strong></h4>';

      	return $return;
	}
} 