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

    protected $schema = [
    ];

    private $values = [
    ];

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
            $className = get_called_class();
            throw new \Exception(`${key} does not exists in this class ${className}`);
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

    public function save()
    {
        // TODO: choose between insert and update
        if(isset($this->schema[$this->values['email']])){
            $this->update();
        }
        else{
            $this->insert();
        }
    }

    public function insert()
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
            $this->id = $db->lastInsertId();
        }
        catch(\PDOException $e)
        {
            print_r($e);
        }
    }

    public function update()
    {
        // TODO: Implement update
    }

    public function destroy()
    {
        // TODO: Implement destroy / delete
    }
}