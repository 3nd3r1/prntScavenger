<?php
$config["demo"] = true;
?>
<!DOCTYPE html>
<html lang="en">
<!--

    Author: Viljami Ranta
    Site: viljamiranta.fi
    GitHub: prntScavenger

-->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/bootstrap4-bubblegum.min.css">
    <link rel="stylesheet" href="/css/main.css?v=20">
    <title>Prnt.sc Scavenger</title>
</head>
<!-- Modal -->
<div class="modal" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="Screenshot" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col-auto">
                        <img src="" id="imagepreview" class="img-fluid">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="" id="gotoimg" class="ht-tm-element btn btn-primary">Open Image</a>
            </div>
        </div>
    </div>
</div>

<body class="ht-body">
    <div class="ht-main">
        <div class="ht-tm-wrapper">
            <div class="container ht-tm-container">
                <div class="row justify-content-center">
                    <div class="col-xl-12 grid-margin stretch-card">
                        <div class="ht-item-header text-center">
                            <h1 class="display-4 text-chicle text-dark vr-tm-yourimage">Prnt.sc Scavenger</h1>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-xl-8">
                        <div class="card vr-tm-imgcard">
                            <div class="card-body">
                                <h4 class="card-title text-center">Image - <span style="color:grey">prnt.sc/</span><span id="code"></span></h4>
                            </div>
                            <img id="screenshot" class="vr-tm-screenshot vr-js-viewlarge img-fluid" src="/loading.gif" alt="Screenshot">
                            <div class="card-footer align-items-center">
                                <a id="like" href="#" data-code="" class="btn btn-primary float-left disabled">Like <i class="fas fa-thumbs-up"></i></a>
                                <p class="text-muted vr-js-like vr-tm-likestext float-left">This image has <span id="likes">1</span> likes</p>
                                <a id="newimg" href="#" class="btn btn-primary float-right disabled">New Image <i class="fas fa-images"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 vr-tm-toptable float-right">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">Top Imgs</h6>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Image</th>
                                                <th>Likes</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if($config["demo"])
                                            {
                                                ?>
                                                <tr>
                                                    <h3>Not available in demo!</h3>
                                                </tr>
                                                <?php
                                            }
                                            else
                                            {
                                                require("db.php");
                                                $q = $db->query("SELECT * FROM scores ORDER BY likes DESC LIMIT 10");
                                                $f = $q->fetchAll();
                                                $n = 1;

                                                foreach ($f as $row) {
                                                ?>
                                                    <tr>
                                                        <th><?php echo $n; ?></th>
                                                        <td><a href="#" class="gotoImg" data-code="<?php echo $row["code"]; ?>"><span color="grey">prnt.sc/</span><?php echo $row["code"]; ?></a></td>
                                                        <td><?php echo $row["likes"]; ?></td>
                                                    </tr>
                                                <?php
                                                    $n++;
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <p class="text-muted">Created by: <a href="https://viljamiranta.fi/">Viljami Ranta</a></p>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/backend.js?v=6"></script>
</body>

</html>
