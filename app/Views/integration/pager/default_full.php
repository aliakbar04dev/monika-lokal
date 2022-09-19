<?php

use CodeIgniter\Pager\PagerRenderer;

/**
 * @var PagerRenderer $pager
 */
$pager->setSurroundCount(2);
?>
<div class="container" style="font-size:11px;">
	<div class="row">
		<div class="col-lg-12">
			<nav aria-label="<?= lang('Pager.pageNavigation') ?> Page navigation example" class="pt-4">
				<ul class="pagination justify-content-center">
					<?php if ($pager->hasPrevious()) : ?>
						<li class="page-item">
							<a class="page-link" href="<?= $pager->getFirst() ?>" aria-label="<?= lang('Pager.first') ?>">
								<?= lang('Pager.first') ?>
							</a>
						</li>
						<li class="page-item">
							<a class="page-link" href="<?= $pager->getPrevious() ?>" aria-label="<?= lang('<') ?>">
								<?= lang('<') ?>
							</a>
						</li>
					<?php endif ?>

					<?php foreach ($pager->links() as $link) : ?>
						<li class="page-item <?= $link['active'] ? 'active' : '' ?>">
							<a class="page-link" href="<?= $link['uri'] ?>">
								<?= $link['title'] ?>
							</a>
						</li>
					<?php endforeach ?>

					<?php if ($pager->hasNext()) : ?>
						<li class="page-item">
							<a class="page-link" href="<?= $pager->getNext() ?>" aria-label="<?= lang('>') ?>">
								<?= lang('>') ?>
							</a>
						</li>
						<li class="page-item">
							<a class="page-link" href="<?= $pager->getLast() ?>" aria-label="<?= lang('Pager.last') ?>">
								<?= lang('Pager.last') ?>
							</a>
						</li>
					<?php endif ?>
				</ul>
			</nav>
		</div>
	</div>
</div>
