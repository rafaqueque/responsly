<?php 

  class DatabaseUtils
  {
    protected $du_user = "root";
    protected $du_database = "responsly_database";
    protected $du_host = "localhost";
    protected $du_password = "root";
    protected $pdo_instance;

    function __construct()
    {
      $this->pdo_instance = new PDO('mysql:dbname='.$this->du_database.';host='.$this->du_host, $this->du_user, $this->du_password);
      $this->pdo_instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);          
    }

    function __destruct()
    {
      $this->pdo_instance = null;
    }

    function insert($table, $data)
    {
      if (is_array($data))
      {
        $this->pdo_instance->beginTransaction();

        $fields_prepared = ":".implode(",:", array_keys($data));
        $fields_unquoted = implode(",", array_keys($data));
        $query_string_parsed = "INSERT INTO ".$table." (".$fields_unquoted.") VALUES (".$fields_prepared.")";

        
        $query = $this->pdo_instance->prepare($query_string_parsed);
        $query->execute($data);

        $id = $this->pdo_instance->lastInsertId();
        
        $this->pdo_instance->commit();

        return $id;
      }
    }


    function update($table, $id, $id_value, $data)
    {
      if (is_array($data))
      {
        $this->pdo_instance->beginTransaction();


        $query_string_parsed = "UPDATE ".$table." SET ";
        
        $num = count($data);
        $count = 0; 
        
        foreach ($data as $field => $value)
        {
          $count++;
          
          $query_string_parsed .= $field." = :".$field."";
          
          if ($count < $num)
          {
            $query_string_parsed .= ",";
          }
        }

        $query_string_parsed .= " WHERE ".$id." = ".$id_value;



        $query = $this->pdo_instance->prepare($query_string_parsed);
        $query->execute($data);
        
        return $this->pdo_instance->commit();
      }
    }


    function delete($table, $id, $id_values=array())
    {

      $this->pdo_instance->beginTransaction();
      
      $query_string_parsed = "DELETE FROM ".$table." WHERE ".$id." = :".$id;

      $query = $this->pdo_instance->prepare($query_string_parsed);

      foreach ($id_values as $value)
      {
        $query->execute(array($id => $value));
      }

      return $this->pdo_instance->commit();
      
    }


    function getRecord($query_string_parsed, $multiple=false)
    {
      $query = $this->pdo_instance->prepare($query_string_parsed);
      $query->execute();
      
      return $multiple ? $query->fetchAll() : $query->fetch();
    }


  }

?>