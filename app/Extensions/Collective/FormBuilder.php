<?php

namespace App\Extensions\Collective;

use App\Models\Base;
use Illuminate\Support\ViewErrorBag;

class FormBuilder extends \Collective\Html\FormBuilder
{
    /**
     * Extend default form control attributes. Intended for Bootstrap 4 use.
     *
     * @param   array $options
     * @param   string $name
     * @param   string $type
     * @return  array
     */
    protected function extendOptions($options, $name, $type)
    {
        if ( ! array_key_exists('id', $options)) {
            if ( ! in_array($type, ['hidden', 'button']) && ! empty($name)) {
                $options['id'] = 'input-' . str_replace('_', '-', $name);
            }
        }

        if ( ! array_key_exists('class', $options)) {
            if (in_array($type, ['radio', 'checkbox'])) {
                $options['class'] = 'form-check-input';
            } else if (in_array($type, ['button', 'submit'])) {
                $options['class'] = 'btn btn-primary';
            } else if ( ! in_array($type, ['hidden'])) {
                $options['class'] = 'form-control';

                if ( ! empty($name)) {
                    $errors = $this->request->session()->get('errors', new ViewErrorBag);
                    if ( ! $errors instanceof ViewErrorBag) {
                        $errors = new ViewErrorBag;
                    }
                    if ($errors->has($name)) {
                        $options['class'] .= ' is-invalid';
                    }
                }
            }
        }

        if ( ! array_key_exists('maxlength', $options)) {
            if ($type == 'password') {
                $options['maxlength'] = 40;
            } else if (in_array($type, ['text', 'search', 'email', 'tel', 'number', 'url'])) {
                $options['maxlength'] = Base::DEFAULT_STRING_LENGTH;
            }
        }

        return $options;
    }

    // Override
    public function button($value = null, $options = [])
    {
        $options = $this->extendOptions($options, null, 'button');

        return parent::button($value, $options);
    }

    // Override
    public function input($type, $name, $value = null, $options = [])
    {
        $options = $this->extendOptions($options, $name, $type);

        if ($value === null) {
            $value = old($name);
        }

        return parent::input($type, $name, $value, $options);
    }

    // Override
    public function textarea($name, $value = null, $options = [])
    {
        $options = $this->extendOptions($options, $name, 'textarea');

        if ($value === null) {
            $value = old($name);
        }

        return parent::textarea($name, $value, $options);
    }

    // Override
    public function select(
        $name,
        $list = [],
        $selected = null,
        array $selectAttributes = [],
        array $optionsAttributes = []
    ) {
        $selectAttributes = $this->extendOptions($selectAttributes, $name, 'select');

        if ($selected === null) {
            $selected = old($name);
        }

        return parent::select($name, $list, $selected, $selectAttributes, $optionsAttributes);
    }
}