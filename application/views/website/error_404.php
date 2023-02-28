<div class="d-grid bg-dark">
    <div class="text-center bg-light text-dark d-grid main-div">
        <!-- <div class="text-light"> -->
        <h1 class=" fs-1">404 Error</h1>
        <h3>This Page Does Not Exists</h3>
        <a class="btn btn-success" href="<?= base_url() ?>maincontroller">Back To Home</a>
        <!-- </div> -->
    </div>
</div>
<style>
    .d-grid {
        height: 100vh;
        place-items: center;
    }

    .fs-1 {
        font-size: 10vw !important;
    }

    .main-div {

        height: 50%;
        padding: 50px;
        border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
        background-color: rebeccapurple;
    }
</style>
</body>

</html>