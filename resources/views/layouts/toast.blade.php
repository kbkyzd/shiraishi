@if(session()->has('success'))
    <script>
        Materialize.toast('<i class="fa fa-check"></i><span>{{ session('success') }}</span>', 2000);
    </script>
@endif
@if(session()->has('status-error'))
    <script>
        Materialize.toast('<i class="fa fa-check"></i><span>{{ session('success') }}</span>', 2000);
    </script>
@endif
