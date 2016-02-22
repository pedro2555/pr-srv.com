<?php

class PlanetRelationsObject extends DataObject {
	private static $has_one = array(
		'Planet1' => 'PlanetObject',
		'Planet2' => 'PlanetObject',
		'Relation' => 'RelationObject'
	);
}