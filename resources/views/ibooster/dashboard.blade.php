@extends('layout')

@section('css')
<link rel="stylesheet" href="/theme/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="/theme/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="/theme/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endsection

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Hasil Ukur HVC</h3>
          </div>
          <div class="card-body table-responsive">
            <table id="table_detail_hvc" class="table table-bordered table-hover text-center">
              <thead>
                <tr>
                    <th>#</th>
                    <th>No Internet</th>
                    <th>STO</th>
                    <th>Status</th>
                    <th>Created Date</th>
                    <th>Created Time</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data_hvc as $k_hvc => $v_hvc)
                <tr>
                    <td>{{ ++$k_hvc }}</td>
                    <td>{{ $v_hvc->no_inet }}</td>
                    <td>{{ $v_hvc->sto }}</td>
                    <td>{{ $v_hvc->oper_status }}</td>
                    <td>{{ $v_hvc->created_date }}</td>
                    <td>{{ $v_hvc->created_time }}</td>
                </tr>
                @endforeach
              </tbody>
              <tfoot>
                <tr>
                    <th>#</th>
                    <th>No Internet</th>
                    <th>STO</th>
                    <th>Status</th>
                    <th>Created Date</th>
                    <th>Created Time</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Hasil Ukur SUGAR</h3>
          </div>
          <div class="card-body table-responsive">
            <table id="table_detail_sugar" class="table table-bordered table-hover text-center">
              <thead>
                <tr>
                    <th>#</th>
                    <th>No Internet</th>
                    <th>STO</th>
                    <th>Status</th>
                    <th>Created Date</th>
                    <th>Created Time</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data_sugar as $k_sugar => $v_sugar)
                <tr>
                    <td>{{ ++$k_sugar }}</td>
                    <td>{{ $v_sugar->no_inet }}</td>
                    <td>{{ $v_sugar->sto }}</td>
                    <td>{{ $v_sugar->oper_status }}</td>
                    <td>{{ $v_sugar->created_date }}</td>
                    <td>{{ $v_sugar->created_time }}</td>
                </tr>
                @endforeach
              </tbody>
              <tfoot>
                <tr>
                    <th>#</th>
                    <th>No Internet</th>
                    <th>STO</th>
                    <th>Status</th>
                    <th>Created Date</th>
                    <th>Created Time</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection

@section('js')
<script src="/theme/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/theme/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/theme/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="/theme/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="/theme/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="/theme/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="/theme/plugins/jszip/jszip.min.js"></script>
<script src="/theme/plugins/pdfmake/pdfmake.min.js"></script>
<script src="/theme/plugins/pdfmake/vfs_fonts.js"></script>
<script src="/theme/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="/theme/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="/theme/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script type="text/javascript">
    $(function () {
        $("#table_detail_hvc").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf"]
        })
        .buttons()
        .container()
        .appendTo('#table_detail_hvc_wrapper .col-md-6:eq(0)');

        $("#table_detail_sugar").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf"]
        })
        .buttons()
        .container()
        .appendTo('#table_detail_sugar_wrapper .col-md-6:eq(0)');
    });
</script>
@endsection
