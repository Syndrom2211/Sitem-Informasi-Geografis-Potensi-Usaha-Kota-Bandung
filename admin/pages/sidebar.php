<div class="col-md-2 sidebar">
  <div class="row">
    <!-- uncomment code for absolute positioning tweek see top comment in css -->
    <div class="absolute-wrapper"> </div>
    <!-- Menu -->
    <div class="side-menu">
      <nav class="navbar navbar-default" role="navigation">
        <!-- Main Menu -->
        <div class="side-menu-container">
          <ul class="nav navbar-nav">
            <li class="active"><a href="index.php"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
            <li><a href="data_akunusaha.php"><span class="glyphicon glyphicon-plane"></span> Data Pengusaha</a></li>
            <li><a href="data_wilayah.php"><span class="glyphicon glyphicon-cloud"></span> Data Wilayah</a></li>

            <!-- Dropdown-->
            <li class="panel panel-default" id="dropdown">
              <a data-toggle="collapse" href="#dropdown-lvl1">
                <span class="glyphicon glyphicon-user"></span> Data Usaha <span class="caret"></span>
              </a>

              <!-- Dropdown level 1 -->
              <div id="dropdown-lvl1" class="panel-collapse collapse">
                <div class="panel-body">
                  <ul class="nav navbar-nav">
                    <li><a href="data_u_pengusaha.php">Oleh Pengusaha</a></li>
                    <li><a href="data_u_dinas.php">Oleh Dinas</a></li>
                  </ul>
                </div>
              </div>
            </li>

            <!-- Dropdown-->
            <li class="panel panel-default" id="dropdown">
              <a data-toggle="collapse" href="#dropdown-lvl2">
                <span class="glyphicon glyphicon-user"></span> Data Master <span class="caret"></span>
              </a>

              <!-- Dropdown level 1 -->
              <div id="dropdown-lvl2" class="panel-collapse collapse">
                <div class="panel-body">
                  <ul class="nav navbar-nav">
                    <li><a href="data_kecamatan.php">Kecamatan</a></li>
                    <li><a href="data_kelurahan.php">Kelurahan</a></li>
                    <li><a href="data_skala.php">Skala Usaha</a></li>
                    <li><a href="data_sektor.php">Sektor Usaha</a></li>
                  </ul>
                </div>
              </div>
            </li>
              <li><a href="data_laporan.php"><span class="glyphicon glyphicon-cloud"></span> Data Laporan Usaha</a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </nav>

    </div>
  </div>
</div>
