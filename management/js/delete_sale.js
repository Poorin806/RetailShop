
window.addEventListener("beforeunload", function (event) {
    var sale_id = document.getElementById("sale_id").value;
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "js/delete_sale.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            if (xhr.responseText == true) {
                alert('ยกเลิกรายการสำเร็จ');
            } else {
                alert('ยกเลิกรายการไม่สำเร็จ');
            }
        }
    };

    // Prepare data and send the request
    var data = "sale_id=" + encodeURIComponent(sale_id);
    xhr.send(data);
});
