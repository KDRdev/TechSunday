<?php require APPROOT . '/views/inc/header.phtml'; ?>
<div class="container">
  <?php flash('post_message'); ?>
  <?php foreach ($data['posts'] as $post) : ?>
  <div class="row post-wrapper">
    <div class="col-12">
      <img class="post-thumbnail" src="" alt="">
      <a href="posts/show/<?php echo $post->postId; ?>">
        <h2><?php echo $post->title; ?></h2>
      </a>
    </div>
  </div>
  <?php endforeach; ?>
</div>
<?php require APPROOT . '/views/inc/footer.phtml'; ?>
