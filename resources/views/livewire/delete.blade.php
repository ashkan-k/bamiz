<script>
    function Delete(key) {
        Swal.fire({
            title: "هشدار ! ",
            icon: 'warning',
            text: "آیا از حذف این آیتم اطمینان دارید؟🤔",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#00aced',
            cancelButtonColor: '#e6294b',
            confirmButtonText: 'حذف',
            cancelButtonText: 'انصراف'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#delete_form_' + key).submit();
            }
        })
    }
</script>
