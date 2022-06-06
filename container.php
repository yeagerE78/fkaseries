<?php
require_once('public/action/connection.php');
if (isset($_GET['id']) != '') {
    $id =  $_GET['id'];
    $stmt = $conn->prepare('SELECT * FROM series WHERE id = :id');
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC) ?>
    <div class="container py-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php" class="text-white">หน้าแรก</a></li>
                <li class="breadcrumb-item"><a href="#" class="text-white text-capitalize disabled"><?php echo $row['title'] ?></a></li>
            </ol>
        </nav>
        <div class="d-flex justify-content-center flex-column flex-sm-row border-bottom ">
            <div class="dog-play">
                <?php
                $id =  $_GET['id'];
                $stmtpart = $conn->prepare('SELECT * FROM part WHERE seriesid = :id');
                $stmtpart->bindParam(':id', $id);
                $stmtpart->execute();
                ?>
                <?php
                if ($stmtpart->rowCount() != 1) {
                    while ($rowpart = $stmtpart->fetch(PDO::FETCH_ASSOC)) { ?>
                        <a href="index.php?id=<?php echo $id ?>&part=<?php echo $rowpart['part'] ?>" class="btn btn-outline-primary mb-2">ตอนที่ <?php echo $rowpart['part'] ?></a>
                <?php }
                }  ?>

                <?php
                if (isset($_GET['part'])) {
                    $part = $_GET['part'];
                } else {
                    $part = 1;
                }
                $stmtparturl = $conn->prepare('SELECT * FROM part WHERE part = :part and seriesid = :id');
                $stmtparturl->bindParam(':part', $part);
                $stmtparturl->bindParam(':id', $id);
                $stmtparturl->execute();
                $rowparturl = $stmtparturl->fetch(PDO::FETCH_ASSOC);
                ?>
                <iframe class="mb-2" src="<?php echo $rowparturl['parturl'] ?>" frameborder="0" allowfullscreen></iframe>
                <?php echo $part ?>
            </div>
        </div>

        <div class="recommend mt-2 d-none d-lg-block border-top border-bottom">
            <h4 class="text-white mt-2 ">ที่คุณชอบ</h4>
            <div class=" d-flex flex-row flex-wrap justify-content-start ps-5">
                <?php for ($i = 0; $i < 8; $i++) { ?>
                    <div class=" m-2 ms-0">
                        <a href="index.php?id=1">
                            <div class="cat">
                                <img class="cat-img" src="public/image/bts.jpg" alt="">
                                <p class="cat-p px-1 pt-1 text-white">better call saul season 1</p>
                                <span class="cat-span p-1 bg-danger text-white fw-bold">HD</span>
                                <span class="cat-im p-1 bg-secondary text-white fw-bold">8.8/10</span>
                            </div>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="recommend mt-2 d-none d-lg-block border-top border-bottom">
            <h4 class="text-white mt-2 ">แนะนำสำหรับคุณ</h4>
            <div class=" d-flex flex-row flex-wrap justify-content-start ps-5">
                <?php for ($i = 0; $i < 8; $i++) { ?>
                    <div class=" m-2 ms-0">
                        <a href="index.php?id=1">
                            <div class="cat">
                                <img class="cat-img" src="public/image/bts.jpg" alt="">
                                <p class="cat-p px-1 pt-1 text-white">better call saul season 1</p>
                                <span class="cat-span p-1 bg-danger text-white fw-bold">HD</span>
                                <span class="cat-im p-1 bg-secondary text-white fw-bold">8.8/10</span>
                            </div>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>

    </div>

    <?php } else if (isset($_GET['all'])) {
    $stmt = $conn->prepare('SELECT * FROM series ORDER BY id DESC');
    $stmt->execute();
    if ($stmt->rowCount() > 0) { ?>
        <div class="container my-3 py-2 border-top border-bottom">
            <div class="mb-2" id="new">
                <div class="w-100 d-flex">
                    <p class="h5 text-light ms-5 me-3">ซีรี่ย์/หนังทั้งหมด</p>
                    <a href="index.php">กลับหน้าแรก</a>
                </div>
                <div class=" d-flex flex-row flex-wrap justify-content-start ps-5">
                    <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                        <div class=" m-2 ms-0">
                            <a href="index.php?id=<?php echo $row['id'] ?>">
                                <div class="cat">
                                    <img class="cat-img" src="public/image/<?php echo $row['image'] ?>" alt="">
                                    <p class="cat-p px-1 pt-1 text-white"><?php echo $row['title'] ?></p>
                                    <span class="cat-span p-1 bg-danger text-white fw-bold text-uppercase"><?php echo $row['resolution'] ?></span>
                                    <span class="cat-im p-1 bg-secondary text-white fw-bold"><?php echo $row['imdb'] ?>/10</span>
                                </div>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    <?php } ?>
    <?php } else {
    $stmt = $conn->prepare('SELECT * FROM series ORDER BY id DESC limit 18');
    $stmt->execute();
    if ($stmt->rowCount() > 0) { ?>
        <div class="container my-3 py-2 border-top border-bottom">
            <div class="mb-2" id="new">
                <div class="w-100 d-flex">
                    <p class="h5 text-light ms-5 me-3">อัปเดตใหม่ล่าสุด</p>
                    <a href="index.php?all" class="text-warning">ดูทั้งหมด</a>
                </div>
                <div class=" d-flex flex-row flex-wrap justify-content-start ps-5">
                    <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                        <div class=" m-2 ms-0">
                            <a href="index.php?id=<?php echo $row['id'] ?>">
                                <div class="cat">
                                    <img class="cat-img" src="public/image/<?php echo $row['image'] ?>" alt="">
                                    <p class="cat-p px-1 pt-1 text-white"><?php echo $row['title'] ?></p>
                                    <span class="cat-span p-1 bg-danger text-white fw-bold text-uppercase"><?php echo $row['resolution'] ?></span>
                                    <span class="cat-im p-1 bg-secondary text-white fw-bold"><?php echo $row['imdb'] ?>/10</span>
                                </div>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    <?php }  ?>

    <?php
    $stmttype = $conn->prepare('SELECT * FROM type ORDER BY id DESC');
    $stmttype->execute();
    while ($rowtype = $stmttype->fetch(PDO::FETCH_ASSOC)) { ?>
        <div class="container my-3 py-2 border-top border-bottom">
            <div class="mb-2" id="new">
                <div class="w-100 d-flex">
                    <p class="h5 text-light ms-5 me-3 text-capitalize"><?php echo $rowtype['category'] ?></p>
                </div>
                <div class=" d-flex flex-row flex-wrap justify-content-start ps-5">
                    <?php
                    $category = $rowtype['category'];
                    $stmtcategory = $conn->prepare('SELECT * FROM series WHERE category=:category');
                    $stmtcategory->bindParam(':category', $category);
                    $stmtcategory->execute();
                    while ($rowcategory = $stmtcategory->fetch(PDO::FETCH_ASSOC)) { ?>
                        <div class=" m-2 ms-0">
                            <a href="index.php?id=<?php echo $rowcategory['id'] ?>">
                                <div class="cat">
                                    <img class="cat-img" src="public/image/<?php echo $rowcategory['image'] ?>" alt="">
                                    <p class="cat-p px-1 pt-1 text-white"><?php echo $rowcategory['title'] ?></p>
                                    <span class="cat-span p-1 bg-danger text-white fw-bold"><?php echo $rowcategory['resolution'] ?></span>
                                    <span class="cat-im p-1 bg-secondary text-white fw-bold"><?php echo $rowcategory['imdb'] ?>/10</span>
                                </div>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    <?php } ?>

<?php } ?>