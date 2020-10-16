<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UsersGroup $usersGroup
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $usersGroup->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $usersGroup->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Users Groups'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="usersGroups form content">
            <?= $this->Form->create($usersGroup) ?>
            <fieldset>
                <legend><?= __('Edit Users Group') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('permissions._ids', ['options' => $permissions]);
                    echo $this->Form->control('users._ids', ['options' => $users]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
