<?php
namespace models;

class BaseEntity {
    protected $data = [];

    public function save($db) {
        $this->getData();

        $fields = array_keys($this->data);
        $values = array_values($this->data);
    
        if ($values[0] === null) {
            array_shift($fields);
            array_shift($values);
        }

        $fieldList = implode(',', $fields);
        $placeholderList = implode(',', array_fill(0, count($fields), '?'));
        
        $classNameParts = explode('\\', static::class);
        $className = end($classNameParts);
        $sql = "INSERT INTO $className ($fieldList) VALUES ($placeholderList)";
    
        $stmt = $db->prepare($sql);
        $stmt->execute($values);
    }

    protected function getData() {
        $reflectionClass = new \ReflectionClass($this);
        $properties = $reflectionClass->getProperties(\ReflectionProperty::IS_PRIVATE);

        foreach ($properties as $property) {
            $property->setAccessible(true);
            $this->data[$property->getName()] = $property->getValue($this);
        }

        return $this->data;
    }
}
?>