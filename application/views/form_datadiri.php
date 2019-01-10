<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>TEST FOR FRONT END PROGRAMMER</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
   <!-- <link rel="stylesheet" href="http://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"> -->
  <!-- Bootstrap 3.3.6 -->
 <!-- <link rel="stylesheet" href="<?=base_url('asset/css/bootstrap.min.css')?>"> -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url('asset/css/AdminLTE.min.css')?>">
  <link rel="stylesheet" href="<?=base_url('asset/css/skins/_all-skins.min.css')?>">
<!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?=base_url('asset/plugins/datepicker/datepicker3.css')?>">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?=base_url('asset/plugins/datatables/dataTables.bootstrap.css')?>">
  <link rel="stylesheet" href="<?=base_url('asset/plugins/datatables/jquery.dataTables.css')?>">
  <link rel="stylesheet" href="<?=base_url('asset/plugins/datatables/jquery.dataTables.min.css')?>">
  <link rel="stylesheet" href="<?=base_url('asset/plugins/datatables/jquery.dataTables_themeroller.css')?>">
 
</head>
<body class="skin-blue layout-top-nav" style="height: auto;">
<div class="wrapper">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="min-height: 281px;">
    <!-- Content Header (Page header) -->
    <div class="container">
    <section class="content-header" >
      <h1>
        Form Data Diri
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Isi form di bawah ini</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="<?=site_url('data_diri/add_data')?>" method="post" enctype="multipart/form-data">
              <div class="box-body">
              	<div class="form-group">
                  <label>Name:</label>  
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-user"></i>
                  </div>              
                  <input type="text" class="form-control" id="name" name="nama" placeholder="Enter Name" pattern="[a-zA-Z]{1,}" required>
                </div>
                </div>
                <div class="form-group">
                <label>BirthDate:</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control" id="birthdate" name="tgllahir" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask>
                </div>
                </div>
                <div class="form-group">
                  <label>Address:</label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-map-marker"></i>
                  </div>
                  <input type="text" class="form-control" id="address" name="alamat" placeholder="Enter Address">
                </div>
                </div>
                <div class="form-group">
                  <label>Email:</label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-envelope"></i>
                  </div>
                  <input type="email" class="form-control" id="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" placeholder="you@example.com" required>
                </div>
                </div>
                <div class="form-group">
                  <label>Photo:</label>
                  <input type="file" id="inputfile" name="filefoto">

                  <p class="help-block">only .jpg and max 2Mb.</p>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" name="uploadimg"class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
        </div>  
      </div>

      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Data User</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="luk_dat" class="table table-bordered">
              <thead>
                <tr>
                  <th>Name</th>
                   <th>BirthDate</th>
                   <th>Address</th>
                   <th>Email</th>
                   <th>Photo</th>
                   <th>Aksi</th>
                 </tr>
              </thead>

              <tbody>
                  <?php foreach($res as $set){?>
                <tr>
                  <td class="ctr"><?=$set->name?></td>
                  <td class="ctr"><?=$set->birthdate?></td>
                  <td><?=$set->address?></td>
                  <td><?=$set->email?></td>
                  <td><?=$set->photo?></td>
                  <td>
                    <div class="btn-group">
                      <!-- <button type="button" class="btn btn-info btn-lg" id="myBtn">Open Modal</button> -->
                      <a href="#" onclick="return edit_user('<?=$set->id?>')" class="btn btn-info btn-s"><i class="glyphicon glyphicon-pencil" style="margin-left: 0px; color: #fff"></i></a>
                      <a href="#" onclick="return delete_user('<?=$set->id?>')" class="btn btn-danger btn-s"><i class="fa fa-trash-o" style="margin-left: 0px; color: #fff"></i> </a>
                    </div>
                  </td>
                </tr>
                 <?php } ?>
              </tbody>
            </table>
        </div>
      </div>
      <!-- /.row -->

<!-- Modal edit -->
<div id="ed_user" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Data User</h4>
      </div>
      <form action="<?=site_url('data_diri/update_data')?>" method="post">
      <div class="modal-body">
        <div class="form-group">
                  <label>Name:</label>  
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-user"></i>
                  </div>              
                  <input type="text" class="form-control" id="nama" name="nama" placeholder="Enter Name" pattern="[a-zA-Z]{1,}" required>
                </div>
                </div>
                <div class="form-group">
                <label>BirthDate:</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control" id="tgllahir" name="tgllahir" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask>
                </div>
                </div>
                <div class="form-group">
                  <label>Address:</label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-map-marker"></i>
                  </div>
                  <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Enter Address">
                </div>
                </div>
                <div class="form-group">
                  <label>Email:</label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-envelope"></i>
                  </div>
                  <input type="email" class="form-control" id="alamatemail" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" placeholder="you@example.com" required>
                </div>
                </div>
                  
          <input type="hidden" name="id" id="id" class="form-control" >
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" >Ubah</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>
<!--tutupmodal-->
</section>    
    <!-- /.content -->
</div>
</div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; 2019 <a href="https://www.instagram.com/luluk.maslukhah/">Luluk M</a>.</strong> All rights
    reserved.
  </footer>

</div>
<!-- ./wrapper -->
<script> var base_url="<?=base_url()?>";</script>
<!-- jQuery 2.2.3 -->
<script src="<?=base_url('asset/plugins/jQuery/jquery-2.2.3.min.js')?>"></script>
<!-- Bootstrap 3.3.6 -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
<script src="<?=base_url('asset/js/bootstrap.min.js')?>"></script>
<script src="<?=base_url('asset/js/bootstrap.js')?>"></script>
<!-- FastClick -->
<script src="<?=base_url('asset/plugins/fastclick/fastclick.js')?>"></script>
<script src="<?=base_url('asset/js/app.min.js')?>"></script>
<script src="<?=base_url('asset/js/demo.js')?>"></script>
<script src="<?=base_url('asset/plugins/datepicker/bootstrap-datepicker.js')?>"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
<script src="http://code.jquery.com/ui/1.9.2/jquery-ui.min.js"></script>
<!-- <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script> -->
<!-- InputMask -->
<script src="<?=base_url('asset/plugins/input-mask/jquery.inputmask.js')?>"></script>
<script src="<?=base_url('asset/plugins/input-mask/jquery.inputmask.date.extensions.js')?>"></script>
<script src="<?=base_url('asset/plugins/input-mask/jquery.inputmask.extensions.js')?>"></script>
<script src="<?=base_url('asset/plugins/datatables/jquery.dataTables.js')?>"></script>
<script src="<?=base_url('asset/plugins/datatables/jquery.dataTables.min.js')?>"></script>
<script src="<?=base_url('asset/plugins/datatables/dataTables.bootstrap.js')?>"></script>
<script src="<?=base_url('asset/plugins/datatables/dataTables.bootstrap.min.js')?>"></script>
<script src="<?=base_url('asset/js/ajx_kly.js')?>"></script>
<script>
$(function () {
  //Datemask yyyy/mm/dd
    $("#datemask").inputmask("yyyy/mm/dd", {"placeholder": "yyyy/mm/dd"});

    $("[data-mask]").inputmask();
});
</script>
<script>
$(document).ready(function(){
    $('#luk_dat').DataTable();
});
</script>

</body>
</html>
