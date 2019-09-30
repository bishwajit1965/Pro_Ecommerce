<?php

namespace Codecourse\Repositories;

use Codecourse\Repositories\Database as Database;
use PDO;
use PDOException;

class FrontEnd
{
    // Database connection constructor
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $dbConnection = $database->dbConnection();
        $this->conn = $dbConnection;
    }

    // View Data in Index page
    public function frontEndDataAndPagination($query)
    {
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                while ($data = $stmt->fetch(PDO::FETCH_OBJ)) {
                    $productsData[] = $data;
                }
                return $productsData;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    // Slider data
    public function sliderDataDisplay($table)
    {
        try {
            $sql = "SELECT * FROM $table";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                while ($data = $stmt->fetch(PDO::FETCH_OBJ)) {
                    $sliderData[] = $data;
                }
                return $sliderData;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    //Pagination begins
    public function paging($table, $records_per_page)
    {
        $query = "SELECT * FROM $table";
        $starting_position = 0;
        if (isset($_GET["page_no"])) {
            $starting_position = ($_GET["page_no"]-1) * $records_per_page;
        }
        $query2 = $query." limit $starting_position, $records_per_page";
        return $query2;
    }

    /**
     * Pagination
     *
     * @param [type] $table
     * @param [type] $records_per_page
     * @return void
     */
    public function paginglink($table, $records_per_page)
    {
        $query = "SELECT * FROM $table";
        $self = $_SERVER['PHP_SELF'];
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $total_no_of_records = $stmt->rowCount();
        if ($total_no_of_records > 0) {
            ?>
            <ul class="pagination">
            <?php
            $total_no_of_pages = ceil($total_no_of_records/$records_per_page);
            $current_page = 1;
            if (isset($_GET["page_no"])) {
                $current_page = $_GET["page_no"];
            }
            if ($current_page!= 1) {
                $previous = $current_page-1;
                echo "<li class='page-item'><a class='page-link' href='".$self."?page_no=1'>First</a></li>";
                echo "<li><a class='page-link' href='".$self."?page_no=".$previous."'>Previous</a></li>";
            }
            for ($i=1; $i<=$total_no_of_pages; $i++) {
                if ($i == $current_page) {
                    echo "<li class='page-item'><a class='page-link' href='".$self."?page_no=".$i."'
                                    style='color:red; background-color:#D9EDF7;'> ".$i."</a></li>";
                } else {
                    echo "<li class='page-item'><a class='page-link' href='".$self."?page_no=".$i."'>".$i."</a></li>";
                }
            }
            if ($current_page!=$total_no_of_pages) {
                $next=$current_page+1;
                echo "<li class='page-item'><a class='page-link' href='".$self."?page_no=".$next."'>Next</a></li>";
                echo "<li class='page-item'><a class='page-link' href='".$self."?page_no=".$total_no_of_pages."'>
                                Last</a></li>";
            } ?>
            </ul>
            <?php
        }
    }
    /**
     * It will fetch the number of rows
     *
     * @param <type> $table  The table
     *
     * @return <type>(description_of_the_return_value)
     */
    public function numberOfCountedRows($table)
    {
        $staff=$this->conn->prepare("SELECT count(*) FROM $table");
        $staff->execute();
        $staffrow = $staff->fetch(PDO::FETCH_NUM);
        $staffcount = $staffrow[0];
        return $staffcount;
    }
    /**
     * It will fetch the number of rows
     * @param <type>$table The table
     *
     * @return boolean ( description_of_the_return_value )
     */
    public function numberOfRows($table)
    {
        $query = "SELECT FOUND_ROWS() FROM $table";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $numberOfRows = $stmt->rowCount();
        if ($numberOfRows) {
            return $numberOfRows;
        } else {
            return false;
        }
    }
}
