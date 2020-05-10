<?php

namespace RudyMas\HTML5_extensions;

use RudyMas\HTML5;

/**
 * Class Forms (Version PHP7)
 *
 * This class is an extention of the HTML5 class.
 * You can use this class to create forms.
 *
 * @author Rudy Mas <rudy.mas@rudymas.be>
 * @copyright 2016-2020, rudymas.be. (http://www.rudymas.be/)
 * @license https://opensource.org/licenses/GPL-3.0 GNU General Public License, version 3 (GPL-3.0)
 * @version 1.0.1.0
 * @package RudyMas\HTML5_extensions
 */
class Forms extends HTML5
{
    private $formData = [];
    private $fieldsetData = [];
    private $nrInput = 0;
    private $nrFieldset = 0;

    /**
     * With this function you add Input elements to the form
     *
     * @param string $fieldset Specifies the name of the fieldset the input-tag belongs to
     * @param string $type Specifies the type of the input-tag to display
     * @param string $id Specifies the id of the input-tag (= for by the label)
     * @param string $class Specifies the class of the input-tag
     * @param string|array $attributes Specifies the other attributes for the input-tag
     * @param string $name Specifies the name of the input-tag (= variable)
     * @param string $value Specifies the value of the input-tag
     * @param string $placeholder Specifies a short hint that describes the expected value of the input-tag
     * @param string $labelText Specifies the text to show by the input-tag
     * @param string $labelId Specifies the id of the label-tag
     * @param string $labelClass Specifies the class of the label-tag
     * @param string|array $labelAttributes Specifies the other attributes for the label-tag
     * @param boolean $div Specifies if there has to be a div-tag around the label- and input-tag (TRUE/FALSE)
     * @param string $divId Specifies the id of the div-tag
     * @param string $divClass Specifies the class of the div-tag
     * @param string|array $divAttributes Specifies the other attributes for the div-tag
     *
     * The information is added to the $formData array
     */
    public function addInput($fieldset, $type, $id = '', $class = '', $attributes = '', $name = '', $value = '',
                             $placeholder = '', $labelText = '', $labelId = '', $labelClass = '',
                             $labelAttributes = '', $div = FALSE, $divId = '', $divClass = '', $divAttributes = '')
    {
        $this->formData[$this->nrInput]['fieldset'] = $fieldset;
        $this->formData[$this->nrInput]['type'] = $type;
        $this->formData[$this->nrInput]['id'] = $id;
        $this->formData[$this->nrInput]['class'] = $class;
        $this->formData[$this->nrInput]['attributes'] = $attributes;
        $this->formData[$this->nrInput]['name'] = $name;
        $this->formData[$this->nrInput]['value'] = $value;
        $this->formData[$this->nrInput]['placeholder'] = $placeholder;
        $this->formData[$this->nrInput]['labelText'] = $labelText;
        $this->formData[$this->nrInput]['labelId'] = $labelId;
        $this->formData[$this->nrInput]['labelClass'] = $labelClass;
        $this->formData[$this->nrInput]['labelAttributes'] = $labelAttributes;
        $this->formData[$this->nrInput]['div'] = $div;
        $this->formData[$this->nrInput]['divId'] = $divId;
        $this->formData[$this->nrInput]['divClass'] = $divClass;
        $this->formData[$this->nrInput]['divAttributes'] = $divAttributes;
        $this->nrInput++;
    }

    /**
     * With this function you add a fieldset to your form
     *
     * @param string $name Specifies a name for the fieldset-tag
     * @param string $legend Specifies the text to show for the legend-tag
     * @param string $fieldsetId Specifies the id of the fieldset-tag
     * @param string $fieldsetClass Specifies the class of the fieldset-tag
     * @param string|array $fieldsetAttributes Specifies the other attributes for the fieldset-tag
     * @param string $legendId Specifies the id of the legend-tag
     * @param string $legendClass Specifies the class of the legend-tag
     * @param string|array $legendAttributes Specifies the other attributes for the legend-tag
     *
     * The information is added to the $fieldsetData array
     */
    public function addFieldset($name, $legend, $fieldsetId = '', $fieldsetClass = '', $fieldsetAttributes = '',
                                $legendId = '', $legendClass = '', $legendAttributes = '')
    {
        $this->fieldsetData[$this->nrFieldset]['name'] = $name;
        $this->fieldsetData[$this->nrFieldset]['legend'] = $legend;
        $this->fieldsetData[$this->nrFieldset]['fieldsetId'] = $fieldsetId;
        $this->fieldsetData[$this->nrFieldset]['fieldsetClass'] = $fieldsetClass;
        $this->fieldsetData[$this->nrFieldset]['fieldsetAttributes'] = $fieldsetAttributes;
        $this->fieldsetData[$this->nrFieldset]['legendId'] = $legendId;
        $this->fieldsetData[$this->nrFieldset]['legendClass'] = $legendClass;
        $this->fieldsetData[$this->nrFieldset]['legendAttributes'] = $legendAttributes;
        $this->nrFieldset++;
    }

    /**
     * Use this function to create the form from the configured input and fieldset data
     *
     * @param string $name Specifies the name of a form
     * @param string $action Specifies where to send the form-data when a form is submitted
     * @param string $method Specifies the HTTP method to use when sending form-data (Default = post)
     * @param string $id Specifies the id of the form-tag
     * @param string $class Specifies the class of the form-tag
     * @param string|array $attributes Specifies the other attributes for the form-tag
     * @return string
     */
    public function createForm($name, $action = '', $method = 'post', $id = '', $class = '', $attributes = '')
    {
        $formOutput = '';
        // Processing the input-tags within the fieldsets first
        foreach ($this->fieldsetData as $fieldData) {
            $formOutput .= $this->fieldset('open', $fieldData['fieldsetId'], $fieldData['fieldsetClass'], $fieldData['fieldsetAttributes']);
            if ($fieldData['legend'] != '') $formOutput .= $this->legend('full', $fieldData['legendId'], $fieldData['legendClass'], $fieldData['legendAttributes'], $fieldData['legend']);
            foreach ($this->formData as $field) {
                if ($fieldData['name'] == $field['fieldset']) $formOutput .= $this->processInput($field);
            }
            $formOutput .= $this->fieldset('close');
        }

        // Processing the input-tags without a fieldset (They always come at the end of the form!!!)
        foreach ($this->formData as $field) {
            if ($field['fieldset'] == '') $formOutput .= $this->processInput($field);
        }
        return $this->form('full', $id, $class, $attributes, $action, $method, $name, $formOutput);
    }

    /**
     * This private function is used by 'createForm' to process the configured input data
     *
     * @param array $field The information that has to be processed
     * @return string
     */
    private function processInput($field)
    {
        $output = '';
        if ($field['div'] == TRUE) $output .= $this->div('open', $field['divId'], $field['divClass'], $field['divAttributes']);
        switch (strtolower($field['type'])) {
            case 'a':
                if ($field['name'] != '' || $field['value'] != '') {
                    $url = sprintf('%s?%s', $field['name'], $field['value']);
                }
                $output .= $this->a('full', $field['id'], $field['class'], $field['attributes'], $url, $field['labelText']);
                break;
            case 'br':
                $output .= $this->br('full', $field['id'], $field['class'], $field['attributes']);
                break;
            case 'divopen':
                $output .= $this->div('open', $field['id'], $field['class'], $field['attributes']);
                break;
            case 'divclose':
                $output .= $this->div('close');
                break;
            case 'span':
                $output .= $this->span('full', $field['id'], $field['class'], $field['attributes'], $field['value']);
                break;
            case 'checkbox':
            case 'radio':
                $output .= $this->input('full', $field['id'], $field['class'], $field['attributes'], $field['type'], $field['name'], $field['value']);
                $output .= $this->label('full', $field['labelId'], $field['labelClass'], $field['labelAttributes'], $field['id'], $field['labelText']);
                break;
            case 'select':
                if ($field['labelText'] != '') {
                    $output .= $this->label('full', $field['labelId'], $field['labelClass'], $field['labelAttributes'], $field['id'], $field['labelText']);
                }
                $output .= $this->select('full', $field['id'], $field['class'], $field['attributes'], $field['name'], $field['value']);
                break;
            case 'textarea':
                if ($field['labelText'] != '') {
                    $output .= $this->label('full', $field['labelId'], $field['labelClass'], $field['labelAttributes'], $field['id'], $field['labelText']);
                    $output .= $this->br('full');
                }
                $output .= $this->textarea('full', $field['id'], $field['class'], $field['attributes'], $field['name'], 0, 0, $field['value']);
                break;
            default:
                if ($field['labelText'] != '') {
                    $output .= $this->label('full', $field['labelId'], $field['labelClass'], $field['labelAttributes'], $field['id'], $field['labelText']);
                }
                if ($field['placeholder'] != '') $this->fixInputAttributes($field);
                $output .= $this->input('full', $field['id'], $field['class'], $field['attributes'], $field['type'], $field['name'], $field['value']);
        }
        if ($field['div'] == TRUE) $output .= $this->div('close');
        return $output;
    }

    /**
     * Adds the placeholder to the attributes with string or array detection of attributes
     *
     * @param array $field All the fields for the input creation
     */
    private function fixInputAttributes(&$field)
    {
        if (is_array($field['attributes'])) {
            $field['attributes']['placeholder'] = $field['placeholder'];
        } else {
            $field['attributes'] .= sprintf(' placeholder="%s"', $field['placeholder']);
            $field['attributes'] = trim($field['attributes']);
        }
    }
}
