window.addEventListener("beforeunload", function (event) {
    const sale_id = document.getElementById('sale_id').value;
    // if (delete_sale_detail(sale_id)==true && delete_sale(sale_id)==true){
    //     this.alert('ยกเลิกรายการสำเร็จ');
    // }else{
    //     this.alert('ยกเลิกรายการไม่สำเร็จ');
    // }
    
    delete_sale_detail(sale_id).then((response) => {
        console.log(response);
    });
    delete_sale(sale_id).then((response) => {
        console.log(response);
    });
    
});
