<div class="main">

    <div class="col-sm-6">
        <div class="row">
            <h4>Add User</h4>
            <form action="func/form_submit.php" method="post">
                <input type="hidden" name="OP" value="REG" />
                <input type="text" placeholder="Full Name" class="form-control" name="name">
                <input type="text" placeholder="Username" class="form-control" name="uname">
                <input type="text" placeholder="Designation" class="form-control" name="desig">
                <input type="email" placeholder="Email" class="form-control" name="email">
                <input type="password" placeholder="Password" class="form-control" name="pass">
                <input type="password" placeholder="Confirm Password" class="form-control" name="cpass">
                <select name="urole" class="form-control">
                    <option value="" default>Select User Role</option>
                    <option value="1">Super Admin</option>
                    <option value="2">Admin</option>
                    <option value="3">Mordarator</option>
                    <option value="4">Operator</option>
                </select>
                <div class="col-sm-12">
                    <div class="row">
                        <label>
                            <input type="checkbox" name="remember" value="true">
                            I accept all the <a href="#">Terms &amp; Condition</a> of result management.
                        </label>
                    </div>
                </div>
                <input type="submit" value="Register" class="btn btn-block btn-info" onclick="submitMyForm(this, event)">

                <a href="../login" class="text-primary text-success">Login</a>
            </form>
        </div>
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
            require_once('../func/functions.php');
            $oDb = new Database();
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