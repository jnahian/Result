<?php
require_once('../func/functions.php');
$oDb = new Database();
?>
<div class="main">
    <h4>Add Subjects</h4>
    <form action="func/form_submit.php" method="post">
        <input type="hidden" name="OP" value="ADSUB"/>
        
        <div class="col-sm-12">
            <div class="row single">
                <div class="col-sm-2 pl0">
                    <input type="text" class="form-control" placeholder="Subject ID" name="subid[]">
                </div>
                <div class="col-sm-5 pl0">
                    <input type="text" class="form-control" placeholder="Subject Name" name="subname[]">
                </div>
                <div class="col-sm-2 pl0">
                    <input type="text" class="form-control" placeholder="Total Marks" name="tmark[]">
                </div>
                <div class="col-sm-2 pl0">
                    <input type="text" class="form-control" placeholder="Pass Mark" name="pmark[]">
                </div>
                <div class="col-sm-1">
                    <a href="#" class="btn btn-info add" onclick="addnew(this, event)"><i class="fa fa-plus"></i></a>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>    
        <div class="col-sm-3 pl0">
            <input type="submit" value="Add Subject" class="btn btn-block btn-success" onclick="submitMyForm(this, event)">
        </div>
    </form>
    <h4>List of Subjects</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Subject ID</th>
                <th>Subject Names</th>
                <th>Total Marks</th>
                <th>Pass Marks</th>
                <th>Manage</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $qr = $oDb->query("select * from subject");
                $sl = 1;
                while ($data = $oDb->fetch($qr)){ 
                    
                ?>
                
                <tr>
                    <td><?php echo $sl++; ?></td>
                    <td><?php echo $data['subid']; ?></td>
                    <td><?php echo $data['s_name']; ?></td>
                    <td><?php echo $data['s_total']; ?></td>
                    <td><?php echo $data['s_pass']; ?></td>
                    </td>
                    <td class="text-center"><a href="#" data-id="<?php echo $data['id']; ?>" onclick="return deleteItem(this, 'subject')" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span></a></td>
                </tr>   
                
            <?php
                }
            ?>
        </tbody>
    </table>
</div>