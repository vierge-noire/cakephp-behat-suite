<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UsersGroup[]|\Cake\Collection\CollectionInterface $usersGroups
 */
?>
<div class="usersGroups index content">
    <?= $this->Html->link(__('New Users Group'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Users Groups') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usersGroups as $usersGroup): ?>
                <tr>
                    <td><?= $this->Number->format($usersGroup->id) ?></td>
                    <td><?= h($usersGroup->name) ?></td>
                    <td><?= h($usersGroup->created) ?></td>
                    <td><?= h($usersGroup->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $usersGroup->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $usersGroup->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $usersGroup->id], ['confirm' => __('Are you sure you want to delete # {0}?', $usersGroup->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
