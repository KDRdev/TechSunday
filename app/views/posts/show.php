<?php require APPROOT . '/views/inc/header.phtml'; ?>
<div class="container">
  <h1><?php echo $data['post']->title; ?></h1>
  <p><?php echo $data['post']->body; ?></p>
  <form action="<?php echo URLROOT; ?>posts/delete/<?php echo $data['post']->id; ?>" method="post">
    <button type="submit" class="btn btn-danger">Delete</button>
  </form>
</div>
<?php require APPROOT . '/views/inc/footer.phtml'; ?>