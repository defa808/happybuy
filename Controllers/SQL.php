<?php
include_once 'Singleton.php';
class PDOp
{
    use Singleton;

    protected $PDO;
    private $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    public  function __construct($dsn, $user = NULL, $pass = NULL, $driver_options = NULL)
    {
        if ($driver_options == NULL)
            $driver_options = $this->options;
        $this->PDO = new PDO($dsn, $user, $pass, $driver_options);
    }

    public function __call($func, $args = NULL)
    {
        if ($args == NULL)
            $args = $this->options;
        return call_user_func_array(array(&$this->PDO, $func), $args);
    }

    public function prepare()
    {
        if (func_num_args() == 0)
            $args = $this->options;
        else
            $args = func_get_args();

        $PDOS = call_user_func_array(array(&$this->PDO, 'prepare'), $args);
        return new SQL($this, $PDOS);
    }

    public function query()
    {
        if (func_num_args() == 0)
            $args = $this->options;
        else
            $args = func_get_args();
        $PDOS = call_user_func_array(array(&$this->PDO, 'query'), $args);

        return new SQL($this, $PDOS);
    }

    public function exec()
    {
        if (func_num_args() == 0)
            $args = $this->options;
        else
            $args = func_get_args();

        return call_user_func_array(array(&$this->PDO, 'exec'), $args);
    }
}

class SQL implements IteratorAggregate
{
    protected $PDOS;
    protected $PDOp;

    public function __construct($PDOp, $PDOS)
    {
        $this->PDOp = $PDOp;
        $this->PDOS = $PDOS;
    }

    public function __call($func, $args = NULL)
    {
        return call_user_func_array(array(&$this->PDOS, $func), $args);
    }

    public function bindColumn($column, &$param, $type = NULL)
    {
        if ($type === NULL)
            $this->PDOS->bindColumn($column, $param);
        else
            $this->PDOS->bindColumn($column, $param, $type);
    }

    public function bindParam($column, &$param, $type = NULL)
    {
        if ($type === NULL)
            $this->PDOS->bindParam($column, $param);
        else
            $this->PDOS->bindParam($column, $param, $type);
    }

    public function execute()
    {
        $args = func_get_args();
        return call_user_func_array(array(&$this->PDOS, 'execute'), $args);
    }

    public function __get($property)
    {
        return $this->PDOS->$property;
    }

    public function getIterator()
    {
        return $this->PDOS;
    }
}
