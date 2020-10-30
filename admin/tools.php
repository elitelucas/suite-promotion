<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Tools</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
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
  <div class="wrapper" id="app">

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>{{pageTitle()}}</h1>
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
              <h3 class="card-title">Settings</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form">
              <div class="card-body">
                <div class="form-group">
                  <label for="Name">Tool Name</label>
                  <input type="text" class="form-control" id="InputName" placeholder="Enter Name" v-model="currentTool.toolname">
                </div>
                <div class="form-group">
                  <label for="InputCategory">Category</label>
                  <input type="text" class="form-control" id="InputCategory" placeholder="Enter Category" v-model="currentTool.category">
                </div>

                <div class="form-group">
                  <p>Open link in...</p>
                  <select class="form-control" style="width: 100%;" v-model="currentTool.method">
                    <option value="New Tab">New Tab</option>
                    <option value="Iframe">Iframe</option>
                    <option value="Popup">Popup</option>
                    <option value="HTML">HTML</option>
                  </select>
                </div>
                <div class="form-group" v-show="showLink">
                  <label for="Link">Enter Link</label>
                  <input type="url" class="form-control" id="InputLink" placeholder="Enter Link" v-model="currentTool.link">
                </div>
                <div class="form-group" v-show="showDescription">
                  <label for="exampleInputID">Description</label>
                  <div class="mb-3">
                    <textarea id="description" class="textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" v-model="currentTool.description"></textarea>
                  </div>
                </div>

                <div class="form-group">
                  <label for="FileName">File Name(.php)</label>
                  <input type="text" class="form-control" id="InputFileName" placeholder="Enter File Name" v-model="currentTool.filename">
                </div>

              </div>
              <!-- /.card-body -->

            </form>
          </div>
          <!-- /.card -->

          <div class="card-footer">
            <template v-if="method === 'create'">
              <button type="submit" class="btn btn-success" @click="btnCreateTool()"><i class="fa fa-plus-circle"></i>
                Create Tool</button>
            </template>
            <template v-else-if="method === 'edit'">
              <button type="submit" class="btn btn-success" @click="btnEditTool()"><i class="fa fa-edit"></i>Edit
                Tool</button>
            </template>
            <button type="submit" class="btn btn-secondary" @click="btnCancel()">Cancel</button>
          </div>

          <br>

          <!--================================================== PROJECTS ==================================================-->

          <div class="card card-success">
            <div class="card-header">
              <h3 class="card-title">Tools</h3>
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
                    <input type="text" class="form-control" placeholder="Search for tools' Name, Category, Method" v-model="search">
                  </div>
                </div>
              </div>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th><input type="checkbox" @click="checkall($event)"></th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Method</th>
                    <th>Link</th>
                    <th>File</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(tool, index) in tools" :key="index" v-if="searched(index)">
                    <td> <input type="checkbox" :value="index" v-model="checkedTools"></td>
                    <td>{{tool.toolname}}</td>
                    <td>{{tool.category}}</td>
                    <td>{{tool.method}}</td>
                    <td><a target="_blank" :href="tool.link">{{tool.link}}</a>
                    <td>{{tool.filename}}.php</td>
                    </td>
                    <td>
                      <button class="btn btn-info btn-sm" @click="btnEditonRow(index)"><i class="fas fa-pencil-alt"></i>
                        Edit</button>
                      <button class="btn btn-danger btn-sm" @click="btnDeleteonRow(index)"><i class="fas fa-trash"></i>
                        Delete</a>
                    </td>
                  </tr>

                </tbody>
                <tfoot>
                  <tr>
                    <th><input type="checkbox" @click="checkall($event)"></th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Method</th>
                    <th>Link</th>
                    <th>File</th>
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
  <script src="../plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
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
  <script src="../src/js/tools.js?<?= time() ?>"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      bsCustomFileInput.init();
    });

    $(function() {
      // Summernote     
      $('#description').summernote({
        callbacks: {
          onChange: function(contents, $editable) {
            app.currentTool.description = contents;
          },
          onChangeCodeview: function(contents, $editable) {
            app.currentTool.description = contents;
          }
        }
      });
    })

    $(function() {
      //Initialize Select2 Elements
      $('.select2').select2()

      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })

      //Bootstrap Duallistbox
      $('.duallistbox').bootstrapDualListbox()

    })
  </script>
</body>

</html>