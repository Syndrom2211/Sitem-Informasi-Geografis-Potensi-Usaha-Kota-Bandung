<footer class="pull-left footer">
  <p class="col-md-12">
    <hr class="divider">
    Copyright &COPY; 2017 <a href="http://www.pingpong-labs.com"> - Dinas</a>
  </p>
</footer>
</div>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="../assets/bootstrap.min.js"></script>
<script src="../assets/filter_table.js"></script>
<script src="../assets/pagination.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.print.min.js"></script>
<script type="text/javascript">
$(function () {
  var $kecamatan=$("#kecamatan");
  var $kelurahan=$("#kelurahan");
  $kecamatan.data('options', $kelurahan.html());
  $kecamatan.change(function(){
      var val=$kecamatan.val();
      var options = $($kecamatan.data('options')).filter('[data-id="'+val+'"]');
      $kelurahan.html(options);
  });

  $('#laporan_data').DataTable( {
          dom: 'Bfrtip',
          buttons: [
              'excel'
          ]
      } );

$('.navbar-toggle-sidebar').click(function () {
$('.navbar-nav').toggleClass('slide-in');
$('.side-body').toggleClass('body-slide-in');
$('#search').removeClass('in').addClass('collapse').slideUp(200);
});

$('#search-trigger').click(function () {
$('.navbar-nav').removeClass('slide-in');
$('.side-body').removeClass('body-slide-in');
$('.search-input').focus();
});
});
</script>
