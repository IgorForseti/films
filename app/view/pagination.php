<div class="center-block"></div>
<nav aria-label="Page navigation example">
    <?php if ($data['count_page']>=9) :?>
    <ul class="pagination">
        <?php if ($data['current_page'] != 1):?>
        <li class="page-item"><a class="page-link" href="/?page=<?= $data['current_page'] - 1?>">Prev</a></li>
        <?php endif?>
        <li class="page-item <?php if($data['current_page'] == 1) echo "active"?>"><a class="page-link" href="/?page=1">1</a></li>

        <?php if ($data['current_page'] >= 5):?>
        <li class="page-item"><a class="btn disabled" href="#" role="button" aria-disabled="true">..</a></li>
        <?php endif?>

        <?php if ($data['current_page']  < 5) : ?>
            <?php for ($i = 2;  ($i <= 5); $i++) : ?>
            <li class="page-item <?php if($data['current_page'] == $i) echo "active"?>">
                <a class="page-link" href="/?page=<?= $i . "\">" . $i?></a></li>
            <?php endfor;?>
        <?php elseif ($data['current_page']+3  >= $data['count_page']) : ?>
            <?php for ($i = $data['count_page'] - 4;  $i < $data['count_page']; $i++) : ?>
            <li class="page-item <?php if($data['current_page'] == $i) echo "active"?>">
                <a class="page-link" href="/?page=<?= $i . "\">" . $i?></a></li>
            <?php endfor;?>
        <?php else : ?>
            <?php for ($i = $data['current_page']-2;   $i <= $data['current_page']+2; $i++) : ?>
            <li class="page-item <?php if($data['current_page'] == $i) echo "active"?>">
                <a class="page-link" href="/?page=<?= $i . "\">" . $i?></a></li>
            <?php endfor;?>
        <?php endif; ?>

        <?php if ($data['count_page'] - $data['current_page'] >= 4):?>
            <li class="page-item"><a class="btn disabled" href="#" role="button" aria-disabled="true">..</a></li>
        <?php endif?>
        <li class="page-item <?php if($data['current_page'] == $i) echo "active"?>">
            <a class="page-link" href="/?page=<?= $data['count_page'] . "\">" . $data['count_page']?></a></li>
        <?php if ($data['current_page'] < $data['count_page']):?>
            <li class="page-item"><a class="page-link" href="/?page=<?= $data['current_page']+1 ?>">Next</a></li>
        <?php endif?>
    </ul>
    <?php else:?>
    <ul>
        <?php if ($data['current_page'] > 1):?>
        <li class="page-item"><a class="page-link" href="/?page=<?= $data['current_page'] - 1?>">Prev</a></li>
        <?php endif?>

        <?php for ($i = 1; $i++; $i < $data['count_page']):?>
            <li class="page-item <?php if($data['current_page'] == $i) echo "active"?>">
                <a class="page-link" href="/?page=<?= $i . "\">" . $i?></a></li>
        <?php endfor;?>

        <?php if ($data['current_page'] < $data['count_page']):?>
            <li class="page-item"><a class="page-link" href="/?page=<?= $data['current_page']+1 ?>">Next</a></li>
        <?php endif?>
    </ul>
    <?php endif;?>
</nav>