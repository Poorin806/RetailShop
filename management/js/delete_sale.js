window.addEventListener("beforeunload", function (event) {
    var sale_id = document.getElementById("sale_id").value;
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "js/delete_sale.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            console.log(xhr.responseText);
            if (xhr.responseText == 'delete_success') {
                alert('ยกเลิกรายการสำเร็จ');
            } else if (xhr.responseText == 'sale_done'){
                alert('รายการขายนี้สำเร็จแล้ว');
            } else {
                alert('ยกเลิกรายการไม่สำเร็จ หรือยังไม่ได้เริ่มการขาย');
            }
        }
    };

    // Prepare data and send the request
    var data = "sale_id=" + encodeURIComponent(sale_id);
    xhr.send(data);
});
