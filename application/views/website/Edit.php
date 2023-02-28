<main class="col-md-9 ml-sm-auto col-lg-10 d-grid px-md-4 px-0 gallery">
    <div class="col-md-6 col-12 border bg-light p-3">
        <h3 class="text-center text-dark allheading" id="form-heading">Edit Profile</h3>
        <div class="d-flex justify-content-between">


            <div class="form-check">
                <input class="form-check-input" type="radio" name="mode" id="edit" checked>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="mode" id="add">
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="mode" id="delete">
            </div>
        </div>

        <form id="submit" method="POST">

        </form>





        <script>
            function passcredentials() {
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
                        errPass.innerHTML = "<sapn class='text-danger'>Invalid Password Format.</span>";
                    }
                }
                document.getElementById('submit').onsubmit = (e) => {
                    e.preventDefault();
                    $('#staticBackdrop').modal("show");
                    if (valid.pass && valid.email) {
                        $.post(document.getElementById('url').value, {
                                email: EMAIL.value,
                                pass: PASS.value
                            },
                            function(data, textStatus, jqXHR) {

                                console.log(data);
                                data = JSON.parse(data);
                                if (data['status'] === 'success') {
                                    errForm.innerHTML = `<span class='text-success'>${data['msg']}</span>`;

                                } else {
                                    errForm.innerHTML = `<span class='text-danger'>${data['msg']}</span>`;
                                    if (location != '')
                                        location.replace(data['location']);
                                }
                                $('#staticBackdrop').modal("hide");

                            },

                        );
                    }
                }

            }
        </script>

        <script>
            const setform = (heading = "Edit Credentials", email = "Enter New Email", pass = "Create New Password", url = "editAdmin", btn = "Update", btn_clr = "btn-primary", action = false) => {
                document.getElementById('submit').innerHTML = `<p class="text-center" id="form-err">&nbsp;</p>
    <div class="form-floating ">
    <input type="email" id="email" name="email" class="form-control" placeholder="${email}" ${!action?'value="<?= $_SESSION['superemail'] ?>"':''} required>
    <label for="email"><i class="fa fa-user" aria-hidden="true"></i> ${email}</label>
        </div>
    <p class="text-center" id="email-err" style="font-size: .9rem">&nbsp;</p>

    <div class="form-floating ">
    <input type="${action?'password':'text'}" id="pass" name="pass" class="form-control" placeholder="${pass}" ${!action?'value="<?= $_SESSION['sessionpass'] ?>"':''} required>
    <label for="pass"> <i class="fa fa-lock" aria-hidden="true"></i> ${pass}</label>
    </div>
    <p class="text-center" id="pass-err" style="font-size: .9rem">&nbsp;</p>

    <div class="input-group justify-content-center">
    <input type="submit" class=" btn ${btn_clr}" value="${btn}">

    </div>
    <input type="hidden" id="url" value="<?= base_url() ?>Secondary/${url}">`;
                document.getElementById('form-heading').innerHTML = heading;
            }
            const edit = document.getElementById('edit');
            const add = document.getElementById('add');
            const dlt = document.getElementById('delete');

            function setPage(data) {
                if (edit.checked) {
                    setform();
                    passcredentials();
                } else if (add.checked) {
                    setform("Add Admin", "Enter Email", "Enter Password", "addnewadmin", "Submit", "btn-success", true);
                    passcredentials();
                } else {
                    setform("Remove Admin", "Remove Email", "Your Password", "dismissadmin", "Dismiss Admin", "btn-danger", true);
                    passcredentials();
                }
            }
            setPage();
            edit.onchange = () => {
                setPage();
            }

            add.onchange = () => {
                setPage();
            }
            dlt.onchange = () => {
                setPage();
            }
        </script>



        <style>
            .d-grid {
                place-items: center;
                height: 90vh;
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