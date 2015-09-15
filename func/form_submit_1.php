<?php

require_once('functions.php');

$ret = array('success' => false, 'message' => '');

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
            if ($oDb->query("INSERT INTO class (c_name, c_sec1, c_sec2, c_sec3) values('$clsname', '$sec1', '$sec2', '$sec3')")) {
                $ret['message'] = 'Class added successfully.';
            } else {
                $ret['message'] = 'Query Faild!';
            }
        }
    } 
    elseif ($operation == 'ADSUB') {
        $subname = $_POST['subname'];
        if (!empty($subname)) {
            $r = array();
            foreach ($subname as $sub) {
                $r[] = $sub;
            }
            $d = json_encode($r);

            $class = $_POST['class'];
            $sec = $_POST['section'];

            if ($oDb->query("update class set c_subjects = '$d' where c_name = '$class'")) {
                $ret['message'] = 'Subjects inserted successfully.';
            } else {
                $ret['message'] = 'Subjects insertion Error!';
            }
        } else {
            $ret['message'] = 'Subject Field is empty!';
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
        
        if($_FILES['stupic']['error'] == 0){
            $i = $_FILES['stupic'];
            $img = 'STU-'.time().$i['name'];
        }
        
        if(!empty($name) && !empty($father) && !empty($mother) && !empty($address) && !empty($dob) && !empty($stuid) && !empty($email) && !empty($pass)) {
            if($oCheck->chkEmail($email)){
                if ($oCheck->chkPass($pass)){
                    $qr = $oDb->query("select * from student where s_sid = '$stuid'");
                    if($qr->num_rows < 1){
                        if($oDb->query("INSERT INTO student (s_name, s_fname, s_mname, s_address, s_dob, s_img, s_sid, s_email, s_pass) values ('$name', '$father', '$mother', '$address', '$dob', '$img', '$stuid', '$email', '$pass')")){
                            move_uploaded_file($i['tmp_name'], '../uploads/images/'.$img);
                            $ret['message'] = 'Student Registration Success';
                            $ret['success'] = TRUE;
                        } else {
                            $ret['message'] = 'Registation failed!';
                        }
                    } else {
                        $ret['message'] = 'Student ID already taken';
                    }
                }else {
                    $ret['message'] = 'Password must be 6 charecter or more';
                }
            } else {
                $ret['message'] = 'Email format mismatch';
            }
        } else {
            $ret['message'] = 'You must fill-up every field.';
        }
    }
}

echo json_encode($ret);

