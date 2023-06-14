@if (session()->has('message'))
    <script>
        Swal.fire({
            title: "تبریک ! 🥳",
            icon: 'success',
            text: '{{ session('message') }}',
            type: "success",
            cancelButtonColor: 'var(--primary)',
            confirmButtonText: 'اوکی',
        })
    </script>
@endif
