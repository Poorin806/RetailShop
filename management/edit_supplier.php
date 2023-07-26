<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการข้อมูลตัวแทนจำหน่าย</title>
    <!-- Essentials Css Icons -->
    <?php include_once "../import/css.php"; ?>

</head>

<body>
    <!-- Navbar -->
    <?php include_once "../import/navbar.php" ?>
    <div class="container my-5">
        <div class="title mb-3">
            <div class="text">
                <h1>แก้ไขข้อมูล<h class="text-primary">ตัวแทนจำหน่าย</h></h1>
                <h6>Edit Supplier Data</h6>
            </div>
        </div>
        <form action="" method="post">
            <div class="row">
                <div class="col-sm-2 mb-3">
                    <label for="" class="form-label">รหัสตัวแทนจำหน่าย</label>
                    <input type="text" name="" id="" class="form-control" placeholder="" disabled>
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="" class="form-label">ชื่อร้าน</label>
                    <input type="text" name="" id="" class="form-control" placeholder="">
                </div>
                <div class="col-sm-4">
                    
                </div>
                <div class="col-sm-4 mb-3">
                    <label for="" class="form-label">ที่อยู่</label>
                    <textarea class="form-control" name="" id="" rows="3"></textarea>
                </div>
                <div class="col-sm-4 mb-3">
                    <label for="" class="form-label">จังหวัด</label>
                    <select name="" id="" class="form-select">
                        <option value="">เลือกจังหวัด...</option>
                    </select>
                </div>
                <div class="col-sm-4">
                    
                </div>
                <div class="col-sm-3">
                    <label for="" class="form-label">เบอร์โทร</label>
                    <input type="tel" name="" id="" class="form-control" placeholder="">
                </div>
                <div class="col-sm-5 mb-3">
                    <label for="" class="form-label">ชื่อผู้ติดต่อ</label>
                    <input type="text" name="" id="" class="form-control" placeholder="">
                </div>
            </div>
            <input type="submit" value="บันทึก" class="btn btn-primary" name="submit">
            <input type="submit" value="ยกเลิก" class="btn btn-secondary" name="cancel">
        </form>
    </div>

    <?php include_once "../import/js.php"; ?>
</body>

</html>