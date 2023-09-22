$('#delete-selected').on('click', function() {
    let selectedProducts = [];

    $('.product-checkbox:checked').each(function() {
        selectedProducts.push($(this).val());
    });

    if (selectedProducts.length === 0) {
        alert('Vui lòng chọn ít nhất 1 sản phẩm');
        return;
    }

    if (confirm('Bạn có chắc chắn sẽ xoá sản phẩm này chứ?')) {
        $.ajax({
            url: "{{ route('product.deleteMultiple') }}",
            method: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                "products": selectedProducts
            },
            success: function(response) {
                location.reload();
            },
            error: function(err) {
                alert('Có lỗi khi xoá. Vui lòng thử lại');
            }
        });
    }
});
