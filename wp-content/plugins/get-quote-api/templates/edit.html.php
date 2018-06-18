<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Edit Quote</title>
    <style>

    </style>
</head>
<body>
<div>
    <h3>Edit Quote</h3>
    <div class="row">
        <div>
            <h3>Please, fill in all fields</h3>
        </div>
        <div class="col-md-4">
            <form action="<?php echo admin_url('admin.php?page=get-quote-api-update&id='.$quote['data']['id'].'&noheader=true'); ?>" name="form" method="post">
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group">
                    <input type="text" name="author" value="<?php echo $quote['data']['author']; ?>" placeholder="Name" class="form-control">
                </div>
                <div class="form-group">
                    <textarea name="text" placeholder="Text Quote" class="form-control"><?php echo $quote['data']['text']; ?></textarea>
                </div>

                <button type="submit" name="submit" class="btn btn-success">Edit</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>