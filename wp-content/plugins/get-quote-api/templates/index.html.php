<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Show Table</title>
    <style>
        #table {
            border-collapse: collapse;
        }
        #table > thead > tr > th {
            border: 1px solid black;
            padding: 0 3px;
            height: 40px;
        }
        #table > tbody > tr > td {
            border: 1px solid black;
            padding: 0 3px;
        }
    </style>
</head>
<body>
<div>
    <h3>Quotes Collection</h3>
    <table id="table">
        <thead>
        <tr>
            <th>Author Name</th>
            <th>Text Quote</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
            <?php foreach ($quotes['data'] as $quote): ?>
                <tr>
                    <td>
                        <a href="<?php echo admin_url('admin.php?page=get-quote-api-index&author='.$quote['author']); ?>">
                            <?php echo $quote['author'] ?>
                        </a>
                    </td>
                    <td>
                        <?php echo $quote['text'] ?>
                    </td>
                    <td>
                        <a href="<?php echo admin_url('admin.php?page=get-quote-api-edit&id='.$quote['id']); ?>">
                            Edit
                        </a>
                        <a href="<?php echo admin_url('admin.php?page=delete_quote_api&id='.$quote['id']); ?>">
                            Delete
                        </a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
</body>
</html>

