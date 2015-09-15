<?php
require_once('../func/functions.php');
$oDb = new Database();
?>


<div class="main">
    <h4>View Result</h4>
    <form action="inc/options.php" method="post">
        <input type="hidden" name="OP" value="SRSRES"/>

        <div class="col-sm-3 pl0">
            <select name="class" id="" class="form-control" onchange="cngSection(this)">
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
            <select name="exam" class="form-control text-capitalize" onchange="stu_list(this)">
                <option value="" default>Select Exam</option>
                <option value="1" >first term</option>
                <option value="2" >second term</option>
                <option value="3" >Final</option>
            </select>
        </div>

        <div class="col-sm-3 pl0">
            <input type="text" name="stuid" placeholder="Student Id" class="form-control"/>
        </div>
        
        <div class = "col-sm-3 pl0">
            <input type = "submit" value = "Search" class = "btn btn-block btn-success" onclick="search_res(this, event)">
        </div>

        <div class="clearfix"></div>

        <div class="show_res"></div>

    </form>
    
</div>