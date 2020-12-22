<div class="content">
    <h1 class="text-center">Films list</h1>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Release year</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data['res'] as $value): ?>
            <tr>
                <td><?= $value['id'] ?></td>
                <td><a href="/film-details?id=<?= $value['id'] ?>"><?= $value['title'] ?></a></td>
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
    <?php if (empty($data['res'])) :?>
    <div class="col-3 m-auto pe-auto">
        <p class="text-center alert-info" >No films added</p>
    </div>
    <?php elseif ($data['count_page'] > 1):?>
        <?php require VIEW ."pagination.php"?>
    <?php endif; ?>
</div>