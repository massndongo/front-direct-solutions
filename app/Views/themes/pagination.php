<?php $pager->setSurroundCount(2) ?>

<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center mb-0">
        <?php if ($pager->hasPrevious()) : ?>
            <li class="page-item" >
                <a href="<?= $pager->getFirst() ?>" class="page-link" aria-label="<?= lang('Pager.first') ?>">
                    <span aria-hidden="true"><i class="fa fa-fast-backward"></i> </span>
                </a>
            </li>
            <li class="page-item" >
                <a href="<?= $pager->getPrevious() ?>"  class="page-link" aria-label="<?= lang('Pager.previous') ?>">
                    <span aria-hidden="true"><i class="fa fa-angle-double-left"></i> </span>
                </a>
            </li>
        <?php endif ?>

        <?php foreach ($pager->links() as $link) : ?>
            <li <?= $link['active'] ? 'class="active"' : '' ?>  class="page-item" >
                <a href="<?= $link['uri'] ?>"  class="page-link">
                    <?= $link['title'] ?>
                </a>
            </li>
        <?php endforeach ?>

        <?php if ($pager->hasNext()) : ?>
            <li class="page-item" >
                <a href="<?= $pager->getNext() ?>"  class="page-link" aria-label="<?= lang('Pager.next') ?>">
                    <span aria-hidden="true"><i class="fa fa-angle-double-right"></i></span>
                </a>
            </li>
            <li class="page-item" >
                <a href="<?= $pager->getLast() ?>" aria-label="<?= lang('Pager.last') ?>"  class="page-link">
                    <span aria-hidden="true"><i class="fa fa-fast-forward"></i></span>
                </a>
            </li>
        <?php endif ?>
    </ul>
</nav>