<main class="col-md-9 ml-sm-auto col-lg-10 d-grid px-md-4 gallery">
    <div class="col-12 border bg-light p-3">
        <h3 class="text-center text-dark allheading">Edit About</h3>

        <form id="submit" method="POST">
            <p class="text-center" id="form-err">&nbsp;</p>

            <div class="input-group d-flex mb-4" style="flex-direction: column;">
                <lable class="input-group-text justify-content-center" id="basic-addon1"><i class="mx-2 fa fa-info-circle" aria-hidden="true"></i> minimum 100 words(<span id="err">0</span>)</lable>
                <textarea id="text" class="form-control" placeholder="About youreself..." aria-label="About youreself..." required></textarea>
            </div>
            <style>
                #text {
                    width: 100%;
                    height: 50vh !important;
                    resize: none;
                }

                .gallery {
                    min-height: 90vh;
                }
            </style>

            <div class="input-group justify-content-center">
                <input type="submit" class=" btn btn-primary">
            </div>
            <input type="hidden" id="url" value="<?= base_url() ?>Secondary/createAboutContent">
            <input type="hidden" id="url2" value="<?= base_url() ?>assets/pages/test.txt" />
        </form>

        <script>
            const TEXT = document.getElementById('text');
            const ERR = document.getElementById('err');
            const data = {
                text: ''
            };
            let allset = false;
            TEXT.oninput = (e) => {
                str = e.target.value;
                arr = str.split(' ');
                arr = arr.filter((val) => val != "");
                ERR.innerHTML = arr.length;
                if (arr.length >= 100) {
                    allset = true;
                    ERR.style.color = 'green';
                } else {
                    allset = false;
                }
                str = arr.join(" ");
                str = str.replaceAll("\n", "<br />");
                data.text = str;
            }
            $('#submit').submit(function(e) {
                e.preventDefault();
                if (allset) {
                    document.getElementById("basic-addon1").removeAttribute("class", "text-danger");
                    $('#staticBackdrop').modal("show");
                    $.post(document.getElementById("url").value, data,
                        function(data, textStatus, jqXHR) {
                            data = JSON.parse(data);
                            if (data.status === 'success') {
                                document.getElementById("form-err").innerHTML = `<span class="text-success">${data.msg}</span>`;
                            } else {
                                document.getElementById("form-err").innerHTML = `<span class="text-danger">${data.msg}</span>`;
                                location.replace(data.loc);
                            }
                            $('#staticBackdrop').modal("hide");

                        },

                    );
                } else {
                    document.getElementById("basic-addon1").setAttribute("class", "text-danger");
                }
            });
        </script>

        <script>
            $(document).ready(function() {
                $.ajax({
                    type: "POST",
                    url: document.getElementById("url2").value,
                    dataType: "text",
                    success: function(response) {
                        document.getElementById("text").innerHTML = response;
                    }
                });
            });
        </script>


        <style>
            .d-grid {
                place-items: center;
                height: 80vh;
            }
        </style>
    </div>

</main>
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