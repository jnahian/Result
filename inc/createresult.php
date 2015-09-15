<?php
require_once('../func/functions.php');
$oDb = new Database();
?>


<div class="main">
    <h4>Create Result</h4>
    <form action="func/form_submit.php" method="post">
        <input type="hidden" name="OP" value="CRTRES"/>

        <div class="col-sm-3 pl0">
            <select name="exam" class="form-control text-capitalize">
                <option value="" default>Select Exam</option>
                <option value="1" >first term</option>
                <option value="2" >second term</option>
                <option value="3" >Final</option>
            </select>
        </div>
        <div class="col-sm-3 pl0">
            <select name="class" id="" class="form-control option1" onchange="cngSection(this)">
                <option value="" default>Select a Class</option>

                <?php 
                    $qr = $oDb->query("select * from class");
                    while ($result = $oDb->fetch($qr)) {
                        ?>
                        <option value="<?php echo $result['class']; ?>"><?php echo $result['class']; ?></option>
                        <?php
                    }
                ?>
            </select>
        </div>
        <div class="col-sm-3 pl0">
            <select name="section" class="form-control option2" onchange="stu_list(this)">
                <option value="" default>Select Class First</option>
            </select>
        </div>
        <div class="col-sm-3 pl0">
            <select name="stuname" class="form-control option3" onchange="sub_list(this)">
                <option value="" default>Select Section First</option>
            </select>
        </div>

        <div class="col-sm-12">
            <div class="row">
                <div class="subjects"></div>
            </div>
        </div>

        <!--        <div class = "col-sm-3 pl0">
                    <input type = "submit" value = "Save" class = "btn btn-block btn-success" onclick = "submitMyForm(this, event)">
                </div>-->

    </form>
    
</div>