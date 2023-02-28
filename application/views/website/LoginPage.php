<main class="col-md-9 ml-sm-auto col-lg-10 d-grid px-md-4 gallery">
    <div class="col-md-6 border bg-light p-3">
        <h3 class="text-center text-dark">Admin Login</h3>

        <form id="submit">
            <p class="text-center" id="form-err">&nbsp;</p>
            <div class="input-group">
                <span class="input-group-text" id="basic-addon1"> <i class="fa fa-user" aria-hidden="true"></i> </span>
                <input type="email" id="email" class="form-control" placeholder="your email" aria-label="your email" aria-describedby="basic-addon1" required>
            </div>
            <p class="text-center" id="email-err" style="font-size: .9rem">&nbsp;</p>


            <div class="input-group">
                <span class="input-group-text" id="basic-addon1"> <i class="fa fa-lock" aria-hidden="true"></i> </span>
                <input type="password" id="pass" class="form-control" placeholder="password" aria-label="password" aria-describedby="basic-addon1" required>
            </div>

            <p class="text-center" id="pass-err" style="font-size: .9rem">&nbsp;</p>

            <div class="input-group justify-content-center">
                <input type="submit" class=" btn btn-primary">
            </div>
            <input type="hidden" id="url" value="<?= base_url() ?>Secondary/login">
        </form>

        <script>
            const EMAIL = document.getElementById('email');
            const PASS = document.getElementById('pass');


            const errEmail = document.getElementById('email-err');
            const errPass = document.getElementById('pass-err');
            const errForm = document.getElementById('form-err');

            const valid = {
                email: false,
                pass: false
            }

            EMAIL.onblur = () => {
                if (/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(EMAIL.value)) {
                    errEmail.innerHTML = "<sapn class='text-success'>All Good</span>";
                    valid.email = true;
                } else {
                    errEmail.innerHTML = "<sapn class='text-danger'>Incorrect Email</span>";
                }
            }


            PASS.onblur = () => {
                PASS.value = PASS.value.trim();
                if (/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(.{8,})$/.test(PASS.value)) {
                    errPass.innerHTML = "<sapn class='text-success'>All Good</span>";
                    valid.pass = true;
                } else if (PASS.value === "") {
                    errPass.innerHTML = "<sapn class='text-danger'>Password is required.</span>";
                } else {
                    errPass.innerHTML = "<sapn class='text-danger'>Incorrect Password.</span>";
                }
            }
            document.getElementById('submit').onsubmit = (e) => {
                e.preventDefault();

                if (valid.pass && valid.email) {
                    $('#staticBackdrop').modal("show");
                    $.post(document.getElementById('url').value, {
                            email: EMAIL.value,
                            pass: PASS.value
                        },
                        function(data, textStatus, jqXHR) {
                            $('#staticBackdrop').modal("hide");
                            data = JSON.parse(data);
                            if (data['location'] !== '') {
                                errForm.innerHTML = `<span class='text-success'>${data['msg']}</span>`;
                                location.replace(data['location']);
                            } else {
                                errForm.innerHTML = `<span class='text-danger'>${data['msg']}</span>`;
                            }


                        },

                    );
                }
            }
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