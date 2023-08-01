function calPricePerAmount() {
    var amount = document.getElementById("pro_amount").value;
    var saleprice = document.getElementById("pro_saleprice").value;
    
    var total_saleprice = amount * saleprice;
    document.getElementById("total_per_pro").value = total_saleprice.toFixed(2);
}
document.getElementById("pro_amount").addEventListener("change", calPricePerAmount);