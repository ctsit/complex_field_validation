<?php
/**
 * @file
 * Provides ExternalModule class for Complex Field Validation.
 */

namespace ComplexFieldValidation\ExternalModule;

use ExternalModules\AbstractExternalModule;
use ExternalModules\ExternalModules;

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
     * Includes a local JS file.
     *
     * @param string $path
     *   The relative path to the js file.
     */
    protected function includeJs($path) {
        echo '<script src="' . $this->getUrl($path) . '"></script>';
    }
}
