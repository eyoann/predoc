<?php
namespace phpUnitTutorial\Fixtures;

use PHPUnit_Extensions_Database_TestCase;
use PDOException;
use PDO;
use PHPUnit_Extensions_Database_DataSet_CompositeDataSet;

class FixturesTestCase extends PHPUnit_Extensions_Database_TestCase{
    public $fixtures = array(
        //table name
        'user',
        'password',
        'questionnaire'
    );

    //connect variable
    private $conn = null;

    //create fixture
    public function setUp()
    {

        //获取mysql连接
        $conn = $this->getConnection();
        //建立PDO连接
        $pdo = $conn->getConnection();
        // set up tables
        $fixtureDataSet = $this->getDataSet($this->fixtures);
        foreach ($fixtureDataSet->getTableNames() as $table) {
            // drop table
            $pdo->exec("DROP TABLE IF EXISTS `$table`;");
            // recreate table
            //Returns a table meta data object for the given table
            $meta = $fixtureDataSet->getTableMetaData($table);
            $create = "CREATE TABLE IF NOT EXISTS `$table` ";
            $cols = array();
            foreach ($meta->getColumns() as $col) {
                $cols[] = "`$col` VARCHAR(200)";
            }
            $create .= '('.implode(',', $cols).');';
            $pdo->exec($create);
        }
        parent::setUp();
    }

    public function tearDown()
    {
        $allTables =
            $this->getDataSet($this->fixtures)->getTableNames();
        foreach ($allTables as $table) {
            // drop table
            $conn = $this->getConnection();
            $pdo = $conn->getConnection();
            $pdo->exec("DROP TABLE IF EXISTS `$table`;");
        }
        parent::tearDown();
    }

    public function getConnection()
    {
        // TODO: Implement getConnection() method.
        if($this->conn == null){
            try {
                $pdo = new PDO('mysql:host=localhost;dbname=questionnaire', 'root', '');
                $this->conn = $this->createDefaultDBConnection($pdo, 'test');
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        return $this->conn;
    }

    public function getDataSet($fixtures = array())
    {
        // TODO: Implement getDataSet() method.
        if (empty($fixtures)) {
            $fixtures = $this->fixtures;
        }

        $compositeDs = new
        PHPUnit_Extensions_Database_DataSet_CompositeDataSet(array());
        $fixturePath = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'fixtures';


        foreach ($fixtures as $fixture) {
            $path =  $fixturePath . DIRECTORY_SEPARATOR . "$fixture.xml";
            $ds = $this->createMySQLXMLDataSet($path);
            $compositeDs->addDataSet($ds);
        }
        return $compositeDs;
    }

    public function loadDataSet($dataSet) {
        // set the new dataset
        $this->getDatabaseTester()->setDataSet($dataSet);
        // call setUp whateverhich adds the rows
        $this->getDatabaseTester()->onSetUp();
    }
}