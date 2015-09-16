<div class="main">
    <h4>Add Class</h4>
    <form action="func/form_submit.php" method="post">
        <input type="hidden" name="OP" value="ADCLS"/>
        <div class="col-sm-3 pl0">
            <input type="text" class="form-control" placeholder="Input Class Name" name="classname">
        </div>
        <div class="col-sm-2 pl0">
            <input type="text" class="form-control" placeholder="Section 1 Name" name="sec1">
        </div>
        <div class="col-sm-2 pl0">
            <input type="text" class="form-control" placeholder="Section 2 Name" name="sec2">
        </div>
        <div class="col-sm-2 pl0">
            <input type="text" class="form-control" placeholder="Section 2 Name" name="sec3">
        </div>
        <div class="col-sm-3">
            <input type="submit" value="Add Class" class="btn btn-block btn-success" onclick="submitMyForm(this, event)">
        </div>
    </form>
    <h4>List of class</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Class Name</th>
                <th>Section 1</th>
                <th>Section 2</th>
                <th>Section 3</th>
                <th>Manage</th>
            </tr>
        </thead>
        <tbody>
            
            <?php 
                require_once('../func/functions.php');
                $oDb = new Database();
                $query = $oDb->query("SELECT * from class order by class");
                $sl = 1;
                while ($result = $oDb->fetch($query)){ ?>
                    <tr>
                        <td><?php echo $sl++; ?></td>
                        <td><?php echo $result['class']; ?></td>
                        <td><?php echo $result['c_sec1']; ?></td>
                        <td><?php echo $result['c_sec2']; ?></td>
                        <td><?php echo $result['c_sec3']; ?></td>
                        <td class="text-center"><a href="#" data-id="<?php echo $result['id']; ?>" onclick="return deleteItem(this, 'class')" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span></a></td>
                    </tr>
                <?php }
            ?>
            
            
        </tbody>
    </table>
</div>