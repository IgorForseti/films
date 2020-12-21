<div class="content">
    <?php if (empty($data['res'])):?> По вашему запросу "
        <?= $data['search']['q']?>" в категории
        <?php if ($data['search']['radio'] == 'start'):?>Stars
        <?php else :?>"Film name":
        <?php endif;?>ничего не найдено</p>
    <?php else:?>
        <p class="text-center">Найдено по запросу <b>"<?= $data['search']['q']?>"</b> в категории
            <?php if ($data['search']['radio'] == 'stars'):?>Stars
            <?php else :?>"<b>Film name</b>":
            <?php endif;?>
        </p>
        <table class="table text-center">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Release year</th>
                <th scope="col">Удалить</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($data['res'] as $value): ?>
                <tr>
                    <td><?= $value['id'] ?></td>
                    <td><a href="/film-details?id=<?= $value['id'] ?>" ><?= $value['title'] ?></a></td>
                    <td><?= $value['release_year'] ?></td>
                    <td>
                        <form action="delete-film" method="post" class="float-left" id="delete" name="delete">
                            <button type="submit" class="btn btn-danger btn-sm btn-secondary"
                                    onclick="return confirm('Подтвердите удаление')" name="id" value="<?= $value['id'] ?>">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>

            <?php endforeach; ?>

            </tbody>
        </table>
    <?php endif?>
</div>