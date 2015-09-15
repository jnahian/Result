<?php

session_start();
/**
 * @author Julkar N. Nahian
 */
define('INC', 'inc/');
define('HOST', 'localhost');
define('USER', 'root');
define('PASSWORD', '');
define('DB_NAME', 'jnahian_result');
define('SELF', $_SERVER['PHP_SELF']);

class Page {

    public function get_part($partname) {
        include_once(INC . $partname . '.php');
    }

    public function current_page() {
        $exp = explode('/', $_SERVER['PHP_SELF']);
        $current = $exp[count($exp) - 1];
        return $current;
    }

    public function get_current_dir() {
        echo $_SERVER['PHP_SELF'];
    }

}

class Database {

    private $_con, $_res;

    private function connect() {
        return $this->_con = mysqli_connect(HOST, USER, PASSWORD, DB_NAME);
    }

    private function disconnect() {
        if ($this->_con) {
            mysqli_close($this->_con);
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function query($string) {
        if ($this->connect()) {
            $this->_res = mysqli_query($this->_con, $string);
            $this->disconnect();
            if ($this->_res) {
//                    echo "Query Success";
                return $this->_res;
            } else {
//                    echo "Query Failed!";
                return FALSE;
            }
        } else {
            echo "Connection Error!";
        }
    }

    public function fetch() {
        if ($this->_res) {
            return mysqli_fetch_array($this->_res);
        } else {
            return FALSE;
        }
    }

    public function q_fetch($string) {
        $this->query($string);
        return $this->fetch();
    }

}

class Check {

    public function chkName($name) {
        if (preg_match("/^[a-z\.\-\ ]{3,}/i", $name))
            return true;
        else
            return false;
    }

    public function chkEmail($email) {
        if (preg_match("/^[a-z0-9\.\_]{4,}@[a-z0-9\-\.]+\.[a-z]{2,10}/i", $email))
            return true;
        else
            return false;
    }

    public function chkPass($pass) {
        if (preg_match('/^.{6,}$/', $pass)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function chkGrade($mark) {
        switch ($mark) {
            case ($mark >= 80 && $mark <= 100) : return "A+";                break;
            case ($mark >= 70 && $mark < 80) : return "A";                break;
            case ($mark >= 60 && $mark < 70) : return "A-";                break;
            case ($mark >= 50 && $mark < 60) : return "B";                break;
            case ($mark >= 40 && $mark < 50) : return "C";                break;
            case ($mark >= 33 && $mark < 40) : return "D";                break;
            case ($mark >= 0 && $mark < 33) : return "F";                break;
            default : return "Invalid Mark";
        }
    }

}

class User extends Database {

    private function isLogged() {
        return isset($_SESSION['username']) ? TRUE : FALSE;
    }

    public function hasAccess() {
        if (!$this->isLogged()) {
            header('location:login/');
            exit();
        }
    }

    private function isExpired() {
        if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] < 6000)) {
            session_unset();
            session_destroy();
            return TRUE;
        }
        $_SESSION['LAST_ACTIVITY'] = time();
        return FALSE;
    }

    public function logout() {
        !isset($_SESSION['username']) || isset($_GET['out']) ? session_destroy() : header("location:../");
    }

}

class Tools {
    public function alert($string){
        echo '<script> alert('."$string".'); </script>';
    }
}

$oPage = new Page();
?>