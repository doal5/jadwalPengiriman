<!-- jQuery -->
<script src="../assets/AdminLTE-3/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../assets/AdminLTE-3/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../assets/AdminLTE-3/dist/js/adminlte.min.js"></script>

<!-- jQuery UI 1.11.4 -->
<script src="../assets/AdminLTE-3/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- ChartJS -->
<script src="../assets/AdminLTE-3/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../assets/AdminLTE-3/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../assets/AdminLTE-3/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../assets/AdminLTE-3/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../assets/AdminLTE-3/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../assets/AdminLTE-3/plugins/moment/moment.min.js"></script>
<script src="../assets/AdminLTE-3/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../assets/AdminLTE-3/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../assets/AdminLTE-3/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../assets/AdminLTE-3/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../assets/AdminLTE-3/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../assets/AdminLTE-3/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../assets/AdminLTE-3/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../assets/AdminLTE-3/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../assets/AdminLTE-3/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../assets/AdminLTE-3/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../assets/AdminLTE-3/plugins/jszip/jszip.min.js"></script>
<script src="../assets/AdminLTE-3/plugins/pdfmake/pdfmake.min.js"></script>
<script src="../assets/AdminLTE-3/plugins/pdfmake/vfs_fonts.js"></script>
<script src="../assets/AdminLTE-3/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../assets/AdminLTE-3/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../assets/AdminLTE-3/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<!-- Page specific script -->
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "info": false,
            "bPaginate": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>

</body>

</html>