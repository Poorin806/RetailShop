<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retail Shop - Province Management</title>

    <!-- Essentials Css Icons -->
    <?php include_once "../import/css.php"; ?>
</head>
<body>

    <!-- Navbar -->
    <?php include_once "../import/navbar.php" ?>

    <div class="mt-5 container">
        <div class="card" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
            <div class="card-header d-flex flex-column flex-sm-row align-items-center justify-content-between row-gap-1">
                <div>
                    <h1 class="fs-4 fw-bold m-0 p-0">จัดการข้อมูลชั้นวางสินค้า</h1>
                </div>
                <div class="d-flex align-items-center column-gap-3">
                    <input type="text" name="ProvinceID" class="form-control" placeholder="จังหวัด" style="width: 200px;">
                    <input type="submit" value="ค้นหา" class="btn btn-primary">
                </div>
            </div>
            <!-- Table -->
            <div class="card-body container py-3">
                <table class="table table-striped table-hover mx-auto align-middle">
                    <thead>
                        <tr class="bg-dark">
                            <th class="fw-bold" style="width: 10%;">#</th>
                            <th class="fw-bold" style="width: 40%;">จังหวัด</th>
                            <th class="fw-bold" style="width: 20%;">รหัสกลุ่มจังหวัด</th>
                            <th class="text-end" style="width: 30%;">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td class="text-end">
                                <a href="#" class="text-decoration-none fs-3 me-2"><i class="bi bi-pencil-square text-warning"></i></a>
                                <a href="#" class="text-decoration-none fs-3"><i class="bi bi-trash-fill text-danger"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <!-- Add New -->
                <div class="text-end my-2">
                    <a href="#" class="btn btn-success">เพิ่มข้อมูล</a>
                </div>
            </div>
            <!-- Footer Summarize -->
            <div class="card-footer text-end">
                <p class="m-0 p-0">สรุป: ...</p>
            </div>
        </div>
    </div>

    <!-- Essentials JS -->
    <?php include_once "../import/js.php"; ?>
</body>
</html>