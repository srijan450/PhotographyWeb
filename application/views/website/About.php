<main class="col-md-9 ml-sm-auto col-lg-10 d-grid px-md-4 px-0 gallery">
    <div class="col-md-12 border bg-light p-3">
        <h3 class="allheading fw-bold">About me</h3>
        <div class="bg-dark text-light p-md-3 p-2 alltext setheight" style="text-align: justify;" id="text-content">

        </div>
        <input type="hidden" id="url2" value="<?= base_url() ?>assets/pages/test.txt" />
        <script>
            let res = false;
            $(document).ready(function() {

                $.ajax({
                    type: "POST",
                    url: document.getElementById("url2").value,
                    beforeSend: function() {
                        $('#staticBackdrop').modal("show");
                    },
                    dataType: "text",
                    success: function(response) {
                        document.getElementById("text-content").innerHTML = response;
                        document.getElementById("text-content").style.height = "auto";
                        res = true;
                    }
                });

            });

            setInterval(() => {
                if (res) {
                    $('#staticBackdrop').modal("hide");

                }

            }, 100);
        </script>
    </div>

    <!-- <div class="col-md-12 border bg-light p-3 allheading">
        <div>
            <h3>Contact Me</h3>
            <i class="fas fa-envelope"></i> <a href="mailto:payalsi87011.com">Mail</a>
        </div>
    </div> -->
</main>
</div>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Comfortaa:wght@700&family=Domine&family=Shadows+Into+Light&display=swap');

    .alltext {
        font-family: 'Comfortaa', cursive;
    }
</style>
<style>
    .setheight {
        height: 50vh;
    }

    .gallery {
        min-height: 80vh;
        align-items: center;
    }
</style>

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-transparent">
            <div class="spinner-border text-light mx-auto" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-transparent">
            <div class="spinner-border text-light mx-auto" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>