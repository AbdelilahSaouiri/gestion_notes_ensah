<?php

$filiere = isset($_GET['filiere']) ? $_GET['filiere'] : "";
$filiereName = 'filiere-' . $filiere . '.csv';
if (isset($_POST['submit'])) {

    $file = $_FILES['file'];
    $fileType = $file["type"];
    $fileName = $file["name"];
    $fileSize = $file["size"];
    $fileTmpName = $file["tmp_name"];
    if ($fileType != "text/csv") {
        echo "<script>alert('Le fichier " . htmlspecialchars($fileName) . " n\\'est pas valide. Seuls les fichiers CSV sont autorisés.');</script>";
    } elseif ($fileSize > 4000000) {
        echo "<script>alert('La taille du fichier " . htmlspecialchars($fileName) . " dépasse la limite de 4Mo.');</script>";
    } elseif ($filiereName != $fileName) {
        echo "<script>alert('Le nom de fichier est invalide pour la filière sélectionnée.');</script>";
    } else {
        $destination = '../../../../storage/' . $fileName; // Remplacez 'chemin/destination/' par le chemin de destination souhaité.
        if (move_uploaded_file($fileTmpName, $destination)) {
            echo "<script>alert('Le fichier " . htmlspecialchars($fileName) . " a été téléchargé avec succès.');</script>";
            include_once "./sendcsvToDb.php";
        } else {
            echo "<script>alert('Une erreur s'est produite lors du téléchargement du fichier.');</script>";
        }
    }
}

?>

<style>
    #drop-area {
        border: 2px dashed #ccc;
        border-radius: 20px;
        width: 100%;
        height: 200px;
        padding: 20px;
        text-align: center;
    }

    #drop-area.highlight {
        border-color: purple;
    }
</style>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <form id="uploadForm" action="" method="post" enctype="multipart/form-data">
                <div id="drop-area" class="mb-4">
                    <i class="bi bi-cloud-arrow-up-fill text-success" style="font-size: 50px;"></i>
                    <h3>Glisser et Déposer le Fichier ici</h3>
                    <p>Ou cliquez pour sélectionner un fichier <span class="text-danger">(Taille Max 4Mo)</span></p>
                    <input type="file" id="fileInput" class="form-control" name="file" style="display: none;">
                </div>
                <div id="file-list" class="text-center p-3 "></div>
                <div class="text-center">
                    <button class="btn text-white w-50" style="background-color: #182253;border-radius:10px;font-size:16px;" name="submit" type="submit">Send</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    const dropArea = document.getElementById('drop-area');
    const fileInput = document.getElementById('fileInput');
    const fileList = document.getElementById('file-list');

    // Éviter le comportement par défaut pour le glisser-déposer
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, preventDefaults, false);
        document.body.addEventListener(eventName, preventDefaults, false);
    });

    // Mettre en évidence la zone de dépôt lors du survol
    ['dragenter', 'dragover'].forEach(eventName => {
        dropArea.addEventListener(eventName, highlight, false);
    });

    // Réinitialiser la mise en évidence de la zone de dépôt lors de la sortie
    ['dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, unhighlight, false);
    });

    // Gérer le téléchargement des fichiers
    dropArea.addEventListener('drop', handleDrop, false);

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    function highlight() {
        dropArea.classList.add('highlight');
    }

    function unhighlight() {
        dropArea.classList.remove('highlight');
    }

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;

        handleFiles(files);
    }

    function handleFiles(files) {
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const reader = new FileReader();

            reader.readAsDataURL(file);
            reader.onload = function() {
                const listItem = document.createElement('div');
                listItem.classList.add('alert', 'alert-success', 'mt-2');
                listItem.innerHTML = `
          <strong class=" text-danger fs-4">${file.name}</strong> 
          <span class="text-drak fs-4">(${formatBytes(file.size)})</span>
          <button type="button" class="btn btn-close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        `;
                fileList.appendChild(listItem);
            };
        }
    }

    function formatBytes(bytes, decimals = 2) {
        if (bytes === 0) return '0 Bytes';

        const k = 1024;
        const dm = decimals < 0 ? 0 : decimals;
        const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];

        const i = Math.floor(Math.log(bytes) / Math.log(k));

        return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
    }

    // Ouvrir le sélecteur de fichier lors du clic sur la zone de dépôt
    dropArea.addEventListener('click', () => {
        fileInput.click();
    });

    // Gérer la sélection de fichiers via le sélecteur de fichier
    fileInput.addEventListener('change', () => {
        const files = fileInput.files;
        handleFiles(files);
    });
</script>