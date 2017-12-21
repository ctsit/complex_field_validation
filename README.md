# REDCap Complex Field Validation
Allows for the addition of valid options outside of the min-max range for a REDCap form field.

## Prerequisites
- [REDCap Modules](https://github.com/vanderbilt/redcap-external-modules)

## Installation
- Clone this repo into to `<redcap-root>/modules/complex_field_validation_v<version_number>`.
- Go to **Control Center > Manage External Modules** and enable Complex Field Validation.
- For each project you want to use this module, go to the project home page, click on **Manage External Modules** link, and then enable Complex Field Validation for that project.


## How to use
Once the module is activated on a project, you may include values outside the predefined min-max range by adding `<span>` tag with class `valid` on the *Field Note*.

For example, if the question were something like "In which month was the subject born?" The field note could read "1-12, or 88 if unknown." Simply use the 1-12 range and decorate additional valid options in the Note like this:

    1-12, or <span class="valid">88</span> if unknown.

You may include as many additional values as you need. As an illustration, the configuration below will allow the user to enter either 95 or 96 although both values are not in the preestablished range of 1-12.

	1-12, or (<span class="valid">95</span> if unknown, <span class="valid">96</span> if prefer not to answer)