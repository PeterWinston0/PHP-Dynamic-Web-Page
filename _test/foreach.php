<!-- <?php

$blog = [
    [
        'title' => 'Alpha',
        'content' => 'Alpha content',
    ],
    [
        'title' => 'Beta',
        'content' => 'Beta content',
    ],
];

$idx = 0;
?>
<script>
    function contentRead(id) {
        var x = document.getElementById(id);
        if (x.style.display === "block") {
            x.style.display = "none";
        } else {
            x.style.display = "block";
        }
    }
</script>

<div class="content">
    <?php foreach ($blog as $row) : ?>
        <?php $id = 'content-' . $idx++; ?>
        <div class="chapter" onclick="contentRead('<?php echo $id; ?>')">
            <div class="cover"></div>
            <h2 class="title"><?= $row ["title"]; ?></h2>
            <p class="essay" id="<?php echo $id; ?>" style="display:none"><?php echo $row ["content"]; ?></p>
        </div>
    <?php endforeach ?>
</div> -->










<!-- WORKING -->
<!-- <script>
function contentRead(id) {
    var x = document.getElementById(id);
    if (x.style.display === "block") {
        x.style.display = "none";
    } else {
        x.style.display = "block";
    }
}
</script>

<?php $id = 'content-' . $idx++; ?>
<div class="chapter" onclick="contentRead('<?php echo $id; ?>')">
    <div class="cover"></div>
    <h2><?= $row ["first_name"]; ?></h2>
    <p id="<?php echo $id; ?>" style="display:none"><?php echo $row ["title"]; ?></p>
</div> -->