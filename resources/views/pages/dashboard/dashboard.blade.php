@extends('layouts.app')

@section('content')
@push('top')
    <style>
 #progressTable {
      font-size:12px;
      width: 100%;
      border-radius: 4px;
      text-align: center;
      font-family: Arial, sans-serif;
    }
    #progressTable th, #progressTable td {
      border: 1px solid #a18d8d;
      padding: 8px;
    }
    #progressTable th {
      background-color: #6a1b9a;
      color: white;
    }
    .row-physical {
      background-color: #cb4335;
      color: white;
    }
    .row-plan {
      background-color: #2e86c1;
      color: white;
    }
      </style>
@endpush

<div class="page-inner">
    <div
      class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
    >
      <div>
        <h3 class="fw-bold mb-3">Dashboard</h3>
        <h6 class="op-7 mb-2">Admin Dashboard</h6>
      </div>
      <div class="ms-md-auto py-2 py-md-0">
        {{-- <a href="#" class="btn btn-label-info btn-round me-2">Manage</a>
        <a href="#" class="btn btn-primary btn-round">Add Customer</a> --}}
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12 col-md-12">
        <div class="card">
          <div class="card-header d-flex flex-column flex-lg-row align-items-center justify-content-between">
            <div class="card-title fw-bold mb-2 mb-lg-0">S-Curve</div>
            <div class="d-flex flex-wrap align-items-center w-70 justify-content-end">
              <div class="me-3 mb-2 mb-lg-0 d-flex align-items-center">
                <label for="category" class="me-2 mb-0 fw-bold">Category</label>
                <select class="form-control form-control-sm" id="category" name="category">
                  <option value="all">All</option>
                  @foreach ($data_sub_category as $item_sub_category)
                    <option value="{{ $item_sub_category->description }}">{{ $item_sub_category->description }}</option>
                  @endforeach
                </select>
              </div>
              <div class="me-3 mb-2 mb-lg-0 d-flex align-items-center">
                <label for="tanggal_awal" class="me-2 mb-0 fw-bold">Tanggal Awal:</label>
                <input type="date" id="tanggal_awal" class="form-control form-control-sm" style="width: 150px;">
              </div>
              <div class="me-3 mb-2 mb-lg-0 d-flex align-items-center">
                <label for="tanggal_akhir" class="me-2 mb-0 fw-bold">Tanggal Akhir:</label>
                <input type="date" id="tanggal_akhir" class="form-control form-control-sm" style="width: 150px;">
              </div>
              <div class="d-flex">
                <button class="btn btn-primary btn-sm" id="filterBtnSCurve">Filter</button>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="chart-container" id="chart-container-1">
              <canvas id="multipleLineChart" ></canvas>
            </div>

            <table id="progressTable">
              <thead>
                <tr id="tableHeader"></tr>
              </thead>
              <tbody id="tableBody"></tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="card">
          <div class="card-header d-flex align-items-center justify-content-between">
            <div class="card-title">Pie Chart - Surat</div>
            <div class="d-flex align-items-center">
              <label for="start_date" class="me-2 mb-0">Tanggal Awal:</label>
              <input type="date" id="start_date" class="form-control form-control-sm me-3" style="width: 150px;">
              
              <label for="end_date" class="me-2 mb-0">Tanggal Akhir:</label>
              <input type="date" id="end_date" class="form-control form-control-sm me-3" style="width: 150px;">
              
              <button class="btn btn-primary btn-sm" id="filterBtn">Filter</button>
            </div>
          </div>
          <div class="card-body row">
            <div class="chart-container col-md-4">
              <canvas
                id="pieChart1"
                style="width: 50%; height: 50%"
              ></canvas>
            </div>
            <div class="chart-container col-md-4">
              <canvas
                id="pieChart2"
                style="width: 50%; height: 50%"
              ></canvas>
            </div>
            <div class="chart-container col-md-4">
              <canvas
                id="pieChart3"
                style="width: 50%; height: 50%"
              ></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
   
  </div>
@endsection

@push('bottom')
<script src="{{ asset('assets/js/plugin/chart.js/chart.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

//S_CURVEEEEE
<script>

  $("#filterBtnSCurve").click(function() {
    let valid = true;
    // if($("#tanggal_awal").val() == ""){
    //   $("#tanggal_awal").addClass("is-invalid");
    //   valid = false
    // }
    // if($("#tanggal_akhir").val() == ""){
    //   $("#tanggal_akhir").addClass("is-invalid");
    //   valid = false
    // }
    
    if(valid) {
      resetTable();
      resetChartContainer(); 
  
      showChart($("#tanggal_awal").val(),$("#tanggal_akhir").val(),$("#category").val());
    }
   
  });
  
  
  function resetChartContainer() {
    const chartContainer = document.getElementById("chart-container-1");
    
    // Hapus semua elemen dalam chart container
    chartContainer.innerHTML = "";
  
    // Buat elemen canvas baru
    const newCanvas = document.createElement("canvas");
    newCanvas.setAttribute("id", "multipleLineChart");
    chartContainer.appendChild(newCanvas);
  }
  
  showChart('', '','all')
  function showChart(param_tgl_awal, param_tgl_akhir,param_category){
  
    $.ajax({
      url: "{{route('s-curve-chart-data')}}",
      data: {
        start_date: param_tgl_awal,
        end_date: param_tgl_akhir,
        category: param_category,
      },
      method:"GET",
      success:function(response){
       
        if(response.status == 'ok'){
          curveChart(response)
  
            // Create table header
          const tableHeader = document.getElementById("tableHeader");
          const thWeek = document.createElement("th");
          thWeek.innerText = "Week";
          tableHeader.appendChild(thWeek);
  
          response.weeks.forEach(week => {
            const th = document.createElement("th");
            th.innerText = week;
            tableHeader.appendChild(th);
          });
  
          const tableBody = document.getElementById("tableBody");
            // Add rows for Physical and Plan
            createRow("Planned", response.planned, "row-physical");
            createRow("Actual",  response.actual, "row-plan");
  
        }else{
          alert("Terjadi Kesalahan")
        }
      }
    })
  }
  
  function resetTable() {
    document.getElementById("tableHeader").innerHTML = ""; // Kosongkan header tabel
    document.getElementById("tableBody").innerHTML = "";   // Kosongkan body tabel
  }
  
    function createRow(label, data, className) {
        const tr = document.createElement("tr");
        tr.classList.add(className);
  
        const tdLabel = document.createElement("td");
        tdLabel.innerText = label;
        tr.appendChild(tdLabel);
  
        data.forEach(value => {
          const td = document.createElement("td");
          td.innerText = value;
          tr.appendChild(td);
        });
  
        tableBody.appendChild(tr);
      }
  
    function curveChart(param){
      var multipleLineChart;
      
  
      multipleLineChart = document
      .getElementById("multipleLineChart")
      .getContext("2d");
    
      multipleLineChart = new Chart(multipleLineChart, {
      type: "line",
      data: {
        labels: param.weeks,
        datasets: [
          {
            label: "Planned",
            borderColor: "#f3545d",
            pointBorderColor: "#FFF",
            pointBackgroundColor: "#f3545d",
            pointBorderWidth: 2,
            pointHoverRadius: 6,
            pointHoverBorderWidth: 1,
            pointRadius: 4,
            backgroundColor: "transparent",
            fill: true,
            borderWidth: 4,
            data: param.planned
          },
          {
            label: "Actual",
            borderColor: "blue",
            pointBorderColor: "#FFF",
            pointBackgroundColor: "blue",
            pointBorderWidth: 2,
            pointHoverRadius: 6,
            pointHoverBorderWidth: 1,
            pointRadius: 4,
            backgroundColor: "transparent",
            fill: true,
            borderWidth: 4,
            data: param.actual
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
          position: "top",
          labels: {
            boxWidth: 12,
            fontSize: 12
          }
        },
        scales: {
          x: {
            grid: {
              color: function (ctx) {
                return ctx.index % 2 === 0 ? "rgba(0, 0, 0, 0.1)" : "rgba(0, 0, 0, 0.05)";
              }
            }
          },
          y: {
            ticks: {
              stepSize: 20,
              callback: function (value) {
                return value + "%"; // Menambahkan "%" di label Y-axis
              }
            },
            grid: {
              color: function (ctx) {
                return ctx.tick.value % 40 === 0 ? "rgba(255, 99, 132, 0.2)" : "rgba(75, 192, 192, 0.1)";
              }
            }
          }
        },
        tooltips: {
          bodySpacing: 4,
          mode: "nearest",
          intersect: 0,
          position: "nearest",
          xPadding: 12,
          yPadding: 12,
          caretPadding: 10,
          callbacks: {
            label: function (tooltipItem, data) {
              return data.datasets[tooltipItem.datasetIndex].label + ": " + tooltipItem.yLabel + "%";
            }
          }
        },
        layout: {
          padding: { left: 15, right: 15, top: 15, bottom: 15 }
        }
      }
    });
    }
    </script>
    

//PIEEEEEE
<script>
  document.getElementById("filterBtn").addEventListener('click', function(){
    if($("#start_date").val() != "" && $("#end_date").val() != ""){
      console.log("DISINI")
      PieChartProcess($("#start_date").val(),$("#end_date").val())
    }else{
      console.log("DISANA")
      PieChartProcess("","")
    }
  })
  PieChartProcess("","")
  function PieChartProcess(start_date_param,end_date_param){
    console.log(start_date_param, end_date_param)
    $.ajax({
      url: "{{ route('dashboard-pie-surat') }}",
      type: "POST",
      data: {
        _token: "{{ csrf_token() }}",
        start_date: $("#start_date").val(),
        end_date: $("#end_date").val()
      },
      success: function (response,color) {
        console.log(response)
        if (response.status == 'ok'){
          
          response.data_pie_surat.map((item) =>{
           
            PieChart(item.id,item.color,item.value,item.legend,item.title)
          })
        }else{
          msg_swal = "Failed";
          color = "btn btn-danger";
          swal(msg_swal, {
                buttons: {
                  confirm: {
                    className: color,
                  },
                },
              });
            
        }
      },
      error: function (xhr) {
        alert('An error occurred: ' + xhr.responseText);
      }
    });
  }
  function PieChart(param_id,param_color, param_data, param_legend, param_title){
        var 
      pieChart1 = document.getElementById(param_id).getContext("2d");
      new Chart(param_id, {
  type: "pie",
  data: {
    datasets: [
      {
        data: param_data,
        backgroundColor: param_color,
        borderWidth: 0,
      },
    ],
    labels: param_legend,
  },
  
  options: {
    responsive: true,
    maintainAspectRatio: false,
    title: {
      display: true,
      text: param_title,
      fontSize: 12,
      fontColor: "#333",
    },
    legend: {
      position: "bottom",
      labels: {
        fontColor: "rgb(154, 154, 154)",
        fontSize: 11,
        usePointStyle: true,
        padding: 20,
      },
    },
    pieceLabel: {
      render: function (args) {
        return args.value; // Tampilkan jumlah data di label
      },
      fontColor: "white",
      fontSize: 14,
    },

    plugins: {
      datalabels: {
        color: 'white',
        font: {
          size: 14,
          weight: 'bold',
        },
        formatter: function(value, context) {
          return value;  // Menampilkan jumlah data saja
        }
      }
    },
    tooltips: false,  
    layout: {
      padding: {
        left: 20,
        right: 20,
        top: 20,
        bottom: 20,
      },
    },
  },
});
                    
   }


</script>
@endpush