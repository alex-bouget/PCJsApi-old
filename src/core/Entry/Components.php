<?php

namespace PCJs\Core\Entry;


class Components implements LoadedEntityInterface
{
    /**
     * @var string $name
     */
    private string $name;

    /**
     * @var array<string, string> $parameters
     */
    private array $parameters;

    /**
     * @var \ReflectionClass $class
     */
    private \ReflectionClass $class;


    /**
     * @var Entry[] $entries
     */
    private array $entries = array();


    public function __construct(\ReflectionClass $class)
    {
        $this->class = $class;
        $this->parameters = get_all_parameters($class);
        $this->name = $this->parameters['Entry'];
        foreach ($class->getMethods() as $method) {
            $entry = new Entry($this->name, $method);
            if ($entry->get_name() === "__") {
                continue;
            } elseif (strpos($entry->get_name(), ".") === false) {
                $this->entries[$entry->get_name()] = $entry;
            } else {
                $this->entries[explode(".", $entry->get_name())[1]] = $entry;
            }
        }
    }

    /**
     * Get the name of the Component
     * 
     * @return string
     */
    public function get_name(): string
    {
        return $this->name;
    }

    /**
     * Get the class of the Component
     * 
     * @return \ReflectionClass
     */
    public function get_class(): \ReflectionClass
    {
        return $this->class;
    }

    /**
     * Get the parameters of the entry
     * 
     * @return array<string, string>
     */
    public function get_parameters(): array
    {
        return $this->parameters;
    }

    /**
     * Get the entries of the Component
     * 
     * @return Entry[]
     */
    public function get_entries(): array
    {
        $entries = array();
        foreach ($this->entries as $entry) {
            if (str_starts_with($entry->get_parameters()["Entry"], "__")) {
                continue;
            }
            $entries[$entry->get_name()] = $entry;
        }
        return $entries;
    }

    /**
     * Get the entry of the Component
     * 
     * @param string $name
     * 
     * @return Entry|false
     */
    public function get_entry(string $name): Entry|false
    {
        if (!isset($this->entries[$name])) {
            return false;
        }
        return $this->entries[$name];
    }
}
