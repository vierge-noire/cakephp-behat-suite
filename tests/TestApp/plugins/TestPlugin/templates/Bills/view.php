<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $bill
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Bill'), ['action' => 'edit', $bill->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Bill'), ['action' => 'delete', $bill->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bill->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Bills'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Bill'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="bills view content">
            <h3><?= h($bill->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Customer') ?></th>
                    <td><?= $bill->has('customer') ? $this->Html->link($bill->customer->name, ['controller' => 'Customers', 'action' => 'view', $bill->customer->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Article') ?></th>
                    <td><?= $bill->has('article') ? $this->Html->link($bill->article->title, ['controller' => 'Articles', 'action' => 'view', $bill->article->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($bill->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Amount') ?></th>
                    <td><?= $this->Number->format($bill->amount) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($bill->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($bill->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
