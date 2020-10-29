<?php
require_once '../initial.php';
require_once '../db/Social.php';
$social = new Social();
$allPlugins = $social->loadAll();
$networks = [];
foreach ($allPlugins as $obj)
  array_push($networks, $obj['network']);
$networks = array_unique($networks);
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="../plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../src/css/adminlte.min.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition layout-top-nav">
  <div class="wrapper">

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" id="app">

      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>{{modalTitle()}}</h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">

          <!-- general form elements -->
          <div class="card card-success">
            <div class="card-header">
              <h3 class="card-title">Branding</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form">
              <div class="card-body">
                <div class="form-group">
                  <label for="linkID">Custom ID</label>
                  <input type="text" class="form-control" id="linkID" placeholder="Enter ID" v-model="currentlink.id">
                </div>
                <div class="form-group">
                  <label for="banner">Custom Banner</label>
                  <div class="mb-3">
                    <textarea id="banner" name="banner" class="textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                  </div>
                </div>

                <div class="form-group">
                  <label for="exampleInputFile">Custom Widget Image</label>

                  <p>
                    <div class="input-group">
                      <input type="url" class="form-control" id="imageURL" placeholder="Enter Image URL" v-model="currentlink.imageURL">
                    </div>
                  </p>
                  <p>-OR-</p>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="exampleInputFile">
                      <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text" id="">Upload</span>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->

            </form>
          </div>
          <!-- /.card -->

          <div class="card card-success">
            <div class="card-header">
              <h3 class="card-title">Networks</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label>Choose Networks</label>
                    <select class="duallistbox" id="networks" multiple="multiple">
                      <?php foreach ($networks as $idx => $network) : ?>
                        <option value="<?= $network ?>"><?= $network ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <!-- /.form-group -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <div class="card card-success">
            <div class="card-header">
              <h3 class="card-title">Actions</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label>Choose Actions Type</label>
                    <select class="duallistbox" id="actions" multiple="multiple">
                      <?php foreach ($allPlugins as $idx => $plugin) : ?>
                        <option value="<?= $plugin['type'] ?>"><?= $plugin['type'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <!-- /.form-group -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <div class="card-footer">
            <template v-if="method === 'create'">
              <button type="submit" class="btn btn-success" @click="createLink()"><i class="fa fa-plus-circle"></i>
                Create Link</button>
            </template>
            <template v-else-if="method === 'edit'">
              <button type="submit" class="btn btn-success" @click="updateLink()"><i class="fa fa-edit"></i>Edit
                Link</button>
            </template>
            <button type="submit" class="btn btn-secondary" @click="showClear()">Cancel</button>
          </div>

          <br>


          <!--================================================== PROJECTS ==================================================-->

          <div class="card card-success">
            <div class="card-header">
              <h3 class="card-title">Links</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-sm-8">
                  <button class="btn btn-danger" @click="btnDelSelected()"><i class="fas fa-trash"></i>Delete Selected</button>
                </div>
                <div class="col-sm-4">
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-search"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Search for links' ID, Networks, Actions" v-model="search">
                  </div>
                </div>
              </div>

              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th><input type="checkbox" @click="checkall($event)"></th>
                    <th>Widget Image</th>
                    <th>ID</th>
                    <th style="width:15%">Networks</th>
                    <th style="width:25%">Actions</th>
                    <th style="width:25%">Link</th>
                    <th style="width:15%">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(link, index) in links" :key="index" v-if="searched(index)">
                    <td> <input type="checkbox" :value="index" v-model="checkedLinks"></td>
                    <td><img width="150px" :src="link.imageURL" alt="Widget-Image"></td>
                    <td>{{link.id}}</td>
                    <td>{{getStringFromArray(link.networks)}}</td>
                    <td>{{getStringFromArray(link.actions)}}</td>
                    <td><a target="_blank" :href="getLinkFromId(link.id)">{{getLinkFromId(link.id)}}</a>
                    </td>
                    <td>
                      <button class="btn btn-info btn-sm" @click="editLink(link.id)"><i class="fas fa-pencil-alt"></i>
                        Edit</button>
                      <button class="btn btn-danger btn-sm" @click="deleteLink(link.id)"><i class="fas fa-trash"></i>
                        Delete</a>
                    </td>
                  </tr>

                </tbody>
                <tfoot>
                  <tr>
                  <th><input type="checkbox" @click="checkall($event)"></th>
                    <th>Widget Image</th>
                    <th>ID</th>
                    <th>Networks</th>
                    <th>Actions</th>
                    <th>Link</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->


        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <div class="float-right d-none d-sm-block">
        <b>Version</b> 3.0
      </div>
      <strong>Copyright &copy; 2020 <a href="https://suite.social">Social Suite</a>.</strong> All rights reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- bs-custom-file-input -->
  <script src="../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
  <!-- Select2 -->
  <script src="../plugins/select2/js/select2.full.min.js"></script>
  <!-- Bootstrap4 Duallistbox -->
  <script src="../plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.js"></script>
  <!-- Bootstrap Switch -->
  <script src="../plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../src/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../src/js/demo.js"></script>
  <!-- Summernote -->
  <script src="../plugins/summernote/summernote-bs4.min.js"></script>
  <!-- Vue.js -->
  <script src="../src/js/vue.js"></script>
  <script src="../src/js/links.js?<?= time() ?>"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      bsCustomFileInput.init();
    });

    $(function() {
      // Summernote
      $('#banner').summernote({
        callbacks: {
          // onChange: function(e) {
          //   app.currentlink.banner = $(this).val();
          // }
          onChange: function(contents, $editable) {
            app.currentlink.banner = contents;
          },
          onChangeCodeview: function(contents, $editable) {
            app.currentlink.banner = contents;
          }
        }
      })
    })

    //Bootstrap Duallistbox
    var bdnetworks, bdactions;
    $(function() {
      bdnetworks = $('.duallistbox#networks').bootstrapDualListbox()
      bdactions = $('.duallistbox#actions').bootstrapDualListbox()

      $('.duallistbox#networks').on('change', function() {
        app.currentlink.networks = $(this).val();
      })

      $('.duallistbox#actions').on('change', function() {
        app.currentlink.actions = $(this).val();
      })
    });

    function setFormFromCurrentLink() {
      //id-vmodel
      $('#banner').summernote('code', app.currentlink.banner); //banner 
      //imageULR-vmodel

      //networks
      $('.duallistbox#networks option').each(function(index) {
        $(this).removeAttr('selected')
        if (app.currentlink.networks.indexOf($(this).attr('value')) != -1)
          $(this).attr('selected', 'selected')
      });
      bdnetworks.bootstrapDualListbox('refresh');

      //actions
      $('.duallistbox#actions option').each(function(index) {
        $(this).removeAttr('selected')
        if (app.currentlink.actions.indexOf($(this).attr('value')) != -1)
          $(this).attr('selected', 'selected')
      });
      bdactions.bootstrapDualListbox('refresh');

    }
  </script>
</body>

</html>