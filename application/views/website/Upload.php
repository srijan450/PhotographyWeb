<main class="col-md-9 ml-sm-auto col-lg-10 d-grid p-md-4 gallery">
    <div class="col-md-6 border bg-light p-3">
        <h3 class="text-center text-dark">Welcome</h3>
        <form id="submit" enctype="multipart/form-data">
            <p class="text-center" id="form-err">&nbsp;</p>
            <div class="input-group mb-4">
                <span class="input-group-text" id="basic-addon1"> <i class="fa fa-file" aria-hidden="true"></i> </span>
                <input type="file" accept="image/*" id="image" name="file" class="form-control" aria-label="file" aria-describedby="basic-addon1" required>
            </div>

            <div class="preview mb-4">
                <img id="hey" src="" alt="preview">
            </div>

            <div class="input-group mb-4">
                <span class="input-group-text" id="basic-addon1"> <i class="fa fa-tag" aria-hidden="true"></i> </span>
                <input type="text" id="category" name="category" class="form-control" placeholder="Category" aria-label="Category" aria-describedby="basic-addon1" required>
            </div>

            <div class="input-group mb-4">
                <span class="input-group-text" id="basic-addon1"> <i class="fa fa-edit" aria-hidden="true"></i> </span>
                <input type="text" id="rename" name="title" class="form-control" placeholder="Title" aria-label="Title" aria-describedby="basic-addon1" required>
            </div>

            <div class="input-group mb-4">
                <span class="input-group-text" id="basic-addon1"> <i class="fa fa-sort" aria-hidden="true"></i> </span>
                <input type="number" id="order" name="order" class="form-control" placeholder="position/order (optional)" aria-label="order" aria-describedby="basic-addon1">
            </div>

            <div class="input-group justify-content-center">
                <input type="submit" class=" btn btn-primary" value="Upload">
            </div>

            <input type="hidden" id="url" value="<?= base_url() ?>Secondary/uploadImage" />
        </form>

        <script>
            $('.preview').hide();
            const IMG = document.getElementById('image');
            const CATE = document.getElementById('category');
            const NAME = document.getElementById('rename');
            const ORDER = document.getElementById('order');

            const errForm = document.getElementById('form-err');

            const valid = {
                img: false,
                cate: false
            }
            IMG.onchange = () => {
                const [file] = IMG.files;
                if (file) {
                    document.getElementById('hey').src = URL.createObjectURL(file);
                    $('.preview').show(1000);
                }
            }

            $('#submit').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    type: "post",
                    url: document.getElementById('url').value,
                    data: new FormData(this),
                    contentType: false,
                    beforeSend: function() {
                        $('#staticBackdrop').modal("show");
                    },
                    cache: false,
                    processData: false,
                    success: function(response) {
                        response = JSON.parse(response);
                        if (response.status === 'success') {
                            errForm.innerHTML = `<span class="text-light px-3 py-1 bg-success">${response.msg}</span>`;
                            IMG.value = '';
                            CATE.value = '';
                            NAME.value = '';
                            ORDER.value = '';
                        } else if (response.status === 'failed') {
                            errForm.innerHTML = `<span class="text-light px-3 py-1 bg-danger ">${response.msg}</span>`;
                        } else {
                            location.replace(response.msg);
                        }
                        setTimeout(() => {
                            location.reload();
                        }, 5000);

                        $('#staticBackdrop').modal("hide");
                    }
                });
            });
        </script>

        <style>
            ::-webkit-file-upload-button {
                color: red;
            }

            ::-webkit-inner-spin-button {
                display: none;
            }

            .preview {
                min-height: 0;
                max-height: 15rem;
                width: 100%;
                background-image: linear-gradient(#fff, #55595c, #fff);
            }

            .preview img {
                max-height: 15rem;
                max-width: 100%;
                width: 100%;
                object-fit: contain;
            }

            .d-grid {
                place-items: center;
                min-height: 90vh;
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