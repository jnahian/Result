<?php

require_once ('../func/functions.php');
$oDb = new Database();
$oCheck = new Check();
$oTools = new Tools();

if (!empty($_POST)) {
    $operation = $_POST['OP'];
    if ($operation == 'CNGSEC') {
        $val = $_POST['val'];
        $qr = $oDb->q_fetch("select * from class where class = '$val'");
        echo '<option value="">Select Section</option>
                <option value="1">' . $qr['c_sec1'] . '</option>
                <option value="2">' . $qr['c_sec2'] . '</option>
                <option value="3">' . $qr['c_sec3'] . '</option>';
    } elseif ($operation == 'STULST') {
        $class = $_POST['class'];
        $sec = $_POST['section'];
        $qr = $oDb->query("select * from student where class = '$class' and s_section = '$sec'");
        echo '<option value="" default>Select Student</option>';
        while ($data = $oDb->fetch($qr)) {
            echo '<option value="' . $data['stuid'] . '">' . $data['s_name'] . '</option>';
        }
    } elseif ($operation == 'SUBLST') {
        $class = $_POST['class'];
        $sec = $_POST['section'];
        $id = $_POST['stuid'];

        $qr = $oDb->query("select * from class_subject where class = '$class' and section = '$sec'");
        echo '<input type="hidden" name="stuid" value="' . $id . '"/><h4>List of the subjects</h4>';
        while ($d = $oDb->fetch($qr)) {
            echo '<div class="col-md-4"><div class="col-sm-7 pl0"><input type="hidden" name="sub_name[]" value="' . $d['subname'] . '"/><label>' . $d['subname'] . ':</label></div><div class="col-sm-5 pr0"><input type="text" name="marks[]" class="form-control" placeholder="Mark"/></div></div>';
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
            $q = $oDb->query("select * from result where stuid = '$stuid' and exam_id = '$exam' and class = '$class' ");

            if ($q->num_rows > 0) {

                $data = $oDb->q_fetch("select * from student natural join result where stuid = '$stuid' and exam_id = '$exam' and class = '$class' ");

                echo '<h4>Result Details <a href="#" class="pull-right" onclick="print_my_page(this, event)" >Print</a></h4>
                    <div class="col-xs-10">
                        <div class="row">
                            <p><b>Name:</b> ' . $data['s_name'] . '</p>
                                <p><b>Father Name:</b> ' . $data['s_fname'] . '</p>
                                <p><b>Address:</b> ' . $data['s_address'] . '</p>
                                <p><b>Class:</b> ' . $data['class'] . '</p>
                                <p><b>Exam:</b> ' . $oRes->exam_name($data['exam_id']) . '</p>
                                <p><b>Result:</b> ' . $oRes->GPA($stuid, $class, $exam) . '</p>
                        </div>
                    </div>
                    <div class="col-xs-2">
                        <div class="row">
                            <img src="uploads/images/' . $data['s_img'] . '" class="img-responsive img-thumbnail" alt="' . $data['s_img'] . '" />
                        </div>
                    </div>
                    
                    <table class="table table-bordered">
                        <thead>

                            <tr>
                                <th>#</th>
                                <th>Subject Names</th>
                                <th>Total Marks</th>
                                <th>Pass Marks</th>
                                <th>Marks Obtained</th>
                                <th>Grade</th>
                            </tr>
                        </thead>
                        <tbody>';

                if ($qr = $oDb->query("SELECT * from result where stuid = '$stuid' and exam_id = '$exam' and class = '$class' ")) {
                    $i = 1;
                    while ($data = $oDb->fetch($qr)) {
                        echo '<tr>
                    <td>' . $i++ . '</td>
                    <td>' . $data['sub_name'] . '</td>
                    <td>Total Marks</td>
                    <td>Pass Marks</td>
                    <td class="text-center">' . $data['marks'] . '</td>
                    <td class="text-center">' . $oRes->point($data['marks']) . '(' . $oRes->grade($data['marks']) . ')' . '</td>
                </tr>';
                    }
                    echo '<tfoot>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="text-right">Total =</td>
                                <td class="text-center">' . $oRes->total($stuid, $class, $exam) . '</td>
                                <td class="text-center">' . $oRes->GPA($stuid, $class, $exam) . ' (GPA)</td>
                            </tr>
                        </tfoot>
                        </tbody></table> <a href="" class="btn btn-info">Go Back</a>';
                }
            } else {
                echo '<h2 class="text-center text-danger">No Result Found! Please Check Your Information</h2><a class="btn btn-info" href="">Go Back</a>';
            }
        }
    }
}
    
//    $qr = $oDb->query("select * from class where");

