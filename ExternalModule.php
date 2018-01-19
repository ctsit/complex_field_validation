<?php
/**
 * @file
 * Provides ExternalModule class for Complex Field Validation.
 */

namespace ComplexFieldValidation\ExternalModule;

use ExternalModules\AbstractExternalModule;
use ExternalModules\ExternalModules;
use Form;

/**
 * ExternalModule class for Complex Field Validation.
 */
class ExternalModule extends AbstractExternalModule {

    /**
     * @inheritdoc
     */
    function redcap_data_entry_form_top($project_id, $record, $instrument, $event_id, $group_id) {
        $this->includeJs('js/checkRanges.js');

        global $Proj;

        $action_tag_name = "@EXTRA-VALID-RANGES";

        foreach (array_keys($Proj->forms[$_GET['page']]['fields']) as $field_name) {
            $field_info = $Proj->metadata[$field_name];

            
            if (!$display_mode = Form::getValueInActionTag($field_info['misc'], $action_tag_name)) {
                continue;
            }

            // Split the action value into an array of arrays
            $field_tag_values = explode(",", $display_mode);
            for($i = 0; $i < sizeof($field_tag_values); $i++){
                $field_tag_values[$i] = explode("-", $field_tag_values[$i]);
            }

            print_r($field_name);
            $this->sendVarToJS('complex_field_validation_tag_values', $field_tag_values);
        }
    }

    /**
     * @inheritdoc
     */
    function redcap_every_page_top($project_id) {
        if (PAGE == 'Design/online_designer.php' && $project_id) {
            // Add action tag
            $this->includeJs('js/addTagToOnlineDesignerActionTagList.js');
        }
    }


    /**
     * Includes a local JS file.
     *
     * @param string $path
     *   The relative path to the js file.
     */
    protected function includeJs($path) {
        echo '<script src="' . $this->getUrl($path) . '"></script>';
    }


    /**
     * Sends a PHP variable over to JS.
     *
     * @param string $name
     *   Variable name
     * @param var $value
     *   Variable value
     */
    protected function sendVarToJS($name, $value) {
        echo '<script>var '. $name .' = ' . json_encode($value) . ';</script>';
    }
}
