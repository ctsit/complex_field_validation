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
        $this->includeJs('js/complexFieldValidationHelper.js');


    }

    /**
     * @inheritdoc
     */
    function redcap_every_page_top($project_id) {
        if (PAGE == 'Design/online_designer.php' && $project_id) {
            $this->includeJs('js/helper.js');
        }

        if($project_id){

            global $Proj;

            foreach (array_keys($Proj->forms[$_GET['page']]['fields']) as $field_name) {
                $field_info = $Proj->metadata[$field_name];
                
                if (!$display_mode = Form::getValueInActionTag($field_info['misc'], $name)) {
                    continue;
                }

                // contains the values of the action tag @EXTRA-VALID-RANGES separated
                // by commas, so if @EXTRA-VALID-RANGES="10,2-34,5", then $field_tag_value
                // is an array with length 3 and values 10, 2-34, 5.
                $field_tag_value = explode(",", $display_mode);


                //TODO: validate tag values


                foreach($field_tag_value as $current){
                    
                }

                $tag_values[$field_name] = $display_mode;


            }

            //print_r($field_name);
            $action_tag_values = explode(",", $display_mode);

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
     * Returns the assigned value to
     * a given action tag.
     *
     * @param string $path
     *   The action tag name.
     */
    protected function getActionTagValue($name) {
        global $Proj;

        foreach (array_keys($Proj->forms[$_GET['page']]['fields']) as $field_name) {
            $field_info = $Proj->metadata[$field_name];
            
            if ($display_mode = Form::getValueInActionTag($field_info['misc'], $name)) {
                break;
            }
        }

        return $display_mode;
    }
}
