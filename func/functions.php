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

    public function user_role() {
        $user = $_SESSION['username'];
        $row = $this->q_fetch("SELECT * FROM user WHERE uname = '$user' ");
        return $row['role'];
    }

    public function get_user_role_name() {
        switch ($this->user_role()) {
            case 1: echo 'Super Admin'; break;
            case 2: echo 'Admin'; break;
            case 3: echo 'Operator'; break;
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

    public function alert($string) {
        echo '<script> alert(' . "$string" . '); </script>';
    }

}

class Permission extends User {

    public function no_access(){
        header("location:".__DIR__);
    }

    public function user_permitted_menu(){
        switch ($this->user_role()) {
            case 1 : return '<li><a href="inc/addclass.php" onclick="load_part(this, event)">Create Class</a></li>
                                <li><a href="inc/addsubject.php" onclick="load_part(this, event)">Create Subject</a></li>
                                <li><a href="inc/regsubtocls.php" onclick="load_part(this, event)">Add Subject to Class</a></li>
                                <li><a href="inc/addstudent.php" onclick="load_part(this, event)">Register Student</a></li>
                                <li><a href="inc/createresult.php" onclick="load_part(this, event)">Create Result</a></li>
                                <li><a href="inc/viewresult.php" onclick="load_part(this, event)">View Result</a></li>
                                <li><a href="inc/createpermission.php" onclick="load_part(this, event)">Create Permission</a></li>
                                <li><a href="inc/adduser.php" onclick="load_part(this, event)">Create User</a></li>';
                    break;
            case 2 : return '<li><a href="inc/addclass.php" onclick="load_part(this, event)">Create Class</a></li>
                                <li><a href="inc/addsubject.php" onclick="load_part(this, event)">Create Subject</a></li>
                                <li><a href="inc/regsubtocls.php" onclick="load_part(this, event)">Add Subject to Class</a></li>
                                <li><a href="inc/addstudent.php" onclick="load_part(this, event)">Register Student</a></li>
                                <li><a href="inc/createresult.php" onclick="load_part(this, event)">Create Result</a></li>
                                <li><a href="inc/viewresult.php" onclick="load_part(this, event)">View Result</a></li>';
                    break;
            case 3 : return '<li><a href="inc/createresult.php" onclick="load_part(this, event)">Create Result</a></li>
                                <li><a href="inc/viewresult.php" onclick="load_part(this, event)">View Result</a></li>';
                    break;
        }
    }

}

class Result extends Database{
    public function total($stuid, $class, $exam){
        $tot = 0;
        $qr = $this->query("SELECT * from result natural join student where stuid = '$stuid' and exam_id = '$exam' and class = '$class' ");
        while ($data = $this->fetch($qr)) {
            $tot += $data['marks'];
        }
        return $tot;
    }
    
    public function GPA($stuid, $class, $exam){
        $gpa = 0;
        $i = 0;
        $qr = $this->query("SELECT * from result natural join student where stuid = '$stuid' and exam_id = '$exam' and class = '$class' ");
        while ($data = $this->fetch($qr)) {
            $gpa += $this->point($data['marks']);
            $i++;
        }
        
        if($i > 8){
            $i = 8;
        }
        
        return substr($gpa/$i, 0, 4);
    }

    public function point($mark) {
        switch ($mark) {
            case ($mark >= 80 && $mark <= 100) : return "5";
                break;
            case ($mark >= 70 && $mark < 80) : return "4";
                break;
            case ($mark >= 60 && $mark < 70) : return "3.5";
                break;
            case ($mark >= 50 && $mark < 60) : return "3";
                break;
            case ($mark >= 40 && $mark < 50) : return "2";
                break;
            case ($mark >= 33 && $mark < 40) : return "1";
                break;
            case ($mark >= 0 && $mark < 33) : return "0";
                break;
            default : return "Invalid Mark";
        }
    }
    public function grade($mark) {
        switch ($point = $this->point($mark)) {
            case ($point = 5) : return "A+";
                break;
            case ($point = 4) : return "A";
                break;
            case ($point = 3.5) : return "A-";
                break;
            case ($point = 3) : return "B";
                break;
            case ($point = 2) : return "C";
                break;
            case ($point = 1) : return "D";
                break;
            case ($point = 0) : return "0";
                break;
            default : return "Invalid Mark";
        }
    }
    public function exam_name($id){
        switch ($id){
            case 1: return 'First Term'; break;
            case 2: return 'Middle Term'; break;
            case 3: return 'Fianl';
        }
    }
}

$oPage = new Page();
$oPermission = new Permission();
$oRes = new Result();
$oTools = new Tools();
?>