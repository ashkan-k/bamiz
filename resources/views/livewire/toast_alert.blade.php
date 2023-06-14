@if (session()->has('toast_message'))
    <script>
        @if (session('toast_message_type') == 'error')
            showToast('{{ session('toast_message') }}', 'error');
        @else
            showToast('{{ session('toast_message') }}', 'success');
        @endif
    </script>
@endif
