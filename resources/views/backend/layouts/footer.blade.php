<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src=" {{ asset('backend/assets/vendor/jquery/jquery-3.3.1.min.js') }}"></script>

<!-- bootstrap bundle js-->
<script src=" {{ asset('backend/assets/vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>
<!-- slimscroll js-->
<script src=" {{ asset('backend/assets/vendor/slimscroll/jquery.slimscroll.js') }}"></script>
<!-- chartjs js-->
<script src=" {{ asset('backend/assets/vendor/charts/charts-bundle/Chart.bundle.js') }}"></script>
<script src=" {{ asset('backend/assets/vendor/charts/charts-bundle/chartjs.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('backend/assets/vendor/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="{{ asset('backend/assets/vendor/datatables/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/assets/vendor/datatables/js/data-table.js') }}"></script>
<!-- main js-->
<script src=" {{ asset('backend/assets/libs/js/main-js.js') }}"></script>
<!-- jvactormap js-->
<script src=" {{ asset('backend/assets/vendor/jvectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
<script src=" {{ asset('backend/assets/vendor/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<!-- sparkline js-->
<script src=" {{ asset('backend/assets/vendor/charts/sparkline/jquery.sparkline.js') }}"></script>
<script src=" {{ asset('backend/assets/vendor/charts/sparkline/spark-js.js') }}"></script>
<!-- dashboard sales js-->
<script src=" {{ asset('backend/assets/libs/js/dashboard-sales.js') }}"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/rowgroup/1.0.4/js/dataTables.rowGroup.min.js"></script>
<script src="https://cdn.datatables.net/select/1.2.7/js/dataTables.select.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>
<script src="{{ asset('backend/assets/vendor/bootstrap-select/js/bootstrap-select.js') }}"></script>
<!--new -->
<script src=" {{ asset('backend/assets/vendor/parsley/parsley.js') }}"></script>
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<script>
    $('#form').parsley();
    </script>
    <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
    </script>