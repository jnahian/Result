<?php

require_once('functions.php');

$ret = array('success' => false, 'message' => '', 'redirect' => false, 'redirect_to' => '');

$oDb = new Database();
$oCheck = new Check();

if (!empty($_POST)) {
    $operation = htmlentities($_POST['OP'], ENT_QUOTES);

    if ($operation == 'REG') {
        $name = htmlentities($_POST['name'], ENT_QUOTES);
        $uname = htmlentities($_POST['uname'], ENT_QUOTES);
        $desig = htmlentities($_POST['desig'], ENT_QUOTES);
        $email = htmlentities($_POST['email'], ENT_QUOTES);
        $pass = sha1(md5(htmlentities($_POST['pass'], ENT_QUOTES)));
        $cpass = sha1(md5(htmlentities($_POST['cpass'], ENT_QUOTES)));
        $role = $_POST['urole'];

        if (!empty($name)) {
            if (!empty($uname)) {
                if (!empty($desig)) {
                    if (!empty($email)) {
                        if ($oCheck->chkEmail($email)) {
                            if ($oCheck->chkPass($pass)) {
                                if ($pass === $cpass) {
                                    if (!empty($role)) {
                                        if (isset($_POST['remember'])) {
                                            $q = $oDb->query("select * from user where uname = '$uname'");
                                            if ($q->num_rows < 1) {
                                                if ($oDb->query("INSERT INTO user (name, uname, designation, email, pass) values('$name', '$uname', '$desig', '$email', '$pass' )")) {
                                                    $ret['message'] = "User Registration Successful.";
                                                    $ret['success'] = true;
                                                } else {
                                                    $ret['message'] = "Registration Error!";
                                                }
                                            } else {
                                                $ret['message'] = "Username Already Taken!";
                                            }
                                        } else {
                                            $ret['message'] = 'You must accept the terms & conditions.';
                                        }
                                    } else {
                                        $ret['message'] = 'You must choose a user role';
                                    }
                                } else {
                                    $ret['message'] = 'Password & Confirm Password dosen\'t match';
                                }
                            } else {
                                $ret['message'] = 'Password must be 6 charecter or more';
                            }
                        } else {
                            $ret['message'] = 'Email format mismatch!';
                        }
                    } else {
                        $ret['message'] = 'Email cannot be empty!';
                    }
                } else {
                    $ret['message'] = 'Designation cannot be empty!';
                }
            } else {
                $ret['message'] = 'Username cannot be empty!';
            }
        } else {
            $ret['message'] = 'Name cannot be empty!';
        }
    } 
    elseif ($operation == 'LOGIN') {
        $uname = htmlentities($_POST['uname'], ENT_QUOTES);
        $pass = sha1(md5(htmlentities($_POST['pass'], ENT_QUOTES)));

        if (!empty($uname) && !empty($pass)) {
            if ($data = $oDb->q_fetch("select * from user where uname = '$uname'")) {
                if ($data['pass'] === $pass) {
                    $_SESSION['username'] = $uname;
                    $_SESSION['LAST_ACTIVITY'] = time();
                    $ret['success'] = TRUE;
                    $ret['redirect'] = TRUE;
                    $ret['redirect_to'] = '../';
                } else {
                    $ret['message'] = 'Username & Password Doesn\'t match';
                }
            } else {
                $ret['message'] = 'User not registered yet.';
            }
        } else {
            $ret['message'] = 'Required Feild empty!';
        }
    } 
    elseif ($operation == 'STULOGIN') {
        $stuid = htmlentities($_POST['stuid'], ENT_QUOTES);
        $pass = md5(htmlentities($_POST['pass'], ENT_QUOTES));

        if (!empty($stuid) && !empty($pass)) {
            if ($data = $oDb->q_fetch("select * from student where stuid = '$stuid'")) {
                if ($data['s_pass'] === $pass) {
                    $_SESSION['username'] = $stuid;
                    $_SESSION['LAST_ACTIVITY'] = time();
                    $ret['success'] = TRUE;
                    $ret['redirect'] = TRUE;
                    $ret['redirect_to'] = './';
                } else {
                    $ret['message'] = 'Username & Password Doesn\'t match';
                }
            } else {
                $ret['message'] = 'User not registered yet.';
            }
        } else {
            $ret['message'] = 'Required Feild empty!';
        }
    } 
    elseif ($operation == 'ADCLS') {
        $clsname = htmlentities($_POST['classname'], ENT_QUOTES);
        $sec1 = htmlentities($_POST['sec1'], ENT_QUOTES);
        $sec2 = htmlentities($_POST['sec2'], ENT_QUOTES);
        $sec3 = htmlentities($_POST['sec3'], ENT_QUOTES);

        if (!empty($clsname) && !empty($sec1) && !empty($sec2) && !empty($sec3)) {
            if ($oDb->query("INSERT INTO class (class, c_sec1, c_sec2, c_sec3) values('$clsname', '$sec1', '$sec2', '$sec3')")) {
                $ret['message'] = 'Class added successfully.';
            } else {
                $ret['message'] = 'Query Faild!';
            }
        } else {
            $ret['message'] = 'Fields are empty!';
        }
    } 
    elseif ($operation == 'DEL') {
        if (isset($_POST['rowid'])) {
            if (!empty($_POST['table'])) {
                $rowId = $_POST['rowid'];
                $table = $_POST['table'];
                if ($oDb->query("delete from $table where id = '$rowId'")) {
                    $ret['success'] = true;
                    $ret['message'] = 'Successfully Deleted';
                } else
                    $ret['message'] = 'Failed! Cannot delete item';
            } else
                $ret['message'] = 'Failed! No table given';
        } else
            $ret['message'] = 'Failed! Key value missing';
    }
    elseif ($operation == 'ADSUB') {
        $subid = $_POST['subid'];
        $subname = $_POST['subname'];
        $tmark = $_POST['tmark'];
        $pmark = $_POST['pmark'];

        foreach ($subid as $i => $val) {
            $j = htmlentities($val, ENT_QUOTES);
            !empty(trim($j)) ? $d[$i][0] = $j : $ret['message'] = 'Subject ID is empty!';
        }
        foreach ($subname as $i => $val) {
            $j = htmlentities($val, ENT_QUOTES);
            !empty(trim($j)) ? $d[$i][1] = $j : $ret['message'] = 'Subject name is empty!';
        }
        foreach ($tmark as $i => $val) {
            $j = htmlentities($val, ENT_QUOTES);
            !empty(trim($j)) ? $d[$i][2] = $j : $ret['message'] = 'Total Mark is empty!';
        }
        foreach ($pmark as $i => $val) {
            $j = htmlentities($val, ENT_QUOTES);
            !empty(trim($j)) ? $d[$i][3] = $j : $ret['message'] = 'Pass Mark is empty!';
        }
        if (!empty($d[$i][0]) && !empty($d[$i][1]) && !empty($d[$i][2]) && !empty($d[$i][3])) {
            foreach ($d as $i) {
                if ($oDb->query("INSERT INTO subject (subid, s_name, s_total, s_pass) values ('$i[0]', '$i[1]', '$i[2]', '$i[3]')")) {
                    $ret['message'] = 'Subjects added successfully';
                }
            }
        } else {
            $ret['message'] = 'You must fill-up every field';
        }
    } 
    elseif ($operation == 'ADSTU') {
        $name = htmlentities($_POST['name'], ENT_QUOTES);
        $father = htmlentities($_POST['fatname'], ENT_QUOTES);
        $mother = htmlentities($_POST['motname'], ENT_QUOTES);
        $address = htmlentities($_POST['address'], ENT_QUOTES);
        $dob = htmlentities($_POST['dateofbirth'], ENT_QUOTES);
        $stuid = htmlentities($_POST['stuid'], ENT_QUOTES);
        $email = htmlentities($_POST['email'], ENT_QUOTES);
        $pass = md5(htmlentities($_POST['pass'], ENT_QUOTES));

        $img = '';

        if ($_FILES['stupic']['error'] == 0) {
            $i = $_FILES['stupic'];
            $img = 'STU-' . time() . $i['name'];
        }

        if (!empty($name) && !empty($father) && !empty($mother) && !empty($address) && !empty($dob) && !empty($stuid) && !empty($email) && !empty($pass)) {
            if ($oCheck->chkEmail($email)) {
                if ($oCheck->chkPass($pass)) {
                    $qr = $oDb->query("select * from student where stuid = '$stuid'");
                    if ($qr->num_rows < 1) {
                        if ($oDb->query("INSERT INTO student (s_name, s_fname, s_mname, s_address, s_dob, s_img, stuid, s_email, s_pass) values ('$name', '$father', '$mother', '$address', '$dob', '$img', '$stuid', '$email', '$pass')")) {
                            move_uploaded_file($i['tmp_name'], '../uploads/images/' . $img);
                            $ret['message'] = 'Student Registration Success';
                        } else {
                            $ret['message'] = 'Registation failed!';
                        }
                    } else {
                        $ret['message'] = 'Student ID already taken';
                    }
                } else {
                    $ret['message'] = 'Password must be 6 charecter or more';
                }
            } else {
                $ret['message'] = 'Email format mismatch';
            }
        } else {
            $ret['message'] = 'You must fill-up every field.';
        }
    } 
    elseif ($operation == 'ADTCLS') {
        $stuid = $_POST['stuid'];
        $class = $_POST['class'];
        $section = $_POST['section'];

        if (!empty($stuid)) {
            if (!empty($class)) {
                if (!empty($section)) {
                    if ($oDb->query("UPDATE student SET class = '$class', s_section = '$section' where stuid = '$stuid' ")) {
                        $ret['message'] = 'Student Added to ' . $class;
                    } else {
                        $ret['message'] = 'Query Failed';
                    }
                } else {
                    $ret['message'] = 'Select a Section';
                }
            } else {
                $ret['message'] = 'Select a Class';
            }
        } else {
            $ret['message'] = 'Select a student first';
        }
    } 
    elseif ($operation == 'CRTRES') {
        $exam = $_POST['exam'];
        $class = $_POST['class'];
        $sec = $_POST['section'];
        $id = $_POST['stuid'];
        $stuname = $_POST['stuname'];
        $subs = $_POST['sub_name'];
        $marks = $_POST['marks'];

        foreach ($subs as $i => $sub) {
            $each[$i]['sub_name'] = $sub;
        }
        foreach ($marks as $i => $mark) {
            $each[$i]['mark'] = $mark;
        }
//        print_r($each);
        if (!empty($exam)) {
            if (!empty($each[$i]['mark'])) {
                foreach ($each as $e) {
                    $s = $e['sub_name'];
                    $m = $e['mark'];
                    if ($oDb->query("INSERT into result (stuid, sub_name, marks, exam_id, class) values('$id', '$s', '$m', '$exam', '$class')")) {
                        $ret['success'] = TRUE;
                        $ret['message'] = 'Insertion Complete';
                    } else {
                        $ret['message'] = 'Insertion Failed!';
                    }
                }
            } else {
                $ret['message'] = 'You must enter all marks';
            }
        } else {
            $ret['message'] = 'Select an exam first.';
        }
    } 
    elseif ($operation == 'REGSUBCLS') {
        if (!empty($_POST)) {
            if(!empty($_POST['class'])){
                $class = $_POST['class'];
                if(!empty($_POST['section'])){
                    $sec = $_POST['section'];
                    if (isset($_POST['subjects'])) {
                        $subs = $_POST['subjects'];
                        foreach ($subs as $sub) {
                            $q = $oDb->query("SELECT * from class_subject where subname = '$sub' and class = '$class' and section = '$sec'");
                            if ($q->num_rows < 1) {
                                if ($qr = $oDb->query("INSERT into class_subject (subname, class, section) values ('$sub', '$class', '$sec')")) {
                                    $ret['message'] = 'Subjects added Successfully';
                                    $ret['success'] = true;
                                } else {
                                    $ret['message'] = 'Failed to add Subjects!';
                                }
                            } else
                                $ret['message'] = 'Subjects Already Exist!';
                        }
                    } else {
                        $ret['message'] = 'No Subject Selected. You Must Select one subject!';
                    }
                } else {
                    $ret['message'] = 'Select A section first';
                }
            } else {
                $ret['message'] = 'ERROR! Select A class first';
            }
        } else {
            $ret['message'] = 'ERROR! Empty form Submitted';
        }
    } 
    elseif ( $operation == 'CRTUPER' ) {
        $pname = trim(htmlentities($_POST['pname'], ENT_QUOTES));
        
        if(!empty($pname)){
            $q = $oDb->query("SELECT * from permission where p_name = '$pname' ");
            if ($q->num_rows < 1) {
                if ($qr = $oDb->query("INSERT into permission (p_name) values ('$pname')")) {
                    $ret['message'] = 'Permission added Successfully';
                    $ret['success'] = true;
                } else {
                    $ret['message'] = 'Failed to add Permission!';
                }
            } else {
                $ret['message'] = 'Already Exists!';
            }
        } else {
                $ret['message'] = 'Permission name cannnot be Empty!';
            }
        
    }
    elseif ( $operation == 'SETPER' ) {
        if (!empty($_POST['user'])){
            $uid = $_POST['user'];
            $pname = $_POST['pname'];
            
            foreach ($pname as $i => $n){
                $r[$i][0] = $n;
            }
            
            if (isset($_POST['read']) || isset($_POST['write']) || isset($_POST['delete'])){
                
                if(isset($_POST['read'])){
                    $read = $_POST['read'];
                    foreach ($read as $i => $n){
                        $r[$i][1] = $n;
                    } 
                }
                
                if(isset($_POST['write'])){
                    $write = $_POST['write'];
                    foreach ($write as $i => $n){
                        $r[$i][2] = $n;
                    }
                }
                
                if(isset($_POST['delete'])){
                    $delete = $_POST['delete'];
                    foreach ($delete as $i => $n){
                        $r[$i][3] = $n;
                    }
                }
                
                print_r($r);
            } else {
                $ret['message'] = 'Choose User Permissions!';
            }
        } else {
            $ret['message'] = 'Select A user First!';
        }
    }
    else {
        $ret['message'] = 'Operation Not Found';
    }
}

echo json_encode($ret);

