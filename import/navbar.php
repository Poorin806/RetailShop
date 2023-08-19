<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-primary w-100" data-bs-theme="dark" 
    style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
            <?php
                if ($CurrentPage == "index.php") {
                    echo "position: fixed; z-index:999; top:0;";
                }
            ?>
    "
>
    <div class="container align-items-center">
        <a class="navbar-brand fw-bold" href="/RetailShop/">Retail Shop</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-nav-item" aria-controls="main-nav-item" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse ms-auto" id="main-nav-item">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link text-light" href="/RetailShop/index.php">หน้าหลัก</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        จัดการระบบทั่วไป
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item text-light" href="/RetailShop/management/province.php">จัดการ จังหวัด</a></li>
                        <li><a class="dropdown-item text-light" href="/RetailShop/management/shelf.php">จัดการ ชั้นวางสินค้า</a></li>
                        <li><a class="dropdown-item text-light" href="/RetailShop/management/product_category.php">จัดการ ประเภทสินค้า</a></li>
                        <li><a class="dropdown-item text-light" href="/RetailShop/management/employee.php">จัดการ ข้อมูลพนักงาน</a></li>
                        <li><a class="dropdown-item text-light" href="/RetailShop/management/customer.php">จัดการ ข้อมูลลูกค้า</a></li>
                        <li><a class="dropdown-item text-light" href="/RetailShop/management/supplier.php">จัดการ ข้อมูลตัวแทนจำหน่าย</a></li>
                        <li><a class="dropdown-item text-light" href="/RetailShop/management/product.php">จัดการ ข้อมูลสินค้า</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        จัดการสินค้า
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item text-light" href="/RetailShop/management/sale.php">ขายสินค้า</a></li>
                        <li><a class="dropdown-item text-light" href="/RetailShop/management/return.php">คืนสินค้า</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo $_SESSION['Emp_name'] ?>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item text-light" href="#" onclick="Logout()">ออกจากระบบ</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<script>

    function Logout() {
        Swal.fire({
        icon: 'success',
        title: 'ออกจากระบบสำเร็จ',
        confirmButtonText: 'ตกลง'
        }).then(result => {
            window.location = '<?php echo $rootDirectory ?>logout.php';
        });
    }

</script>