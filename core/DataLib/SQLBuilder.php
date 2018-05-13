<?php
/**
 * Created by PhpStorm.
 * User: alexg
 * Date: 01.04.2018
 * Time: 15:16
 */

namespace core\DataLib;


use PDO;

class SQLBuilder implements CRUD
{

    private $settings = [
        "host" => "127.0.0.1",
        "database" => "happybuy",
        "username" => "root",
        "password" => "",
        "options" => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false]
    ];

    private $dbh = null, $table, $columns, $sql, $bindValues, $getSQL,
        $className, $where, $orWhere, $whereCount = 0, $isOrWhere = false,
        $rowCount = 0, $limit, $orderBy, $lastIDInserted = 0;


    public function __construct()
    {
        try {
            $this->dbh = new PDO("mysql:host=" . $this->settings['host'] . ";dbname=" . $this->settings['database'] . ";charset=utf8",
                $this->settings['username'], $this->settings['password'], $this->settings['options']);

            $db_config = null;
            return $this;
        } catch (Exception $e) {
            die("Error establishing a database connection.");
        }
    }


    public function query($query, $args = [])
    {
        $this->resetQuery();
        $query = trim($query);
        $this->getSQL = $query;
        $this->bindValues = $args;

        $stmt = $this->dbh->prepare($query);
        $stmt->execute($this->bindValues);
        $this->rowCount = $stmt->rowCount();
        return $this;

    }

    private function resetQuery()
    {
        $this->table = null;
        $this->columns = null;
        $this->sql = null;
        $this->bindValues = null;
        $this->className = null;
        $this->limit = null;
        $this->orderBy = null;
        $this->getSQL = null;
        $this->where = null;
        $this->orWhere = null;
        $this->whereCount = 0;
        $this->isOrWhere = false;
        $this->rowCount = 0;
        $this->lastIDInserted = 0;
    }

    public function exec()
    {
        $this->buildQuery();
        $stmt = $this->dbh->prepare($this->sql);
        $stmt->execute($this->bindValues);
        return $stmt->rowCount();
    }

    public function table($table_name)
    {
        $this->resetQuery();
        $this->table = $table_name;
        return $this;
    }

    public function className($className)
    {
        $this->className = $className;
        return $this;
    }

    public function where()
    {
        $this->firstOrAddWhereWithAnd();

        $this->isOrWhere = false;

        $num_args = func_num_args();
        $args = func_get_args();
        if ($num_args == 1) {
            if (is_numeric($args[0])) {
                $this->where .= "`id` = ?";
                $this->bindValues[] = $args[0];
            } elseif (is_array($args[0])) {
                $arr = $args[0];
                $x = 0;

                foreach ($arr as $param) {
                    if ($x == 0) {
                        $x++;
                    } else {
                        if ($this->isOrWhere) {
                            $this->where .= " Or ";
                        } else {
                            $this->where .= " AND ";
                        }

                        $x++;
                    }
                    $count_param = count($param);
                    if ($count_param == 1) {
                        $this->where .= "`id` = ?";
                        $this->bindValues[] = $param[0];
                    } elseif ($count_param == 2) {
                        $operators = explode(',', "=,>,<,>=,>=,<>");
                        $operatorFound = false;

                        foreach ($operators as $operator) {
                            if (strpos($param[0], $operator) !== false) {
                                $operatorFound = true;
                                break;
                            }
                        }

                        if ($operatorFound) {
                            $this->where .= $param[0] . " ?";
                        } else {
                            $this->where .= "`" . trim($param[0]) . "` = ?";
                        }

                        $this->bindValues[] = $param[1];
                    } elseif ($count_param == 3) {
                        $this->where .= "`" . trim($param[0]) . "` " . $param[1] . " ?";
                        $this->bindValues[] = $param[2];
                    }
                }
            }
            // end of is array
        } elseif ($num_args == 2) {
            $operators = explode(',', "=,>,<,>=,>=,<>");
            $operatorFound = false;
            foreach ($operators as $operator) {
                if (strpos($args[0], $operator) !== false) {
                    $operatorFound = true;
                    break;
                }
            }

            if ($operatorFound) {
                $this->where .= $args[0] . " ?";
            } else {
                $this->where .= "`" . trim($args[0]) . "` = ?";
            }

            $this->bindValues[] = $args[1];

        } elseif ($num_args == 3) {

            $this->where .= "`" . trim($args[0]) . "` " . $args[1] . " ?";
            $this->bindValues[] = $args[2];
        }

        return $this;
    }

    public function orWhere()
    {
        $this->firsOrAddWhereWithOr();
        $this->isOrWhere = true;
        // call_user_method_array ( 'where_orWhere' , $this ,  func_get_args() );

        $num_args = func_num_args();
        $args = func_get_args();
        if ($num_args == 1) {
            if (is_numeric($args[0])) {
                $this->where .= "`id` = ?";
                $this->bindValues[] = $args[0];
            } elseif (is_array($args[0])) {
                $arr = $args[0];
                $x = 0;

                foreach ($arr as $param) {
                    if ($x == 0) {
                        $x++;
                    } else {
                        if ($this->isOrWhere) {
                            $this->where .= " Or ";
                        } else {
                            $this->where .= " AND ";
                        }

                        $x++;
                    }
                    $count_param = count($param);
                    if ($count_param == 1) {
                        $this->where .= "`id` = ?";
                        $this->bindValues[] = $param[0];
                    } elseif ($count_param == 2) {
                        $operators = explode(',', "=,>,<,>=,>=,<>");
                        $operatorFound = false;

                        foreach ($operators as $operator) {
                            if (strpos($param[0], $operator) !== false) {
                                $operatorFound = true;
                                break;
                            }
                        }

                        if ($operatorFound) {
                            $this->where .= $param[0] . " ?";
                        } else {
                            $this->where .= "`" . trim($param[0]) . "` = ?";
                        }

                        $this->bindValues[] = $param[1];
                    } elseif ($count_param == 3) {
                        $this->where .= "`" . trim($param[0]) . "` " . $param[1] . " ?";
                        $this->bindValues[] = $param[2];
                    }
                }
            }
            // end of is array
        } elseif ($num_args == 2) {
            $operators = explode(',', "=,>,<,>=,>=,<>");
            $operatorFound = false;
            foreach ($operators as $operator) {
                if (strpos($args[0], $operator) !== false) {
                    $operatorFound = true;
                    break;
                }
            }

            if ($operatorFound) {
                $this->where .= $args[0] . " ?";
            } else {
                $this->where .= "`" . trim($args[0]) . "` = ?";
            }

            $this->bindValues[] = $args[1];

        } elseif ($num_args == 3) {

            $this->where .= "`" . trim($args[0]) . "` " . $args[1] . " ?";
            $this->bindValues[] = $args[2];
        }

        return $this;
    }

    private function firstOrAddWhereWithAnd()
    {
        if ($this->whereCount == 0) {
            $this->where .= " WHERE ";
            $this->whereCount += 1;
        } else {
            $this->where .= " AND ";
        }
    }

    private function firsOrAddWhereWithOr()
    {
        if ($this->whereCount == 0) {
            $this->where .= " WHERE ";
            $this->whereCount += 1;
        } else {
            $this->where .= " OR ";
        }
    }

    public function get()
    {
        $this->buildQuery();
        $stmt = $this->executeQuery();
        if ($stmt->rowCount() > 0)
            return $stmt->fetch();
        return false;
    }

    public function getAll()
    {
        $this->buildQuery();
        $stmt = $this->executeQuery();
        return $stmt->fetchAll();
    }

    private function executeQuery()
    {
        $this->getSQL = $this->sql;
        $stmt = $this->dbh->prepare($this->sql);
        if ($this->className !== null)
            $stmt->setFetchMode(PDO::FETCH_CLASS, $this->className);

        $stmt->execute($this->bindValues);
        return $stmt;
    }

    private function buildQuery()
    {
        if ($this->columns === null) {
            $select = "*";
        } else {
            $select = $this->columns;
        }

        $this->sql = "SELECT " . $select . " FROM `" . $this->table . "`";

        if ($this->where !== null) {
            $this->sql .= $this->where;
        }

        if ($this->orderBy !== null) {
            $this->sql .= $this->orderBy;
        }

        if ($this->limit !== null) {
            $this->sql .= $this->limit;
        }
    }

    public function insert($fields = [])
    {

        $keys = implode('`, `', array_keys($fields));
        $values = '';
        $x = 1;
        foreach ($fields as $field => $value) {
            $values .= '?';
            $this->bindValues[] = $value;
            if ($x < count($fields)) {
                $values .= ', ';
            }
            $x++;
        }

        $this->sql = "INSERT INTO `{$this->table}` (`{$keys}`) VALUES ({$values})";
        $this->getSQL = $this->sql;
        $stmt = $this->dbh->prepare($this->sql);
        $stmt->execute($this->bindValues);
        $this->lastIDInserted = $this->dbh->lastInsertId();

        return $this->lastIDInserted;
    }//End insert function

    public function select($columns)
    {
        $columns = explode(',', $columns);
        foreach ($columns as $key => $column) {
            $columns[$key] = trim($column);
        }

        $columns = implode('`, `', $columns);


        $this->columns = "`{$columns}`";

        return $this;
    }

    public function update($fields = [], $id = null)
    {
        $set = '';
        $x = 1;

        foreach ($fields as $column => $field) {
            $set .= "`$column` = ?";
            $this->bindValues[] = $field;
            if ($x < count($fields)) {
                $set .= ", ";
            }
            $x++;
        }

        $this->sql = "UPDATE `{$this->table}` SET $set";
        if (isset($id)) {
            $this->buildConditions($id);
            // end if there is an Array
            $this->sql .= $this->where;

            $this->getSQL = $this->sql;
            $stmt = $this->dbh->prepare($this->sql);
            $stmt->execute($this->bindValues);
            return $stmt->rowCount();
        }
        return $this;
    }

    public function delete($table_name, $id = null)
    {

        $this->sql = "DELETE FROM `{$table_name}`";

        if (isset($id)) {
            $this->buildConditions($id);
            $this->sql .= $this->where;

            $this->getSQL = $this->sql;
            $stmt = $this->dbh->prepare($this->sql);
            $stmt->execute($this->bindValues);
            return $stmt->rowCount();
        }// end if there is an ID or Array
        // $this->getSQL = "<b>Attention:</b> This Query will update all rows in the table, luckily it didn't execute yet!, use exec() method to execute the following query :<br>". $this->sql;
        // $this->getSQL = $this->sql;
        return $this;
    }

    private function buildConditions($id)
    {
        // if there is an ID
        if (is_numeric($id)) {
            $this->sql .= " WHERE `id` = ?";
            $this->bindValues[] = $id;
            // if there is an Array
        } elseif (is_array($id)) {
            $arr = $id;
            $x = 0;

            foreach ($arr as $param) {
                if ($x == 0) {
                    $this->where .= " WHERE ";
                    $x++;
                } else {
                    if ($this->isOrWhere) {
                        $this->where .= " Or ";
                    } else {
                        $this->where .= " AND ";
                    }

                    $x++;
                }
                $count_param = count($param);

                if ($count_param == 1) {
                    $this->where .= "`id` = ?";
                    $this->bindValues[] = $param[0];
                } elseif ($count_param == 2) {
                    $operators = explode(',', "=,>,<,>=,>=,<>");
                    $operatorFound = false;

                    foreach ($operators as $operator) {
                        if (strpos($param[0], $operator) !== false) {
                            $operatorFound = true;
                            break;
                        }
                    }

                    if ($operatorFound) {
                        $this->where .= $param[0] . " ?";
                    } else {
                        $this->where .= "`" . trim($param[0]) . "` = ?";
                    }

                    $this->bindValues[] = $param[1];
                } elseif ($count_param == 3) {
                    $this->where .= "`" . trim($param[0]) . "` " . $param[1] . " ?";
                    $this->bindValues[] = $param[2];
                }

            }
            //end foreach
        }
    }

    /**
     * Sort result in a particular order according to a column name
     * @param  string $field_name The column name which you want to order the result according to.
     * @param  string $order it determins in which order you wanna view your results whether 'ASC' or 'DESC'.
     * @return object             it returns DB object
     */
    public function orderBy($field_name, $order = 'ASC')
    {
        $field_name = trim($field_name);

        $order = trim(strtoupper($order));

        // validate it's not empty and have a proper valuse
        if ($field_name !== null && ($order == 'ASC' || $order == 'DESC')) {
            if ($this->orderBy == null) {
                $this->orderBy = " ORDER BY $field_name $order";
            } else {
                $this->orderBy .= ", $field_name $order";
            }
        }

        return $this;
    }

}