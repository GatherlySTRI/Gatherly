<?php
namespace models;

class BaseEntity { // NE PAS METTRE D'ATTRIBUT PROTECTED, CETTE VISIBILITE EST RESERVE AUX CLASSES FILLES
    private $data = [];

    public function get_class_name(){
        $classNameParts = explode('\\', static::class);
        return end($classNameParts);
    }

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
        
        $className = $this->get_class_name();
        $sql = "INSERT INTO $className ($fieldList) VALUES ($placeholderList)";
    
        $stmt = $db->prepare($sql);
        $stmt->execute($values);
    }

    public function find($db, $id) {
        $className = $this->get_class_name();
        $id_name = $this->get_primary_key_name();

        $sql = "SELECT * FROM $className WHERE $id_name = :id";
    
        $stmt = $db->prepare($sql);
        $stmt->execute([':id' => $id]);
    
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
    
        if ($result) {
            foreach ($result as $key => $value) {
                if (property_exists($this, $key)) {
                    $this->{$key} = $value;
                }
            }
        }
    
        return $this;
    }

    protected function getData() {
        $reflectionClass = new \ReflectionClass($this);
        $properties = $reflectionClass->getProperties(\ReflectionProperty::IS_PROTECTED);

        foreach ($properties as $property) {
            $property->setAccessible(true);
            $this->data[$property->getName()] = $property->getValue($this);
        }

        return $this->data;
    }

    protected function get_primary_key_name() {
        $reflectionClass = new \ReflectionClass($this);
        $properties = $reflectionClass->getProperties(\ReflectionProperty::IS_PROTECTED);

        $firstProperty = $properties[0];
        // $firstProperty->setAccessible(true);
        // $this->data[$firstProperty->getName()] = $firstProperty->getValue($this);
        
        return $firstProperty->getName();
    }

}
?>