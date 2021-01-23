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
        // uncomment for debugging
        // echo "<pre>";
        // print_r($results);
        // echo "</pre>";
        
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

    public function save(&$errors = null)
    {
        if($this->values[array_key_first($this->schema)] === null)
        {
            $this->insert($errors);
        }
        else
        {
            $this->update($errors);
        }
    }

    public function insert(&$errors = [])
    {
        // // TODO: Implement insert
         $db = $GLOBALS['db'];
        // $tableName = self::tablename();
        // $sqlStr = "INSERT INTO `${tableName}` (";
        // $valuesStr = "(";
        // foreach($this->schema as $key => $value)
        // {
        //     $sqlStr.=$key.',';
        //     $valuesStr.=':'.$key.',';
        // }

        // $sqlStr = rtrim($sqlStr, ',');
        // $valuesStr = rtrim($valuesStr, ',');

        // $sqlStr = $sqlStr.') VALUES '.$valuesStr.');';

        $sqlStr = 'INSERT INTO ' . self::tablename() . ' (';
            $valueString = ' VALUES (';
            
            foreach ($this->schema as $key => $schemaOptions)
            {
                if($key !== array_key_first($this->schema) && $key !== 'createdAt' && $key !== 'updatedAt')
                {
                    $sqlStr .= '`'.$key.'` ,';
                    
                    if($this->values[$key] === null)
                    {
                        $valueString .= 'NULL,';
                    }
                    else
                    {
                        $valueString .= $db->quote($this->values[$key]).',';
                    }
                }
            }

            $sqlStr = trim($sqlStr, ',');
            $valueString = trim($valueString, ',');
            $sqlStr .= ')'. $valueString .');';

        try
        {
            $stmt=$db->prepare($sqlStr);
            $stmt->execute($this->values);
            $id = array_key_first($this->schema);
            $this->$id = $db->lastInsertId();
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
                if($this->values[$key] !== null && $key !== array_key_first($this->schema) && $key !== 'createdAt' && $key !== 'updatedAt')
                {
                    $sql .= $key . ' = ' . $db->quote($this->values[$key]).',';
                }
            }

            $sql = trim($sql, ',');
            $sql .= ' WHERE '.array_key_first($this->schema).' = ' . $this->values[array_key_first($this->schema)];

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
            $sql = 'DELETE FROM ' . self::tablename() . ' WHERE '.  array_key_first($this->schema).' = ' . $this->values[array_key_first($this->schema)];
            $db->exec($sql);
            return true;
        }
        catch (\PDDOException $e)
        {
            $errors[] = 'Error deleting ' . get_called_class();
        }
        return false;
    }

    /**
     * Variable Validation
     *      validate -- validates all Variables of a Model by calling validateValue
     *      validateValue -- validating 1 Value by checking $schemaOptions for compatibility
     */

    public function validate(&$errors = [])
    {
        foreach($this->schema as $key => $schemaOptions)
        {
            if(isset($this->values[$key]) && is_array($schemaOptions))
            {
                $valueErrors = $this->validateValue($key, $this->values[$key], $schemaOptions);

                if($valueErrors !== true)
                {
                    array_push($errors, ...$valueErrors);
                }
            }
        }

        if(count($errors) === 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }


    protected function validateValue($attribute, &$value, &$schemaOptions)
    {

        $type = $schemaOptions['type'];
        $errors = [];

        switch ($type)
        {
            case Model::TYPE_INTEGER:
                break;
            case Model::TYPE_UINTEGER:
                break;
            case Model::TYPE_STRING:
            {
                if(isset($schemaOptions['min']) && mb_strlen($value) < $schemaOptions['min'])   
                {
                    $errors [] = $attribute.': String needs min. '.$schemaOptions['min'].' chatacters!';
                }     

                if(isset($schemaOptions['max']) && mb_strlen($value) > $schemaOptions['max'])
                {
                    $errors [] = $attribute.': String can have max. '.$schemaOptions['max'].' characters!';
                }
                break;
            }
            
            case Model::TYPE_JSON:
                break;
            case Model::TYPE_DECIMAL:
                break;
            case Model::TYPE_DATE:
                break;
            case Model::TYPE_BOOLEAN:
                break;
        }

        return count($errors) > 0 ? $errors : true ; 
    }
}