<?php require APPROOT . '/views/inc/header.phtml'; ?>
<?php flash('post_message'); ?>
<?php foreach ($data['posts'] as $post) : ?>
<div class="row post-wrapper">
  <a href="<?php echo $post->url; ?>">
    <img class="post-thumbnail" src="" alt="">
    <h2><?php echo $post->title; ?></h2>
    <span>3 min read</span>
  </a>
</div>
<?php endforeach; ?>
<?php require APPROOT . '/views/inc/footer.phtml'; ?>
