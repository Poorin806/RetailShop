function deleteRow(pro_id) {
    console.log("pro_id in deleteRow:", pro_id);
    var sale_id = document.getElementById("sale_id").value;
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "js/delete_product.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            if(xhr.responseText=='true'){
                fetchDataAndRefreshTable(sale_id);
                console.log('refresh table');
                document.getElementById("pro_id").focus();
            }else{
                console.log('Can not refresh table');
            }
        }
    };

    // Prepare data and send the request
    var data = "sale_id=" + encodeURIComponent(sale_id) + "&pro_id=" + encodeURIComponent(pro_id);
    xhr.send(data);
    console.log(data);
}
