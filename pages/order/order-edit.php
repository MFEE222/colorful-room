<!doctype html>
<html lang="en">

<head>
    <title>order edit</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="py-2 my-3">
                    <a href="./order-details.php" class="btn btn-danger">回訂單明細</a>
                </div>
                <form action="" method="post">
                    <div class="mb-3 input-group-sm">
                        <label for="order-num" class="form-label">訂單編號</label>
                        <input type="text" class="form-control" id="Order number" name="Order number" value="" readonly>
                    </div>
                    <div class="mb-3 input-group-sm">
                        <label for="order-status" class="form-label">訂單狀態</label>
                        <input type="text" class="form-control" id="order-status" name="order-status" value="">
                    </div>
                    <div class="mb-3 input-group-sm">
                        <label for="payment-status" class="form-label">付款狀態</label>
                        <input type="text" class="form-control" id="payment-status" name="payment-status" value="">
                    </div>
                    <div class="mb-3 input-group-sm">
                        <label for="payment-method" class="form-label">付款方式</label>
                        <input type="text" class="form-control" id="payment-method" name="payment-method" value="">
                    </div>
                    <div class="mb-3 input-group-sm">
                        <label for="sum" class="form-label">金額</label>
                        <input type="text" class="form-control" id="sum" name="sum" value="">
                    </div>
                    <div class="mb-3 input-group-sm">
                        <label for="discount" class="form-label">折扣</label>
                        <input type="text" class="form-control" id="discount" name="discount" value="">
                    </div>

                    <!-- Modal -->
                    <div>
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">取消</button>
                        <button type="submit" class="btn btn-outline-danger" href="member-edit.php">確定</button>
                    </div>
                            
                </form>

                <?php
                // endif; 
                ?>
            </div>
            <?php if (isset($_SESSION["customer"])) : ?>
                <?php unset($_SESSION["customer"]); ?>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>