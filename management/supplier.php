<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retail Shop - Management</title>

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
                    <h1 class="fs-4 fw-bold m-0 p-0">
                        <i class="bi bi-person-badge-fill"></i>
                        จัดการข้อมูลตัวแทนจำหน่าย
                    </h1>
                </div>
                <div class="d-flex align-items-center column-gap-3">
                    <input type="text" name="ID" class="form-control" placeholder="ตัวแทนจำหน่าย" style="width: 200px;">
                    <input type="submit" value="ค้นหา" class="btn btn-primary">
                </div>
            </div>
            <!-- Table -->
            <div class="card-body container py-3">
                <table class="table table-striped table-hover mx-auto align-middle">
                    <thead>
                        <tr class="bg-dark">
                            <th class="fw-bold" style="width: 15%;">รหัสตัวแทนจำหน่าย</th>
                            <th class="fw-bold" style="width: 20%;">ชื่อร้าน</th>
                            <th class="fw-bold" style="width: 10%;">ที่อยู่</th>
                            <th class="fw-bold" style="width: 10%;">เบอร์โทร</th>
                            <th class="fw-bold" style="width: 15%;">จังหวัด</th>
                            <th class="fw-bold" style="width: 10%;">ชื่อผู้ติดต่อ</th>
                            <th class="text-end" style="width: 20%;">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>1</th>
                            <td>Mark</td>
                            <td>Mark</td>
                            <td>Mark</td>
                            <td>Mark</td>
                            <td>Mark</td>
                            <td class="text-end">
                                <a href="edit_supplier.php" class="text-decoration-none fs-3 me-2"><i class="bi bi-pencil-square text-warning"></i></a>
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

    <!-- Totoal Summarize -->
    <div class="container fixed-bottom mb-5">
        <p class="bg-secondary text-light p-2 m-0 rounded fw-bolder fs-6 position-absolute end-0 bottom-50" style="width: fit-content;">สรุปอะไรก็ตามแต่ xx หน่่วย</p>
    </div>

    <!-- Essentials JS -->
    <?php include_once "../import/js.php"; ?>
</body>
</html>