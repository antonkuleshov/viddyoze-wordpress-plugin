<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Show Table</title>
    <style>

    </style>
</head>
<body>
<div>
    <h3>Create Quote</h3>
    <div class="row">
        <div>
            <h3>Please, fill in all fields</h3>
        </div>
        <div class="col-md-4">
            <form action="<?php echo admin_url('admin.php?page=get-quote-api-create&noheader=true'); ?>" name="form" method="post">
                <div class="form-group">
                    <input type="text" name="author" placeholder="Name" class="form-control">
                </div>
                <div class="form-group">
                    <textarea name="text" placeholder="Text Quote" class="form-control"></textarea>
                </div>

                <button type="submit" name="submit" class="btn btn-success">Create</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>