<?php
require_once('../func/functions.php');
$oDb = new Database();
?>
<div class="main">

    <div class="col-sm-12 pl0">
        <h4>Add Subject to Class</h4>
        <form action="func/form_submit.php" method="post">
            <input type="hidden" name="OP" value="REGSUBCLS" />

            <div class="col-sm-4 pl0">
                <select class="form-control" name="class">
                    <option value="" default>Select Class</option>
                    <?php
                        $qr = $oDb->query("select * from class");
                        while ($d = $oDb->fetch($qr)) {
                            echo '<option value="' . $d['class'] . '">' . $d['class'] . '</option>';
                        }
                    ?>
                </select>
            </div>
            <div class="clearfix"></div>

            <?php
                $qr = $oDb->query("select * from subject");
                while ($d = $oDb->fetch($qr)) {
                    echo    '<div class="col-sm-3">
                                <div class="row">
                                    <input id="id_'.$d['subid'].'" type="checkbox" name="subjects[]" value="'.$d['subid'].'" />
                                    <label for="id_'.$d['subid'].'">'.$d['s_name'].'</label>
                                </div>
                            </div>';
                }
            ?>

            <div class="clearfix"></div>
            <input type="submit" value="Add subjects to Class" class="btn btn-info" onclick="submitMyForm(this, event)">
        </form>
    </div>
    
    <h4>List of Subjects in Classes</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Class Name</th>
                <th>Subjects</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sl = 1;
            $qr = $oDb->query("select * from class_subject natural join subject");
            while ($data = $oDb->fetch($qr)) {
                ?>
                <tr>
                    <td><?php echo $sl++; ?></td>
                    <td><?php echo $data['class']; ?></td>
                    <td><?php echo $data['s_name']; ?></td>
                </tr>
            <?php }
            ?>

        </tbody>
    </table>
</div>