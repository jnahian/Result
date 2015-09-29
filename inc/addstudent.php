<?php
require_once('../func/functions.php');
$oDb = new Database();

?>
<div class="main">

    <div class="col-sm-6 pl0">
        <h4>Register Student</h4>
        <form action="func/form_submit.php" method="post">
            <input type="hidden" name="OP" value="ADSTU" />
            <input type="text" placeholder="Full Name" class="form-control" name="name">
            <input type="text" placeholder="Father's Name" class="form-control" name="fatname">
            <input type="text" placeholder="Mother's Name" class="form-control" name="motname">
            <textarea class="form-control" placeholder="Address" name="address"></textarea>
            <label>Date of Birth</label>
            <input type="date" class="form-control" placeholder="Date of Birth" name="dateofbirth"/>
            <label>Upload Your Image</label><input type="file" name="stupic"/>
            <label>Login Information</label>
            <input type="text" placeholder="Student ID" class="form-control" name="stuid" maxlength="5">
            <span class="info pull-right">Student ID format: 10001</span> 
            <input type="email" placeholder="Email" class="form-control" name="email">
            <input type="password" placeholder="Password" class="form-control" name="pass">
            <input type="submit" value="Register" class="btn btn-block btn-info" onclick="submitMyForm(this, event)">
            <input type="reset" class="reset"/>
        </form>
    </div>
    <div class="col-sm-6 pr0">
        <h4>Add Student to a Class</h4>
        <form action="func/form_submit.php" method="post">
            <input type="hidden" name="OP" value="ADTCLS" />
            <select class="form-control" name="stuid">
                <option value="" default>Select Student</option>
                <?php 
                    $qr = $oDb->query("select * from student");
                    while ($d = $oDb->fetch($qr)){
                        echo '<option value="'.$d['stuid'].'">'.$d['s_name'].'</option>';
                    }
                ?>
            </select>
            <div class="col-sm-6 pl0">
                <select class="form-control" name="class" onchange="cngSection(this)">
                    <option value="" default>Select Class</option>
                    <?php 
                        $qr = $oDb->query("select * from class order by class");
                        while ($d = $oDb->fetch($qr)){
                            echo '<option value="'.$d['class'].'">'.$d['class'].'</option>';
                        }
                    ?>
                </select>
            </div>
            <div class="col-sm-6 pr0">
                <select class="form-control option2" name="section">
                    <option value="" default>Select Class First</option>
                </select>
            </div>

            <input type="submit" value="Add to Class" class="btn btn-block btn-info" onclick="submitMyForm(this, event)">
            <input type="reset" class="reset"/>
        </form>
    </div>
    <div class="clearfix"></div>
    <h4>List of Student</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Student's Name</th>
                <th>Class</th>
                <th>Address</th>
                <th>Date Of Birth</th>
                <th>Image</th>
                <th>Student ID</th>
                <th>Email</th>
                <th>Manage</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $sl = 1;
                $qr = $oDb->query("select * from student");
                while ($data = $oDb->fetch($qr)) {
                    ?>
                    <tr>
                        <td><?php echo $sl++; ?></td>
                        <td><?php echo $data['s_name']; ?></td>
                        <td><?php echo $data['class']; ?></td>
                        <td><?php echo $data['s_address']; ?></td>
                        <td><?php echo $data['s_dob']; ?></td>
                        <td><img src="uploads/images/<?php echo $data['s_img']; ?>"/></td>
                        <td><?php echo $data['stuid']; ?></td>
                        <td><?php echo $data['s_email']; ?></td>
                        <td class="text-center"><a href="#" data-id="<?php echo $data['id']; ?>" onclick="return deleteItem(this, 'student')" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span></a></td>
                    </tr>
                <?php }
            ?>

        </tbody>
    </table>
</div>