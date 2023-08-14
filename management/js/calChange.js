document.getElementById("receive_price").addEventListener("change", function() {
    var net_price = document.getElementById("net_price").value;
    var receive_price = document.getElementById("receive_price").value;
    var change = receive_price - net_price;
    
    document.getElementById("change_price").value = change.toFixed(2);
});