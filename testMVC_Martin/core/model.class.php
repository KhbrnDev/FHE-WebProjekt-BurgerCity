<?php

/**
 * @author Kristof Friess <kristof.friess@fh-erfurt.de>
 * @copyright Since 2018 by Kristof Friess
 * @version 1.0.0
 */


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

    protected $schema = [];

    protected $data = []; 



    /**
     * Static Mehtods 
     *      tablename() 
     *      find($where)    -- find somethings (more than 1 if exists) with '$where' clause
     *      findOne($where) -- find something  (only 1 if exists) with '$where' clause
     */

    public static function tablename()
    {
        $class = get_called_class();
        if(defined($class.'::TABLENAME'))
        {
            return $class::TABLENAME;
        }
        return null;
    }

    public static function find($where = '')
    {

        try
        {
            $sql = ' SELECT * FROM ' . self::tablename();
            if(!empty($where))
            {
                $sql .= 'WHERE ' . $where . ';';
            }

            $resultArray = $GLOBALS['db']->query($sql)->fetchAll();
        }
        catch (\PDOException $e)
        {
            die('Select satement failed: ' . $e->getMessage());
        }

        if(!empty($resultArray))
        {
            return $resultArray;
        }

        return null;

    }

    public static function findOne($where = '')
    {

        try
        {
            $sql = ' SELECT * FROM ' . get_called_class()::TABLENAME;
            if(!empty($where))
            {
                $sql .= ' WHERE ' . $where . ';';
            }

            $resultArray = $GLOBALS['db']->query($sql)->fetchAll();
            
        }
        catch(\PDOException $e)
        {
            die('Select statement fauled: ' . $e->getMessage());
        }

        if(!empty($resultArray[0]))
        {
            return $resultArray[0];
        }
        
        return null;

    }


    /**
     * Magic Methods for handling Object 
     *      construct
     *      destruct
     *      set 1 Value
     *      get 1 Value
     */

    public function __construct($params)
    {
        foreach($this->schema as $key => $value)
        {
            if(isset($params[$key]))
            {
                $this->{$key} = $params[$key];
            }
            else
            {
                $this->{$key} = null;
            }
        }
    }
    
    public function __destruct()
    {
        $this->schema = null;
        $this->data = null;
    }
    
    public function __set($key, $value)
    {
        // id, createdAt and updatedAt is only set by database
        if(array_key_exists($key, $this->schema) /* && $key !== 'id' && $key !== 'createdAt' && $key !== 'updatedAt' */)
        {
            $this->data[$key] = $value;
            return;
        }
        
        throw new \Exception('You can not write to property "' . $key . '" for the class ' . get_called_class());
    }
    
    public function __get($key)
    {
        if (array_key_exists($key, $this->data))
        {
            return $this->data[$key];
        }
        
        throw new \Exception('You can not access to property "' . $key . '"" for the class "' . get_called_class());
    }
 
    /**
     * Database Methods to handle Model sepcific Database calls
     *      destroy -- destroy/ deleting element from database table
     *      save (insert, update) -- no editing of id, createdAt and updatedAt
     *          insert -- create new database entry
     *          update -- updating existing database entry
     * 
     */

    public function save(&$errors = null)
    {
        if($this->id === null)
        {
            $this->insert($errors);
        }
        else
        {
            $this->update($errors);
        }
    }
    
    protected function insert(&$errors)
    {
        $db = $GLOBALS['db'];
        
        try
        {
            $sql = 'INSERT INTO ' . self::tablename() . ' (';
            $valueString = ' VALUES (';
            
            foreach ($this->schema as $key => $schemaOptions)
            {
                if($key !== 'id' && $key !== 'createdAt' && $key !== 'updatedAt')
                {
                    $sql .= '`'.$key.'` ,';
                    
                    if($this->data[$key] === null)
                    {
                        $valueString .= 'NULL,';
                    }
                    else
                    {
                        $valueString .= $db->quote($this->data[$key]).',';
                    }
                }
            }
            
            $sql = trim($sql, ',');
            $valueString = trim($valueString, ',');
            $sql .= ')'. $valueString .');';
            
            $statement = $db->prepare($sql);
            $statement->execute();
            
            return true;
        }
        catch (\PDOException $e)
        {
            $errors[] = 'Error inserting ' . get_called_class();
        }
        return false;
    }

    protected function update(&$errors)
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


    /**
     * Variable Validation
     *      validate -- validates all Variables of a Model by calling validateValue
     *      validateValue -- validating 1 Value by checking $schemaOptions for compatibility
     */

    public function validate(&$errors = [])
    {
        foreach($this->schema as $key => $schemaOptions)
        {
            if(isset($this->data[$key]) && is_array($schemaOptions))
            {
                $valueErrors = $this->validateValue($key, $this->data[$key], $schemaOptions);

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
        }

        return count($errors) > 0 ? $errors : true ; 
    }

}  