<!DOCTYPE html>
<html>
<head>
    <title>Electre Result</title>
    <!-- Include Bootstrap 5.1 CSS or link to a CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="p-4" style="background-color: #B0D9B1">
        <div class="row">
            <div class="col-6" >
                <div id="alternatif" class="p-3 mb-4" style="background-color: #D0E7D2; border-radius: 10px; box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.1);"></div>
                <div id="kriteria" class="p-3 mb-4" style="background-color: #D0E7D2; border-radius: 10px; box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.1);"></div>
                <div class="row">
                    <div class="col-6">
                        <div id="n" class="p-3 mb-4" style="background-color: #D0E7D2; border-radius: 10px; box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.1);"></div>
                    </div>
                    <div class="col-6">
                        <div id="m" class="p-3 mb-4" style="background-color: #D0E7D2; border-radius: 10px; box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.1);"></div>
                    </div>
                </div>
                <div id="x_rata" class="p-3 mb-4" style="background-color: #D0E7D2; border-radius: 10px; box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.1);"></div>
                <div id="kriteria" class="p-3 mb-4" style="background-color: #D0E7D2; border-radius: 10px; box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.1);"></div>
                <div id="c" class="p-3 mb-4" style="background-color: #D0E7D2; border-radius: 10px; box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.1);"></div>
                <div id="d" class="p-3 mb-4" style="background-color: #D0E7D2; border-radius: 10px; box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.1);"></div>
                <div class="row">
                    <div class="col-6">
                        <div id="threshold_c" class="p-3 mb-4" style="background-color: #D0E7D2; border-radius: 10px; box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.1);"></div>
                    </div>
                    <div class="col-6">
                        <div id="threshold_d" class="p-3 mb-4" style="background-color: #D0E7D2; border-radius: 10px; box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.1);"></div>
                    </div>
                </div>
                <div id="e" class="p-3 mb-4" style="background-color: #D0E7D2; border-radius: 10px; box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.1);"></div>
                <div id="conclusion_dapat" class="p-3" style="background-color: #D0E7D2; border-radius: 10px; box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.1);"></div>
            </div>
            <div class="col-6">
                <div id="x" class="p-3 mb-4" style="background-color: #D0E7D2; border-radius: 10px; box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.1);"></div>
                <div id="r" class="p-3 mb-4" style="background-color: #D0E7D2; border-radius: 10px; box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.1);"></div>
                <div id="v" class="p-3 mb-4" style="background-color: #D0E7D2; border-radius: 10px; box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.1);"></div>
                <div id="f" class="p-3 mb-4" style="background-color: #D0E7D2; border-radius: 10px; box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.1);"></div>
                <div id="g" class="p-3 mb-4" style="background-color: #D0E7D2; border-radius: 10px; box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.1);"></div>
                <div id="conclusion_tidak" class="p-3" style="background-color: #D0E7D2; border-radius: 10px; box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.1);"></div>
            </div>
        </div>

        <!-- Include Bootstrap 5.1 JS and Popper.js or link to CDNs -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Include jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="{{asset('js/script.js')}}"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                $.ajax({
                    url: "{{ url('/elektre/result') }}", // Replace with the actual URL
                    type: "GET",
                    success: function(response) {
                        displayResultN(response.n);
                        displayResultM(response.m);
                        displayResultX(response.X);
                        displayResultX_Rata(response.x_rata);
                        displayResultR(response.R);
                        displayResultkriteria(response.kriteria);
                        displayResultV(response.V);
                        displayResultC(response.c);
                        displayResultD(response.d);
                        displayResultThreshold_C(response.threshold_c);
                        displayResultThreshold_D(response.threshold_d);
                        displayResultF(response.F);
                        displayResultG(response.G);
                        displayResultE(response.E);
                        displayResultConclusion(response.E);
                    },
                    error: function(xhr, status, error) {
                        alert("An error occurred while calculating Electre.");
                    }
                });

                $.ajax({
                    url: "{{ url('/elektre/alternatif') }}", // Ganti dengan URL yang sesuai
                    type: "GET",
                    success: function(response) {
                        displayalternatif(response.alternatif);
                    },
                    error: function(xhr, status, error) {
                        alert("Terjadi kesalahan saat mengambil data alternatif.");
                    }
                });
    
                $.ajax({
                    url: "{{ url('/elektre/kriteria') }}", // Ganti dengan URL yang sesuai
                    type: "GET",
                    success: function(response) {
                        displaykriteria(response.kriteria);
                    },
                    error: function(xhr, status, error) {
                        alert("Terjadi kesalahan saat mengambil data alternatif.");
                    }
                });
            });
        </script>
    </div>
</body>
</html>
