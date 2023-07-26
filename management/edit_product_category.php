<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการข้อมูลประเภทสินค้า</title>
    <!-- Essentials Css Icons -->
    <?php include_once "../import/css.php"; ?>

</head>

<body>
    <!-- Navbar -->
    <?php include_once "../import/navbar.php" ?>
    <div class="container my-5">
        <div class="title mb-3">
            <div class="text">
                <h1>แก้ไขข้อมูล<h class="text-primary">ประเภทสินค้า</h></h1>
                <h6>Edit Product Category Data</h6>
            </div>
        </div>
        <form action="" method="post">
            <div class="row">
                <div class="col-sm mb-3">
                    <label for="" class="form-label">ชื่อประเภทสินค้า</label>
                    <input type="text" name="" id="" class="form-control w-50" placeholder="">
                </div>
            </div>
            <input type="submit" value="บันทึก" class="btn btn-primary" name="submit">
            <input type="submit" value="ยกเลิก" class="btn btn-secondary" name="cancel">
        </form>
    </div>

    <?php include_once "../import/js.php"; ?>
</body>

</html>