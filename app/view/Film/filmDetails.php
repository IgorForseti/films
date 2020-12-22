<div class="content">
    <h1 class="text-center">Details about "<?= $data['res'][0]['title'] ?>"</h1>
    <table class="table text-center">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Release year</th>
            <th scope="col">Format</th>
            <th scope="col">Stars</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data['res'] as $value): ?>
            <tr>
                <td><?= $value['id'] ?></td>
                <td><?= $value['title'] ?></td>
                <td><?= $value['release_year'] ?></td>
                <td><?= $value['format'] ?></td>
                <td><?php $i=0; foreach ($value['stars'] as $stars => $link) :?>
                        <a href="search?radio=stars&q=<?= $link ?>"><?= $stars ?></a>
                        <?php $i++; if ($i != count($value['stars'])) echo ", "?>
                    <?php endforeach;?>
                </td>
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
    <?php if (empty($data['res'])) :?>
        <div class="col-3 m-auto pe-auto">
            <p class="text-center alert-info" >There is no such film</p>
        </div>
    <?php endif; ?>
</div>