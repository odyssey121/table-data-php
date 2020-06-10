<?php


namespace Api;

use Exception;
use PDO;
use Throwable;

require_once 'Api.php';


class DistanceApi extends Api
{
    public $apiName = 'distance';
    private $db = null;

    public function __construct($pdoObj)
    {
        $this->db = new $pdoObj();
        parent::__construct();
    }

    public function searchAction()
    {

        $distances = [];
        $db_conn = ($this->db)->getConnect();
        $searchExpression = "%" . $this->requestParams['search'] . "%";
        $sth = $db_conn->query("SELECT * FROM distance WHERE distance.name LIKE '$searchExpression';");
        while ($row = $sth->fetch(\PDO::FETCH_ASSOC)) {
            $distances[] = [
                'id' => $row['id'],
                'date' => $row['date'],
                'name' => $row['name'],
                'quantity' => $row['quantity'],
                'distance' => $row['distance']
            ];
        }
        return $this->response($distances);
    }

    public function filterAction()
    {
        $query_str = "SELECT * FROM distance ";
        $filter = $this->requestParams['filter'];
        if (isset($this->requestParams['max'])) {
            $query_str .= "WHERE $filter <= {$this->requestParams['max']}";
        }
        if (isset($this->requestParams['min'])) {
            $query_str .= isset($this->requestParams['max']) ?
                "AND $filter >= {$this->requestParams['min']}" :
                "WHERE $filter >= {$this->requestParams['min']};";
        }
        $distances = [];
        try {
            $db_conn = ($this->db)->getConnect();
            $sth = $db_conn->query($query_str);

            while ($row = $sth->fetch(\PDO::FETCH_ASSOC)) {
                $distances[] = [
                    'id' => $row['id'],
                    'date' => $row['date'],
                    'name' => $row['name'],
                    'quantity' => $row['quantity'],
                    'distance' => $row['distance']
                ];
            }
        } catch (Throwable $t) {
            return json_encode(array('error' => $t->getMessage()));
        }
        return $this->response($distances);
    }

    public function indexAction()
    {

        $db_conn = ($this->db)->getConnect();
        $sth = $db_conn->query("SELECT * FROM distance ORDER BY date DESC");
        $distances = [];
        while ($row = $sth->fetch(\PDO::FETCH_ASSOC)) {
            $distances[] = [
                'id' => $row['id'],
                'date' => $row['date'],
                'name' => $row['name'],
                'quantity' => $row['quantity'],
                'distance' => $row['distance']
            ];
        }
        return $this->response($distances);


    }
}