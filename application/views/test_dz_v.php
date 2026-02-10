<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dropzone File Name</title>

    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" />
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
</head>

<body>
    <h2>Upload File (Just get the name)</h2>

    <form action="<?php echo site_url('Dz/upload_file'); ?>" class="dropzone" id="my-great-dropzone"></form>
    <div id="test"></div>

    <script>
        Dropzone.autoDiscover = false;

        var myDropzone = new Dropzone("#my-great-dropzone", {
            paramName: "file",
            maxFilesize: 5, // MB
            addRemoveLinks: true,

            init: function () {
                this.on("success", function (file, response) {
                    var testDiv = document.getElementById('test');
                    var p = document.createElement("p");
                    p.textContent = response;
                    testDiv.appendChild(p);
                });
            }
        });
    </script>

</body>

</html>