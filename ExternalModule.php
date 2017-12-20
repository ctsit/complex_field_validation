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
    function redcap_data_entry_form_top($project_id, $record = null, $instrument, $event_id, $group_id = null) {
        if (empty($record)) {
            return;
        }
    }
}
