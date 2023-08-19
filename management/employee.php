<?php

    // Connection
    include_once('../import/connect.php');

?>

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
        <div class="card mb-5" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
            <div class="card-header d-flex flex-column flex-sm-row align-items-center justify-content-between row-gap-1">
                <div>
                    <h1 class="fs-4 fw-bold m-0 p-0">
                        <i class="bi bi-person-lines-fill"></i>
                        จัดการข้อมูลพนักงาน
                    </h1>
                </div>
                <div class="d-flex align-items-center column-gap-3">
                    <input type="text" name="ID" id="searchEmployee" class="form-control" placeholder="ค้นหาพนักงาน" style="width: 200px;">
                    <a href="add_employee.php" class="btn btn-primary">เพิ่มข้อมูล</a>
                </div>
            </div>
            <!-- Table -->
            <div class="card-body container py-3">
                <table class="table table-striped table-hover mx-auto align-middle">
                    <thead>
                        <tr class="bg-dark">
                            <th class="fw-bold" style="width: 10%;">รหัสพนักงาน</th>
                            <th class="fw-bold" style="width: 30%;">ชื่อพนักงาน</th>
                            <th class="fw-bold" style="width: 20%;">สถานะ</th>
                            <th class="fw-bold" style="width: 20%;">ประเภทพนักงาน</th>
                            <th class="text-end" style="width: 20%;">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql = "SELECT * FROM employee";
                            $result = $con->query($sql);
                            while ($data = mysqli_fetch_array($result)) {
                                ?>
                                <tr>
                                    <th><?php echo $data['Emp_id'] ?></th>
                                    <td><?php echo $data['Emp_name'] ?></td>
                                    <td>
                                        <?php 
                                            if($data['Emp_status'] == 1)
                                                echo 'เข้าระบบได้';
                                            else{
                                                echo 'ไม่อนุญาตให้เข้าระบบ';
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php 
                                            if ($data['Emp_type'] == 1){
                                                echo 'พนักงาน';
                                            }
                                            else{
                                                echo 'เจ้าของกิจการ';
                                            }
                                        ?>
                                    </td>
                                    <td class="text-end">
                                        <a href="edit_employee.php?ID=<?php echo $data['Emp_id'] ?>" class="text-decoration-none fs-3 me-2"><i class="bi bi-pencil-square text-warning"></i></a>
                                        <a href="#" class="text-decoration-none fs-3" onclick="deleteConfirm('<?php echo $data['Emp_id'] ?>')"><i class="bi bi-trash-fill text-danger"></i></a>
                                    </td>
                                </tr>
                                <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- Footer Summarize -->
            <div class="card-footer text-end">
                <?php
                    $all_rows = mysqli_num_rows($result);
                ?>
                <p class="m-0 p-0">สรุปพนักงานทั้งหมด: <?php echo $all_rows ?> คน</p>
            </div>
        </div>
    </div>

    <!-- Totoal Summarize -->
    <div class="container fixed-bottom mb-5">
        <p class="bg-secondary text-light p-2 m-0 rounded fw-bolder fs-6 position-absolute end-0 bottom-50" style="width: fit-content;">สรุปพนักงานทั้งหมด <?php echo $all_rows ?> คน</p>
    </div>

    <!-- Essentials JS -->
    <script>

        function deleteConfirm(id) {
            Swal.fire({
                icon: 'question',
                title: 'ต้องการที่จะลบข้อมูลจริงหรือไม่?',
                showCancelButton: true,
                confirmButtonText: 'ยืนยัน',
                cancelButtonText: 'ยกเลิก',
                }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    window.location = 'delete.php?Employee=' + id
                }
            })
        }                            

        document.addEventListener("DOMContentLoaded", function () {
            const searchInput = document.getElementById('searchEmployee');
            const resultTable = document.querySelector('table tbody');

            searchInput.addEventListener('input', function () {
                const searchText = searchInput.value.trim();
                if (searchText === '') {
                    // ถ้าไม่มีข้อความในช่องค้นหาให้แสดงข้อมูลทั้งหมดอีกครั้ง
                    fetchAndShowData();
                } else {
                    // ถ้ามีข้อความในช่องค้นหาให้ส่งคำค้นหาไปหาเซิร์ฟเวอร์
                    fetchAndShowData(searchText);
                }
            });

            function fetchAndShowData(searchText = '') {
                // ส่งคำค้นหาไปหาเซิร์ฟเวอร์ด้วย AJAX
                const xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            const data = JSON.parse(xhr.responseText);
                            // แสดงผลลัพธ์ที่ได้รับกลับมา
                            showData(data);
                        } else {
                            console.error('เกิดข้อผิดพลาดในการค้นหา: ' + xhr.status);
                        }
                    }
                };
                xhr.open('GET', 'searching.php?employee_search=' + encodeURIComponent(searchText));
                xhr.send();
            }

            function showData(data) {
                // แสดงผลลัพธ์ในตาราง
                let html = '';
                for (const row of data) {
                    html += `<tr>
                                <th>${row.Emp_id}</th>
                                <td>${row.Emp_name}</td>
                                <td>${row.Emp_status == 1 ? 'เข้าสู่ระบบได้' : 'ไม่อนุญาตให้เข้าระบบ'}</td>
                                <td>${row.Emp_type == 1 ? 'พนักงาน' : 'เจ้าของกิจการ'}</td>
                                <td class="text-end">
                                    <a href="edit_employee.php?ID=${row.Emp_id}" class="text-decoration-none fs-3 me-2"><i class="bi bi-pencil-square text-warning"></i></a>
                                    <a href="#" class="text-decoration-none fs-3" onclick="deleteConfirm('${row.Emp_id}')"><i class="bi bi-trash-fill text-danger"></i></a>
                                </td>
                            </tr>`;
                }
                resultTable.innerHTML = html;
            }

            // โหลดข้อมูลเริ่มต้นเมื่อหน้าเว็บโหลด
            fetchAndShowData();
        });
    </script>
    
    <?php include_once "../import/js.php"; ?>
</body>
</html>