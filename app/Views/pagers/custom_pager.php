<?php $pager->setSurroundCount(2) ?>

<nav aria-label="Page navigation" style="margin-top: 2rem;">
    <ul style="display: flex; list-style: none; gap: 0.5rem; justify-content: center; align-items: center; padding: 0;">
        <?php if ($pager->hasPrevious()) : ?>
            <li>
                <a href="<?= $pager->getFirst() ?>" aria-label="First" style="padding: 0.5rem 0.75rem; border: 1px solid var(--line); border-radius: 0.5rem; background: #fff; color: var(--muted); font-size: 0.875rem;">«</a>
            </li>
            <li>
                <a href="<?= $pager->getPrevious() ?>" aria-label="Previous" style="padding: 0.5rem 0.75rem; border: 1px solid var(--line); border-radius: 0.5rem; background: #fff; color: var(--muted); font-size: 0.875rem;">‹</a>
            </li>
        <?php endif ?>

        <?php foreach ($pager->links() as $link) : ?>
            <li>
                <a href="<?= $link['uri'] ?>" style="padding: 0.5rem 1rem; border: 1px solid <?= $link['active'] ? 'var(--primary)' : 'var(--line)' ?>; border-radius: 0.5rem; background: <?= $link['active'] ? 'var(--primary)' : '#fff' ?>; color: <?= $link['active'] ? '#fff' : 'var(--text)' ?>; font-weight: <?= $link['active'] ? '700' : '500' ?>; font-size: 0.875rem;">
                    <?= $link['title'] ?>
                </a>
            </li>
        <?php endforeach ?>

        <?php if ($pager->hasNext()) : ?>
            <li>
                <a href="<?= $pager->getNext() ?>" aria-label="Next" style="padding: 0.5rem 0.75rem; border: 1px solid var(--line); border-radius: 0.5rem; background: #fff; color: var(--muted); font-size: 0.875rem;">›</a>
            </li>
            <li>
                <a href="<?= $pager->getLast() ?>" aria-label="Last" style="padding: 0.5rem 0.75rem; border: 1px solid var(--line); border-radius: 0.5rem; background: #fff; color: var(--muted); font-size: 0.875rem;">»</a>
            </li>
        <?php endif ?>
    </ul>
</nav>
