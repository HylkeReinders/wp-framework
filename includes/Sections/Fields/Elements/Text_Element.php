<?php

namespace CoffeePlugins\BolWpPlugin\Sections\Fields\Elements;

use CoffeePlugins\BolWpPlugin\Options\Options;

if (!defined('ABSPATH')) {
    exit;
}

class Text_Element extends Element implements Settings_Element_Interface
{

    /**
     * Render the element.
     */
    public function render()
    {
?>

        <fieldset>
            <label>
                <input 
                    type="text" 
                    name="<?php echo esc_attr($this->name); ?>" 
                    id="<?php echo esc_attr($this->name); ?>" 
                    value="<?php echo esc_attr($this->value); ?>" />
                <?php echo esc_html($this->label); ?>
            </label>
        </fieldset>

<?php
    }

    /**
     * Sanitize the given option value.
     *
     * @param string $option_value
     *
     * @return string
     */
    public function sanitize($option_value)
    {
        return strval($option_value);
    }
}
