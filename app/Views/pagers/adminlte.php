<?php
/**
 * Pager template mengikuti komponen pagination Bootstrap 5 / AdminLTE 4.
 *
 * @var CodeIgniter\Pager\PagerRenderer $pager
 */
$pager->setSurroundCount(2);

$total = (int) $pager->getTotal();
$from  = $total > 0 ? (int) $pager->getPerPageStart() : 0;
$to    = $total > 0 ? (int) $pager->getPerPageEnd() : 0;
?>
<div class="d-flex justify-content-between align-items-center mt-3 flex-wrap gap-2">
  <div class="text-muted small">
    Showing <?= $from ?> to <?= $to ?> of <?= $total ?> entries
  </div>
  <ul class="pagination pagination-sm m-0">
    <?php if ($pager->hasPrevious()): ?>
      <li class="page-item">
        <a class="page-link" href="<?= $pager->getPrevious() ?>" aria-label="Sebelumnya">&laquo;</a>
      </li>
    <?php else: ?>
      <li class="page-item disabled">
        <span class="page-link">&laquo;</span>
      </li>
    <?php endif; ?>

    <?php if ($pager->hasPreviousPage()): ?>
      <li class="page-item">
        <a class="page-link" href="<?= $pager->getFirst() ?>"><?= $pager->getFirstPageNumber() ?></a>
      </li>
      <li class="page-item disabled"><span class="page-link">&hellip;</span></li>
    <?php endif; ?>

    <?php foreach ($pager->links() as $link): ?>
      <li class="page-item <?= $link['active'] ? 'active' : '' ?>">
        <a class="page-link" href="<?= $link['uri'] ?>"><?= $link['title'] ?></a>
      </li>
    <?php endforeach; ?>

    <?php if ($pager->hasNextPage()): ?>
      <li class="page-item disabled"><span class="page-link">&hellip;</span></li>
      <li class="page-item">
        <a class="page-link" href="<?= $pager->getLast() ?>"><?= $pager->getLastPageNumber() ?></a>
      </li>
    <?php endif; ?>

    <?php if ($pager->hasNext()): ?>
      <li class="page-item">
        <a class="page-link" href="<?= $pager->getNext() ?>" aria-label="Berikutnya">&raquo;</a>
      </li>
    <?php else: ?>
      <li class="page-item disabled">
        <span class="page-link">&raquo;</span>
      </li>
    <?php endif; ?>
  </ul>
</div>