@extends('layouts.app')

@section('content')
@push('top')
    
<style type="text/css">
    html, body{
        height:100%;
        padding:0px;
        margin:0px;
        
    }
.dataTables_filter {
  margin-bottom: 10px;
}

.dt-buttons {
  margin-bottom: 10px;
  color:#fff;
}
.dataTables_wrapper .dataTables_paginate {
  margin-top: 20px;
  margin-bottom: 20px; /* Tambahkan margin bawah */
}
table.dataTable td {
    padding: 0px 0px !important; /* Kurangi padding default */
    vertical-align: middle;      /* Pastikan teks tetap di tengah */
  }
  table.dataTable {
    border: 1px solid #dee2e6;
  }
  table.dataTable th, table.dataTable td {
    border: 1px solid #dee2e6;
  }

  /* Ganti warna latar belakang header */
#myTable thead th {
    background-color: #ebf5fb;
     /* Warna teks putih */
    font-size:10px !important;
}
.bg-th{
  background-color: #ebf5fb;
}

#myTable thead th {
    padding: 5px;
} 

  #myTable tbody td  {
   font-size:12px !important;
   color: #2d2c2c
   
}
#pdf-viewer-modal .modal-dialog {
        max-width: 90%;
        margin: 1.75rem auto;
    }
    #pdf-viewer-modal .modal-body {
        height: 80vh;
        overflow-y: auto;
        padding: 0;
    }
    #pdf-canvas {
        width: 100%;
        display: block;
        margin: 0 auto;
    }
</style>
<link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.2.1/css/buttons.dataTables.css" />
@endpush
<div class="page-inner">
    <div
      class="d-flex align-items-left align-items-md-center flex-column flex-md-row  pb-2"
    >
      <div class="d-flex align-items-center gap-4">

        <h6 class="op-7 mb-2">Permissions </h6>
       
        </div> 
     
    </div>
    <div class="row">
     
      <div class="col-sm-12 col-md-12">
      <div class="card ">
               
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="myTable">
              <thead>
                <tr>  
                  <th  class="bg-th">Name</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
      </div> 
    </div>
    </div>
  </div>

  <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
     
      </div>
    </div>
  </div>
  
@endsection

@push('bottom')
<!-- Bootstrap 5 + DataTables -->
<script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<!-- DataTables Buttons Scripts -->
<script src="https://cdn.datatables.net/buttons/3.2.1/js/dataTables.buttons.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.1/js/buttons.dataTables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.1/js/buttons.print.min.js"></script>

<script>

function viewDelete(param){
  $(".modal-content").html("");
$.ajax({
  url: "{{ route('user-delete', ':id') }}".replace(':id', param), // Ganti dengan route yang sesuai
    type: "GET",
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function(response) {
    
      $(".modal-content").html("");
      $(".modal-content").html(response);
      
    },
    error: function(xhr) {
        alert('An error occurred: ' + xhr.responseText);
    }
});
}

 $(document).ready(function() {
  var table = $('.table').DataTable({
          processing: true,
          serverSide: true,
          stateSave: true,
          pageLength: 30,  // Ini mengatur default jumlah data per halaman
          lengthMenu: [ [10, 25, 50, 100], [10, 25, 50, 100] ], 
          language : {
                sLengthMenu: "Show _MENU_"
            },
      
          ajax: {
            //mdr tidak ada kondisi
            url : "{{ route('get-permission') }}",
          },
          dom: '<"d-flex flex-column"<"mb-2"B><"d-flex justify-content-between"lf>>rtip',
          buttons: [
            { extend: 'excelHtml5', text: 'Export Excel', className: 'btn btn-success btn-sm' },
            { extend: 'pdfHtml5', text: 'Export PDF', className: 'btn btn-danger btn-sm' },
            { extend: 'print', text: 'Print', className: 'btn btn-primary btn-sm' }
          ],
          columns: [
              { data: 'name', name: 'name' },
              // { data: 'action', name: 'action', orderable: false, searchable: false } ,
             ],
            
      });
    });
    </script>

  
@endpush