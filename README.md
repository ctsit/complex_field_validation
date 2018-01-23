# REDCap Complex Field Validation

A REDCap Module that allows for the addition of valid options outside of the min-max range for a REDCap form field with number validation.


## Prerequisites
- [REDCap Modules](https://github.com/vanderbilt/redcap-external-modules)

## Installation
- Clone this repo into to `<redcap-root>/modules/complex_field_validation_v<version_number>`.
- Go to **Control Center > Manage External Modules** and enable Complex Field Validation.
- For each project you want to use this module, go to the project home page, click on **Manage External Modules** link, and then enable Complex Field Validation for that project.


## How to use
Once the module is activated on a project, you may include values outside the predefined min-max range either by 
1. adding a `<span>` tag with class `valid` on the *Field Note*, or by
2. adding the action tag `@EXTRA-VALID-RANGES` on the *Action Tags / Field Annotation*. 

For example, if the question were something like "In which month was the subject born?," simply use the 1-12 range and decorate additional valid options either in the 'Field Note' like this:

    1-12, or <span class="valid">88</span> if unknown.
    
or in the 'Action Tags / Field Annotation':

    @EXTRA-VALID-RANGES = "88"

You may include as many additional values as you need. As an illustration, the configuration below will allow the user to add the new valid values 88, 95, 96, and 97, although none of these values are in the preestablished range of 1-12.

    1-12, or (<span class="valid">88</span>,<span class="valid">95</span>, <span class="valid">96</span>, <span class="valid">97</span>)
    
To use the action tag instead (or in addition), you can include the following in the 'Action Tags / Field Annotation' field

    @EXTRA-VALID-RANGES = "88,95-97"

Notice that you can combine ranges and fixed values as such `@EXTRA-VALID-RANGES = "88,95-97,13,15-17,24"`.

These two ways of including values outside the predefined min-max range can be used simultaneously. 