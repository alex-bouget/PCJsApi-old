<?php

namespace PCJs\Core\Entry;

class EntryLoader
{
    /**
     * @var array<Components> $components
     */
    private array $components = array();

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->components = array();
        $all_classes = classes_in_namespace('PCJs\Components');
        foreach ($all_classes as $class) {
            $comp = new Components(new \ReflectionClass('PCJs\Components\\' . $class));
            if (!in_array('PCJs\Core\ComponentType\EntryComponentInterface', $comp->get_class()->getInterfaceNames())) {
                throw new \Exception("The class " . $comp->get_class()->getName() . " must implement the interface LoadedEntityInterface");
            }
            $this->components[$comp->get_name()] = $comp;
        }
    }

    /**
     * Get the components
     * 
     * @return array<Components>
     */
    public function get_components(): array
    {
        return $this->components;
    }

    /**
     * Get a component
     * 
     * @param string $name
     * 
     * @return Components|false
     */
    public function get_component($name): Components|false
    {
        if (!isset($this->components[$name])) {
            return false;
        }
        return $this->components[$name];
    }

    /**
     * Get an entry
     * 
     * @param string $name
     * 
     * @return Entry|false
     */
    public function get_entry($name): Entry|false
    {
        $components_name = explode('.', $name)[0];
        $entry_name = explode('.', $name)[1];
        if (!isset($this->components[$components_name])) {
            return false;
        }
        return $this->components[$components_name]->get_entry($entry_name);
    }
}
