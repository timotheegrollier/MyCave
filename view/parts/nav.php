<nav class="navbar navbar-expand-lg navbar-dark fixed-top ">
    <a class="navbar-brand" href="?action=home"><img src="../../mvCave/public/img/logo.png" class="img-fluid w-75"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse navbar-light justify-content-end " id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item <?php if (isset($_GET['action'])) {
                                    if ($_GET['action'] == 'home') {
                                        echo "active";
                                    }
                                } else {
                                    echo "active";
                                } ?> ">
                <a class="nav-link" href="?action=home">Home</a>
            </li>
            <li class="nav-item <?php if (isset($_GET['action'])) {
                                    if ($_GET['action'] == 'cave') {
                                        echo "active";
                                    }
                                } ?>">
                <a class="nav-link" href="?action=cave">Cave</a>
            </li>
            <li><i data-toggle="modal" data-target="#exampleModal" class="fas fa-power-off login btn"></i></li>
        </ul>

    </div>

</nav>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Connexion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>