<?php



namespace dwp\core;

abstract class Model
{
    // useful types for schema
    const TYPE_STRING   = 'string';
    const TYPE_INTEGER  = 'int';
    const TYPE_UINTEGER = 'uint';
    const TYPE_DECIMAL  = 'dec';
    const TYPE_DATE     = 'date';
    const TYPE_JSON     = 'json';
    const TYPE_BOOLEAN  = 'boolean';

    protected $schema = [];

    private $values = [];

    
    public static function tablename()
    {
        $class = get_called_class();
        if(defined($class.'::TABLENAME'))
        {
            return $class::TABLENAME;
        }
        return null;
    }

    public static function find($whereStr = '1')
    {
        $db = $GLOBALS['db'];
        $sqlStr = 'SELECT * FROM `'.self::tablename().'` WHERE '.$whereStr.';';
        $results = [];
        try
        {
            $results = $db->query($sqlStr)->fetchAll();
            $count = count($results);
            for ($i=0; $i < $count; ++$i)
            { 
                $class = get_called_class();
                $results[$i] = new $class($results[$i]);
            }
        }
        catch(\PDOException $error)
        {
            print_r($error);
        }

        return $results;
    }


    public static function findOne($whereStr = '1')
    {
        $results = self::find($whereStr);

        if(count($results) > 0)
        {
            return $results[0];
        }

        return null;
    }


    public function __construct($values)
    {
        try
        {
            foreach($this->schema as $key => $value)
            {
                if(isset($values[$key]))
                {
                    $this->$key = $values[$key];
                }
                else
                {
                    $this->$key = null;
                }
            }
            
        }
        catch(\Exception $error)
        {
            print_r($error);
            exit(1);
        }
    }

    public function __set($key, $value)
    {
        //TODO catch exception directly in class.?
        if(isset($this->schema[$key]))
        {
            $this->values[$key] = $value;
        }
        else
        {
            $className = get_called_class();
            throw new \Exception(`${key} does not exists in this class ${className}`);
        }
    }

    public function __get($key)
    {
        // TODO: Check is the key in the schema?
        //       If so return the value in values if not exists return default value from schema or null
        if(isset($this->schema[$key]))
        {
            return $this->values[$key];
        }
        else
        {
            return null; 
        }
    }

    public function __destruct()
    {
        // TODO: Free memory here
        try
        {
            foreach($this->schema as $key => $value)
            {
                
                $this->$key = null;
                unset($key);
                
            }
            
        }
        catch(\Exception $error)
        {
            print_r($error);
            exit(1);
        }
    }

    public function save(&$errors = [])
    {
        // TODO: choose between insert and update
        if(isset($this->schema[$this->values['email']])){
            $this->update();
        }
        else{
            $this->insert($errors);
        }
    }

    public function insert(&$errors = [])
    {
        // TODO: Implement insert
        $db = $GLOBALS['db'];
        $tableName = self::tablename();
        $sqlStr = "INSERT INTO `${tableName}` (";
        $valuesStr = "(";
        foreach($this->schema as $key => $value)
        {
            $sqlStr.=$key.',';
            $valuesStr.=':'.$key.',';
        }

        $sqlStr = rtrim($sqlStr, ',');
        $valuesStr = rtrim($valuesStr, ',');

        $sqlStr = $sqlStr.') VALUES '.$valuesStr.');';

        try
        {
            $stmt=$db->prepare($sqlStr);
            $stmt->execute($this->values);
            //Diese Zeile schemist Fehler in __set() 
            //$this->id = $db->lastInsertId();
        }
        catch(\PDOException $e)
        {
            $errors [] = $e;
        }
    }

    public function update(&$errors)
    {
        $db = $GLOBALS['db'];

        try
        {
            $sql = 'UPDATE ' . self::tablename() . ' SET ';

            foreach ($this->schema as $key => $schemaOptions)
            {
                if($this->data[$key] !== null && $key !== 'id' && $key !== 'createdAt' && $key !== 'updatedAt')
                {
                    $sql .= $key . ' = ' . $db->quote($this->data[$key]).',';
                }
            }

            $sql = trim($sql, ',');
            $sql .= ' WHERE id = ' . $this->data['id'];

            $statement = $db->prepare($sql);
            $statement->execute();

            return true;
        }
        catch(\PDOException $e)
        {
            $errors [] = 'Error updating ' . get_called_class();
        }
        return false;
    }

    public function destroy(&$errors = null)
    {
        $db = $GLOBALS['db'];

        try
        {
            $sql = 'DELETE FROM ' . self::tablename() . ' WHERE id = ' . $this->id;
            $db->exec($sql);
            return true;
        }
        catch (\PDDOException $e)
        {
            $errors[] = 'Error deleting ' . get_called_class();
        }
        return false;
    }
}