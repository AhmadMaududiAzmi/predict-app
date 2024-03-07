@extends('layouts.app')

@section('lib-style')
@endsection

@section('page-style')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style>
  /* Spinner */
  .spinner-container {
    position: relative;
    width: 50px;
    /* Ubah lebar dan tinggi container sesuai keinginan */
    height: 50px;
  }

  .spinner {
    position: absolute;
    width: 100%;
    height: 100%;
    border-radius: 50%;
    border: 3px solid #ccc;
    border-top-color: #ff7f50;
    animation: spin 2s linear infinite;
  }

  @keyframes spin {
    100% {
      transform: rotate(360deg);
    }
  }

  .percentage {
    position: absolute;
    top: 55%;
    left: 55%;
    transform: translate(-50%, -50%);
    font-family: Arial, sans-serif;
    font-size: 12px;
    /* Ubah ukuran teks persentase sesuai keinginan */
    font-weight: bold;
  }
</style>
@endsection

@section('content')
<div class="row g-4">
  <div class="col-12">
    <div class="card mb-0 h-100 overflow-hidden" id="predictContainer">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="card-title mb-0"> Grafik Harga Komoditas
          @if (count($request->all()) > 0)
          {{ $comoditiesSelectedValue }} di {{ $pasarSelectedValue }} {{ $startDate }} sampai
          {{ $endDate }}
          @endif
        </h5>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#predictModal">
          <span class="btn-icon-label">
            <i data-feather="filter" class="me-2"></i>
            <span>Tampilkan</span>
          </span>
        </button>
      </div>
      <div class="card-body p-0">
        <div class="spinner-container d-none" id="spinner">
          <div class="spinner"></div>
          <span class="percentage">0%</span>
        </div>
        <div class="panel col-md-12">
          <canvas id="chart"></canvas>
        </div>
      </div>
      <div class="col-12 row card-header justify-content-between d-flex align-items-center d-none" id="addPredict">
        <form action="" class="modal-body row g-3 requires-validation">
          <div class="col-6 d-flex justify-content-start">
            <label>Input data</label>
            <input type="hidden" name="tanggal_start" value="{{ $startDate }}">
            <input type="hidden" name="tanggal_end" value="{{ $endDate }}">
            <input type="hidden" name="pasar" value="{{ $request->pasar }}">
            <input type="hidden" name="komoditas" value="{{ $request->komoditas }}">
            <input type="number" required name="next_predict" class="form-control" placeholder="Contoh : 30">
          </div>
          <div class="col-6 justify-content-end d-flex">
            <button class="btn btn-success m-1" type="submit">
              <span class="btn-icon-label">
                <span>Predict</span>
                <i data-feather="arrow-right" class="me-2"></i>
              </span>
            </button>
            <button class="btn btn-success m-1" type="submit">
              <span class="btn-icon-label">
                <span>Save</span>
                <i data-feather="arrow-left" class="me-2"></i>
              </span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="col-12">
    <div class="card mb-0">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="card-title mb-0"> Daftar Data Uji</h5>
      </div>
      <div class="card-body">
        <div class="main-table rounded">
          <table class="table table-striped" id="trained_data">
            <thead>
              <tr>
                <th>No</th>
                <th>Tanggal Awal</th>
                <th>Tanggal Akhir</th>
                <th>Komoditas</th>
                <th>Pasar</th>
              </tr>
            </thead>
            <tbody>
              {{-- @foreach ($item as $model)
              <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->tanggal_awal }}</td>
                <td>{{ $item->tanggal_akhir }}</td>
                <td>{{ $item->nm_komoditas }}</td>
                <td>{{ $item->nm_pasar }}</td>
              </tr>
              @endforeach --}}
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="col-12">
    <div class="card mb-0">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="card-title mb-0"> Daftar Prediksi Harga Komoditas </h5>
      </div>
      <div class="card-body">
        <div class="main-table rounded">
          <table class="table table-striped" id="comoditiesTable">
            <thead>
              <tr>
                <th>No.</th>
                <th>Tanggal</th>
                <th>Nama Komoditas</th>
                <th>Nama Pasar</th>
                <th>Harga</th>
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

<!-- Modal -->
<div class="modal fade" id="predictModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-labelledby="delete" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateComodityLabel">Prediksi Harga Komoditas</h5>
      </div>
      <form action="{{ url('grafik') }}" class="modal-body row g-3 requires-validation">
        <div class="col-12">
          <label for="komoditas" class="form-label">Komoditas</label>
          <select name="komoditas" id="komoditas_option" class="form-control" required>
            <option value="">- Pilih -</option>
            @foreach ($comodities as $item)
            <option value="{{ $item->id }}" {{ $request->komoditas == $item->id ? 'selected' : '' }}>
              {{ $item->nama_komoditas }}
            </option>
            @endforeach
          </select>
        </div>
        <div class="col-12">
          <label for="pasar" class="form-label">Pasar</label>
          <select name="pasar" id="pasar_option" class="form-control" required>
            <option value="">- Pilih -</option>
            @foreach ($markets as $item)
            <option value="{{ $item->id }}" {{ $request->pasar == $item->id ? 'selected' : '' }}>
              {{ $item->nm_pasar }}
            </option>
            @endforeach
          </select>
        </div>
        <div class="col-12">
          <label for="tanggalAwal" class="form-label">Tanggal Awal</label>
          <input type="date" required min="2016-01-01" max="2020-12-31" name="tanggal_awal" id="tanggal_awal"
            class="form-control" value="{{ $startDate }}">
        </div>
        <div class="col-12">
          <label for="tanggalAkhir" class="form-label">Tanggal Akhir</label>
          <input type="date" required min="2016-01-01" max="2020-12-31" name="tanggal_akhir" id="tanggal_akhir"
            class="form-control" value="{{ $endDate }}">
        </div>
        <div class="col-12 d-flex align-items-center justify-content-center">
          <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">
            <span class="btn-icon-label">
              <i data-feather="x" class="me-2"></i>
              <span> Batal </span>
            </span>
          </button>
          <button type="submit" class="btn btn-success" onclick="grafik()" id="tampilkan">
            <span class="btn-icon-label">
              <i data-feather="refresh-cw" class="me-2"></i>
              <span> Tampilkan </span>
            </span>
          </button>
        </div>
        <div class="col-12 d-flex align-items-center justify-content-center">
          <span style="font: 14">*Model akan tersimpan dengan otomatis pada database</span>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('lib-script')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/moment"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-moment"></script>
@endsection

@section('page-script')
<script>
  function grafik() {
    event.preventDefault();
    $("#predictModal").modal('hide');
    $("#spinner").removeClass("d-none");

    if (window.myChart) {
      window.myChart.destroy();
    }

    let currentPercentage = 0; // Persentase awal
    const intervalTime = 1000; // Waktu dalam milidetik (1 detik = 1000 milidetik)
    const increment = 1; // Persentase yang ingin ditambahkan setiap interval
    const maxPercentage = 80; // Batas maksimum persentase

    function updateSpinner(percentage) {
      const spinner = $('.spinner');
      const percentageText = $('.percentage');

      const rotation = percentage / 100 * 360;
      spinner.css('transform', `rotate(${rotation}deg)`);
      percentageText.text(`${percentage}%`);
    }

            const timer = setInterval(() => {
                if (currentPercentage <= maxPercentage) {
                    updateSpinner(currentPercentage);
                    currentPercentage += increment;
                } else {
                    currentPercentage %= 100; // Setel ulang persentase ke 0 setelah mencapai batas
                }
            }, intervalTime);

            let komoditas = $("#komoditas_option").val();
            let pasar = $("#pasar_option").val();
            let tanggal_awal = $("#tanggal_awal").val();
            let tanggal_akhir = $("#tanggal_akhir").val();

            $.ajax({
                type: "get",
                url: "/grafik",
                data: {
                    komoditas: komoditas,
                    pasar: pasar,
                    tanggal_awal: tanggal_awal,
                    tanggal_akhir: tanggal_akhir
                },
                dataType: "json",
                success: function(response) {
                    $("#spinner").addClass("d-none");
                    $('#addPredict').removeClass("d-none");

                    // console.log({response});

                    let predictedData = response.Predicted;
                    let actualData = response.Actual;
                    let labelData = Object.keys(predictedData).map(timestamp => {
                        let date = new Date(parseInt(timestamp));
                        return date.toISOString().split('T')[0];
                    });

                    let ctx = document.getElementById('chart').getContext('2d');

                    window.myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: labelData,
                            datasets: [{
                                    label: 'Predicted',
                                    data: Object.values(predictedData),
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    borderWidth: 1,
                                    fill: false
                                },
                                {
                                    label: 'Actual',
                                    data: Object.values(actualData),
                                    borderColor: 'rgba(255, 99, 132, 1)',
                                    borderWidth: 1,
                                    fill: false
                                }
                            ]
                        },
                        options: {
                            scales: {
                                x: {
                                    type: 'time',
                                    time: {
                                        unit: 'day',
                                        tooltipFormat: 'DD-MM-YYYY',
                                        displayFormats: {
                                            day: 'DD-MM-YYYY'
                                        }
                                    }
                                },
                                y: {
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        }
                    });
                }
            });
        }
</script>
@endsection