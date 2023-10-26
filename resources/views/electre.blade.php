<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Metode Electre</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="content">
            <div class="Judul">
                <h1 class="mt-5 text-center">Sistem Pendukung Keputusan dengan Menggunakan Metode Electre</h1><hr>
            </div>
            <div class="perbandingan-berpasangan">
                <br><h3>Tabel Perbandingan Berpasangan</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th></th>
                            @foreach (array_keys(reset($array)) as $kriteria)
                                <th>K{{ $kriteria }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($array as $alternatif => $kriteriaValues)
                            <tr>
                                <th>A{{ $alternatif }}</th>
                                @foreach ($kriteriaValues as $value)
                                    <td>{{ $value }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="normalisasi">
                <br><h3>Tabel Normalisasi</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th></th>
                            @foreach (array_keys(reset($normalisasi)) as $kriteria)
                                <th>K{{ $kriteria }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($normalisasi as $alternatif => $kriteriaValues)
                            <tr>
                                <th>A{{ $alternatif }}</th>
                                @foreach ($kriteriaValues as $value)
                                    <td>{{ $value }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="bobot-kriteria">
                <br><h3>Bobot Kriteria</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Kriteria</th>
                            @foreach (array_keys(reset($normalisasi)) as $kriteria)
                                <th>K{{ $kriteria }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>Bobot</th>
                            @foreach ($bobot as $kriteriaBobot => $kriteriaValues)
                                @foreach ($kriteriaValues as $value)
                                    <td>{{ $value }}</td>
                                @endforeach
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="preferensi">
                <br><h3>Tabel Preferensi</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th></th>
                            @foreach (array_keys(reset($preferensi)) as $kriteria)
                                <th>K{{ $kriteria }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($preferensi as $alternatif => $kriteriaValues)
                            <tr>
                                <th>A{{ $alternatif }}</th>
                                @foreach ($kriteriaValues as $value)
                                    <td>{{ $value }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="corcordance">
                <br><h3>Corcordance Index</h3>
                <table class="table table-bordered">
                    <tbody>
                        @foreach ($concordanceIndex as $alternatif => $kriteriaValues)
                            <tr>
                                @foreach ($kriteriaValues as $v => $value)
                                    @if(is_array($value))
                                    <tr>
                                        <td>C {{$alternatif}},{{$v}}</td>
                                        <td>
                                            @foreach ($value as $item)
                                                {{ $item }}
                                            @endforeach
                                        </td>
                                    </tr>
                                    @else
                                        <td>{{ $value }}</td>
                                    @endif
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="discordance">
                <br><h3>Discordance Index</h3>
                <table class="table table-bordered">
                    <tbody>
                        @foreach ($discordanceIndex as $alternatif => $kriteriaValues)
                            <tr>
                                @foreach ($kriteriaValues as $v => $value)
                                    @if(is_array($value))
                                    <tr>
                                        <td>D {{$alternatif}},{{$v}}</td>
                                        <td>
                                            @foreach ($value as $item)
                                                {{ $item }}
                                            @endforeach
                                        </td>
                                    </tr>
                                    @else
                                        <td>{{ $value }}</td>
                                    @endif
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="concordance-matrik">
                <br><h3>Concordane Matriks</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th></th>
                            @foreach (array_keys(reset($concordanceMatrix)) as $kriteria)
                                <th>K{{ $kriteria }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($concordanceMatrix as $alternatif => $kriteriaValues)
                            <tr>
                                <th>A{{ $alternatif }}</th>
                                @foreach ($kriteriaValues as $value)
                                    <td>{{ $value }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="discordance-matrik">
                <br><h3>Discordance Matriks</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th></th>
                            @foreach (array_keys(reset($discordanceMatrix)) as $kriteria)
                                <th>K{{ $kriteria }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($discordanceMatrix as $alternatif => $kriteriaValues)
                            <tr>
                                <th>A{{ $alternatif }}</th>
                                @foreach ($kriteriaValues as $value)
                                    <td>{{ $value }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="threshold">
                <br><h3>Threshold</h3>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>Concordance</th>
                            <th>{{$concordanceThreshold}}</th>
                        </tr>
                        <tr>
                            <th>Discordance</th>
                            <th>{{$discordanceThreshold}}</th>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="concordance-dominance">
                <br><h3>Concordance Dominance</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th></th>
                            @foreach (array_keys(reset($concordanceDominance)) as $kriteria)
                                <th>K{{ $kriteria - 1 }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($concordanceDominance as $alternatif => $kriteriaValues)
                            <tr>
                                <th>A{{ $alternatif }}</th>
                                @foreach ($kriteriaValues as $value)
                                    <td>{{ $value }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="discordance-dominance">
                <br><h3>Discordance Dominance</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th></th>
                            @foreach (array_keys(reset($discordanceDominance)) as $kriteria)
                                <th>K{{ $kriteria - 1 }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($discordanceDominance as $alternatif => $kriteriaValues)
                            <tr>
                                <th>A{{ $alternatif }}</th>
                                @foreach ($kriteriaValues as $value)
                                    <td>{{ $value }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="aggregate">
                <br><h3>Aggregate Dominance</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th></th>
                            @foreach (array_keys(reset($aggregateDominance)) as $kriteria)
                                <th>K{{ $kriteria - 1 }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($aggregateDominance as $alternatif => $kriteriaValues)
                            <tr>
                                <th>A{{ $alternatif }}</th>
                                @foreach ($kriteriaValues as $value)
                                    <td>{{ $value }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
