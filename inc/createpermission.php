<?php 
            require_once('../func/functions.php');
            $oDb = new Database();
            ?>
<div class="main">

    <div class="col-sm-6">
        
            <h4>Create User Permission</h4>
            <form action="func/form_submit.php" method="post">
                <input type="hidden" name="OP" value="CRTUPER" />
                <input type="text" placeholder="Premission Name" class="form-control" name="pname">
                
                <input type="submit" value="Create Permission" class="btn btn-block btn-info" onclick="submitMyForm(this, event)">
            </form>
    </div>
    <div class="col-sm-6">
        <h4>Set User Permissions</h4>
        <form action="func/form_submit.php" method="post">
            <input type="hidden" name="OP" value="SETPER" />
           <select name="user" id="" class="form-control">
               <option value="">Select User</option>
               
               <?php 
                    $qr = $oDb->query("select * from user");
                    while ($row = $oDb->fetch($qr)){
                        echo '<option value="'.$row['uid'].'">'.$row['name'].'</option>';
                    }
               ?>
               
           </select>
            <table class="table table-bordered">
               <tr>
                   <th>Permission Name</th>
                   <th>Read</th>
                   <th>Write</th>
                   <th>Delete</th>
               </tr> 
               
               <?php 
                    $qr = $oDb->query("select * from permission where uid = '0'");
                    while ($row = $oDb->fetch($qr)){
                        echo    '<tr class="text-center">
                                    <input type="hidden" name="pname[]" value="'.$row['p_name'].'" />
                                    <td>'.$row['p_name'].'</td>
                                    <td><input name="read[]" type="checkbox" value="0" onchange="cng_option_value(this)"><label></label></td>
                                    <td><input name="write[]" type="checkbox" value="0" onchange="cng_option_value(this)"><label></label></td>
                                    <td><input name="delete[]" type="checkbox" value="0" onchange="cng_option_value(this)"><label></label></td>
                                </tr>';
                    }
               ?>

                
            </table>
            
            <input type="submit" value="Set Permission" class="btn btn-block btn-warning" onclick="submitMyForm(this, event)">
            <input type="reset" class="reset"/>
        </form>
    </div>
    <div class="clearfix"></div>
    <h4>List of User</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>User's Name</th>
                <th>Username</th>
                <th>Designation</th>
                <th>Email</th>
                <th>Role</th>
                <th>Manage</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $qr = $oDb->query("select * from user");
            $sl = 1;
            while ($data = $oDb->fetch($qr)) {
                ?>
                <tr>
                    <td><?php echo $sl++; ?></td>
                    <td><?php echo $data['name']; ?></td>
                    <td><?php echo $data['uname']; ?></td>
                    <td><?php echo $data['designation']; ?></td>
                    <td><?php echo $data['email']; ?></td>
                    <td><?php echo $data['role']; ?></td>
                    <td class="text-center"><a href="#" data-id="<?php echo $data['id']; ?>" onclick="return deleteItem(this, 'user')" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span></a></td>
                </tr>
<?php }
?>

        </tbody>
    </table>
</div>