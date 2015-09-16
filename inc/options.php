<?php

require_once ('../func/functions.php');
$oDb = new Database();
$oCheck = new Check();
$oTools = new Tools();

if (!empty($_POST)) {
    $operation = $_POST['OP'];
    if ($operation == 'CNGSEC') {
        $val = $_POST['val'];
        $qr = $oDb->q_fetch("select * from class where class = '$val' order by class");
        echo '<option value="">Select Section</option>
                <option value="1">' . $qr['c_sec1'] . '</option>
                <option value="2">' . $qr['c_sec2'] . '</option>
                <option value="3">' . $qr['c_sec3'] . '</option>';
    } elseif ($operation == 'STULST') {
        $class = $_POST['class'];
        $sec = $_POST['section'];
        $qr = $oDb->query("select * from student where class = '$class' and s_section = '$sec' order by class");
        echo '<option value="" default>Select Student</option>';
        while ($data = $oDb->fetch($qr)) {
            echo '<option value="' . $data['stuid'] . '">' . $data['s_name'] . '</option>';
        }
    } elseif ($operation == 'SUBLST') {
        $class = $_POST['class'];
        $sec = $_POST['section'];
        $id = $_POST['stuid'];

        $qr = $oDb->query("select * from subject where class = '$class' and s_section = '$sec' order by class");
        echo '<input type="hidden" name="stuid" value="' . $id . '"/><h4>List of the subjects</h4>';
        while ($d = $oDb->fetch($qr)) {
            echo '<div class="col-md-4"><div class="col-sm-7 pl0"><input type="hidden" name="sub_name[]" value="' . $d['s_name'] . '"/><label>' . $d['s_name'] . ':</label></div><div class="col-sm-5 pr0"><input type="text" name="marks[]" class="form-control" placeholder="Mark"/></div></div>';
        }
        echo '<div class = "col-sm-3 pl0">
                <input type = "submit" value = "Save" class = "btn btn-block btn-success" onclick = "submitMyForm(this, event)">
            </div>';
    } elseif ($operation == 'SRSRES') {
        $stuid = htmlentities($_POST['stuid'], ENT_QUOTES);
        $class = htmlentities($_POST['class'], ENT_QUOTES);
        $exam = htmlentities($_POST['exam'], ENT_QUOTES);
//        echo $class . '/' . $stuid.'/'.$exam;

        if (!empty($class) && !empty($exam) && !empty($stuid)) {
            if ($qr = $oDb->query("SELECT * from result natural join student where stuid = '$stuid' and exam_id = '$exam' and class = '$class' ")) {
                
                $data = $oDb->fetch($qr);
                
                echo '<h4>Result Details</h4>
                    <div class="col-xs-10">
                        <div class="row">
                            <p><b>Name:</b> '.$data['s_name'].'</p>
                                <p><b>Father Name:</b> '.$data['s_fname'].'</p>
                                <p><b>Address:</b> '.$data['s_address'].'</p>
                                <p><b>Class:</b> '.$data['class'].'</p>
                        </div>
                    </div>
                    <div class="col-xs-2">
                        <div class="row">
                            <img src="uploads/images/'.$data['s_img'].'" class="img-responsive img-thumbnail" alt="'.$data['s_img'].'" />
                        </div>
                    </div>
                    
                    <table class="table table-bordered">
                        <thead>

                            <tr>
                                <th>Subject Names</th>
                                <th>Total Marks</th>
                                <th>Pass Marks</th>
                                <th>Marks Obtained</th>
                                <th>Grade</th>
                            </tr>
                        </thead>
                        <tbody>';
                while ($data = $oDb->fetch($qr)) {
                    echo '<tr>
                    <th>' . $data['sub_name'] . '</th>
                    <th>Total Marks</th>
                    <th>Pass Marks</th>
                    <th>' . $data['marks'] . '</th>
                    <th>' . $oCheck->chkGrade($data['marks']) . '</th>
                </tr>';
                }
                echo '</tbody></table> <a href="" class="btn btn-info">Go Back</a>';
            } 
        } 
    }
}
    
//    $qr = $oDb->query("select * from class where");

