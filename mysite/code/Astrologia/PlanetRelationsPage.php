<?php

class PlanetRelationsPage extends Page {
	private static $has_many = array(
		'PlanetRelations' => 'PlanetRelationsObject'
	);

	public function getCMSFields() {
        // Get the fields from the parent implementation
        $fields = parent::getCMSFields();    
        // Create a default configuration for the new GridField, allowing record editing
        $config = GridFieldConfig_RelationEditor::create();
        // Set the names and data for our gridfield columns
        $config->getComponentByType('GridFieldDataColumns')->setDisplayFields(array(
            'PlanetObject.Name'=> 'Name'
        ));    
        // Create a gridfield to hold the student relationship    
        $PlanetsField = new GridField(
            'Planets', // Field name
            'PlanetObject', // Field title
            DataObject::get('Planets'), // List of all related students
            $config
        );        
        // Create a tab named "Students" and add our field to it
        $fields->addFieldToTab('Root.Planets', $PlanetsField);
        return $fields;
    }
}

class PlanetRelationsPage_Controller extends Page_Controller {

}