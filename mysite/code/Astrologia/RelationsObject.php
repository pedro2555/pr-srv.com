<?php

class RelationsObject extends DataObject {
	private static $db = array(
		'Description' => 'varchar(50)',
		'SinglePlanetRelation' => 'boolean'
	);
}