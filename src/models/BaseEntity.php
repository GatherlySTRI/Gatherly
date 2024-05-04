<?php
namespace models;

class BaseEntity { // NE PAS METTRE D'ATTRIBUT PROTECTED, CETTE VISIBILITE EST RESERVE AUX CLASSES FILLES
    private $data = [];

    public function get_db_connector(){// Instanciation du connecteur de la BDD si il n'est pas présent
        $db_host = getenv('DB_HOST') ?: '127.0.0.1';
        $db_port = getenv('DB_PORT') ?: '5432';
        $db_name = getenv('DB_NAME') ?: 'gatherly_db';
        $db_user = getenv('DB_USER') ?: 'postgres';
        $db_password = getenv('DB_PASSWORD') ?: 'postgres';
        $db = new \PDO("pgsql:host=$db_host;port=$db_port;dbname=$db_name", $db_user, $db_password);
        return $db;
    }

    public function get_class_name(){
        $classNameParts = explode('\\', static::class);
        return end($classNameParts);
    }

    public function save($db=null) { // Persistance des objets dans la BDD
        if($db==null){
            $db = $this->get_db_connector();
        }
        
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

        return $db;
    }

    public function find($db, $id) { // Recherche de la ligne correspondant à l'objet dans la BDD
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

    public function find_by_column($db=null, $column_name, $column_value) { // Recherche de la ligne correspondant à l'objet dans la BDD selon la valeur d'une colonne
        if($db==null){
            $db = $this->get_db_connector();
        }

        $className = $this->get_class_name();

        $sql = "SELECT * FROM $className WHERE $column_name = :value";

        $stmt = $db->prepare($sql);
        $stmt->execute(['value' => $column_value]);

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

    protected function getData() { // Récupération des propriétés de la table
        $reflectionClass = new \ReflectionClass($this);
        $properties = $reflectionClass->getProperties(\ReflectionProperty::IS_PROTECTED);

        foreach ($properties as $property) {
            $property->setAccessible(true);
            $this->data[$property->getName()] = $property->getValue($this);
        }

        return $this->data;
    }

    protected function get_primary_key_name() { // Récupère le nom de la clé primaire
        $reflectionClass = new \ReflectionClass($this);
        $properties = $reflectionClass->getProperties(\ReflectionProperty::IS_PROTECTED);

        $firstProperty = $properties[0];
        // $firstProperty->setAccessible(true);
        // $this->data[$firstProperty->getName()] = $firstProperty->getValue($this);
        
        return $firstProperty->getName();
    }

}
?>