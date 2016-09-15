<div>
  <ul>
    <li><?= $this->linkToIf($this->post->previous_id(), $this->t('.previous'), array('post#show', 'id' => $this->post->previous_id())) ?> <?= $this->linkToIf($this->post->next_id(), $this->t('.next'), array('post#show', 'id' => $this->post->next_id())) ?> <?= $this->linkTo($this->t('.random'), 'post#random') ?></li>
    <?php if ($this->post->parent_id) : ?>
      <li><?= $this->linkTo($this->t('.parent'), array('post#show', 'id' => $this->post->parent_id)) ?></li>
    <?php endif ?>
  </ul>
</div>
