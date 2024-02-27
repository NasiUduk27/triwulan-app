@extends('layout.template')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Data SubKegiatan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Data Subkegiatan</a></li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">TAMBAH</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ $url_form }}">
                    @csrf
                    {!! isset($master_subkegiatan) ? method_field('PUT') : '' !!}

                    <div class="form-group">
                        <label>Tahun Anggaran</label>
                        <select class="form-control @error('tahun') is-invalid @enderror" name="tahun">
                            <option value="" selected disabled>Pilih Tahun</option>
                            @php
                                $currentYear = date('Y');
                                $startYear = 2022; // Tahun awal
                            @endphp
                            @for($year = $currentYear; $year >= $startYear; $year--)
                                <option value="{{ $year }}" {{ isset($master_subkegiatan) && $master_subkegiatan->tahun == $year ? 'selected' : '' }}>{{ $year }}</option>
                            @endfor
                        </select>
                        @error('tahun')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Pilih Bidang</label>
                        <select class="form-control" name="nama_bidang" id="nama_bidang">
                            <option selected>--PILIH--</option>
                            @foreach($bidang as $b)
                            <option value="{{ $b->nama_bidang }}">{{ $b->nama_bidang }}</option>
                            @endforeach
                          </select>
                        @error('nama_bidang')
                            <span class="error invalid-feedback">{{ $message }} </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Pilih Program</label>
                        <select class="form-control" name="nama_program" id="nama_program" onchange="pilihProgram()">
                            <option selected>--PILIH--</option>
                            @foreach($program as $p)
                            <option value="{{ $p->id }}">{{ $p->nama_program }}</option>
                            @endforeach
                          </select>
                        @error('nama_program')
                            <span class="error invalid-feedback">{{ $message }} </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Pilih Kegiatan</label>
                        <select class="form-control" name="nama_kegiatan" id="nama_kegiatan">
                            <option selected>--PILIH--</option>
                            @foreach($master_kegiatan as $k)
                            <option value="{{ $k->id }}">{{ $k->nama_kegiatan }}</option>
                            @endforeach
                          </select>
                        @error('nama_kegiatan')
                            <span class="error invalid-feedback">{{ $message }} </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Nomor Rekening</label>
                        <input class="form-control @error('rekening_subkegiatan') is-invalid @enderror"
                            value="{{ isset($master_subkegiatan) ? $master_subkegiatan->rekening_subkegiatan : old('rekening_subkegiatan') }}"
                            name="rekening_subkegiatan" type="text" />
                        @error('rekening_subkegiatan')
                            <span class="error invalid-feedback">{{ $message }} </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Nama SubKegiatan</label>
                        <input class="form-control @error('nama_subkegiatan') is-invalid @enderror"
                            value="{{ isset($master_subkegiatan) ? $master_subkegiatan->nama_subkegiatan : old('nama_subkegiatan') }}"
                            name="nama_subkegiatan" type="text" />
                        @error('nama_subkegiatan')
                            <span class="error invalid-feedback">{{ $message }} </span>
                        @enderror
                    </div>

                    <button class="btn btn-primary" type="submit">Simpan</button>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                Terima Kasih
            </div>
            <!-- /.card-footer-->
    </div>
    <!-- /.card -->

    </section>
    <!-- /.content -->
    </div>
@endsection

@push('custom_css')
    <style>
        th {}

        /* .card{
          background:green;
          color:aliceblue;
          transition: 0.5s;
      }

      .card:hover{
          background: aqua;
          color: blue;
          transform:scale(0.9);
      } */
    </style>
@endpush

@push('custom_js')
<script>
    const pilihProgram = () => {
        let program = document.querySelector('#program').value;
        $.ajax({
            url: '/get-kegiatan',
            method: 'GET',
            data: {
                program: program,
            },
            success: function(response) {
                let kegiatan = document.querySelector('#kegiatan');
                let option = '';
                option += '<option selected>--PILIH--</option>';
                response.forEach(res => {
                    option += `<option value="${res.nama_kegiatan}">${res.nama_kegiatan}</option>`
                });
                kegiatan.innerHTML = option;
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
</script>
@endpush
