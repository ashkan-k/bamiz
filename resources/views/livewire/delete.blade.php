<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {

    @this.on('triggerDelete', orderId => {
        Swal.fire({
            title: "هشدار ! ",
            icon: 'warning',
            text: "آیا می خواهید این آیتم حذف شود ؟ 🤔",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#00aced',
            cancelButtonColor: '#e6294b',
            confirmButtonText: 'تایید',
            cancelButtonText: 'انصراف'
        }).then((result) => {
            //if user clicks on delete
            if (result.value) {
                // calling destroy method to delete
            @this.call('destroy', orderId)
                // success response
                Swal.fire({
                    title: session('message'),
                    icon: 'success',
                    type: 'success'
                });

            }
        });
    });
    })
</script>
