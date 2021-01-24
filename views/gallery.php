<?php
    session_start();
    if(!isset($_SESSION['id'])){
        header('Location:login.php');
        exit;
    }
    require_once "../layouts/header.php";
    require_once "../layouts/nav.php";
    require_once "../vendor/helpers/helpers.php";
    require_once "../controllers/file/getUserFiles.php";
    require_once "../vendor/helpers/helpers.php";
?>

    <button class="new-folder" id="newFolder">
        <img src="https://img.icons8.com/color/48/000000/folder-invoices--v2.png" alt=""/>
    </button>
    <main class="container gallery-container">
        <div class="folders-container">
            <h2>My Folders</h2>
            <div class="no-item">
                <?php if(count($folders ?? []) === 0): ?>
                    <img src="../src/img/folder.png" alt="no folder image">
                <?php endif;?>
            </div>
            <div class="folders">
                <?php foreach ($folders as $folder): ?>
                    <a href="?folder=<?= urlencode($currentFolder."/".$folder)?>">
                        <img src="https://img.icons8.com/color/48/000000/folder-invoices--v2.png" alt=""/>
                        <?= str_replace($_SESSION['name']."##","",$folder) ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="files-container">
            <h2>My Files</h2>
            <div class="no-item">
                <?php if(count($media ?? []) === 0): ?>
                    <img src="../src/img/file.png" alt="no file image">
                <?php endif;?>
            </div>
            <div class="files">
                <?php foreach ($media as $myFile): ?>
                    <?php if(file_type($myFile) === "img"): ?>
                        <img src="<?=  str_replace("#","%23",$currentFolder)."/".urlencode($myFile) ?>" alt="file">
                    <?php elseif(file_type($myFile) === "video"): ?>
                        <video src="<?= str_replace("#","%23",$currentFolder)."/".urlencode($myFile) ?>" controls></video>
                    <?php elseif(file_type($myFile) === "audio"): ?>
                        <audio src="<?=  str_replace("#","%23",$currentFolder)."/".urlencode($myFile) ?>" controls></audio>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </main>
    <div id="modal" class="overlay">
        <div class="auth-container">
            <h2>import your file</h2>
            <form action="../controllers/file/upload.php" method="post" enctype="multipart/form-data">
                <input type="hidden" value="<?= $currentFolder ?>" name="location" required>
                <label for="ordinary-file">File</label>
               <div class="file-custom">
                   <input type="file" name="file" id="ordinary-file" required>
                   <div tabindex="0" id="custom-file">
                       <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                       browse your files
                   </div>
               </div>
                <input type="submit" value="submit">
            </form>
        </div>
        <div class="auth-container">
            <h2>Create new folder</h2>
            <form action="../controllers/file/makeFolder.php" method="post">
                <label for="folder">Folder Name :</label>
                <input type="text" name="new_folder" id="folder" required>
                <input type="hidden" name="location" value="<?= $currentFolder ?>" required>
                <input type="submit" value="confirm">
            </form>
        </div>
    </div>
<?php
require_once "../layouts/footer.php"
?>
