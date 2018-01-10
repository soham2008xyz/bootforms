<?php namespace AdamWathan\BootForms\Elements;

use AdamWathan\Form\Elements\Text;

/**
 * Class InputGroup
 * @package AdamWathan\BootForms\Elements
 */
class InputGroup extends Text
{
    /**
     * @var array
     */
    protected $beforeAddon = [];

    /**
     * @var array
     */
    protected $afterAddon = [];

    /**
     * @var array
     */
    protected $classAddon = [];

    /**
     * @var string
     */
    protected $addonID;

    /**
     * @param $addon
     * @return $this
     */
    public function beforeAddon($addon)
    {
        $this->beforeAddon[] = $addon;

        return $this;
    }

    /**
     * @param $addon
     * @return $this
     */
    public function afterAddon($addon)
    {
        $this->afterAddon[] = $addon;

        return $this;
    }

    /**
     * @param $class
     * @return $this
     */
    public function addAddonClass($class)
    {
        $this->classAddon[] = $class;

        return $this;
    }

    /**
     * @param $id
     * @return $this
     */
    public function addAddonId($id)
    {
        $this->addonID = $id;

        return $this;
    }

    /**
     * @param $type
     * @return $this
     */
    public function type($type)
    {
        $this->attributes['type'] = $type;
        return $this;
    }

    /**
     * @param array $addons
     * @return string
     */
    protected function renderAddons($addons)
    {
        $html = '';

        foreach ($addons as $addon) {
            $html .= sprintf('<span %sclass="input-group-addon%s">%s</span>', $this->renderAddonsId(), $this->renderAddonsClass(), $addon);
        }

        return $html;
    }

    /**
     * @return string
     */
    protected function renderAddonsId()
    {
        if($this->addonID) {
            return sprintf('id="%s"' . ' ', $this->addonID);
        }
    }

    /**
     * @return string
     */
    protected function renderAddonsClass()
    {
        $html = '';

        foreach($this->classAddon as $class) {
            $html .= ' ' . $class;
        }

        return $html;
    }

    /**
     * @return string
     */
    public function render()
    {
        $html = '<div class="input-group">';
        $html .= $this->renderAddons($this->beforeAddon);
        $html .= parent::render();
        $html .= $this->renderAddons($this->afterAddon);
        $html .= '</div>';

        return $html;
    }
}
