<footer class="pull-left footer">
  <p class="col-md-12">
    <hr class="divider">
    Copyright &COPY; 2017 <a href="http://www.pingpong-labs.com"> - Dinas</a>
  </p>
</footer>
</div>
<script src="../assets/jquery-1.11.0.min.js"></script>
<script src="../assets/bootstrap.min.js"></script>
<script src="../assets/filter_table.js"></script>
<script src="../assets/pagination.js"></script>
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
